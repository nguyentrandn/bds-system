<?php

namespace App\Jobs;

use App\Models\Admin;
use App\Models\User;
use App\Models\Message;
use App\Models\UserContact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\UserSetting;

class TriggerSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $param;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($param)
    {
        $this->param = $param;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function handle()
    {
        /**
         * Create record in database
         */
        $id = DB::table('trigger_mail')
            ->insertGetId($this->param);

        /**
         * Get data and template
        */
        $mail = DB::table('trigger_mail')
                ->select([
                    'trigger_mail.*',
                    'mail_template_master.subject AS subject',
                    'mail_template_master.template AS template',
                ])
                ->join('mail_template_master', 'trigger_mail.template_id', '=', 'mail_template_master.id')
                ->whereNull('delivery_at')
                ->where('trigger_mail.id', '=' , $id)
                ->orderBy('created_at', 'ASC')->first();

        /**
         * Prepare delivery content
         */
        $user = null;
        $reaction_user = null;

        $params = (array) $mail;

        /**
         * Popolate user data.
         */
        if($mail->user_id) {
            $user = User::find($mail->user_id);
            if($user) {
                $params = array_merge($params, [
                    'username' => $user->お名前1 . $user->お名前2,
                    'mail_to'  => $user->メールアドレス,
                    'reset_password_token' => $mail->reset_password_token,
                ]);
            }
        }

        /**
         * Popolate admin data.
         */
        if($mail->admin_id) {
            $admin = Admin::find($mail->admin_id);
            if($admin) {
                $params = array_merge($params, [
                    'admin_name'             => $admin->fullname,
                    'mail_to'                => $admin->email,
                    'reset_password_token'   => $mail->reset_password_token,
                    'invitation_token'       => $mail->invitation_token,
                ]);
            }
        }

        /**
         * Populate user temporary register.
        */
        if($mail->mail_to) {
            $params = array_merge($params, [
                'mail_to'                => $mail->mail_to,
                'invitation_token'       => $mail->invitation_token,
                'nickname'               => $mail->mail_to,
            ]);
        }

        /**
         * Default system setting variables.
         */
        $params['app_url']   = config('app.url');
        $params['user_url']  = config('app.user_url');
        $params['admin_url']  = config('app.admin_url');
        $params['app_name']  = config('app.name');
        $params['signature'] = "
        ---------------------------------------------
        彩-SAI- 運営事務局

        運営会社
        株式会社フジハウジング
        〒346-0016
        埼玉県久喜市久喜東 2丁目 4-1
        TEL：0480-26-4568
        お問い合わせはこちら
        ---------------------------------------------
        ";


        $params['html_content'] = $params['template'];

        foreach ($params as $property => $value) {
            $params['subject']        = str_replace('{{$' . $property . '}}', $value, $params['subject']);
            $params['html_content']   = str_replace('{{$' . $property . '}}', $value, $params['html_content']);
        }

        /**
         * Adding <br> tag
         */
        $params['html_content'] = nl2br($params['html_content']);

        /**
         * Convert HTML mail to TXT mail
         */
        $params['text_content'] = strip_tags($params['html_content']);

        $delivery_at = null;

        /**
         * Sending email
         */
        if($this->checkAllowSendEmail($params)) {
            Mail::send([], [], function ($message) use ($params) {
                $message->to($params['mail_to'])
                        ->subject($params['subject'])
                        ->setBody($params['html_content'], 'text/html')
                        ->addPart($params['text_content'], 'text/plain');;
            });

            $delivery_at = Carbon::now();
        } else {
            $delivery_at = 'skip';
        }

        /**
         * Update delivery success.
         */
        DB::table('trigger_mail')
            ->where('id', $params['id'])
            ->update([
                'delivery_at'               => $delivery_at,
                'nickname'                  => $params['nickname'],
                'nickname_user_reaction'    => $params['nickname_user_reaction'],
                'mail_to'                   => $params['mail_to'],
                'subject'                   => $params['subject'],
                'html_content'              => $params['html_content'],
                'text_content'              => $params['text_content'],
            ]);
    }

    private function checkAllowSendEmail($mail) {
        return 1;
    }
}
