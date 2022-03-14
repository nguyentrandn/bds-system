<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FundController;
use App\Http\Controllers\Api\FundApplicationController;
use App\Http\Controllers\Api\DepositController;
use App\Http\Controllers\Api\WithdrawalController;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\FundMessageController;
use App\Http\Controllers\Api\UserMessageController;
use App\Http\Controllers\Api\UserRegisterController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\ScreenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * AJAX
 */
Route::prefix('/ajax')->group(function () {
    /**
     * Admin
     */
    Route::post('/admin.list', [AdminController::class,'list']);
    Route::get('/admin.detail.{id}', [AdminController::class,'detail']);
    Route::post('/admin.create',[AdminController::class,'create']);
    Route::post('/admin.update.{id}',[AdminController::class,'update']);
    Route::delete('/admin.delete.{id}', [AdminController::class, 'delete']);
    Route::get('/admin.me', [AdminAuthController::class, 'getMe']);

    /**
     * Admin Authentication
     */
    Route::post('/admin.signin', [AdminAuthController::class, 'signin']);
    Route::post('/admin.signout', [AdminAuthController::class, 'signout']);
    Route::post('/admin.active_account', [AdminAuthController::class, 'activeAccount']);
    Route::post('/admin.forgot_password', [AdminAuthController::class, 'forgotPassword']);
    Route::post('/admin.reset_password', [AdminAuthController::class, 'resetPassword']);

    /**
     * Fund
     */
    Route::post(  '/fund.create',             [ FundController::class, 'create' ]);
    Route::post(  '/fund.update.{id}',        [ FundController::class, 'update' ]);
    Route::get(   '/fund.detail.{id}',        [ FundController::class, 'detail' ]);
    Route::post(  '/fund.clone.{id}',         [ FundController::class, 'clone' ]);
    Route::post(  '/fund.list',               [ FundController::class, 'list' ]);
    Route::post(  '/fund/csv/download',       [ FundController::class, 'downloadCSV' ]);
    
    /**
     * Register
     */
    Route::post('/register/send-email-invitation', [ UserRegisterController::class, 'sendEmailInvitation' ]);
    Route::post('/register/input-profile/{invitation_token}', [ UserRegisterController::class, 'inputProfile' ]);
    Route::post('/register/confirm-and-create-account/{invitation_token}', [ UserRegisterController::class, 'confirmAndCreateAccount' ]);

    /**
     * User
     */
    Route::post('/user.create', [UserController::class, 'create']);
    Route::post('/user.update.{id}', [UserController::class, 'update']);
    Route::get('/user.detail.{id}', [UserController::class, 'detail']);
    Route::post('/user.list', [UserController::class, 'list']);
    Route::post('/user/csv/download', [UserController::class, 'downloadCSV']);

    /**
     * Fund Application
     */
    Route::get(  '/fund_application/csv/get_upload_format',      [ FundApplicationController::class, 'getCSVUploadFormat' ]);
    Route::post( '/fund_application/csv/upload/{fund_id}',       [ FundApplicationController::class, 'uploadCSV' ]);
    Route::post( '/fund_application/csv/download',               [ FundApplicationController::class, 'downloadCSV' ]);
    Route::post( '/fund_application/list',                       [ FundApplicationController::class, 'list' ]);
    Route::get(  '/fund_application/detail/{fund_id}/{user_id}', [ FundApplicationController::class, 'detail' ]);
    Route::post( '/fund_application/update/{fund_id}/{user_id}', [ FundApplicationController::class, 'update' ]);
    Route::post( '/fund_application/create',                     [ FundApplicationController::class, 'create' ]);


    /**
     * Deposit
     */
    Route::get(  '/deposit/csv/get_upload_format',        [ DepositController::class, 'getCSVUploadFormat' ]);
    Route::post( '/deposit/csv/upload/{fund_id}',         [ DepositController::class, 'uploadCSV' ]);
    Route::get(  '/deposit/detail/{fund_id}/{user_id}',   [ DepositController::class, 'detail' ]);
    Route::post( '/deposit/update/{fund_id}/{user_id}',   [ DepositController::class, 'update' ]);

    /**
     * Withdrawal
     */
    Route::get(  '/withdrawal/csv/get_upload_format',      [ WithdrawalController::class, 'getCSVUploadFormat' ]);
    Route::post( '/withdrawal/csv/upload/{fund_id}',       [ WithdrawalController::class, 'uploadCSV' ]);
    Route::get(  '/withdrawal/detail/{fund_id}/{user_id}', [ WithdrawalController::class, 'detail' ]);
    Route::post( '/withdrawal/update/{fund_id}/{user_id}', [ WithdrawalController::class, 'update' ]);

    /**
     * Investor
     */
    Route::post( '/investor/list',            [ InvestorController::class, 'list' ]);
    Route::post( '/investor/csv/download',    [ InvestorController::class, 'downloadCSV' ]);

    /**
     * Notice
     */
    Route::post(   '/notice/list',        [ NoticeController::class, 'list' ]);
    Route::get(    '/notice/detail/{id}', [ NoticeController::class, 'detail' ]);
    Route::post(   '/notice/update/{id}', [ NoticeController::class, 'update' ]);
    Route::post(   '/notice/create',      [ NoticeController::class, 'create' ]);
    Route::delete( '/notice/delete/{id}', [ NoticeController::class, 'delete' ]);

    /**
     * Fund Message
     */
    Route::post(   '/fund-message/list',        [ FundMessageController::class, 'list' ]);
    Route::get(    '/fund-message/detail/{id}', [ FundMessageController::class, 'detail' ]);
    Route::post(   '/fund-message/update/{id}', [ FundMessageController::class, 'update' ]);
    Route::post(   '/fund-message/create',      [ FundMessageController::class, 'create' ]);
    Route::delete( '/fund-message/delete/{id}', [ FundMessageController::class, 'delete' ]);


    /**
     * User Message
     */
    Route::post(   '/user-message/list',        [ UserMessageController::class, 'list' ]);
    Route::get(    '/user-message/detail/{id}', [ UserMessageController::class, 'detail' ]);
    Route::post(   '/user-message/update/{id}', [ UserMessageController::class, 'update' ]);
    Route::post(   '/user-message/create',      [ UserMessageController::class, 'create' ]);
    Route::delete( '/user-message/delete/{id}', [ UserMessageController::class, 'delete' ]);


    /**
     * User Authentication
     */
    Route::post( '/user/signin',                    [ UserAuthController::class, 'signin' ]);
    Route::get(  '/user/signout',                   [ UserAuthController::class, 'signout' ]);
    Route::post( '/user/email-reset-password',      [ UserAuthController::class, 'emailResetPassword' ]);
    Route::post( '/user/reset-password',            [ UserAuthController::class, 'resetPassword' ]);


    /**
     * User Data
     */
    Route::post( '/user/input-verification-code',  [ UserController::class, 'inputVerificationCode' ]);
    Route::post( '/user/apply-fund',  [ UserController::class, 'applyFund' ]);
    Route::post( '/user/deposit-and-withdrawal-history-list',     [ UserController::class, 'depositAndWithdrawalHistoryList' ]);
    Route::post( '/user/investment-distribution-status-list',     [ UserController::class, 'listInvestmentDistributionStatus' ]);
    Route::post( '/user/send-contact',                            [ UserController::class, 'sendContact' ]);
    Route::post( '/user/message-list',                            [ UserController::class, 'listUserMessages' ]);
});

/**
 * Screens
 */
Route::get('', [ScreenController::class, 'renderHomeScreen']);

Route::get('/signin',          [ UserAuthController::class, 'renderSigninPage' ])->name('login');
Route::get('/fund',            [ ScreenController::class, 'renderFundListPage' ]);
Route::get('/fund/detail',     [ ScreenController::class, 'renderFunDetailPage' ]);
Route::get('/notice',          [ ScreenController::class, 'renderNoticeListPage' ]);
Route::get('/notice/detail',   [ ScreenController::class, 'renderNoticeDetailPage' ]);

/**
 * User Authenticated routes
 */
Route::group([
    'middleware' => 'auth:user',
], function ($router) {
    Route::get('/my-page', [ ScreenController::class, 'renderUserMyPage' ]);
    Route::get('/profile', [ ScreenController::class, 'renderUserProfilePage' ]);
});

Route::get('/admin', [ScreenController::class, 'redirectToHomeAdmin']);
Route::get('/{screen}', [ScreenController::class, 'renderScreen']);
Route::get('/{folder}/{screen}', [ScreenController::class, 'renderScreenWithSubFolder']);
Route::get('/{folder1}/{folder2}/{screen}', [ScreenController::class, 'renderScreenWithMultipleSubFolder']);
