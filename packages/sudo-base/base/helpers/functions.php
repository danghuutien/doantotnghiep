<?php 
/**
 * Đặt lại ngôn ngữ nếu trên url có request setLanguage
 * @param string        $language: key của ngôn ngữ đặt tại config('app.language')
 */
function setLanguage($language) {
    // Đặt lại ngôn ngữ nếu trên url có request setLanguage
    if (isset($language) && !empty($language)) {
        // Chỉ lấy ngôn ngữ chỉ định tại config tránh nhập ngôn ngữ không có
        if (array_key_exists($language, config('app.language') ?? [])) {
            session(['locale' => $language]);
        }
    }
    // Set ngôn ngữ cho mọi route
    \App::setLocale(\Session::get('locale') ?? \App::getLocale());
}
/**
 * Dùng để validate dữ liệu cho toàn bộ Form trên web
 * @param requests       $requests: Request của form truyên vào
 * @param string         $field: Tên trường dùng để kiểm tra
 * @param string         $message: Text kiểm tra nếu lỗi
 * @param string         $typeValidate: Loại validate (VD: required | unique | email | min | max | same)
 * @param string         $typeSpecial: Một vài Loại validate đặc biệt có giá trị (VD: min:10 | max:10 | unique:table_name)
 */
function validateForm($requests, $field, $message='', $typeValidate='required', $typeSpecial='') {
    if (!empty($typeSpecial)) {
        $requests->validate([$field => $typeSpecial], [$field.'.'.$typeValidate => __($message)]);
    } else {
        $requests->validate([$field => $typeValidate], [$field.'.'.$typeValidate => __($message)]);
    }
}
/*
 * Cập nhật SEO
 * @param requests      $requests: Request của form truyên vào
 * @param string        $table: Tên bảng
 * @param number        $id: id thuộc bảng
 */
function seos($requests, $type, $type_id) {
    $seo = DB::table('seos')->where('type', $type)->where('type_id',$type_id)->first();
    $data_seo = [
        'title' => $requests->meta_title,
        'description' => $requests->meta_description,
        'robots' => $requests->meta_robots,
        'social_image' => $requests->social_image,
        'social_title' => $requests->social_title,
        'social_description' => $requests->social_description,
    ];
    if (!empty($seo)) {
        \DB::table('seos')->where('type',$type)->where('type_id',$type_id)->update($data_seo);
    } else {
        $data_seo['type'] = $type;
        $data_seo['type_id'] = $type_id;
        \DB::table('seos')->insert($data_seo);
    }
}

/*
 * Cập nhật lịch sử hệ thống
 * @param array         $compact: Mảng giá trị thay đổi ['key' => 'value', 'key2' => 'value2']
 * @param string        $table: tên bảng
 * @param number        $id: id của bảng
 * @param string        $idName: tên id của cột (Một vài bảng đặc biệt)
 */
function systemLogs($action, $compact = [], $type = '', $type_id = '', $idName = 'id') {
    switch ($action) {
        case 'create': 
            // Lấy các key từ đó đưa vào data để
            $compact_fields = [];
            foreach ($compact as $key => $value) {
                $compact_fields[] = $key;
            }
            // foreach lấy giá trị
            $data = [];
            foreach ($compact_fields as $field) {
                $data[$field] = (string)$compact[$field] ?? '';
            }
            // Chuẩn hóa detail
            $detail = [
                'fields'    => $compact_fields,
                'data'       => $data ?? [],
            ];
            $detail = base64_encode(json_encode($detail));
            // Thêm logs
            DB::table('system_logs')->insert([
                'admin_id'      => \Auth::guard('admin')->user()->id,
                'ip'            => getClientIp(),
                'time'          => date('Y-m-d H:i:s'),
                'action'        => $action,
                'type'          => $type,
                'type_id'       => $type_id,
                'detail'        => $detail
            ]);
        break;
        case 'login': 
            // Thêm logs
            DB::table('system_logs')->insert([
                'admin_id'      => \Auth::guard('admin')->user()->id,
                'ip'            => getClientIp(),
                'time'          => date('Y-m-d H:i:s'),
                'action'        => $action
            ]);
        break;
        default:
            $data = DB::table($type)->where($idName, $type_id)->first();
            // Kiểm tra nếu có tồn tại bản ghi thì mới ghi logs
            if (!empty($data)) {
                // Lấy các key từ đó đưa vào hàm cũ và mới để check
                $compact_fields = [];
                foreach ($compact as $key => $value) {
                    $compact_fields[] = $key;
                }
                // foreach lấy giá trị cũ và mới
                $old = []; $new = [];
                foreach ($compact_fields as $field) {
                    if ($field != 'updated_at') {
                        $old[$field] = (string)$data->$field ?? '';
                        $new[$field] = (string)$compact[$field] ?? '';
                    }
                }
                // nếu giá trị cũ khác giá trị mới thì mới thêm
                if ($old != $new) {
                    // Thêm updated_at vào nếu có tại compact
                    if (in_array('updated_at', $compact_fields)) {
                        $old['updated_at'] = (string)$data->$field ?? '';
                        $new['updated_at'] = (string)$compact[$field] ?? '';
                    }
                    // Chuẩn hóa detail
                    $detail = [
                        'fields'    => $compact_fields,
                        'old'       => $old ?? [],
                        'new'       => $new ?? [],
                    ];
                    $detail = base64_encode(json_encode($detail));
                    // Thêm logs
                    DB::table('system_logs')->insert([
                        'admin_id'      => \Auth::guard('admin')->user()->id,
                        'ip'            => getClientIp(),
                        'time'          => date('Y-m-d H:i:s'),
                        'action'        => $action,
                        'type'          => $type,
                        'type_id'       => $type_id,
                        'detail'        => $detail
                    ]);
                }
            }
        break;
    }
}

