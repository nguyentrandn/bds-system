<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends AppModel implements Authenticatable
{
    use HasFactory, SoftDeletes, AuthenticableTrait;

    use HasFactory;
    public $timestamps = true;
    protected $table = 'admin';
    public const TABLE_NAME = 'admin';
    protected $guarded = [];

    public static function getCurrentLoginId() {
        return auth('admin')->user()->id;
    }

    public static function findOne($id, $selectFields, $withRelations = []) {
        $result = Admin::withTrashed()
                    ->where('id', $id)
                    ->select($selectFields)
                    ->with($withRelations)
                    ->first();

        return $result;
    }
    
    public static function listData($conditions, $selectFields = []) {
        DB::statement("
            CREATE OR REPLACE VIEW `v_admin_list` AS
            SELECT
                `id`,
                `氏名` AS `氏名`,
                `email` AS `メールアドレス`,
                `role` AS `権限`,
                DATE(`created_at`) AS `登録日`,
                DATE(`updated_at`) AS `最終更新者`,
                `updated_at` AS `updated_at`,
                `created_at` AS `created_from`,
                `created_at` AS `created_to`
            FROM `admin`
            WHERE `deleted_at` IS NULL
        ");

        $query =  DB::table('v_admin_list')->orderBy('updated_at', 'DESC');
        self::bindingQueryCondition($query, $conditions);
        
        if($selectFields) {
            $query->select($selectFields);
        }

        return $query->get();
    }
}
