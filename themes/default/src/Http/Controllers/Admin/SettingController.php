<?php

namespace Sudo\Theme\Http\Controllers\Admin;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use DB;
use Form;

class SettingController extends AdminController
{
    function __construct() {
        parent::__construct();
        $this->models = new \Sudo\Theme\Models\Setting;
        $this->table_name = $this->models->getTable();
    }

    // Cấu hình chung
    public function general(Request $requests) {
        $setting_name = 'general';
        $module_name = "Cấu hình giao diện";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->title('Thông tin chung');
            $form->image('favicon', $data['favicon']??'', 0, 'Favicon', 'Chọn ảnh','Chọn ảnh có kích thước 30x30 để hiển thị đẹp nhất', true);
            $form->image('logo_header', $data['logo_header']??'', 0, 'Logo hiển thị header desktop', 'Chọn ảnh','Chọn ảnh có kích thước 170x55', true);
            $form->image('logo_header_mobile', $data['logo_header_mobile']??'', 0, 'Logo hiển thị header mobile', 'Chọn ảnh','', true);
        $form->title('Thông tin footer');
            $form->text('address_headquarters', $data['address_headquarters'] ?? '', 0, 'Trụ sở chính','', true);
            $form->text('address_branch', $data['address_branch'] ?? '', 0, 'Chi nhánh HCM','', true);
            $form->text('hotline', $data['hotline'] ?? '', 0, 'Hotline','Hotline', true);
            $form->text('hotline_insurance', $data['hotline_insurance'] ?? '', 0, 'Hotline bảo hành','Hotline', true);
            $form->text('email', $data['email'] ?? '', 0, 'Email','', true);
            $form->textarea('time_work', $data['time_work'] ?? '', 0, 'Giờ làm việc', 'Nhập thời gian làm việc, text màu xanh đặt trong cặp thẻ <span></span>', 3, true);
            $form->text('facebook', $data['facebook'] ?? '', 0, 'Facebook','Link', true);
            $form->text('tiktok', $data['tiktok'] ?? '', 0, 'Tiktok','Link', true);
            $form->text('instagram', $data['instagram'] ?? '', 0, 'Instagram','Link', true);
            $form->text('youtube', $data['youtube'] ?? '', 0, 'Youtube','Link', true);
            $form->text('zalo', $data['zalo'] ?? '', 0, 'Zalo','Link', true);
            $form->text('messenger', $data['messenger'] ?? '', 0, 'Messenger','Link', true);
            $form->text('bct_link', $data['bct_link'] ?? '', 0, 'Link đăng ký bộ công thương','Link', true);
            $form->text('dmca', $data['dmca'] ?? '', 0, 'Link DMCA','Link', true);
            $form->textarea('copyright', $data['copyright'] ?? '', 0, 'copyright', '', true);
            $form->title('Cấu hình danh sách dịch vụ');
                $form->custom('Form::custom.form_custom', [
                    'has_full' => false,
                    'name' => 'services',
                    'value' => $data['services'] ?? [],
                    'label' => 'Thêm (Thêm tối đa 4 box)',
                    'generate' => [
                        [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'50x50', ],
                        [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tiêu đề', ],
                        [ 'type' => 'text', 'name' => 'desc', 'placeholder' => 'Mô tả', ],
                    ],
                ]);

        $form->title('Cấu hình ảnh banner quảng cáo sitebar');
            $form->image('banner_ads_sb', $data['banner_ads_sb'] ?? '', 0, 'Banner', 'Chọn ảnh','Chọn ảnh có kích thước 370x660', true);
            $form->text('banner_ads_link', $data['banner_ads_link'] ?? '', 0, 'Link quảng cáo','Link', true);
        $form->title('Cấu hình trang hệ thống cửa hàng');
            $form->text('store_meta_title', $data['store_meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('store_meta_description', $data['store_meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('store_meta_image', $data['store_meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
            $form->image('store_banner', $data['store_banner'] ?? '', 0, 'Ảnh banner', 'Chọn ảnh','Chọn ảnh có kích thước 1170x400', true);
            $form->custom('Form::custom.drag_drop',
                [
                    'has_full'          => false,
                    'name'              => 'hotProducts',
                    'value'             => $data['hotProducts'] ?? [],
                    'required'          => 0,
                    'label'             => 'Chọn sản phẩm nổi bật',
                    'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                    'suggest_table'     => 'products',
                    'suggest_id'        => 'id',
                    'suggest_name'      => 'name',
                ]
            );

        $form->title('Cấu hình câu hỏi thường gặp');
            $form->image('faqBackground', $data['faqBackground'] ?? '', 0, 'Hình nền câu hỏi thường gặp', 'Chọn ảnh','Chọn ảnh có kích thước 1920x800', true);
            $form->image('faqBackground_mobile', $data['faqBackground_mobile'] ?? '', 0, 'Hình nền câu hỏi thường gặp mobile', 'Chọn ảnh', '', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'faq',
                'value' => $data['faq'] ?? [],
                'label' => 'Thêm câu hỏi',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'question', 'placeholder' => 'Câu hỏi', ],
                    [ 'type' => 'textarea', 'name' => 'answer', 'placeholder' => 'Câu trả lời', ],
                ],
            ]);

        $form->title('Cấu hình ảnh banner trang tìm kiếm');
            $form->image('banner_search', $data['banner_search'] ?? '', 0, 'Banner', 'Chọn ảnh','Chọn ảnh có kích thước 192x660', true);
        $form->action('editconfig');
        $form->title('Cấu hình lời cảm ơn khi khách hàng đặt hàng');
            $form->textarea('text_success', $data['text_success'] ?? '', 0, 'Meta Description', '', 5,true);
        $form->action('editconfig');
        $form->title('Cấu hình background Toshiko thương hiệu nổi tiếng Châu Á');
            $form->image('famous-brand', $data['famous-brand'] ?? '', 0, 'Background Toshiko thương hiệu nổi tiếng Châu Á', 'Chọn ảnh','Chọn ảnh có kích thước 192x660', true);
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note','module_name'
        ), 'Default::admin.settings.form');
    }
    public function menu(Request $requests){
        $setting_name = 'menu';
        $module_name = "Cấu hình menu";
        $note = "Translate::form.require_text";

        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->title('Cấu hình menu danh mục sản phẩm');
                $form->custom('Default::admin.settings.base.customMenu', [
                    'label' => 'Menu danh mục sản phẩm',
                    'name' => 'menu_categories',
                    'value' => $data['menu_categories'] ?? [],
                ]);
            $form->title('Cấu hình menu header');
            $form->custom('Default::admin.settings.base.customMenu', [
                'label' => 'Menu header',
                'name' => 'primary_menu',
                'value' => $data['primary_menu'] ?? []
            ]);
            
            $form->title('Cấu hình menu footer');
                $form->custom('Default::admin.settings.base.customMenu', [
                    'label' => 'Menu trang chính sách',
                    'name' => 'menu_policy',
                    'value' => $data['menu_policy'] ?? []
                ]);
                $form->custom('Default::admin.settings.base.customMenu', [
                    'label' => 'Menu về chúng tôi',
                    'name' => 'menu_about',
                    'value' => $data['menu_about'] ?? [],
                    'addScript' => 1
                ]);
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    // Cấu hình trang chủ
    public function home(Request $requests) {
        $setting_name = 'home';
        $module_name = "Cấu hình trang chủ";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
            $form->textarea('html_home', $data['html_home'] ?? '', 0, 'Mã html chèn vào thẻ head', '', 5,true);
        $form->endCard();
        $form->title('Cấu hình hình ảnh dưới slides');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'afterSlides',
                'value' => $data['afterSlides'] ?? [],
                'label' => 'Thêm ảnh (Thêm tối đa 3 ảnh)',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'550x225', ],
                    [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Nhập link', ],
                ],
            ]);
        $form->title('Cấu hình sản phẩm bán chạy');
            $form->custom('Form::custom.drag_drop',
                [
                    'has_full'          => false,
                    'name'              => 'saleProducts',
                    'value'             => $data['saleProducts'] ?? [],
                    'required'          => 0,
                    'label'             => 'Chọn sản phẩm bán chạy',
                    'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                    'suggest_table'     => 'products',
                    'suggest_id'        => 'id',
                    'suggest_name'      => 'name',
                ]
            );
            $form->image('bannerAds', $data['bannerAds'] ?? '', 0, 'Banner quảng cáo', 'Chọn ảnh','Chọn ảnh có kích thước 1170x275', true);
        $form->title('Cấu hình danh sách videos');
                $form->custom('Form::custom.form_custom', [
                    'has_full' => false,
                    'name' => 'videos',
                    'value' => $data['videos'] ?? [],
                    'label' => 'Thêm (Thêm tối đa 5 box)',
                    'generate' => [
                        [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước 1170x810', ],
                        [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tiêu đề', ],
                        [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Link youtube', ],
                        [ 'type' => 'textarea', 'name' => 'desc', 'placeholder' => 'Mô tả', ],
                    ],
                ]);
                // $form->image('videoLeft', $data['videoLeft'] ?? '', 0, 'Hình nền video bên trái', 'Chọn ảnh','Chọn ảnh có kích thước 1170x810', true);
                $form->image('videoRight', $data['videoRight'] ?? '', 0, 'Hình nền video bên phải', 'Chọn ảnh','Chọn ảnh có kích thước 750x810', true);
                $form->text('videoLink', $data['videoLink'] ?? '', 0, 'Link xem thêm','', true);
        $form->title('Cấu hình Giải thưởng & Chứng nhận');
            $form->text('certificationTitle', $data['certificationTitle'] ?? '', 0, 'Tiêu đề','', true);
            $form->textarea('certificationDesc', $data['certificationDesc'] ?? '', 0, 'Mô tả', '', true, true);
                $form->text('certificationLink', $data['certificationLink'] ?? '', 0, 'Link xem thêm','', true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'certification',
                'value' => $data['certification'] ?? [],
                'label' => 'Thêm ảnh (Tối đa 4 ảnh)',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'label' => 'Chọn ảnh', 'size' => 'Chọn ảnh có kích thước lần lượt 262x242, 330x303, 186x161, 243x224', ],
                ],
            ]);
        $form->title('Cấu hình đối tác');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'partens',
                'value' => $data['partens'] ?? [],
                'label' => 'Thêm đối tác',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'label' => 'Chọn ảnh', 'size' => 'Chọn ảnh có kích thước 150x150', ],
                    [ 'type' => 'text', 'name' => 'link', 'placeholder' => 'Nhập link', ],
                ],
            ]);
        $form->title('Cấu hình Toshiko thương hiệu nổi tiếng Châu Á');
            $form->text('serviceTitle', $data['serviceTitle'] ?? '', 0, 'Tiêu đề','', true);
            $form->textarea('serviceDesc', $data['serviceDesc'] ?? '', 0, 'Mô tả','', true, true);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'services',
                'value' => $data['services'] ?? [],
                'label' => 'Thêm (Thêm tối đa 4 box)',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'50x50', ],
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tiêu đề', ],
                    [ 'type' => 'text', 'name' => 'desc', 'placeholder' => 'Mô tả', ],
                ],
            ]);
        $form->title('Cấu hình Bản đồ showroom');
            $form->textarea('map_showroom', $data['map_showroom'] ?? '', 0, 'Nhúng bản đồ', '', true, true);
        $form->action('editconfig', route('app.home'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    // Cấu hình trang danh mục tin tức
    public function postCategory(Request $requests) {
        $setting_name = 'post_category';
        $module_name = "Cấu hình trang danh mục tin tức";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->title('Cấu hình SEO trang danh mục tổng');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
        $form->title('Cấu hình ảnh banner danh mục tổng & Tag');
            $form->image('banner', $data['banner'] ?? '', 0, 'Banner danh mục tổng', 'Chọn ảnh','Chọn ảnh có kích thước 1170x400', true);
            
        $form->action('editconfig', route('app.home'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    // Cấu hình trang sarn phẩm
    public function product(Request $requests) {
        $setting_name = 'product';
        $module_name = "Cấu hình trang sản phẩm";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->title('Sản phẩm ưu chuộng hiển thị tại trang danh mục');
            $form->custom('Form::custom.drag_drop',
                [
                    'has_full'          => false,
                    'name'              => 'product_favorite',
                    'value'             => $data['product_favorite'] ?? [],
                    'required'          => 0,
                    'label'             => 'Chọn sản phẩm ưa chuộng',
                    'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                    'suggest_table'     => 'products',
                    'suggest_id'        => 'id',
                    'suggest_name'      => 'name',
                ]
            );
            $form->image('product_favorite_bgk', $data['product_favorite_bgk'] ?? '', 0, 'Ảnh banner', 'Chọn ảnh','Chọn ảnh có kích thước 323x424', true);
            $form->text('code_color', $data['code_color'] ?? '', 0, 'Mã màu','', true);
        $form->title('Cấu hình giấy chứng nhận và giải thưởng trang chi tiết sản phẩm');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'certification',
                'value' => $data['certification'] ?? [],
                'label' => 'Thêm nội dung',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image_item', 'size' => 'Chọn ảnh', ],
                    [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                ],
            ]);
        $form->title('Cấu hình giấy hình ảnh nổi bật của thương hiệu');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'outstanding_brand',
                'value' => $data['outstanding_brand'] ?? [],
                'label' => 'Thêm nội dung',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image_item', 'size' => 'Chọn ảnh', ],
                    [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                ],
            ]);
        $form->title('Cấu hình ảnh banner quảng cáo sitebar');
            $form->image('banner_ads', $data['banner_ads'] ?? '', 0, 'Meta Image', 'Chọn ảnh','Chọn ảnh có kích thước 385x575', true);
            $form->text('banner_ads_link', $data['banner_ads_link'] ?? '', 0, 'Link','', true);
        $form->title('Cấu hình ưu đãi chung cho tất cả sản phẩm');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'promotion',
                'value' => $data['promotion'] ?? [],
                'label' => 'Quà tặng ngoài sản phẩm',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'desc', 'placeholder' => 'Nội dung ưu đãi dành chung cho các sản phẩm', ],
                ],
            ]);
        $form->action('editconfig', route('app.home'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }

    //Cấu hình trang liên hệ
    public function contact(Request $requests){
        $setting_name = 'contact';
        $module_name = "Cấu hình trang liên hệ";
        $note = "Translate::form.require_text";
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->text('meta_title', $data['meta_title'] ?? '', 0, 'Meta Title','', true);
            $form->textarea('meta_description', $data['meta_description'] ?? '', 0, 'Meta Description', '', 5,true);
            $form->image('meta_image', $data['meta_image'] ?? '', 0, 'Meta Image', 'Chọn ảnh','', true);
        $form->endCard();
        $form->title('cấu hình liên hệ');
        $form->textarea('title', $data['title'] ?? '', 0, 'Tiêu đề', 'Nhập tiêu đề', 3, true);
        $form->textarea('description', $data['description'] ?? '', 0, 'Mô tả', 'Nhập mô tả', 3, true);
        $form->text('headquarters_contact', $data['headquarters_contact'] ?? '', 0, 'Trụ sở chính','', true);
        $form->text('address_contact', $data['address_contact'] ?? '', 0, 'Chi nhánh HCM','', true);
        $form->text('hotline_contact', $data['hotline_contact'] ?? '', 0, 'Số hotline', '', true);
        $form->text('email_contact', $data['email_contact'] ?? '', 0, 'Địa chỉ Email', '', true);
        $form->textarea('time_work', $data['time_work'] ?? '', 0, 'Thời gian làm việc', 'Nhập thời gian làm việc, text màu xanh đặt trong cặp thẻ <span></span>', 3, true);
        $form->text('fanpage_contact', $data['fanpage_contact'] ?? '', 0, 'Link Fanpage', '', true);
        $form->textarea('iframe_map', $data['iframe_map'] ?? '', 0, 'Iframe Map', 'Nhập link google map', 5, true);
        $form->action('editconfig', route('app.contact.show'));
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'module_name', 'note'
        ), 'Default::admin.settings.form');
    }
    // Cấu hình tổng quan
    public function overview(Request $requests){
        $setting_name   = 'overview';
        $module_name    = "Cài đặt";
        $note           = "Translate::form.require_text";

        $nation = [0=>'Lựa chọn...', 1 => 'Việt Nam'];
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-3');
            $form->custom('Default::admin.custom.sidebar');
        $form->endCard();
        $form->card('col-lg-9', 'Tổng quan');
            $form->row();
                $form->text('name_company', $data['name_company']??'', 0, 'Tên công ty', '', false, 'col-lg-6');
                $form->text('domain', $data['domain']??'', 0, 'Tên miền', 'Không bao gồm https:// hay www. VD: sudo.vn', false, 'col-lg-6');
            $form->endRow();
            $form->row();
                $form->text('address', $data['address']??'', 0, 'Địa chỉ', '', false, 'col-lg-4');
                $form->select('nation', $data['nation']??'', 0, 'Quốc gia', $nation,0, [], false, 'col-lg-4');
                $form->text('zip_code', $data['zip_code']??'', 0, 'Mã bưu điện', '', false, 'col-lg-4');
            $form->endRow();
            $form->row();
                $form->email('email', $data['email']??'', 0, 'Email (nhận thông báo từ website)', '', false, 'col-lg-4');
                $form->text('phone', $data['phone']??'', 0, 'Điện thoại', '', false, 'col-lg-4');
                $form->text('hotline', $data['hotline']??'', 0, 'Di động (Hotline)', '', false, 'col-lg-4');
            $form->endRow();
            $form->actionInline('editconfig');
        $form->endCard();
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình email
    public function email(Request $requests){
        $setting_name   = 'email';
        $module_name    = "Cài đặt";
        $note           = "Translate::form.require_text";
        $protocol = [
            'smtp'      => 'SMTP', 
        ];
        $smtp_encryption = [
            'tls'=>'TLS',
        ];
        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-3');
            $form->custom('Default::admin.custom.sidebar');
        $form->endCard();
        $form->card('col-lg-9', 'Email');
            $form->tab('', ['Cài đặt SMTP', 'Nội dung gửi Email'], ['setting_email', 'content_email'], true);
                $form->contentTab('setting_email');
                    $form->select('protocol', $data['protocol']??'', 0, 'Giao thức', $protocol, 0);
                    $form->row();
                        $form->text('smtp_host', $data['smtp_host']??'', 0, 'Máy chủ gửi SMTP', '', false, 'col-lg-4');
                        $form->text('smtp_port', $data['smtp_port']??'', 0, 'Cổng (Port)', '', false, 'col-lg-4');
                        $form->select('smtp_encryption', $data['smtp_encryption']??'', 0, 'Kiểu mã hóa', $smtp_encryption,0, [], false, 'col-lg-4');
                    $form->endRow();
                    $form->row();
                        $form->text('smtp_username', $data['smtp_username']??'', 0, 'Tên đăng nhập', '', false, 'col-lg-4');
                        $form->password('smtp_password', $data['smtp_password']??'', 0, 'Mật khẩu', '', '', false, 'col-lg-4');
                        $form->text('smtp_charset', $data['smtp_charset']??'utf-8', 0, 'Email Charset (Mặc định utf-8)', '', false, 'col-lg-4');
                    $form->endRow();
                    $form->row();
                        $form->text('from_address', $data['from_address']??'', 0, 'Email gửi thư', 'Thường dùng với email đăng nhập', false, 'col-lg-4');
                        $form->text('from_name', $data['from_name']??'', 0, 'Tên người gửi', 'VD: Sudo', false, 'col-lg-4');
                        $form->text('smtp_email_reply_to', $data['smtp_email_reply_to']??'', 0, 'Email nhận thư khi người dùng trả lời', 'VD: info@sudo.vn', false, 'col-lg-4');
                    $form->endRow();
                    $form->custom('Default::admin.custom.note');
                    $form->title('Kiểm tra cấu hình email');
                    $form->email('test_mail', '', 0, 'Email nhận thư', '', false, 'col-lg-3');
                    $form->custom('Default::admin.custom.btn_check_email');
                $form->endContentTab();

                $form->contentTab('content_email');
                    $form->title('Email thông báo liên hệ');
                    $form->text('content_subject', $data['content_subject']??'', 0, 'Tiêu đề thư', '');
                    $form->text('content_name', $data['content_name']??'', 0, 'Tên người gửi', '');
                    $form->title('Các biến có thể sử dụng trong "Nội dung thư"');
                    $form->custom('Default::admin.custom.param_email', ['param' => ['name'=>'Tên người gửi', 'address'=>'Địa chỉ', 'phone'=>'Điện thoại', 'content'=>'Nội dung liên hệ']]);
                    $form->editor('content_detail', $data['content_detail']??'', 0, 'Nội dung thư', '');
                $form->endContentTab();
            $form->endTab(true);
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình mã chuyển đổi
    public function code(Request $requests){
        $setting_name   = 'code';
        $module_name    = "Cài đặt";
        $note           = "Translate::form.require_text";

        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-3');
            $form->custom('Default::admin.custom.sidebar');
        $form->endCard();
        $form->card('col-lg-9', 'Mã chuyển đổi');
            $form->textarea('html_head', $data['html_head']??'', 0, 'Mã html chèn vào thẻ head');
            $form->textarea('html_body', $data['html_body']??'', 0, 'Mã html chèn vào sau thẻ mở body');
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }

    // Cấu hình mã chuyển đổi
    public function googleAuthenticate(Request $requests){
        $setting_name   = 'googleAuthenticate';
        $module_name    = "Bảo mật 2 lớp Google Authenticate";
        $note           = "Translate::form.require_text";

        // Thêm hoặc cập nhật dữ liệu
        if (isset($requests->redirect)) {
            $this->models->postData($requests, $setting_name);
        }
        // Lấy dữ liệu ra
        $data = $this->models->getData($setting_name);
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->checkbox('enabled', $data['enabled']??'', 1, 'Bật tính năng');
        $form->endCard();
        $form->action('editconfig');
        // Hiển thị form tại view
        return $form->render('custom', compact(
            'note', 'module_name', 'setting_name'
        ), 'Default::admin.settings.form');
    }
}