/*
 * Đa ngôn ngữ toàn bộ bảng nếu cần
 * @param requests      $requests: Request của form truyền vào
 * @param string        $lang_table: tên bảng
 * @param number        $lang_table_id: id của bảng
 */
function langMetas($requests, $lang_table = '', $lang_table_id = '') {
    $lang_locale = $requests->lang_locale ?? \App::getLocale();
    $lang_referer = $requests->lang_referer;
    // Kiểm tra đã tồn tại ngôn ngữ chưa (TH bản ghi hiện tại đã có đa ngồn ngữ)
    $check_exists = DB::table('language_metas')
                        ->where('lang_locale', $lang_locale)
                        ->where('lang_table', $lang_table)
                        ->where('lang_table_id', $lang_table_id)
                        ->first();
    // TH bản ghi hiện tại chưa có đa ngồn ngữ thì mới thêm
    if ($check_exists == null) {
        // Kiểm tra xem có bản ghi của bản gốc không
        $check_referer_exists = DB::table('language_metas')
                                    ->where('lang_table', $lang_table)
                                    ->where('lang_table_id', $lang_referer)
                                    ->first();
        // Nếu không tồn tại referer (TH bản ghi gốc chưa có đa ngôn ngữ)
        if ($check_referer_exists == null) {
            $lang_code = getCodeLangMeta();
        } else {
            $lang_code = $check_referer_exists->lang_code ?? getCodeLangMeta();
        }
        $lang_meta = [
            'lang_table'        => $lang_table,
            'lang_table_id'     => $lang_table_id,
            'lang_locale'       => $lang_locale,
            'lang_code'         => $lang_code,
        ];
        DB::table('language_metas')->insert($lang_meta);
    }
}

/**
 * Hàm tự động tạo mới chuỗi ngẫu nhiên cho lang_code tại bảng language_metas
 * @return string
 */
function getCodeLangMeta() {
    $rand_string = uniqid();
    return $rand_string;
}

/**
 * Tạo mật khẩu
 * @param number         $length: số lượng ký tự muốn sinh
 * @return string
 */
function passwordGenerate($length = 12) {
    $characters = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*()';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * Kiểm tra độ mạnh của mật khẩu
 * @param string         $password: mật khẩu muốn kiểm tra
 * @return number
 */
function passwordStrength($password) {
    $strength = 0;
    if (strlen($password) < 6) { // Phải có 6 ký tự trở lên
        return $strength;
    }else {
        $strength++;
    }
    if (preg_match("@\d@", $password)) { // Nên có ít nhất 1 số
        $strength++;
    }
    if (preg_match("@[A-Z]@", $password)) { // Nên có ít nhất 1 chữ hoa
        $strength++;
    }
    if (preg_match("@[a-z]@", $password)) { // Nên có ít nhất 1 chữ thường
        $strength++;
    }
    if (preg_match("@\W@", $password)) { // Nên có 1 ký tự đặc biệt
        $strength++;
    }
    if (!preg_match("@\s@", $password)) { // Không nên có ký tự rỗng
        $strength++;
    }
    return $strength; // = 6 - Tùy vào mức độ cần thiết của ứng dụng mà đưa ra số strength yêu cầu
}

/**
 * Tạo chuỗi ngẫu nhiên gồm số, chữ, in hoa
 * @param number         $length: số lượng ký tự muốn sinh
 * @return string
 */
function randString( $length = 10) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen( $chars );
    $str = '';
    for( $i = 0; $i < $length; $i++ ) {
    	$str .= $chars[ rand( 0, $size - 1 ) ];
    }
    return $str;
}

