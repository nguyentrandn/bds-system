<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FundPublic extends AppModel
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'fund_public';
    public const TABLE_NAME = 'fund_public';
    protected $guarded = [];

    public static function listData($conditions, $selectFields = [], $page = -1) {
        $default_page_size = 12;

        DB::statement("
            CREATE OR REPLACE VIEW `v_fund_public_list` AS 
            SELECT 
                `一人あたり投資可能口数_from`,
                COALESCE(`投資単位（1口）`, 0) AS `投資単位（1口）`,
                `予定分配率`,
                `メイン画像`,
                TIMESTAMPDIFF(month, `運用期間_from`, `運用期間_to`)  AS `運用期間`,
                (
                    CASE 
                        WHEN `v_fund_list`.`ファンドステータス` = '募集前' THEN 'rec_before'
                        WHEN `v_fund_list`.`ファンドステータス` = '募集中' THEN 'rec_invite'
                        WHEN `v_fund_list`.`ファンドステータス` = '運用中' THEN 'rec_underOp'
                    END
                ) AS `ui_list_data_status`,
                CEIL(((`応募金額` * `投資単位（1口）`) / `fund`.`募集金額` ) * 100) AS `reach_percent`,
                DATE_FORMAT(`fund`.`募集期間（日時）_from`, '%Y/%m/%d %H:%i') AS `募集開始予定`,
                `v_fund_list`.*
            FROM `fund`
            JOIN `fund_public` ON `fund`.`id` = `fund_public`.`fund_id`
            JOIN `v_fund_list` ON `fund`.`id` = `v_fund_list`.`id`
            WHERE `fund`.`deleted_at` IS NULL
        ");

        $query =  DB::table('v_fund_public_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
            $query->select($selectFields);
        }

        if($page > 0) {
            return $query->paginate($default_page_size);
        }

        return $query->get();
    }

    /**
     * Get one by ID
     */
    public static function findById($fundId) {
        $conditions = [];
        $conditions[] = [
            'column_name' => 'id',
            'search_operator' => '=',
            'value' => $fundId,
        ];  

        $items = FundPublic::listData($conditions);

        return count($items) > 0 ? $items[0] : null;
    }
}