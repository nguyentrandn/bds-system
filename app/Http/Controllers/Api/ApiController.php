<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Exception;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function __construct()
    {

    }

    public static function formatResponse($data = [], $meta = [], $status = '200'): JsonResponse {
        if(empty($data)){
            $response['meta'] = [
                'message' => 'データがありません'
            ];
        }else{
            $response = [
                'success' => true,
            ];
        }
        $response['result'] = $data;

        if($meta) {
            $response['meta'] = array_merge($response['meta'] ?? [], $meta);
        }
        return Response::json($response, $status);
    }

    public static function formatResponseMessage($message, $status = '200'): JsonResponse {
        $response = [
            'success' => true,
        ];

        $response['meta'] = [
            'message' => $message
        ];

        return Response::json($response, $status);
    }

    public function encode_utf8($data) {
        /**
         * 'UTF-8', 'Shift-JIS, EUC-JP, JIS, SJIS, JIS-ms, eucJP-win, SJIS-win, ISO-2022-JP,ISO-2022-JP-MS, SJIS-mac, SJIS-Mobile#DOCOMO, SJIS-Mobile#KDDI,SJIS-Mobile#SOFTBANK, UTF-8-Mobile#DOCOMO, UTF-8-Mobile#KDDI-A,UTF-8-Mobile#KDDI-B, UTF-8-Mobile#SOFTBANK, ISO-2022-JP-MOBILE#KDDI'
         */
        return mb_convert_encoding($data, 'UTF-8', 'SJIS-win, SJIS-mac, Shift-JIS, JIS, SJIS, UTF-8');
    }

    public function readCSVfile($filepath)
    {
        $rows   = array_map('str_getcsv', file($filepath));
        $header = array_shift($rows);
        $csv    = array();
        foreach($rows as $row) {
            $csv[] = array_combine($header, $row);
        }

        $formated_csv = [];
        foreach($csv as $row) {
            $formated_row = [];

            foreach ($row as $key => $value) {
                $formated_row[$this->encode_utf8($key)] = $this->encode_utf8($value);
            }

            $formated_csv[] = $formated_row;
        }
            
        unset($csv);
        return $formated_csv;
    }

    public function validateDate($date, $format = 'Y-m-d') {
        try {
            Carbon::createFromFormat($format, $date);
        }  catch (Exception $e) {
           return false;
        }

        return true;
    }

    public function validateRequiredData($formData, $allowEmptyColumns = []) {
        $error_fields = [];

        foreach($formData as $field) {
            if(!$field['value'] && !in_array($field['column_name'], $allowEmptyColumns)) {
                if(!isset($field['allow_empty']) || isset($field['allow_empty']) && $field['allow_empty'] !== true) {
                    $error_fields[] = [
                        'column_name' => $field['column_name']
                    ];
                }
            }
        }

        return $error_fields;
    }
}