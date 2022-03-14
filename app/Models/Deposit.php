<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends AppModel
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'deposit';
    public const TABLE_NAME = 'deposit';
    protected $guarded = [];

    public static function listData($conditions) {
        $query =  DB::table('deposit')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);

        return $query->get();
    }
}
