<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContact extends AppModel
{
    use SoftDeletes;
    
    public $timestamps = true;
    protected $table = 'user_contact';
    public const TABLE_NAME = 'user_contact';
    protected $guarded = [];
}
