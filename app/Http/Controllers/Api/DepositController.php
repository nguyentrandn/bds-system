<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Investor;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class DepositController extends ApiController
{
    private $subjectClassModel = Investor::class;
    private $csvFileName = '入金登録';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Create
     */
    public function create(Request $request) {
        $fields = $request->all();
        $data_to_insert = [];

        foreach($fields as $field) {
            $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'file') {
                $data_to_insert[$field['column_name']] = $this->saveBase64Image($field['value'], $field['file_name']);
            } else {
                $data_to_insert[$field['column_name']] = $field['value'];
            }
        }

        $this->subjectClassModel::create($data_to_insert);
    }

    /**
     * Update
     */
    public function update(Request $request, $fund_id, $user_id) {
        $fields = $request->all();
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
        
        $this->subjectClassModel::where('fund_id', $fund_id)
                                ->where('user_id', $user_id)
                                ->update($data_to_update);
    }

    /**
     * List all data
     */
    public function list(Request $request) {
        $items = $this->subjectClassModel::listData($request->all());
        return self::formatResponse($items);
    }

    /**
     * Get detail data
     */
    public function detail(Request $request, $fund_id, $user_id) {
        $fund = $this->subjectClassModel::query()
                    ->where('fund_id', $fund_id)
                    ->where('user_id', $user_id)
                    ->first()
                    ->toArray();
        $data = [];

        $user = User::find($user_id)->first();

        if($user) {
            $fund['お名前'] = $user->お名前1 . $user->お名前2;
        }

        foreach ($fund as $key => $value) {
            $data[] = [
                'column_name' => $key,
                'value'       => $value,
            ];
        }
        
        return $data;
    }

    /**
     * Upload CSV file
     * 
     * Process:::
     *   1. Read file and convert encoding 
     *   2. Validate data
     *   3. Convert column name to field name if required
     *   4. Start transaction and import data.
     *   5. Finish
     */
    public function uploadCSV(Request $request, $fund_id) {
        $csv_data = $this->readCSVfile($request->file);

        /**
         * Validate empty file
         */
        if(!$csv_data || count($csv_data) === 0) {
            return response()->json([
                'error' => 'CSVファイルが空です'
            ], 400);
        }

        /**
         * Validate CSV headers
         */
        $upload_headers = [];
        $expected_headers = [ 'ユーザーID', '入金日' ];

        foreach ($csv_data[0] as $key => $value) {
            $upload_headers[] = $key;
        }

        if(count(array_diff($upload_headers, $expected_headers)) > 0) {
            return response()->json([
                'error' => 'CSVヘッダーの不一致'
            ], 400);
        }

        /**
         * Validate row data format
         */
        $total_error = 0;
        $line_count = 1;
        $error_message = '';

        foreach ($csv_data as $row) {
            $line_error_count = 0;

            foreach ($row as $key => $value) {
                switch($key) {
                    case 'ユーザーID': {
                        if(!is_numeric($value))  $line_error_count++;
                        if(!$value)  $line_error_count++;
                        break;
                    }
                    case '入金日': {
                        if(!$this->validateDate($value)) $line_error_count++;
                        if(!$value)  $line_error_count++;
                        break;
                    }
                }
            }

            if($line_error_count > 0) {
                $error_message .= '行のCSVファイル「' . $line_count . '」」もっている「' . $line_error_count . '」エラー' . PHP_EOL;
            }

            $total_error += $line_error_count;
            $line_count++;
        }

        if ($total_error > 0) {
            return response()->json([
                'error' => $error_message
            ], 400);
        }

        /**
         * Add column if not exists
         */
        $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
        foreach ($csv_data[0] as $key => $value) {
            if($key === 'ユーザーID') {
                $key = 'user_id';
            }

            if(!in_array($key, $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $key);
            }
        }

        /**
         * Convert data to format for insert
         */
        $data_to_insert = [];
        foreach($csv_data as $item) {
            $row = [];
            foreach ($item as $key => $value) {
                $column_name = $key;

                if($column_name === 'ユーザーID') {
                    $column_name = 'user_id';
                }

                $row[$column_name] = $value;
            }
            $row['fund_id'] = $fund_id;
            $row['入金状況'] = '入金済';

            $data_to_insert[] = $row;
        }
        $items = $this->subjectClassModel::upsert($data_to_insert, ['fund_id', 'user_id']);

        return self::formatResponse($items);
    }

    /**
     * Download CSV
     */
    public function downloadCSV(Request $request) {
        $items = $this->subjectClassModel::listData($request->all());

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => 'attachment; filename="' . $this->csvFileName . '"_' . date('Y-m-d') . '.csv',
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
     * Get CSV import format
     */
    public function getCSVUploadFormat(Request $request) {
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => 'attachment; filename="' . $this->csvFileName . '"_' . date('Y-m-d') . '.csv',
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function () {
            $columns = [
                mb_convert_encoding('ユーザーID',"SJIS-win", "UTF-8"),
                mb_convert_encoding('入金日',"SJIS-win", "UTF-8"),
            ];

            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            fputcsv($file, 
                [
                    mb_convert_encoding('1',"SJIS-win", "UTF-8"),
                    mb_convert_encoding('2022-01-20',"SJIS-win", "UTF-8"),
                ]
            );
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}