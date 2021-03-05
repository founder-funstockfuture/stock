<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use DB;

class SyncCmoneyDatabases extends Command
{
    use \App\Models\Traits\CmoneyHelper;


    protected $signature = 'cmoney {to_database} {from_table} {to_table} {ym} {--d=10}';

    protected $description = '將 Cmoney資料庫指定表格資料 匯入 funstock資料庫';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        set_time_limit(1800);

        $to_database = $this->argument('to_database');
        // cmoney 表格名稱(中文)
        // $from_name='券商進出個股明細';
        $from_table = $this->argument('from_table');
        // funstock 表格名稱(英文)
        // $to_table='ch_dealer_io_details';
        $to_table = $this->argument('to_table');
        // 取值的年月
        $ym = $this->argument('ym');
        
        //若無日期
        if($d=$this->option('d')){
            $ymd=$ym.$d;
            $sql="SELECT * FROM $from_table WHERE 日期='$ymd'";
            $ymd_php_format=substr($ym,0,4).'-'.substr($ym,4,2).'-'.$d;
            // 匯入前先刪資料
            DB::connection('mysql_'.$to_database)->table($to_table)
            ->where('data_date', '=', $ymd_php_format)->delete();

        }else{
            $specify_month_start = $ym.'01';
            $specify_month_end = date("Ymt", strtotime(substr($ym,0,4).'-'.substr($ym,4,2).'-01'));
            $specify_month_start_php_format = substr($ym,0,4).'-'.substr($ym,4,2).'-01';
            $specify_month_end_php_format=date("Y-m-t", strtotime(substr($ym,0,4).'-'.substr($ym,4,2).'-01'));

            $sql="SELECT * FROM $from_table WHERE 日期>='$specify_month_start' AND 日期<='$specify_month_end' ";
            // 匯入前先刪資料
            DB::connection('mysql_'.$to_database)->table($to_table)->where('data_date', '>=', $specify_month_start_php_format)
            ->where('data_date', '<=', $specify_month_end_php_format)->delete();
        }

        $client = new Client;
        $url=env('CMONEY_DATABASE_URL');
        $cmoney_column_names=$this->getCmoneyColumnNames($from_table);
        $funstock_column_names=$this->getFunstockColumnNames($to_table);


        $db_table_name=["$from_table"];
        $response = $client->request('POST', $url, ['json' => [
            'FormatSQL' => $sql,
            'TableNames' => $db_table_name,
        ]]);
        
        $result_all = json_decode($response->getBody(), true);
        $result_rows = json_decode($result_all['ResultValue'],true);

        $insert_data=[];
        $funstock_column_count=count($funstock_column_names);
        //總資料筆數
        $all_data_count=count($result_rows);
        if($all_data_count>0){
            $j=0;
            foreach($result_rows as $val){
                $j++;
                
                $temp_array=[];
                for($i=0;$i<$funstock_column_count;$i++){
                    $temp_array[$funstock_column_names[$i]]=$val[$cmoney_column_names[$i]];
                }
    
                $insert_data[] = $temp_array;
                // 當滿 2000 筆，儲存到資料庫
                // 不足 2000 筆，最後一次迴圈要存到資料庫
                if($j==3500 || $all_data_count==1){
                    DB::connection('mysql_'.$to_database)->table($to_table)->insert($insert_data);
                    $j=0;
                    $insert_data=[];
                }
    
                $all_data_count--;
            }
    
            //DB::connection('mysql_twse')->table($to_table)->insert($insert_data);
    
            $this->info("同步[".$from_table."]到[".$to_table.']，資料來源日期'.$ym.$d);
    

        }else{
            $this->info('無資料!!');

        }
 


    }
}