/**
 * Xóa Cache
 * @param string         $name: tên trong cache
 */
function pullCache($name) {
    \Cache::pull($name);
}

/**
 * Loại bỏ toàn bộ html tại chuỗi
 * @param string         $string: Chuỗi muốn bỏ
 * @return string
 */
function removeHTML($string){
    $string = preg_replace('/<[^>]*>/', ' ', $string); 
    $string = str_replace('&nbsp;', ' ', $string);
    $string = str_replace("\r", '', $string);
    $string = str_replace("\n", ' ', $string);
    $string = str_replace("\t", ' ', $string);
    $string = trim(preg_replace('/ {2,}/', ' ', $string));
    return $string;
}

/**
 * Loại bỏ toàn bộ script tại chuỗi
 * @param string         $string: Chuỗi muốn bỏ
 * @return string
 */
function removeScript($string){
    $string = preg_replace ('/<script.*?\>.*?<\/script>/si', '<br />', $string);
    $string = preg_replace ('/on([a-zA-Z]*)=".*?"/si', ' ', $string);
    $string = preg_replace ('/On([a-zA-Z]*)=".*?"/si', ' ', $string);
    $string = preg_replace ("/on([a-zA-Z]*)='.*?'/si", " ", $string);
    $string = preg_replace ("/On([a-zA-Z]*)='.*?'/si", " ", $string);
    return $string;
}

/**
 * Loại bỏ toàn bộ XML tại chuỗi
 * @param string         $string: Chuỗi muốn bỏ
 * @return string
 */
function removeXML($string){
    $string = preg_replace('/<xml>.*?<\/xml>/si','',$string);
    //$string = preg_replace('/<!--.*?-->/si','',$string);
    return $string;
}
function replaceMQ($text){
    $text	= str_replace("\'", "'", $text);
    $text	= str_replace("'", "''", $text);
    return $text;
}
function removeMagicQuote($str){
    $str = str_replace("\'", "'", $str);
    $str = str_replace("\&quot;", "&quot;", $str);
    $str = str_replace("\\\\", "\\", $str);
    return $str;
}
function removeUTF8BOM($text) {
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
}

/**
 * Lấy số lượng ký tự trong 1 chuỗi
 * @param string         $string: Chuỗi muốn cắt
 * @param number         $length: Số ký tự muốn cắt (Mặc định là 150)
 * @return string
 */
function cutString($str, $length = 150, $char=" ..."){
    //Nếu chuỗi cần cắt nhỏ hơn $length thì return luôn
    $strlen	= mb_strlen($str, "UTF-8");
    if($strlen <= $length) return $str;

    //Cắt chiều dài chuỗi $str tới đoạn cần lấy
    $substr	= mb_substr($str, 0, $length, "UTF-8");
    if(mb_substr($str, $length, 1, "UTF-8") == " ") return $substr . $char;

    //Xác định dấu " " cuối cùng trong chuỗi $substr vừa cắt
    $strPoint= mb_strrpos($substr, " ",0, "UTF-8");

    //Return string
    if($strPoint < $length - 20) return $substr . $char;
    else return mb_substr($substr, 0, $strPoint, "UTF-8") . $char;
}

/**
 * Lấy url
 * @param string         $url: Loại url muốn lấy (current: link hiện tại | back: link trang trước đó | full: link full có cả param)
 * @return string
 */
function getUrlLink($url=''){
    switch ($url) {
        case 'current':     $link = url()->current();       break;
        case 'back':        $link = url()->previous();      break;
        case 'full':        $link = url()->full();          break;
        default:            $link = url('');                break;
    }
    return $link;
}

/**
 * Lấy IP của máy hiện tại
 * @return IP
 */
function getClientIp() {
    return \Request::ip();
}

/**
 * Lấy toàn bộ html của 1 trang web (Crawl)
 * @param string         $url: Loại url muốn lấy
 * @return string
 */
function getHtmlByCurl($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $str = curl_exec($curl);
    curl_close($curl);
    return $str;
}

/**
 * Nén string và encode cho các trường hợp xuất dữ liệu
 * @param  string       $string
 * @return  string
 */
function compress_encode($string) {
    return base64_encode(gzcompress($string, 9));
}

