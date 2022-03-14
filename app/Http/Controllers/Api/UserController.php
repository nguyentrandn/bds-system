<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use App\Models\Investor;
use App\Models\UserContact;
use App\Models\UserVerificationCode;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    private $subjectClassModel = User::class;
    private $csvFileName = '顧客一覧';


    public function __construct() {

    }

    /**
     * Create
     */
    public function create(Request $request){
        $fields = $request->all();
    
        $data_to_insert = [];

        foreach($fields as $field) {
            $exists_columns = User::getTableColumns(User::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                User::addColumnToTable(User::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            $data_to_insert[$field['column_name']] = $field['value'];
        }

        $user = User::create($data_to_insert);

        return self::formatResponse([
            'id' => $user->id,
        ]);
    }

    /**
     * Update
     */
    public function update(Request $request, $id){
        $fields = $request->all();
    
        $data_to_update = [];

        $error_fields = $this->validateRequiredData($fields, [
            '固定電話',
            '携帯電話',
            '勤務先',
        ]);

        if(count($error_fields) > 0) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => '必須項目です。',
                'error_fields' => $error_fields
            ], 400);
        }

        foreach($fields as $field) {
            $exists_columns = User::getTableColumns(User::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                User::addColumnToTable(User::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            $data_to_update[$field['column_name']] = $field['value'];
        }

        if(isset($data_to_update['マイナンバー']) && strlen($data_to_update['マイナンバー']) !== 12) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => 'マイナンバー、12文字でないといけません。',
                'error_fields' => [
                    [ 
                        'column_name' => 'マイナンバー'
                    ]
                ]
            ], 400);
        }


        /**
         * Check if user already input enought my number and banking information
         */
        $required_fields = [
            'マイナンバー', '金融機関名', '支店名', '口座種別', '口座番号', '口座名義人'
        ];
        $total_input_fields = 0;

        foreach($data_to_update as $key => $value) {
            if(in_array($key, $required_fields) && $value) {
                $total_input_fields++;
            }
        }

        // If input enough fields, then set flag to ON
        if($total_input_fields === count($required_fields)) {
            $data_to_update['allow_investment_flag'] = true;
        }

        User::where('id', $id)
                ->update($data_to_update);
    }

    public function list(Request $request) {
        $items =  User::listData($request->all());

        return self::formatResponse($items);
    }

    public function detail(Request $request, $id) {
        $fund = User::find($id)->toArray();
        $data = [];

        foreach ($fund as $key => $value) {
            $data[] = [
                'column_name' => $key,
                'value'       => $value,
            ];
        }
        
        return $data;
    }


    /**
     * Download CSV
     */
    public function downloadCSV(Request $request) {
        $items = $this->subjectClassModel::listData($request->all(), [
            'ユーザーID',
            'お名前',
            '固定電話番号',
            '携帯電話番号',
            '本人確認日',
            '登録日',
            '申込数合計',
            '投資数合計',
        ]);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => 'attachment; filename=' . $this->csvFileName . '_' . date('Y-m-d') . '.csv',
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function () use ($items) {
            $headers = [];

            foreach ($items[0] as $key => $value) {
                $headers[] = mb_convert_encoding($key,"SJIS-win", "UTF-8");
            }

            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($items as $item) {
                $row = [];

                foreach ($item as $key => $value) {
                    $row[] = mb_convert_encoding($value, "SJIS-win", "UTF-8");
                }
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Input verification code
     */
    public function inputVerificationCode(Request $request) {
        $validator = Validator::make($request->all(), [
            'code'          => ['required'],
        ], [], [
            'code'          => 'コード',
        ]);

        if($validator->fails()){
            return response()->json([
                'suscess' => false,
                'submit' => false,
                'message' => $validator->errors()->first(),
                'invalid_fields' => $validator->errors(),
            ], CLIENT_ERROR);
        }

        $code = UserVerificationCode::query()
                            ->where('code', $request->code)
                            ->where('user_id', auth('user')->user()->id)
                            ->first();

        if(!$code) {
            return response()->json([
                'error' => true,
                'message' => __('code not exist'),
            ], 400);
        }

        $user = auth('user')->user();

        /**
         * Update verification status.
         */
        $user->identity_verification_flag = true;
        $user->本人確認コード入力日 = Carbon::now();
        $user->save();

        return response()->json([
            'success' => true
        ], SUCCESS);
    }

    /**
     * List deposit And withdrawal history list
     */
    public function depositAndWithdrawalHistoryList(Request $request) {
        $items =  User::depositAndWithdrawalHistoryList($request->all());

        return self::formatResponse($items);
    }

    /**
     * List investment distribution status
     */
    public function listInvestmentDistributionStatus(Request $request) {
        $items =  Investor::listInvestmentDistributionStatus($request->all());
        return self::formatResponse($items);
    }

    /**
     * List investment distribution status
     */
    public function listUserMessages(Request $request) {
        $items =  User::listUserMessages($request->all());
        return self::formatResponse($items);
    }

    /**
     * Send user contact
     */
    public function sendContact(Request $request) {
        $fields = $request->all();
        $data_to_insert = [];

        foreach($fields as $field) {
            $exists_columns = UserContact::getTableColumns(UserContact::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                UserContact::addColumnToTable(UserContact::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'file') {
                $data_to_insert[$field['column_name']] = $this->saveBase64Image($field['value'], $field['file_name']);
            } else {
                $data_to_insert[$field['column_name']] = $field['value'];
            }
        }

        UserContact::create($data_to_insert);
    }
}
