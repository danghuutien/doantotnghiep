<?php

namespace Sudo\Base\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class SudoSeedCommand extends Command {

    protected $signature = 'sudo:seeds {table=all}';

    protected $description = 'Khởi tạo dữ liệu khi tạo core';

    public function handle() {
    	$table = $this->argument('table');
    	switch ($table) {
    		case 'all':
			break;
    	}
    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }

}