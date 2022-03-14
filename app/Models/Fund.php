<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fund extends AppModel
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'fund';
    public const TABLE_NAME = 'fund';
    protected $guarded = [];

    public static function listData($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_fund_list` AS 
            SELECT 
                `fund`.`id`                                                AS `id`,       
                `ファンド名`                                                 AS `ファンド名`,
                `fund_status`.`ファンドステータス`                             AS `ファンドステータス`,
                CONCAT(DATE(`募集期間（日時）_from`), ' ~ ', DATE(`募集期間（日時）_to`))    AS `募集期間`,
                (
                    CASE 
                        WHEN 
                            `fund_status`.`ファンドステータス` = '募集中' THEN DATEDIFF(`募集期間（日時）_to`, CURDATE())
                        WHEN 
                            `fund_status`.`ファンドステータス` IN ('不成立', '募集終了', '運用中', '運用終了') THEN '募集終了'
                        ELSE '-'
                    END
                ) AS `残り日数`,
                (
                    SELECT COUNT(0) FROM `fund_application` WHERE `fund_id` = `fund`.`id` AND `deleted_at` IS NULL
                )                                                          AS `応募金額`,
                (
                    SELECT SUM(`申込口数`) FROM `fund_application` WHERE `fund_id` = `fund`.`id` AND `deleted_at` IS NULL
                )                                                          AS `口数`,
                (
                    SELECT COUNT(DISTINCT `user_id`) FROM `fund_application` WHERE `fund_id` = `fund`.`id` AND `deleted_at` IS NULL
                )                                                          AS `人数`,
                CONCAT(
                    '¥', FORMAT(COALESCE(`募集金額`, 0) , 'D', 'en-us')
                )                                                          AS `募集金額`,
                `updated_at`                                               AS `updated_at`,
                DATE(`募集期間（日時）_from`) AS `募集期間（日時）_from`,
                DATE(`募集期間（日時）_to`) AS `募集期間（日時）_to`
            FROM `fund`
            JOIN (
                SELECT
                    id,
                    (
                        CASE 
                            WHEN `failed_at` IS NOT NULL THEN '不成立'
                            WHEN `published_at` IS NULL THEN '作成中'
                            WHEN `published_at` IS NOT NULL AND CURDATE() < `募集期間（日時）_from` THEN '募集前'
                            WHEN `published_at` IS NOT NULL AND CURDATE() BETWEEN `募集期間（日時）_from` AND `募集期間（日時）_to` THEN '募集中'
                            WHEN `published_at` IS NOT NULL AND CURDATE() > `募集期間（日時）_to` AND CURDATE() < `運用期間_from` THEN '募集終了'
                            WHEN `published_at` IS NOT NULL AND CURDATE() BETWEEN `運用期間_from` AND `運用期間_to` THEN '運用中'
                            WHEN `published_at` IS NOT NULL AND CURDATE() > `運用期間_to` THEN '運用終了'
                        END
                    ) AS `ファンドステータス`
                FROM `fund`
                WHERE 
                    `deleted_at` IS NULL
            ) `fund_status`
                ON `fund`.`id` = `fund_status`.`id`
            WHERE `deleted_at` IS NULL
        ");

        $query =  DB::table('v_fund_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
            $query->select($selectFields);
        }

        return $query->get();
    }
}