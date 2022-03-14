<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AppModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class UserVerificationCode extends AppModel implements Authenticatable
{
    use HasFactory, SoftDeletes, AuthenticableTrait;

    use HasFactory;
    public $timestamps = true;
    protected $table = 'user_verification_code';
    public const TABLE_NAME = 'user_verification_code';
    protected $guarded = [];
}