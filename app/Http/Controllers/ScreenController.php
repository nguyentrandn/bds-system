<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\FundPublic;
use App\Models\FundApplication;
use App\Models\User;
use App\Models\Fund;
use App\Models\Investor;
use App\Models\TemporaryRegister;
use App\Models\FundMessage;
use App\Models\UserMessage;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Throwable;

class ScreenController extends BaseController
{
    public function __construct()
    {

    }

    public function renderHomeScreen() {
        // Get just first page of data!!!
        $items = FundPublic::listData([], [], 1);

        $paginations = [];
        for($i=1; $i <= ceil( $items->total() / $items->perPage() ); $i++) {
            $paginations[] = $i;
        }

        $notices = Notice::listData([
            [
                'column_name' => '公開先',
                'search_operator' => '=',
                'value' => '全員（マイページ＋TOPページ）',
            ]
        ]);

        return view('index', [
            'items' => $items,
            'paginations' => $paginations,
            'notices' => $notices,
        ]);
    }

    public function renderNoticeListPage() {
        $notices = Notice::listData([
            [
                'column_name' => '公開先',
                'search_operator' => '=',
                'value' => '全員（マイページ＋TOPページ）',
            ]
        ]);

        return view('notice', [
            'notices' => $notices,
        ]);
    }

    /**
     * Render notice detail page.
     */
    public function renderNoticeDetailPage(Request $request) {
        $message = Notice::find($request->notice_id);
    
        if(!$message) {
            return view('errors.404', []);
        }
        
        if(!$message) {
            return view('errors.404', []);
        }

        // Set view status
        if(auth('user')->user()) {
            DB::table('message_read')
                ->insert([
                    'message_id'   => $request->notice_id,
                    'message_type' => 'notice',
                    'read_at'      => Carbon::now(),
                ]);
        }

        // Parse attachments
        $message_attachments = json_decode($message->添付ファイル) ?? [];

        $params['message'] = $message;
        $params['message_attachments'] = $message_attachments;
        $params['is_notice_detail_page'] = true;

        return view('/user/my61', [
            'user'   => auth('user')->user(),
            'params' => $params,
        ]);
    }

    public function redirectToHomeAdmin() {
        return redirect('/admin/FD10');
    }

    public function renderScreen($screen) {
        return view($screen, [
            'admin' => auth('admin')->user(),
            'user'  => auth('user')->user(),
        ]);
    }

    public function renderUserMyPage() {
        $conditions = [
            [
                'column_name' => 'user_id',
                'search_operator' => '=',
                'value' => auth('user')->user()->id,
            ]
        ];  

        $current_investment_amount = 0;
        $cumulative_investment_amount = 0;
        $cumulative_distribution_amount_before_tax = 0;

        $investment_history =  Investor::listInvestmentDistributionStatus($conditions);

        foreach($investment_history as $item) {
            if($item->ファンドステータス == '運用中') {
                $current_investment_amount += $item->償還金合計_number;
            }

            if($item->ファンドステータス == '用終了') {
                $cumulative_investment_amount += $item->償還金合計_number;
            }

            $cumulative_distribution_amount_before_tax += $item->分配金合計（税引後）_number;
        }

        return view('user/my10', [
            'user'   => auth('user')->user(),
            'current_investment_amount'                 => $current_investment_amount,
            'cumulative_investment_amount'              => $cumulative_investment_amount,
            'cumulative_distribution_amount_before_tax' => $cumulative_distribution_amount_before_tax
        ]);
    }

    public function renderUserProfilePage() {
        return view('/user/my70', [
            'user'   => auth('user')->user(),
        ]);
    }


    public function renderFunDetailPage(Request $request) {
        $fund = Fund::find($request->fund_id);
        $fund_public_data = FundPublic::findById($request->fund_id);

        if(!$fund) {
            return view('errors.404',['message' => __('fund not exist')]);
        }

        if($fund_public_data) {
            $fund->応募金額 = $fund_public_data->応募金額;
            $fund->残り日数 = $fund_public_data->残り日数;
            $fund->ファンドステータス = $fund_public_data->ファンドステータス;
            $fund->reach_percent = $fund_public_data->reach_percent;
            $fund->募集開始予定 = $fund_public_data->募集開始予定;
        } else {
            $fund->応募金額 = 0;
            $fund->残り日数 = 0;
            $fund->reach_percent = 0;
            $fund->ファンドステータス = '作成中';
            $fund->募集開始予定 = '';
        }

        $is_applied = false;

        if(auth('user')->user()) {
            $apply_data = FundApplication::query()->where('user_id', auth('user')->user()->id)
                                                  ->where('fund_id', $request->fund_id)
                                                  ->whereNull('deleted_at')
                                                  ->first();
                                                
            if($apply_data) {
                $is_applied = true;
            }
        }

        /**
         * Set popup to show
         */

        $popup_to_show = ''; // Default is nothing.

        if(!auth('user')->user()) {
            // Show popup request user login to apply.
            $popup_to_show = 'login';
        } else {
            // Show popup request confirm identify information.
            if(!auth('user')->user()->identity_verification_flag)  {
                $popup_to_show = 'verify';
            } else {
                // Show popup request input enough information if user still not allowed to investment.
                if(!auth('user')->user()->allow_investment_flag) {
                    $popup_to_show = 'profile';
                }
            }
        }

        return view('/fund/fu20', [
            'user'   => auth('user')->user(),
            'fund'   => $fund,
            'popup_to_show' => $popup_to_show,
            'is_applied' => $is_applied,
        ]);
    }

