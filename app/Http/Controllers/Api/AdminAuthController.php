<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Validator;
use App\Mail\NotifyEmail;
use Mail;
use App\Rules\ValidAdminPass;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function __construct() {

    }

    public function getMe() {
        $current_login_admin_id = Admin::getCurrentLoginId();

        $item = Admin::findOne($current_login_admin_id,
            [
                'id', 'role', '氏名', 'email', 'created_at', 'updated_at'
            ]
        );

        if(!$item) {
            throw new Exception('Not found');
        }
        return [
            'result' => $item
        ];
    }

    public function activeAccount(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => ['required', new ValidAdminPass],
            'invitation_token' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'suscess' => false,
                'submit' => false,
                'invalid_fields' => $validator->errors()
            ], CLIENT_ERROR);
        }

        $admin = Admin::where('invitation_token', md5(config('filesystems.scretkey').$request->invitation_token))->first();
        if($admin){
            if(Carbon::now()->gt($admin->invitation_token_expired_at)) {
                return response()->json([
                    'success' => false,
                    'error' => __("invitaion token is expired")
                ], CLIENT_ERROR);
            }

            $admin->invitation_token = null;
            $admin->invitation_token_expired_at = null;
            $admin->email_verified_at = Carbon::now();

            $admin->password = bcrypt($request->password);
            $admin->is_allow_login = true;
            $admin->save();

            return response()->json([
                'success' => true
            ], SUCCESS);
        }else{
            return response()->json([
                'success' => false,
                'error' => __("invitaion token is not exist")
            ], CLIENT_ERROR);
        }
    }

    public function signin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:150',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'submit' => false,
                'invalid_fields' => $validator->errors()
            ], CLIENT_ERROR);
        }
        if (!auth('admin')->attempt($validator->validated())) {
            return response()->json([
                'success' => false,
                'error' => __('Email or password is incorrect')
            ], CLIENT_ERROR);
        }

        if(auth('admin')->user()->is_allow_login != 1){
            return response()->json([
                'success' => false,
                'error' => __('account has been locked')
            ], AUTHEN_ERROR);
        }

        $admin = Admin::find(auth('admin')->user()->id);
        $admin->last_login_at = Carbon::now();

        return response()->json([
            'success' => true,
        ], SUCCESS);
    }

    public function signout(Request $request) {
        auth('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true
        ], SUCCESS);
    }

    public function forgotPassword(Request $request) {
        DB::beginTransaction();
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:150',
            ]);

            if($validator->fails()){
                return response()->json([
                    'suscess' => false,
                    'submit' => false,
                    'invalid_fields' => $validator->errors()
                ], CLIENT_ERROR);
            }

            $admin = Admin::where('email', $request->email)->where('is_allow_login', 1)->whereNull('deleted_at')->first();

            if($admin){
                $resetPasswordToken = md5(Admin::strRandom().rand(1, 10) . microtime());
                $reset_password_expired_at = Carbon::now()->addHours(24);

                $admin->reset_password_token = md5(config('filesystems.scretkey').$resetPasswordToken);
                $admin->reset_password_token_expired_at = $reset_password_expired_at;
                $admin->save();

                Mail::to($admin->email)->send(new NotifyEmail([
                    'subject'  => config('app.name') . 'パスワードをリセットしてください。',
                    'template' => 'admin_reset_password',
                    'fullname' =>  $admin->fullname,
                    'reset_password_token' =>  $resetPasswordToken,
                ]));

                DB::commit();
                return response()->json([
                    'suscess' => true
                ], SUCCESS);
            }else{
                return response()->json([
                    'suscess' => false,
                    'error' => __("account not exist")
                ], CLIENT_ERROR);
            }
        }catch (\Exception $e) {
            logger($e);
            DB::rollback();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], SERVER_ERROR);
        }
    }

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password' => ['required', new ValidAdminPass],
            'reset_password_token' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'suscess' => false,
                'submit' => false,
                'invalid_fields' => $validator->errors()
            ], CLIENT_ERROR);
        }

        $account = Admin::where('reset_password_token', md5(config('filesystems.scretkey').$request->reset_password_token))
                            ->where('is_allow_login', 1)
                            ->whereNull('deleted_at')
                            ->first();
        if($account){
            if(Carbon::now()->gt(Carbon::parse($account->reset_password_token_expired_at))){
                return response()->json([
                    'success' => false,
                    'error' => __('link reset is expired')
                ], CLIENT_ERROR);
            }
            $account->password = bcrypt($request->new_password);
            $account->reset_password_token = null;
            $account->save();
            return response()->json([
                'success' => true
            ], SUCCESS);

        }else{
            return response()->json([
                'success' => false,
                'error' => __("reset password token is not exist")
            ], CLIENT_ERROR);
        }
    }
}
