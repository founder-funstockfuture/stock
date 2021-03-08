<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use DB;
use App\Jobs\ImportDataFromCmoney;


class SyncCmoneyDatabases extends Command
{
    use \App\Models\Traits\CmoneyHelper;

    protected $signature = 'cmoney {to_database} {from_table} {to_table} {y} {--m=01} {--d=10} {--d_name=日期}';

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
        $y = $this->argument('y');
        $m = $this->option('m');
        $d = $this->option('d');

        // 依參數判斷
        $date_column_name=$this->option('d_name');

        switch($date_column_name){
            case"日期":
                $ymd_php_format=$y.'-'.$m.'-'.$d;

                if($m && $d){
                    $sql="SELECT * FROM $from_table WHERE $date_column_name='$y$m$d'";
                    // 匯入前先刪資料
                    DB::connection('mysql_'.$to_database)->table($to_table)
                    ->where('data_date', '=', $ymd_php_format)->delete();
        
                }elseif($m){
                    $ymd_php_format=$y.'-'.$m;
                    $specify_month_start = $y.$m;
                    $specify_month_end = $y.$m;
                    $specify_month_start_php_format = $y.'-'.$m.'-01';
                    $specify_month_end_php_format=date("Y-m-t", $y.'-'.$m.'-01');

                    // 有月無日
                    $sql="SELECT * FROM $from_table WHERE $date_column_name>='$specify_month_start' AND $date_column_name<='$specify_month_end' ";
                    // 匯入前先刪資料
                    DB::connection('mysql_'.$to_database)->table($to_table)->where('data_date', '>=', $specify_month_start_php_format)
                    ->where('data_date', '<=', $specify_month_end_php_format)->delete();
        
                }else{
                    $this->info("欄位選擇「日期」，需填月份參數");
                }


                break;
            case"年月":
                if($m){
                    $ymd_format=$y.$m;
                    $sql="SELECT * FROM $from_table WHERE $date_column_name='$ymd_format'";
                    // 匯入前先刪資料
                    DB::connection('mysql_'.$to_database)->table($to_table)
                    ->where('data_date', '=', $ymd_format)->delete();
        
                }else{
                    $specify_month_start = $y.'01';
                    $specify_month_end = $y.'12';

                    //無月份
                    $sql="SELECT * FROM $from_table WHERE $date_column_name>='$specify_month_start' AND $date_column_name<='$specify_month_end' ";
                    // 匯入前先刪資料
                    DB::connection('mysql_'.$to_database)->table($to_table)->where('data_date', '>=', $specify_month_start)
                    ->where('data_date', '<=', $specify_month_end)->delete();
        
                }

                break;
            case"年度":
                //若無月份或日期
                $sql="SELECT * FROM $from_table WHERE $date_column_name='$y'";

                // 匯入前先刪資料
                DB::connection('mysql_'.$to_database)->table($to_table)
                    ->where('data_date', '=', $y)->delete();

            break;

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
                if($j==2000 || $all_data_count==1){
                    //DB::connection('mysql_'.$to_database)->table($to_table)->insert($insert_data);
                    dispatch(new ImportDataFromCmoney($to_database,$to_table,$insert_data));

                    $j=0;
                    $insert_data=[];
                }
    
                $all_data_count--;
            }
    
            $this->info("同步[".$from_table."]到[".$to_table.']，資料來源日期'.$y.$m.$d);
    

        }else{
            $this->info('無資料!!');

        }

    }
}
