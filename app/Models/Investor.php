<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Investor extends AppModel
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'investor';
    public const TABLE_NAME = 'investor';
    protected $guarded = [];

    public static function listData($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_investor_list` AS 
            SELECT
                `investor`.`fund_id`, 
                `investor`.`user_id`, 
                `investor`.`fund_id` AS `基金ID`,
                `investor`.`user_id` AS `ユーザーID`,
                DATE(`fund_application`.`申込日`) AS `申込日`, 
                `fund_application`.`申込口数` AS `申込口数`, 
                `fund_application`.`キャンセル日` AS `キャンセル日`, 
                `fund_application`.`抽選結果` AS `抽選結果`, 
                `fund_application`.`当選口数` AS `当選口数`, 
                `fund_application`.`当選口数` AS `投資口数`, 
                `fund_application`.`入金期限` AS `入金期限`,
                DATE(`fund_application`.`抽選日`) AS `抽選日`,
                `investor`.`入金状況` AS `入金状況`, 
                `investor`.`入金日` AS `入金日`, 
                COALESCE(`investor`.`摘要`, '') AS `摘要`,
                `investor`.`出金登日`  AS `出金登日`,
                `v_fund_list`.`ファンドステータス` AS `ファンドステータス`,
                `fund`.`ファンド名` AS `ファンド名`,
                CONCAT(
                    '¥',
                    FORMAT(
                        `investor`.`金額`,
                        'D',
                        'en-us'
                    )
                ) AS `出金額（税引前）`,
                `investor`.`updated_at` AS `updated_at`,
                ( 
                    SELECT
                        CONCAT(`お名前1`, `お名前2`) 
                    FROM `user` 
                    WHERE
                        `user`.`id` = `fund_application`.`user_id`
                    LIMIT 1
                )                    AS `お名前`,
                CONCAT(
                '¥', 
                FORMAT(
                    `fund_application`.`当選口数` * `fund`.`投資単位（1口）`, 
                    'D', 'en-us'
                )
                ) AS `投資金額`,
                `fund_application`.`当選口数` * `fund`.`投資単位（1口）` AS `投資金額_number`,
                `fund`.`配当日` AS `分配日`,
                `investor`.`金額` AS `金額`,
                `user`.`個人・法人` AS `個人・法人`
          FROM
            `investor` 
            JOIN `fund_application` ON `fund_application`.`fund_id` = `investor`.`fund_id`  AND `fund_application`.`user_id` = `investor`.`user_id` 
            JOIN `fund` ON `fund`.`id` = `investor`.`fund_id` AND `fund`.`deleted_at` IS NULL 
            JOIN `v_fund_list` ON `v_fund_list`.`id` = `investor`.`fund_id`
            JOIN `user` ON `user`.`id` = `investor`.`user_id`
        ");

        $query =  DB::table('v_investor_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions, $selectFields);

        return $query->get();
    }


    public static function listInvestmentDistributionStatus($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_investment_distribution_status_list` AS 
            SELECT 
                `v_investor_list`.`fund_id` AS `fund_id`,
                `v_investor_list`.`user_id` AS `user_id`,
                `v_investor_list`.`updated_at` AS `updated_at`,
                `ファンドステータス`,
                `ファンド名`,
                `投資金額`,
                `摘要`,
                CONCAT(
                    '¥', 
                    FORMAT(
                        `分配金合計（税引前）`,
                        'D', 'en-us'
                    )
                ) AS `分配金合計（税引前）`,
                `分配金合計（税引前）` AS `分配金合計（税引前）_number`,
                CONCAT(
                    '¥', 
                    FORMAT(
                        `源泉調整額`,
                        'D', 'en-us'
                    )
                ) AS `源泉調整額`,
                `源泉調整額` AS `源泉調整額_number`,
                (
                    CONCAT(
                        '¥', 
                        FORMAT(
                            (
                                `分配金合計（税引前）` - `源泉調整額`
                            ),
                            'D', 'en-us'
                        )
                    )
                ) AS `分配金合計（税引後）`,
                `分配金合計（税引前）` - `源泉調整額` AS `分配金合計（税引後）_number`,
                (
                    CONCAT(
                        '¥', 
                        FORMAT(
                            (
                                (`分配金合計（税引前）` - `源泉調整額`) + `投資金額_number`
                            ),
                            'D', 'en-us'
                        )
                    )
                ) AS `償還金合計`,
                (`分配金合計（税引前）` - `源泉調整額`) + `投資金額_number` AS `償還金合計_number`
            FROM `v_investor_list`
            JOIN (
                SELECT
                    `fund_id`,
                    `user_id`,
                    (
                        CASE
                            WHEN `摘要`     = '分配金' THEN `金額`
                            WHEN `摘要`     = '分配金＋投資金額' THEN COALESCE( `金額` - `投資金額_number`, 0 )
                        END
                    ) AS `分配金合計（税引前）`, -- No1
                    (
                        CASE 
                            WHEN `個人・法人` = '個人' THEN FLOOR( 
                                (
                                    CASE
                                        WHEN `摘要`     = '分配金' THEN `金額`
                                        WHEN `摘要`     = '分配金＋投資金額' THEN COALESCE( `金額` - `投資金額_number`, 0 )
                                    END
                                ) * 0.2042 
                            )
                            WHEN `個人・法人` = '法人' THEN FLOOR( 
                                (
                                    CASE
                                        WHEN `摘要`     = '分配金' THEN `金額`
                                        WHEN `摘要`     = '分配金＋投資金額' THEN COALESCE( `金額` - `投資金額_number`, 0 )
                                    END
                                ) * 0.15314 
                            )
                        END
                    ) AS `源泉調整額`         -- No2
                FROM `v_investor_list`
            ) AS `base` 
                ON `v_investor_list`.`user_id` = `base`.`user_id` 
                   AND `v_investor_list`.`fund_id` = `base`.`fund_id`
        ");

        $query =  DB::table('v_investment_distribution_status_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions, $selectFields);

        return $query->get();
    }
}
