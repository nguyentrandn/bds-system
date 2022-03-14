<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AppModel extends Model
{
    use HasFactory;

    public const PER_PAGE = 10000;

    protected static function formatResponsePagination($query, $getAllRows, $perPage, $formatDataFunc) {
        $collection = $getAllRows
                        ? $query->paginate($perPage ?? self::PER_PAGE)
                        : $query->get();

        $response = [
            'result' => $collection->map(function($data) use ($formatDataFunc){
                return $formatDataFunc($data);
            })
        ];

        if($getAllRows) {
            $response['meta'] = [
                'total_record' => (int) $collection->total(),
                'per_page' => (int) $collection->perPage(),
                'current_page' => (int) $collection->currentPage(),
            ];
        } else {
            $response['meta'] = [
                'total_record' =>  count($collection),
                'per_page' => count($collection),
                'current_page' => 1,
            ];
        }

        return $response;
    }

    public static function strRandom($length = 60)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
    
    protected static function formatResponseAll($query, $formatDataFunc){
        $collection = $query->get();

        return $collection->map(function($data) use ($formatDataFunc){
            return $formatDataFunc($data);
        });
    }

    protected static function getTableColumns($tableName) {
        [ $keys, $values ] = Arr::divide(
            Schema::getColumnListing($tableName)
        );

        return $values;
    }

    protected static function addColumnToTable($tableName, $columnName, $datatype = 'text') {
        $sql_datatype = '';

        switch($datatype) {
            case 'text': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'email': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'radio': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'file': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'checkbox': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'attachment': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'number': {
                $sql_datatype = 'INT';
                break;
            }
            case 'tel': {
                $sql_datatype = 'TEXT';
                break;
            }
            case 'password': {
                $sql_datatype = 'TEXT';
                break;
            }
        }

        DB::statement(sprintf("ALTER TABLE `%s` ADD COLUMN `%s` %s",$tableName, $columnName, $sql_datatype));
    }

    public static function formatResponse($data, $success = true) {
        $response = [
            'success' => $success,
        ];

        if (!empty($data)) {
            $response['result'] = $data;
        }

        return $response;
    }

    public static function bindingQueryCondition($query, $conditions, $selectFields = []) {
        foreach($conditions as $item) {
            if(!$item['value']) {
                continue;
            }
            
            if( is_array($item['value']) && $item['search_operator'] == '=' ) {
                $query->whereIn($item['column_name'], $item['value']);
            }
            else if ($item['search_operator'] == 'like') {
                if(isset($item['search_multiple_column'])) {
                    $columns = explode(',', $item['column_name']);
                    
                    $query->where(function($query) use($columns, $item){
                        foreach($columns as $col) {
                            $query->orWhere($col, 'like', '%' . $item['value'] . '%');
                        }
                    });
                } else {
                    $query->where($item['column_name'], 'like', '%' . $item['value'] . '%');
                }
            }
            else {
                $query->where($item['column_name'], $item['search_operator'], $item['value']);
            }
        }

        if($selectFields) {
            $query->select($selectFields);
        }
    }
}
