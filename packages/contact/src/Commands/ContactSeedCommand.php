<?php

namespace Sudo\Contact\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class ContactSeedCommand extends Command {

    protected $signature = 'sudo/contacts:seeds';

    protected $description = 'Khởi tạo dữ liệu mẫu cho Trang đơn';

    public function handle() {
        DB::table('contacts')->truncate();
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $stt = 0;
        for ($i=0; $i < 50; $i++) {
            $stt++;
            $name = 'Sudo '.$stt;
            $email = 'info@sudo.vn'.$stt;
            $phone = '0123456789';
            $subject = 'Khởi tạo dữ liệu mẫu '.$stt;
            $content = 'Khởi tạo nội dung dữ liệu mẫu '.$stt;
            $db_insert = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'subject' => $subject,
                'content' => $content,
                'status' => 1,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ];
            DB::table('contacts')->insert($db_insert);
        }
        $this->echoLog('Lien he duoc tao thanh cong. So luong: '.$stt);
    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }
}