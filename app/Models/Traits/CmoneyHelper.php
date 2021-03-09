<?php

namespace App\Models\Traits;

use GuzzleHttp\Client;
use DB;

trait CmoneyHelper
{
    //private $table_name;

    private function getCmoneyColumnNames($table_name){

        $client = new Client;

        $url=env('CMONEY_DATABASE_URL');

        // 取表格欄位
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$table_name}' ORDER BY ordinal_position";
        $response = $client->request('POST', $url, ['json' => [
            'FormatSQL' => $sql,
            'TableNames' => ["$table_name"],
        ]]);
        $result_all = json_decode($response->getBody(), true);
        $result_rows = json_decode($result_all['ResultValue'], true);

        $data=[];
        foreach($result_rows as $val){
            $data[] =$val['COLUMN_NAME'];
        }

        return $data;
    }


    private function getFunstockColumnNames($table_name){

        $db_data = DB::connection('mysql_twse')->select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$table_name}' ORDER BY ordinal_position");

        $data=[];

        // 移除不需要輸入資料的欄位
        $i=0;
        foreach($db_data as $val){
            if($i==0 || $i==count($db_data)-1 || $i==count($db_data)-2){
                $i++;
                continue;
            }
            $data[] =$val->COLUMN_NAME;
            $i++;
        }

        return $data;
    }






    
}