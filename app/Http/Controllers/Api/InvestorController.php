<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\Fund;
use App\Models\Investor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class InvestorController extends ApiController
{
    private $subjectClassModel = Investor::class;
    private $csvFileName = '投資一覧';

    public function __construct() {
        parent::__construct();
    }

    public function list(Request $request) {
        $items = $this->subjectClassModel::listData($request->all());
        return self::formatResponse($items);
    }

    /**
     * Download CSV
     */
    public function downloadCSV(Request $request) {
        $items = $this->subjectClassModel::listData($request->all(), [
            '基金ID',
            'ユーザーID',
            '入金状況',
            '申込日',
            '抽選日',
            'お名前',
            '投資金額',
            '投資口数',
            '入金期限',
            '入金日',
            '分配日',
            '摘要',
            '出金額（税引前）',
        ]);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => 'attachment; filename="' . $this->csvFileName . '"_' . date('Y-m-d') . '.csv',
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function () use ($items) {
            $headers = [];

            foreach ($items[0] as $key => $value) {
                $headers[] = mb_convert_encoding($key,"SJIS-win", "UTF-8");
            }

            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);

            foreach ($items as $item) {
                $row = [];

                foreach ($item as $key => $value) {
                    $row[] = mb_convert_encoding($value, "SJIS-win", "UTF-8");
                }
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}