    public function renderFundListPage(Request $request) {
        $conditions = [];

        if(isset($request->ファンドステータス)) {
            $conditions[] = [
                'column_name' => 'ファンドステータス',
                'search_operator' => '=',
                'value' => $request->ファンドステータス,
            ];  
        }

        $items = FundPublic::listData($conditions, [], $request->page ?? 1);

        $paginations = [];
        for($i=1; $i <= ceil( $items->total() / $items->perPage() ); $i++) {
            $paginations[] = $i;
        }

        return view('/fund/fu10', [
            'user'          => auth('user')->user(),
            'items'         => $items,
            'paginations'   => $paginations,
        ]);
    }

    public function renderScreenWithSubFolder(Request $request, $folder, $screen) {
        $params = [];

        /**
         * Verify required login route.
         */
        $require_user_login_routes = [
            'user/my20',
            'user/my30',
            'user/my40',
            'user/my50',
        ];

        $is_required_login_route = false;

        foreach($require_user_login_routes as $path) {
            if( $request->path() == $path ) {
                $is_required_login_route = true;
            }
        }

        if(!auth('user')->user() && $is_required_login_route ) {
            return redirect()->to('/signin');
        }
        // ------------------------------------------------------------

        /**
         * Fund detai screen (FD30)
         */
        if($screen === 'FD30') {
            $fund_id = request()->get('fund_id');

            $fundPublic = FundPublic::where('fund_id', $fund_id )->first();
            $fund_status = DB::table('v_fund_list')->where('id', $fund_id )->first();

            $params['fund_status'] = $fund_status->ファンドステータス;
            $params['show_button'] = false;
            $params['button_text'] = '公開';
            
            if(!$fundPublic) {
                $params['fund_published'] = false;
                $params['show_button'] = true;
                $params['button_text'] = '公開';
            } else {
                $params['fund_published'] = true;


                if(in_array($fund_status->ファンドステータス, ['募集終了', '運用中', '運用終了'])) {
                    $params['show_button'] = true;
                    $params['button_text'] = 'ファンド不成立';
                }

                if($fund_status->ファンドステータス === '不成立') {
                    $params['show_button'] = false;
                    $params['button_text'] = 'ファンド不成立';
                }
            }
        }

        /**
         * Admin - user detail profile (US20)
         */
        if($screen === 'US20') {
            $user = User::find($request->user_id);
            $params['user'] = $user;
        }

        /**
         * RG20 (User enter profile screen)
         */
        if($screen === 'rg20' || $screen === 'rg21') {
            $user = TemporaryRegister::query()->where('invitation_token' , '=' ,  md5(config('filesystems.scretkey').$request->invitation_token))->first();

            if(!$user){
                return view('errors.404', ['message' => __('invitaion token is not exist')]);
            }
    
            if($user && Carbon::now()->gt($user->invitation_token_expired_at)){
                return view('errors.404',['message' => __('invitaion token is expired')]);
            }

            $params['user'] = $user;
        }

        /**
         * CP20 ( Reset password screen )
         */
        if($screen === 'cp20') {
            $user = User::query()->where('reset_password_token' , '=' ,  md5(config('filesystems.scretkey').$request->reset_password_token))->first();

            if(!$user){
                return view('errors.404', ['message' => __('reset password token is not exist')]);
            }
    
            if($user && Carbon::now()->gt($user->reset_password_token_expired_at)){
                return view('errors.404',['message' => __('link reset is expired')]);
            }

            $params['user'] = $user;
        }

        /**
         * MY61 Message detail page
         */
        if($screen === 'my61') {
            $message = null;


            if($request->message_type == 'fund_message') {
                $message = FundMessage::find($request->message_id);
            } 
            else if ($request->message_type == 'user_message')  {
                $message = UserMessage::find($request->message_id);
            }
            else if ($request->message_type == 'notice')  {
                $message = Notice::find($request->message_id);
            }

            if(!$message) {
                return view('errors.404', []);
            }
            // Set view status
            if(auth('user')->user()) {
                DB::table('message_read')
                    ->insert([
                        'message_id'   => $request->message_id,
                        'message_type' => $request->message_type,
                        'read_at'      => Carbon::now(),
                    ]);
            }

            // Parse attachments
            $message_attachments = json_decode($message->添付ファイル) ?? [];

            $params['message'] = $message;
            $params['message_attachments'] = $message_attachments;
        }

        try {
            return view($folder . '.' . $screen, [
                'admin'  => auth('admin')->user(),
                'user'   => auth('user')->user() ,
                'params' => $params
            ]);
        } catch(Throwable $ex) {
            return view('errors.404', []);
        }
    }

    public function renderScreenWithMultipleSubFolder($folder1, $folder2, $screen) {
        try {
            return view($folder1 . '.' .  $folder2 . '.' . $screen, [
                'admin' => auth('admin')->user()
            ]);
        } catch(Throwable $ex) {
            return view('errors.404', []);
        }
    }
}
