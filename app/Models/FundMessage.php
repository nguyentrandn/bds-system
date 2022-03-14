<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class FundMessage extends AppModel implements Authenticatable
{
    use HasFactory, SoftDeletes, AuthenticableTrait;

    use HasFactory;
    public $timestamps = true;
    protected $table = 'fund_message';
    public const TABLE_NAME = 'fund_message';
    protected $guarded = [];

    public static function listData($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_fund_message_list` AS
            SELECT
                `id`,
                `fund_id`,
                DATE_FORMAT(`送信日時`, '%Y-%m-%d %H:%i') AS `送信日時`,
                `タイトル` AS `タイトル`,
                `updated_at` AS `updated_at`
            FROM `fund_message`
            WHERE `deleted_at` IS NULL
        ");

        $query =  DB::table('v_fund_message_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
            $query->select($selectFields);
        }

        return $query->get();
    }
}
