<?php

namespace App\Http\Controllers\Api;

use App\Jobs\TriggerSendEmail;
use App\Mail\NotifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Rules\ValidUserPass;

class UserAuthController extends ApiController
{
    public function __construct(){
    }

    public function renderSigninPage(Request $request){
        session(['url.intended' => url()->previous()]);
        
        return view('login/lg10');
    }

    /**
     * Signin
     */
    public function signin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'submit' => false,
                'message' => $validator->errors()
            ], CLIENT_ERROR);
        }

        $user = User::where('メールアドレス', $request->email)->whereNull('deleted_at')->first();

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => __('email or password invalid')
            ], AUTHEN_ERROR);
        }
        
        if (!auth('user')->attempt([ 'メールアドレス' => $request->email, 'password' => $request->password ])) {
            return response()->json([
                'success' => false,
                'message' => __('email or password invalid')
            ], CLIENT_ERROR);
        }

        $user = User::find(auth('user')->user()->id);
        $user->last_login_at = Carbon::now();
        $user->save();

        $previous_url = session()->pull('url.intended');

        $allowedRedirectURLs = [
            '/my-page',
            '/fund/detail',
            '/fund',
        ];

        $allow_redirect = false;
        foreach($allowedRedirectURLs as $url) {
            if(str_contains($previous_url, $url)) {
                $allow_redirect = true;
            }
        }

        if(!$allow_redirect) {
            $previous_url = '/my-page';
        }

        return response()->json([
            'success' => true,
            'previous_url' => $previous_url,
        ], SUCCESS);
    }

    /**
     * Signout
     */
    public function signout(Request $request) {
        auth('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Send email reset password
     */
    public function emailResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'メールアドレス' => 'required',
            '秘密の質問' => 'required',
            '秘密の質問（答え）' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'submit' => false,
                'message' => $validator->errors()
            ], CLIENT_ERROR);
        }

        try {
            $data = $request->all();
            $currentTime = Carbon::now('Asia/Tokyo');

            $user = User::query()->where('メールアドレス', $request->メールアドレス)
                                 ->where('秘密の質問', $request->秘密の質問)
                                 ->where('秘密の質問（答え）', $request->秘密の質問（答え）)
                                 ->whereNull('deleted_at')
                                 ->first();

            if(!$user) {
                return response()->json([
                    'success' => false,
                    'submit' => false,
                    'message' => __('account no longer exists'),
                ], CLIENT_ERROR);
            }

            $reset_password_token                    = md5(User::strRandom().rand(1, 10) . microtime());

            User::where('id', $user->id)
                    ->update([
                        'reset_password_token'            => md5(config('filesystems.scretkey').$reset_password_token),
                        'reset_password_token_expired_at' => Carbon::now('Asia/Tokyo')->addHours(24),
                    ]);
            
            TriggerSendEmail::dispatch([
                'user_id'              => $user->id,
                'template_id'          => 14,
                'reset_password_token' => $reset_password_token,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password'          => ['required'],
            'confirm_password'      => ['required', 'same:new_password'],
            'reset_password_token'  => 'required'
        ], [], [
            'new_password'          => '新しいパスワード',
            'confirm_password'      => 'パスワードの確認'
        ]);

        if($validator->fails()){
            return response()->json([
                'suscess' => false,
                'submit' => false,
                'message' => $validator->errors()->first(),
                'invalid_fields' => $validator->errors(),
            ], CLIENT_ERROR);
        }

        /**
         * パスワードには半角英数字が使用できます。アルファベットの大文字、アルファベットの小文字、
         * 数字を含む8～16文字でご設定ください。記号や全角文字（漢字やひらがな等）はお使いいただけません。
         */
        $valid_format_password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/";

        if( !preg_match($valid_format_password_pattern, $request->new_password) ) {
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

        $user = User::where('reset_password_token', md5(config('filesystems.scretkey').$request->reset_password_token))
                ->whereNull('deleted_at')
                ->first();

        if($user){
            if (Carbon::now('Asia/Tokyo')->gt(Carbon::parse($user->reset_password_token_expired_at))) {
                return response()->json([
                    'success' => false,
                    'error' => __('link reset is expired')
                ], CLIENT_ERROR);
            }

            $user->password = bcrypt($request->new_password);
            $user->reset_password_token = null;
            $user->reset_password_token_expired_at = null;
            $user->reset_password_at = Carbon::now('Asia/Tokyo');
            $user->save();

            return response()->json([
                'success' => true
            ], SUCCESS);
        }
        else {
            return response()->json([
                'success' => false,
                'error' => __("reset password token is not exist")
            ], CLIENT_ERROR);
        }
    }
}
