<?php

namespace Sudo\Post\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class PostSeedCommand extends Command {

    protected $signature = 'sudo/posts:seeds';

    protected $description = 'Khởi tạo dữ liệu mẫu cho Bài viết';

    public function handle() {
        DB::table('seos')->where('type', 'posts')->delete();
        DB::table('seos')->where('type', 'post_categories')->delete();
        DB::table('system_logs')->where('type', 'posts')->delete();
        DB::table('system_logs')->where('type', 'post_categories')->delete();
        DB::table('language_metas')->where('lang_table', 'posts')->delete();
    	DB::table('language_metas')->where('lang_table', 'post_categories')->delete();
        
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $detail = '<p>Chạy xe đạp giảm cân và nâng cao sức khỏe sẽ đạt được hiệu quả tốt hơn khi bạn kết hợp với một chế độ ăn khoa học. Nếu chưa biết loại thực phẩm nào nên và không nên ăn trong thời gian này, bạn có thể tham khảo gợi ý từ các chuyên gia dinh dưỡng được tổng hợp dưới đây nhé!</p>
            <div class="tubo-media-item"> </div>
            <div class="tubo-media-item"><img style="display: block; margin-left: auto; margin-right: auto;" src="https://example.sudospaces.com/toshiko/2022/12/bitmap17.png" alt="" /></div>
            <h1 id="mcetoc_1gk7m5n7a0"><strong> 1. Các loại thực phẩm người chạy xe đạp giảm cân nên ăn</strong></h1>
            <p>Đối với người tập luyện chạy xe đạp giảm cân, việc bổ sung nước và dinh dưỡng phù hợp cho cơ thể rất quan trọng. Trong đó, 2 loại dưỡng chất cần thiết là carbohydrate và protein. Carbohydrate có vai trò giải phóng năng lượng bổ sung cho lượng glycogen hao hụt trong buổi tập dài, còn protein đảm nhận nhiệm vụ hỗ trợ phục hồi cơ bắp.</p>
            <div class="tubo-media-item"> </div>
            <div class="tubo-media-item"><img style="display: block; margin-left: auto; margin-right: auto;" src="https://example.sudospaces.com/toshiko/2022/12/bitmap18.png" alt="" /></div>
            <p> </p>
            <h2 id="mcetoc_1gk7m9goa5"><span style="white-space: pre-wrap;">1.1 Khai lang</span></h2>
            <p><span style="white-space: pre-wrap;"><br />Khoai lang là nguồn cung cấp carbohydrate rất tốt để bạn bổ sung năng lượng trước buổi chạy xe đạp giảm cân hoặc sau buổi tập khi cơ thể bị thiếu hụt glycogen. Loại củ này còn bổ sung Kali bị tiêu hao khi tiết mồ hôi. Ngoài ra, khoai lang cũng rất giàu vitamin C có tác dụng trong việc chữa lành các vết thương.<br />1.1. Khoai lang<br />Khoai lang là nguồn cung cấp carbohydrate rất tốt để bạn bổ sung năng lượng trước buổi chạy xe đạp giảm cân hoặc sau buổi tập khi cơ thể bị thiếu hụt glycogen. Loại củ này còn bổ sung Kali bị tiêu hao khi tiết mồ hôi. Ngoài ra, khoai lang cũng rất giàu vitamin C có tác dụng trong việc chữa lành các vết thương.<br />1.1. Khoai lang<br />Khoai lang là nguồn cung cấp carbohydrate rất tốt để bạn bổ sung năng lượng trước buổi chạy xe đạp giảm cân hoặc sau buổi tập khi cơ thể bị thiếu hụt glycogen. Loại củ này còn bổ sung Kali bị tiêu hao khi tiết mồ hôi. Ngoài ra, khoai lang cũng rất giàu vitamin C có tác dụng trong việc chữa lành các vết thương.<br />1.1. Khoai lang<br />Khoai lang là nguồn cung cấp carbohydrate rất tốt để bạn bổ sung năng lượng trước buổi chạy xe đạp giảm cân hoặc sau buổi tập khi cơ thể bị thiếu hụt glycogen. Loại củ này còn bổ sung Kali bị tiêu hao khi tiết mồ hôi. Ngoài ra, khoai lang cũng rất giàu vitamin C có tác dụng trong việc chữa lành các vết thương.<br />1.1. Khoai lang<br />Khoai lang là nguồn cung cấp carbohydrate rất tốt để bạn bổ sung năng lượng trước buổi chạy xe đạp giảm cân hoặc sau buổi tập khi cơ thể bị thiếu hụt glycogen. Loại củ này còn bổ sung Kali bị tiêu hao khi tiết mồ hôi. Ngoài ra, khoai lang cũng rất giàu vitamin C có tác dụng trong việc chữa lành các vết thương.<br />Xem thêm<br />Ghế massage Toshiko thu hút người dùng Việt<br />Chạy xe đạp giảm cân nên và không nên ăn gì?<br />Toshiko tự hào Top 10 Thương hiệu tiêu biểu châu Á - Thái Bình Dương 2022</span></p>';

        // Bài viết
        $stt = 0;
        for ($j=0; $j < 1; $j++) { 
            $posts = [];
            $seos = [];
            $lang_metas = [];
            for ($i=0; $i < 100; $i++) {
                $stt++;
                $name = 'Chạy xe đạp giảm cân nên và không nên ăn gì '.$stt.'?';
                $posts[] = [
                    'name' => $name,
                    'slug' => str_slug($name),
                    'image' => 'https://example.sudospaces.com/toshiko/2022/12/bitmap15.png',
                    'related_posts' => '1,2,3,4,5',
                    'detail' => $detail,
                    'status' => 1,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
                $seos[] = [
                    'type'              => 'posts',
                    'type_id'           => $stt+1,
                    'title'             => '',
                    'description'       => '',
                    'robots'            => 'Index,Follow',
                ];
                $lang_metas[] = [
                    'lang_table'        => 'posts',
                    'lang_table_id'     => $stt+1,
                    'lang_locale'       => 'vi',
                    'lang_code'         => getCodeLangMeta()
                ];
            }
            DB::table('posts')->insert($posts);
            DB::table('seos')->insert($seos);
            DB::table('language_metas')->insert($lang_metas);
        }
        $this->echoLog('Bai viet duoc tao thanh cong. So luong: '.$stt);

        // maps
        $stt = 0;
        for ($j=0; $j < 1; $j++) { 
            $post_category_maps = [];
            for ($i=0; $i < 100; $i++) {
                $stt++;
                $post_category_maps[] = [
                    'post_id' => $stt,
                    'post_category_id' => rand(1,5),
                ];
            }
            \DB::table('post_category_maps')->insert($post_category_maps);
        }
    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }

}