/**
 * Giải nén string và decode cho các string qua func compress_encode
 * @param  string       $string
 * @return string
 */
function compress_decode($string) {
    return gzuncompress(base64_decode($string));
}

/**
 * Verify email qua verify-email.org
 * @param  string       $string
 * @return  boolean
 */
function verifyEmailOrg($email) {
    return true;
    if (strpos($email, '@yahoo.com.vn')) {
        return true;
    } else {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://app.verify-email.org/api/v1/RxmBjTr3s8j5l8pvy4uRBxrKbV60ZR7fJ4AB1TtkpYVCjo7gTP/verify/$email");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $data = curl_exec($ch);
        $data = json_decode($data,true);
        //$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($data['status'] == 1) { return true; }
        return false;
    }
}

/**
 * Định dạng giá 
 * @param  number       $price: Giá
 * @param  number       $text_default: Text hiển thị giá là 0 để null thì sẽ không hiển thị text này
 * @return  string
 */
function formatPrice($price, $text_default = "Miễn phí", $price_unit = 'đ') {
    if ($price == 0 && $text_default != null) {
        return $text_default;
    } else {
        return number_format($price, 0, '.', '.').$price_unit;
    }
}

/**
 * Định dạng thời gian 
 * @param  timestamps   $time: Thời gian dạng timestamps
 * @return  string
 */
function formatTime($time, $format='Y-m-d H:i:s') {
    return date($format, strtotime($time));
}

/**
 * Định dạng số
 * @param  string       $string: chuỗi chỉ muốn lấy số
 * @return  string
 */
function onlyNumber($string = '') {
    return trim(preg_replace('/[^0-9]/', '', $string));
}

/**
 * Thời gian sang khoảng thời gian dạng text
 * @param  timestamps   $time: Thời gian dạng timestamps
 * @param  string       $time_format: Định dạng thời gian
 * @param  string       $text_before: Text hiển thị đằng trước
 * @return  string
 */
function changeTimeToText($time, $time_format = 'H:i d/m/Y', $text_before = ''){
    if(!is_numeric($time)){
        $time = strtotime($time);
    }
    $time_check = time() - $time;
    if($time_check < 60) {
        return $text_before.' '.round(time()-$time).' '.__('giây trước');
    } elseif($time_check < 60*60){
        return $text_before.' '.round((time() - $time)/60).' '.__('phút trước');
    } elseif($time_check < 60*60*24){
        return $text_before.' '.round(((time()-$time)/60)/60).' '.__('giờ trước');
    }else{
        return date($time_format, $time);
    }
}

/* CÁC HÀM LIÊN QUAN ĐẾN ẢNH */

/**
 * Hàm lấy link ảnh trong file public
 * @param  string       $file: Đường dẫn từ đi vào từ public/
 * @return  string
 */
function getImageFile($file=null) {
    if (!isset($file)) {
        return getImageDefault();
    } else {
        return asset($file);
    }
}

/**
 * Thay đổi resize ảnh
 * @param  string       $link_img: link ảnh
 * @param  string       $size: Kích thước ảnh
 * @return  string
 */
function resizeImage($link_img='',$size='') {
    // Kích thước ảnh hợp lệ tiny 80, small 150, medium 300, large 600
    $array_size = array('tiny','small','medium','large');
    // nếu size không thuộc ảnh hợp lệ thì trả về ảnh đó luôn
    if(!in_array($size,$array_size)) {
        return $link_img;
    }
    // Vị trí của cái . cuối cùng
    $endS = strrpos($link_img,'.'); 
    // Đuôi ảnh
    $img_ext = substr($link_img,$endS+1); 
    // Đường dẫn ảnh không có đuôi
    $img_path_name = substr($link_img,0,$endS); 
    // Vị trí dấu - cuối cùng
    $starG = strrpos($img_path_name,'-'); 
    //tiny,small,medium,large hoặc 1 text bất kỳ nếu link là ảnh mặc định
    $prefix = substr($img_path_name, $starG+1);
    // Xử lý thêm đuôi
    return $img_path_name.'-'.$size.'.'.$img_ext;
}

/**
 * replace link ảnh cũ sang mới
 * @param  string       $content: nội dung hoặc ảnh cần chuyển
 * @return  string
 */
function replaceImageLink($content) {
    $content = str_replace(config('SudoMedia.image_old')??[], config('SudoMedia.image_new')??'',$content);
    return $content;
}

