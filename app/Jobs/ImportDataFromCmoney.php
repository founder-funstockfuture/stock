<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;


class ImportDataFromCmoney implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $to_database;
    protected $to_table;
    protected $insert_data;

    public function __construct($to_database,$to_table,$insert_data)
    {
        $this->to_database = $to_database;
        $this->to_table = $to_table;
        $this->insert_data = $insert_data;
    }

    public function handle()
    {
        DB::connection('mysql_'.$this->to_database)->table($this->to_table)->insert($this->insert_data);

    }
}
