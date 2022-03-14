<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends AppModel
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'withdrawal';
    public const TABLE_NAME = 'withdrawal';
    protected $guarded = [];

    public static function listData($conditions) {
        $query =  DB::table('withdrawal')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);

        return $query->get();
    }
}