/**
 * Lấy ảnh mặc định
 * @param  string       $name: loại ảnh, nếu là load thì sẽ lấy ảnh loading
 * @return  string
 */
function getImageDefault($name='') {
    if ($name == "load") {
        return asset('/core/img/loading_image.gif');
    } else {
        return asset('/core/img/default_image.png');
    }
}

/**
 * Hàm lấy ảnh chính sau khi đã replace
 * @param  string       $image: link ảnh
 * @param  string       $size: Kích thước ảnh
 * @param  string       $image_default: Ảnh mặc định nếu ảnh rỗng
 * @return  string
 */
function getImage($image = '', $size = '', $image_default = '') {
    if ($image == '') {
        if ($image_default == '') {
            $image = getImageDefault();
        } else {
            $image = $image_default;
        }
    } else {
        $image = replaceImageLink($image);
        $image = resizeImage($image,$size);
    }
    return $image;
}

/**
 * Định dạng lại keyword để tìm kiếm chính xác hơn
 * @param  string       $keyword: từ tìm kiếm
 * @return  array
 */
function formatKeyword($keyword='') {
    if (isset($keyword)) {
        $keyword = $keyword;
        $key = str_replace(" ","%",$keyword);
        $key = str_replace("\'","'",$key);
        $key = str_replace("'","''",$key);
    } else {
        $keyword = $key = "";
    }
    return [
        'keyword' => $keyword,
        'key' => $key,
    ];
}

/**
 * Check xem có quyền hay không
 * @param string            $role
 * @return bool
 */
function checkRole($role) {
    $has_role = \Auth::guard('admin')->user()->hasRole($role);
    return $has_role;
}

/**
 * Phục vụ cho hiển thị active của menu tại admin
 * Check tên route hiện tại và tên mảng route điều kiện để active menu 
 * @param string            $route_string: Chuỗi route mặc định 
 * @param array             $route_array: mảng route check thêm
 * @return string
 */
function activeMenu($route_string = '', $route_array = []) {
    $class = '';
    // Gộp chuỗi route với mảng làm một
    $active_group = [];
    if (isset($route_string) && !empty($route_string)) {
        $active_group[] = $route_string;
    }
    if (isset($route_array) && !empty($route_array)) {
        foreach ($route_array as $active) {
            $active_group[] = $active;
        }
    }
    // Kiểm tra route_name hiện tại có trùng chuỗi với chuỗi tại mảng trên hay không
    if (in_array(\Route::currentRouteName(), $active_group)) {
        $class = 'mm-active';
    }
    // Trả về tên class
    return $class;
}

/**
 * Chuyển collection sang dạng mảng [key => value]
 * @param collection    $collect: hàm được lấy ra từ query [get, paginate, ...]
 * @param string        $key_array: tên trường lấy làm key VD: 'id'
 * @param string        $value_array: tên trường lấy làm value VD: name
 * @return array        $array
 */
function collectToArray($collect, $key_array, $value_array) {
    $array = [];
    foreach ($collect as $key => $value) {
        $array[$value->$key_array] = $value->$value_array;
    }
    return $array;
}

/**
 * Loại bỏ toàn bộ script tại mảng
 * @param array         $array: Mảng [key => value] cần bỏ script tại value
 * @return array
 */
function removeScriptArray($array = []) {
    $data = [];
    foreach ($array as $key => $value) {
        $data[$key] = removeScript($value);
    }
    return $data;
}

function filePath($filePath) {
    $fileParts = pathinfo($filePath);
    if(!isset($fileParts['filename']))
    {$fileParts['filename'] = substr($fileParts['basename'], 0, strrpos($fileParts['basename'], '.'));}
    return $fileParts;
}
function resizeWImage($image, $w='w300'){
    if($image == '') {
        return getImageDefault();
    }
    $source = $image;
    if(str_ends_with($image, '.gif') !== false || str_ends_with($image, '.webp')){
        return $image;
    }
    try {
        $path = $image;
        $disk = config('SudoMedia.storage_type');
        $upload = Storage::disk($disk);
        if(!$upload->exists($image)) {
            return $image;
        }

        $webpPath = $image.'.webp';
        if($upload->exists($webpPath)) {
            return $webpPath;
        }
        $image = file_get_contents(asset($image));
        $image = Image::make($image);
        $image_convert = $image->encode('webp')->stream('webp', 85);
        $upload->put($path.'.webp', $image_convert->__toString(),'public');
        return $webpPath;
    } catch (\Exception $e) {
        \Log::error('addWebp error for image '.$source);
        \Log::error($e->getMessage());
        return $source;
    }
}
