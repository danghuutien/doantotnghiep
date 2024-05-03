<?php

namespace Sudo\Comment\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class CommentSeedCommand extends Command {

    protected $signature = 'sudo/comments:seeds';

    protected $description = 'Khởi tạo dữ liệu mẫu cho Trang đơn';

    public function handle() {
        DB::table('comments')->truncate();
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
                'admin_id'  => 0,
                'parent_id'  => 0,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'ip' => '127.0.0.1',
                'type' => 'posts',
                'type_id' => 1,
                'content' => $content,
                'status' => 1,
                'time' => $created_at,
            ];
            DB::table('comments')->insert($db_insert);
        }
        $this->echoLog('Lien he duoc tao thanh cong. So luong: '.$stt);
    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }

}