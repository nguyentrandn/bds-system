<?php

namespace App\Library;

use App\Models\Contactus;
use Validator,Redirect,Response,File;
use Storage;
use App\Models\FileUpload;
use App\Models\Account;
use App\Email\NotifyEmail;
use DB;
use Mail;
use Exception;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/18/2016
 * Time: 3:14 PM
 */
class Helpers
{
    public static function strRandom($length = 60)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public static function csv(array $list,array $columns = [], $to_encoding = 'SJIS-win'){

        $fp = fopen('php://output', 'w');

        if ($columns) {
            mb_convert_encoding($columns, $to_encoding, 'UTF-8');
            fputcsv($fp, $columns);
        }

        foreach ($list as $row) {
            fputcsv($fp, $row);
            mb_convert_encoding($row, $to_encoding, 'UTF-8');
        }

        fclose($fp);
    }
}
