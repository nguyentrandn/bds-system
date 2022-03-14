<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends AppModel implements Authenticatable
{
    use HasFactory, SoftDeletes, AuthenticableTrait;
    use HasFactory;
    
    public $timestamps = true;
    protected $table = 'user';
    public const TABLE_NAME = 'user';
    protected $guarded = [];

    public static function getCurrentLoginId() {
      return auth('user')->user()->id;
    }

    public function verification_code(){
        return $this->hasOne(UserVerificationCode::class, 'user_id', 'id');
    }
 
    public static function listData($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_user_list` AS 
            SELECT
                `id` AS `ユーザーID`,
                `user`.`id` AS `id`,
                `user`.`メールアドレス` AS `メールアドレス`,
                `user`.`住所` AS `住所`,
                `建物名`,
                `固定電話`,
                `携帯電話`,
                CONCAT(`user`.`フリガナ1`, `user`.`フリガナ2`) AS `フリガナ`,
                concat(`user`.`お名前1`, `user`.`お名前2`) AS `お名前`,
                `user`.`固定電話` AS `固定電話番号`,
                `user`.`携帯電話` AS `携帯電話番号`,
                `user`.`本人確認日` AS `本人確認日`,
                '未' AS `本人確認`,
                cast(`user`.`created_at` as date) AS `登録日`,
                COUNT(DISTINCT `fund_application`.`fund_id`) AS `申込数合計`,
                COUNT(DISTINCT `investor`.`fund_id`) AS `投資数合計`,
                `user`.`updated_at` AS `updated_at`,
                `user`.`created_at` AS `created_from`,
                `user`.`created_at` AS `created_to`
            FROM
                `user`
            LEFT JOIN `fund_application`
              ON `fund_application`.`user_id` = `user`.`id` AND `fund_application`.`deleted_at` IS NULL
            LEFT JOIN `investor`
              ON `investor`.`user_id` = `user`.`id` AND `investor`.`deleted_at` IS NULL
            GROUP BY
              `user`.`id`
            ;
        ");

        $query =  DB::table('v_user_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
            $query->select($selectFields);
        }

        return $query->get();
    }

    /**
     * 
     */
    public static function depositAndWithdrawalHistoryList($conditions, $selectFields = []) {
      DB::statement("
        CREATE OR REPLACE VIEW `v_deposit_and_withdrawal_history_list` AS 
        -- Deposit
        SELECT
          '入金'     AS `入金／出金`,
          `投資金額`  COLLATE utf8mb4_general_ci AS `入出金額`,
          `摘要`     AS `摘要`,
          `ファンド名` AS `ファンド`,
          `入金日` AS `日付`,
          `入金日` AS `日付_from`,
          `入金日` AS `日付_to`,
          `user_id`,
          `fund_id`
        FROM v_investor_list
        WHERE `入金日` IS NOT NULL

        UNION ALL

        -- Withdrawal
        SELECT
          '出金' AS `入金／出金`,
          `出金額（税引前）` COLLATE utf8mb4_general_ci AS  `入出金額`,
          `摘要`     AS `摘要`,
          `ファンド名` AS `ファンド`,
          `出金登日` AS `日付`,
          `出金登日` AS `日付_from`,
          `出金登日` AS `日付_to`,
          `user_id`,
          `fund_id`
        FROM v_investor_list
        WHERE `出金登日` IS NOT NULL
      ");
      

      $query =  DB::table('v_deposit_and_withdrawal_history_list')->orderBy('日付', 'DESC');
      self::bindingQueryCondition($query, $conditions);
      
      if($selectFields) {
          $query->select($selectFields);
      }

      return $query->get();
    }

    /**
     * List all user messages
     */
    public static function listUserMessages($conditions, $selectFields = [], $page = -1) {
      $default_page_size = 12;
      
      DB::statement("
          CREATE OR REPLACE VIEW `v_message_list` AS 
          -- User messages
          SELECT
              `id`,
              `user_id`,
              'user_message' AS `message_type`,
              DATE(`送信日時`) AS `送信日時`,
              `タイトル`,
              EXISTS(
                SELECT 
                  1 
                FROM `message_read`
                WHERE 
                  `message_id` = `id` AND `message_type` = 'user_message'
              ) AS `is_read`,
              `updated_at`
          FROM v_user_message_list

          UNION ALL

          -- Fund message
          SELECT
              `id`,
              'all' AS `user_id`,
              'fund_message' AS `message_type`,
              DATE(`送信日時`) AS `送信日時`,
              `タイトル`,
              EXISTS(
                SELECT 
                  1 
                FROM `message_read` 
                WHERE 
                  `message_id` = `id` AND `message_type` = 'fund_message'
              ) AS `is_read`,
              `updated_at`
          FROM v_fund_message_list

          UNION ALL

          -- Notice
          SELECT
              `id`,
              'all' AS `user_id`,
              'notice' AS `message_type`,
              DATE(`登録日`) AS `送信日時`,
              `タイトル`,
              EXISTS(
                SELECT 
                  1 
                FROM `message_read` 
                WHERE 
                  `message_id` = `id` AND `message_type` = 'notice'
              ) AS `is_read`,
              `updated_at`
          FROM v_notice_list
        ");

        $query =  DB::table('v_message_list')->orderBy('is_read', 'ASC')->orderBy('送信日時', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
          $query->select($selectFields);
        }

        if($page > 0) {
            return $query->paginate($default_page_size);
        }

        return $query->get();
    }
}
