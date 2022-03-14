<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FundApplication extends AppModel
{
    use HasFactory;

    protected $table = 'fund_application';
    public const TABLE_NAME = 'fund_application';
    public CONST LIST_APPLICATION_STATUS = [
        '申込',
        '当選',
        '落選',
        'キャンセル',
        '再当選',
    ];

    protected $guarded = [];

    public static function listData($conditions, $selectFields = []) {
        DB::statement("
        CREATE
        OR REPLACE VIEW `v_fund_application_list` AS
        SELECT
            `fund_id` AS `基金ID`,
            `user_id` AS `ユーザーID`,
            `fund_id` AS `fund_id`,
            `user_id` AS `user_id`,
            COALESCE(`抽選結果`, '申込') AS `抽選ステータス`,
            `fund`.`ファンド名` AS `ファンド名`,
            DATE(`申込日`) AS `申込日`,
            (
                SELECT
                    CONCAT(`お名前1`, `お名前2`)
                FROM
                    `user`
                WHERE
                    `user`.`id` = `fund_application`.`user_id`
                LIMIT
                    1
            ) AS `お名前`,
            CONCAT(
                '¥',
                FORMAT(
                    `申込口数` * `fund`.`投資単位（1口）`,
                    'D',
                    'en-us'
                )
            ) AS `申込金額`,
            COALESCE(`申込口数`, '-') AS `申込口数`,
            CONCAT(
                '¥',
                FORMAT(
                    COALESCE(`当選口数` * `fund`.`投資単位（1口）`, 0),
                    'D',
                    'en-us'
                )
            ) AS `当選金額`,
            COALESCE(`当選口数`, '-') AS `当選口数`,
            COALESCE(`キャンセル日`, '-') AS `キャンセル日`,
            `fund_application`.`updated_at` AS `updated_at`,
            COALESCE(`fund_application`.`抽選日`, '-') AS `抽選日`
        FROM
            `fund_application`
            JOIN `fund` ON `fund_application`.`fund_id` = `fund`.`id`
        WHERE
            `fund_application`.`deleted_at` IS NULL
            AND `fund`.`deleted_at` IS NULL      
        ");

        $query =  DB::table('v_fund_application_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions, $selectFields);

        return $query->get();
    }
}
