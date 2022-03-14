<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Mail\NotifyEmail;
use Mail;

class AdminController extends ApiController
{
    private $subjectClassModel = Admin::class;
    private $csvFileName = 'アカウント一覧';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Create
     */
    public function create(Request $request){
        $fields = $request->all();
    
        $error_fields = $this->validateRequiredData($fields);

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

        $data_to_insert['is_allow_login'] = false;
        $invitation_token = md5(Admin::strRandom().rand(1, 10) . microtime());

        $data_to_insert['invitation_token'] = md5(config('filesystems.scretkey').$invitation_token);
        $data_to_insert['invitation_token_expired_at'] = Carbon::now()->addHours(24);

        $item = $this->subjectClassModel::create($data_to_insert);

        Mail::to($item->email)->send(new NotifyEmail([
            'subject'  => config('app.name') . '管理権限登録のお知らせ',
            'template' => 'admin_invitation',
            'fullname' =>  $item->氏名,
            'invitation_token' =>  $invitation_token,
        ]));

        return self::formatResponse([
            'id' => $item->id,
        ]);
    }

    /**
     * Update
     */
    public function update(Request $request, $id){
        $fields = $request->all();
    
        $error_fields = $this->validateRequiredData($fields);

        if(count($error_fields) > 0) {
            return response()->json([
                'error' => true,
                'error_code' => 'required_fields',
                'message' => '必須項目です。',
                'error_fields' => $error_fields
            ], 400);
        }

        $data_to_update = [];

        foreach($fields as $field) {
            $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'file') {
                $data_to_update[$field['column_name']] = $this->saveBase64Image($field['value'], $field['file_name']);
            } else {
                $data_to_update[$field['column_name']] = $field['value'];
            }
        }

        $data_to_update['updated_at'] = Carbon::now();

        $this->subjectClassModel::where('id', $id)
                ->update($data_to_update);

        return self::formatResponse([
            'id' => $id,
        ]);
    }
    
    public function list(Request $request) {
        $items = $this->subjectClassModel::listData($request->all());
        return self::formatResponse($items);
    }

    public function detail(Request $request, $id) {
        $item = $this->subjectClassModel::find($id)->toArray();
        $data = [];

        foreach ($item as $key => $value) {
            $data[] = [
                'column_name' => $key,
                'value'       => $value,
            ];
        }
        
        return $data;
    }

    public function delete(Request $request, $id) {
        $data = [
            'deleted_at' => Carbon::now()
        ];

        $this->subjectClassModel::where('id', $id)
            ->update($data);

        return self::formatResponse([
            'id' => $id,
        ]);
    }

    /**
     * Download CSV
     */
    public function downloadCSV(Request $request) {
        $items = $this->subjectClassModel::listData($request->all(), [
            '氏名',
            'メールアドレス',
            '権限',
            '登録日',
            '最終更新者',
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
}
