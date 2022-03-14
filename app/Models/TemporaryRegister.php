<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TemporaryRegister extends AppModel
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'temporary_register';
    public const TABLE_NAME = 'temporary_register';
    protected $guarded = [];
}
