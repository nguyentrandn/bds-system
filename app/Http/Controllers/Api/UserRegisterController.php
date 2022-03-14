<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\TemporaryRegister;
use App\Models\User;
use App\Models\UserVerificationCode;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Jobs\TriggerSendEmail;

class UserRegisterController extends ApiController
{
    private $subjectClassModel = TemporaryRegister::class;

    public function __construct() {

    }

    /**
     * Create
     */
    public function sendEmailInvitation(Request $request){
        $fields = $request->all();
    
        $error_fields = $this->validateRequiredData($fields, []);

        if(count($error_fields) > 0) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => '必須項目です。',
                'error_fields' => $error_fields
            ], 400);
        }
        
        $data_to_insert = [];

        foreach($fields as $field) {
            $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            $data_to_insert[$field['column_name']] = $field['value'];
        }

        /**
         * Check user exists or not
         */
        $user = User::where('メールアドレス', $data_to_insert['メールアドレス'])->whereNull('deleted_at')->first();

        if($user) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => 'このメールは存在します。',
                'error_fields' => [
                    [
                        'column_name' => 'メールアドレス'
                    ]
                ]
            ], 400);
        }

        if($data_to_insert['メールアドレス'] !== $data_to_insert['メールアドレス（確認用）']) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => 'メールアドレス（確認用）が一致しません',
                'error_fields' => [
                    [
                        'column_name' => 'メールアドレス（確認用）'
                    ]
                ]
            ], 400);
        }

        if($data_to_insert['password'] !== $data_to_insert['password_confirm']) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => 'パスワードが一致しません',
                'error_fields' => [
                    [
                        'column_name' => 'password_confirm'
                    ]
                ]
            ], 400);
        }

        /**
         * パスワードには半角英数字が使用できます。アルファベットの大文字、アルファベットの小文字、
         * 数字を含む8～16文字でご設定ください。記号や全角文字（漢字やひらがな等）はお使いいただけません。
         */
        $valid_format_password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/";

        if( !preg_match($valid_format_password_pattern, $data_to_insert['password']) ) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => 'この形式は無効です。',
                'error_fields' => [
                    [
                        'column_name' => 'password'
                    ]
                ]
            ], 400);
        }

        $invitation_token = md5($this->subjectClassModel::strRandom().rand(1, 10) . microtime());
        $data_to_insert['invitation_token']            = md5(config('filesystems.scretkey').$invitation_token);
        $data_to_insert['invitation_token_expired_at'] = Carbon::now()->addHours(24);

        $data_to_insert['password'] = bcrypt($data_to_insert['password']);

        /**
         * Remove some fields just for compare confirmtion
         */
        unset($data_to_insert['メールアドレス（確認用）']);
        // unset($data_to_insert['password_confirm']);

        $record = $this->subjectClassModel::create($data_to_insert);

        TriggerSendEmail::dispatch([
            'mail_to'               => $record->メールアドレス,
            'template_id'           => 12,
            'invitation_token'      => $invitation_token
        ]);

        return self::formatResponse([
            'id' => $record->id,
        ]);
    }

    /**
     * inputProfile
     */
    public function inputProfile(Request $request, $invitation_token) {
        $fields = $request->all();
    
        $data_to_update = [];

        foreach($fields as $field) {
            $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            $data_to_update[$field['column_name']] = $field['value'];
        }

        $this->subjectClassModel::where('invitation_token', md5(config('filesystems.scretkey').$invitation_token))
                ->update($data_to_update);

        return self::formatResponse([
            'success' => true,
        ]);
    }

    /**
     * confirm and create account
     */
    public function confirmAndCreateAccount(Request $request, $invitation_token) {
        $token = md5(config('filesystems.scretkey').$request->invitation_token);

        $temp_user = TemporaryRegister::query()->where('invitation_token' , '=' ,  $token)->first();

        if(!$temp_user){
            return response()->json([
                'error' => true,
                'message' => __('invitaion token is not exist'),
            ], 400);
        }

        if($temp_user && Carbon::now()->gt($temp_user->invitation_token_expired_at)){
            return response()->json([
                'error' => true,
                'message' => __('invitaion token is expired'),
            ], 400);
        }

        unset($temp_user->invitation_token);
        unset($temp_user->invitation_token_expired_at);
        unset($temp_user->password_confirm);
        unset($temp_user->agree);
        unset($temp_user->メールアドレス（確認用）);

        /**
         * Create new user from temporary information
         */
        $user = User::create($temp_user->toArray());

        /**
         * Create user verification code
         */
        UserVerificationCode::create([
            'user_id'    => $user->id,
            'code'       => UserVerificationCode::strRandom(12),
            'created_at' => Carbon::now(),
        ]);

        /**
         * Make token inactive now.
         */
        TemporaryRegister::where('invitation_token', $token)
                ->update([
                    'invitation_token_expired_at' => Carbon::now()
                ]);

        return self::formatResponse([
            'success' => true,
        ]);
    }
}
