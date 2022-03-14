<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Notice extends AppModel implements Authenticatable
{
    use HasFactory, SoftDeletes, AuthenticableTrait;

    use HasFactory;
    public $timestamps = true;
    protected $table = 'notice';
    public const TABLE_NAME = 'notice';
    protected $guarded = [];

    public static function listData($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_notice_list` AS
            SELECT
                `id`,
                CONCAT(`公開期間_from`, ' ~ ', `公開期間_to`) AS `公開期間`,
                `公開先` AS `宛先`,
                `タイトル` AS `タイトル`,
                `公開期間_from`,
                `公開期間_to`,
                `公開先`,
                DATE(`created_at`) AS `登録日`,
                DATE(`updated_at`) AS `最終更新者`,
                `updated_at` AS `updated_at`,
                `created_at` AS `created_from`,
                `created_at` AS `created_to`
            FROM `notice`
            WHERE `deleted_at` IS NULL
        ");

        $query =  DB::table('v_notice_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
            $query->select($selectFields);
        }

        return $query->get();
    }
}
