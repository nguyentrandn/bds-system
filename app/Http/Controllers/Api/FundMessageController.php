<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\FundMessage;
use App\Models\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Mail\NotifyEmail;
use Mail;

class FundMessageController extends ApiController
{
    private $subjectClassModel = FundMessage::class;
    private $csvFileName = 'メッセージ';

    public function __construct() {
        parent::__construct();
    }

    private function saveBase64File($img, $filename) {
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
            $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'attachment') {
                $data = [];

                foreach($field['value'] as $item) {
                    if($item['data_type'] == 'text') {
                        $data[] = [
                            'url'  => $item['file'],
                            'name' => $item['name'],
                        ];
                    } 
                    else if( $item['data_type'] == 'file' ) {
                        $data[] = [
                            'url'  => $this->saveBase64File($item['file'], $item['name']),
                            'name' => $item['name'],
                        ];
                    }
                }

                $data_to_insert[$field['column_name']] = json_encode($data);
            } else {
                $data_to_insert[$field['column_name']] = $field['value'];
            }
        }

        $data_to_insert['admin_id'] = Admin::getCurrentLoginId();

        $item = $this->subjectClassModel::create($data_to_insert);

        return self::formatResponse([
            'id' => $item->id,
        ]);
    }

    /**
     * Update
     */
    public function update(Request $request, $id){
        $fields = $request->all();
    
        $data_to_update = [];

        foreach($fields as $field) {
            $exists_columns = $this->subjectClassModel::getTableColumns($this->subjectClassModel::TABLE_NAME);
            if(!in_array($field['column_name'], $exists_columns)) {
                $this->subjectClassModel::addColumnToTable($this->subjectClassModel::TABLE_NAME, $field['column_name'], $field['data_type']);
            }

            if($field['data_type'] === 'attachment') {
                $data = [];

                foreach($field['value'] as $item) {
                    if($item['data_type'] == 'text') {
                        $data[] = [
                            'url'  => $item['file'],
                            'name' => $item['name'],
                        ];
                    } 
                    else if( $item['data_type'] == 'file' ) {
                        $data[] = [
                            'url'  => $this->saveBase64File($item['file'], $item['name']),
                            'name' => $item['name'],
                        ];
                    }
                }

                $data_to_update[$field['column_name']] = json_encode($data);
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
            '送信日時',
            'タイトル',
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
