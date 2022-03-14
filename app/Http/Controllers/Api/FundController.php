<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Fund;
use App\Models\FundApplication;
use App\Models\FundPublic;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class FundController extends ApiController
{
    private $subjectClassModel = Fund::class;
    private $csvFileName = 'ファンド一覧';

    public function __construct() {
        parent::__construct();
    }

    private function saveBase64Image($img, $filename) {
        $folderPath = "public/file/";
        $image_parts = explode(";base64,", $img);
        $image_base64 = base64_decode($image_parts[1]);
        $uniqid = uniqid();
        $file_path = $folderPath . $uniqid . '_' . $filename;

        Storage::disk('local')->put($file_path, $image_base64, 'public');

        // Return public URL of image
        return config('app.user_url') . '/storage/file/' . $uniqid . '_' . $filename;
    }

    /**
     * Create
     */
    public function create(Request $request){
        $fields = $request->all();
    
        $data_to_insert = [];

        foreach($fields as $field) {
            $exists_columns = Fund::getTableColumns(Fund::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                Fund::addColumnToTable(Fund::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'file') {
                $data_to_insert[$field['column_name']] = $this->saveBase64Image($field['value'], $field['file_name']);
            } else {
                $data_to_insert[$field['column_name']] = $field['value'];
            }
        }

        $fund = Fund::create($data_to_insert);


        return self::formatResponse([
            'id' => $fund->id,
        ]);
    }

    /**
     * Update
     */
    public function update(Request $request, $id){
        $fields = $request->post();
    
        if($request->query('do_validate') || $request->query('do_public_fund')) {
            $error_fields = $this->validateRequiredData($fields, [
                '建物名',
            ]);

            if(count($error_fields) > 0) {
                return response()->json([
                    'error' => true,
                    'error_code' => 'required_fields',
                    'message' => '必須項目です。',
                    'error_fields' => $error_fields
                ], 400);
            }
        }

        $data_to_update = [];

        foreach($fields as $field) {
            $exists_columns = Fund::getTableColumns(Fund::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                Fund::addColumnToTable(Fund::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'file') {
                $data_to_update[$field['column_name']] = $this->saveBase64Image($field['value'], $field['file_name']);
            } else {
                $data_to_update[$field['column_name']] = $field['value'];
            }
        }

        if($request->query('do_public_fund')) {
            $data_to_update['ファンドステータス'] = '募集前';
            $data_to_update['published_at'] = Carbon::now();

            $recruitment_end_date = Carbon::createFromFormat('Y-m-d H:i', $data_to_update['募集期間（日時）_to']);
            $now = Carbon::now();

            if($recruitment_end_date->lt($now)) {
                return response()->json([
                    'error' => true,
                    'error_code' => 'required_fields',
                    'message' => '募集期間（日時）無効です。',
                    'error_fields' => [
                        [
                            'column_name' => '募集期間（日時）_to'
                        ]
                    ]
                ], 400);
            }

            $public_fund_data = [
                'created_at' => Carbon::now(),
                'fund_id'    => $id,
                'admin_id'   => Admin::getCurrentLoginId(),
            ];

            FundPublic::upsert($public_fund_data, ['fund_id', 'admin_id']);
        }

        Fund::where('id', $id)
                ->update($data_to_update);
    }
    
    public function list(Request $request) {
        $items = Fund::listData($request->all());
        return self::formatResponse($items);
    }

    public function detail(Request $request, $id) {
        $fund = Fund::find($id)->toArray();
        $data = [];

        $fund_status = DB::table('v_fund_list')->where('id', $id)->first();

        $fund['ファンドステータス'] = $fund_status->ファンドステータス;

        foreach ($fund as $key => $value) {
            $data[] = [
                'column_name' => $key,
                'value'       => $value,
            ];
        }
        
        return $data;
    }

    /**
     * Clone
     */
    public function clone(Request $request, $id) {
        $fund = Fund::find($id);
        $newFund = $fund->replicate();
        $newFund->created_at = Carbon::now();
        $newFund->ファンド名 = $newFund->ファンド名 . ' (複写)';

        /**
         * No need copy auto generate columns
         */
        unset($newFund->出資総額);
        unset($newFund->劣後出資額);
        unset($newFund->合計);
        unset($newFund->分配原資);
        unset($newFund->全体口数);
        unset($newFund->優先出資分配金);
        unset($newFund->劣後出資分配金（営業者）);
        unset($newFund['1口あたり']);
        unset($newFund['運用期間_interval']);

        unset($newFund->published_at);
        unset($newFund->failed_at);

        $newFund->save();

        return self::formatResponse([
            'id' => $newFund->id,
        ]);
    }

    /**
     * Download CSV
     */
    public function downloadCSV(Request $request) {
        $items = $this->subjectClassModel::listData($request->all(), [
            'ファンド名',
            'ファンドステータス',
            '募集期間',
            '残り日数',
            '応募金額',
            '口数',
            '人数',
            '募集金額',
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
