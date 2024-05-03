<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;
use Sudo\Ecommerce\Models\OrderDetail;
use Sudo\Ecommerce\Models\Product;

class ProductController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Product;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Sản phẩm';
        $this->has_seo = true;
        $this->has_locale = false;
        parent::__construct();

        $product_categories = new ListCategory('product_categories', false);
        $this->product_categories = $product_categories->data();
        \View::share('product_categories', $this->product_categories);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::products.table', $this->has_locale);

        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('category_id', 'Danh mục', 'array', $this->product_categories);
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        
        // Build bảng
        $listdata->add('image', 'Ảnh', 0);
        $listdata->add('name', 'Tên', 0);
        $listdata->add('category_id', 'Danh mục', 0);
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Hành động', 0, 'action');
        // Lấy dữ liệu data
        $data = $listdata->data();
        $show_data = $data['show_data'];
        $show_data_array_id = $show_data->pluck('id')->toArray();
        // Trả về views
        return $listdata->render(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Danh mục
        $categories = new ListCategory('product_categories', $this->has_locale, Request()->lang_locale ?? \App::getLocale());
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-8');
            $form->lang($this->table_name, true);
            $form->text('name', '', 1, 'Tiêu đề', '');
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', 'true', 'products', true);
            $form->row();
                $form->text('sku', '', 0, 'Mã sản phẩm', '', false, 'col-lg-3');
                $form->number('quantity', '', 1, 'Số lượng', '', false, 'col-lg-3', false, false);
                $form->number('price', '', 1, 'Giá bán', '', false, 'col-lg-3', false, true);
                $form->number('price_old', '', 0, 'Giá thị trường', '', false, 'col-lg-3', false, true);
            $form->endRow();
            $form->custom('Ecommerce::products.form.combo_select', ['title'=>'Chọn sản phẩm mua cùng combo', 'record_locale' => \App::getLocale()]);
            $form->text('insurance', '', 0, 'Bảo hành', '', false, '');
            $form->text('video', '', 0, 'Video Youtube', '', false, '');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'promotion',
                'value' => [],
                'label' => 'Ưu đãi dành riêng cho sản phẩm',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'desc', 'placeholder' => 'Nội dung ưu đãi', ],
                ],
            ]);
            $form->checkbox('flash_sale', 0, 1, 'Hiện giá sốc', '');
            $form->checkbox('compare', 0, 1, 'Cho phép trả góp', '');
            $form->tab('Nội dung', ['Nội dung', 'Xuất bản'], ['content', 'xuatban'], true);
                $form->contentTab('content');
                    $form->editor('detail', '', 0, 'Nội dung');
                $form->endContentTab();
                $form->contentTab('xuatban');
                    $form->datetimepicker('created_at', '', 0, 'Thời gian xuất bản', '', false, 'col-lg-4');
                    $form->datetimepicker('updated_at', '', 0, 'Thời gian cập nhật', '', false, 'col-lg-4');
                $form->endContentTab();
            $form->endTab(true);
            $form->multiSuggest('related_products', '', 0, 'Sản phẩm liên quan', 'Tìm theo tên sản phẩm...', 'products','id', 'name', false);
            $form->title('Kho hàng');
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'specifications',
                'value' => [],
                'label' => 'Thông số kỹ thuật',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                    [ 'type' => 'text', 'name' => 'value', 'placeholder' => 'Giá trị', ],
                ],
            ]);
            // Bộ lọc
            if (config('SudoProduct.filters') == true) {
                $form->custom('Ecommerce::admin.products.form.product_filters', [
                    'product_id' => 0,
                    'category_id' => 0,
                ]);
            }
            $form->action('add');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-4');
            $form->select('category_id', '', 1, 'Danh mục sản phẩm', $categories->data_select(), 1);
            $form->image('image', '', 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước 600x600 để hiển thị đẹp nhất');
            $form->multiImage('slide', '', 0, 'Ảnh Slide');
        $form->endCard();

        // Hiển thị form tại view

        return $form->render('create_multi_col');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        // Xử lý validate
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:slugs');
        // Các giá trị mặc định
        validateForm($requests, 'category_id', 'Danh mục không được để trống.');
        validateForm($requests, 'quantity', 'Số lượng không được để trống.');
        validateForm($requests, 'price', 'Giá bán không được để trống.');
       
        $quantity = 0;
        $flash_sale = 0;
        $compare = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($slide) && !empty($slide)) { $slide = implode(',', $slide); } else { $slide = null; }
        if (isset($related_products) && !empty($related_products)) { $related_products = implode(',', $related_products); } else { $related_products = null; }
        $created_at = $created_at ?? date('Y-m-d H:i:s');
        $updated_at = $updated_at ?? date('Y-m-d H:i:s');
        $specifications = base64_encode(json_encode($specifications ?? []));
        $promotion = base64_encode(json_encode($promotions ?? []));
        // Nếu click lưu nháp
        if($redirect == 'save'){
            // $status = 0;
            $redirect = 'edit';
        }
        $status = 0;
        $price_old = intval($price_old ?? 0);
        // nén filter thành json
        // Thêm vào DB
        $combo = !empty($sale) ? json_encode($sale) : '';
        $compact = compact('promotion','combo','sku','name', 'category_id','slug','image', 'slide', 'price', 'price_old','detail', 'related_products', 'quantity','status', 'insurance', 'flash_sale', 'compare', 'specifications', 'video','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, $this->has_locale);
        DB::table('slugs')->insert([
            'table' => 'products',
            'table_id' => $id,
            'slug' => $slug,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
        // Lưu bộ lọc của sản phẩm
        if (isset($filters) && !empty($filters)) {
            $this->setFilter($filters, $id);
        }
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.create_success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Ngôn ngữ bản ghi hiện tại
        $language_meta = \DB::table('language_metas')->where('lang_table', $this->table_name)->where('lang_table_id', $data_edit->id)->first();
        // danh mục ứng với ngôn ngữ
        $categories = new ListCategory('product_categories', $this->has_locale, $language_meta->lang_locale ?? null);
        $slug_item = DB::table('slugs')->where('table', 'products')->where('table_id', $id)->first();
        $slug = $slug_item->slug;
        $form = new Form;
        $form->card('col-lg-8');
            $form->lang($this->table_name);
            $form->text('name', $data_edit->name, 1, 'Tiêu đề', '');
            $form->slug('slug', $slug, 1, 'Đường dẫn', 'name', 'true', 'products', true);
            $form->row();
                $form->text('sku', $data_edit->sku, 0, 'Mã sản phẩm', '', false, 'col-lg-3');
                $form->number('quantity', $data_edit->quantity, 1, 'Số lượng', '', false, 'col-lg-3', false, false);
                $form->number('price', number_format($data_edit->price), 0, 'Giá bán', '', false, 'col-lg-3', false, true);
                $form->number('price_old', number_format($data_edit->price_old), 0, 'Giá thị trường', '', false, 'col-lg-3', false, true);
            $form->endRow();
            $combos = !empty($data_edit->combo) ? json_decode($data_edit->combo ?? '',1) : [];
            $form->custom('Ecommerce::products.form.combo_select', ['product_sale' => $combos,'title'=>'Chọn sản phẩm mua cùng combo', 'record_locale' => $language_meta->lang_locale ?? \App::getLocale()]);
            $form->text('insurance', $data_edit->insurance ?? '', 0, 'Bảo hành', '', false, '');
            $form->text('video', $data_edit->video ?? '', 0, 'Video Youtube', '', false, '');
            $promotion = json_decode(base64_decode($data_edit->promotion), 1);
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'promotion',
                'value' => $promotion,
                'label' => 'Ưu đãi dành riêng cho sản phẩm',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'desc', 'placeholder' => 'Tên quà tặng', ],
                ],
            ]);
            $form->checkbox('flash_sale', $data_edit->flash_sale, 1, 'Hiện giá sốc', '');
            $form->checkbox('compare', $data_edit->compare, 1, 'Cho phép trả góp', '');
            $form->tab('Nội dung', ['Nội dung', 'Xuất bản'], ['content', 'xuatban'], true);
                $form->contentTab('content');
                    $form->editor('detail', $data_edit->detail, 0, 'Nội dung');
                $form->endContentTab();
                $form->contentTab('xuatban');
                    $form->datetimepicker('created_at', $data_edit->created_at, 0, 'Thời gian xuất bản', '', false, 'col-lg-4');
                    $form->datetimepicker('updated_at', $data_edit->updated_at, 0, 'Thời gian cập nhật', '', false, 'col-lg-4');
                $form->endContentTab();
            $form->endTab(true);
            $form->multiSuggest('related_products', $data_edit->related_products, 0, 'Sản phẩm liên quan', 'Tìm theo tên sản phẩm...', 'products','id', 'name', false);
            $form->title('Kho hàng');
            $specifications = json_decode(base64_decode($data_edit->specifications), 1);
            $form->custom('Form::custom.form_custom', [
                'has_full' => true,
                'name' => 'specifications',
                'value' => $specifications ?? [],
                'label' => 'Thông số kỹ thuật',
                'generate' => [
                    [ 'type' => 'text', 'name' => 'title', 'placeholder' => 'Tiêu đề', ],
                    [ 'type' => 'text', 'name' => 'value', 'placeholder' => 'Giá trị', ],
                ],
            ]);
            // Bộ lọc
            if (config('SudoProduct.filters') == true) {
                $form->custom('Ecommerce::admin.products.form.product_filters', [
                    'product_id' => $data_edit->id,
                    'category_id' => $data_edit->category_id,
                ]);
            }
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-4');
            $form->select('category_id', $data_edit->category_id, 1, 'Danh mục sản phẩm', $categories->data_select(), 1);
            $form->image('image', $data_edit->image, 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước 600x600 để hiển thị đẹp nhất');
            $form->multiImage('slide', array_filter(explode(',', $data_edit->slide)), 0, 'Ảnh Slide');
        $form->endCard();
        $form->action('edit', $data_edit->getUrl());

        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        $slug_item = DB::table('slugs')->where('table', 'products')->where('table_id', $id)->first();
        // Xử lý validate
        validateForm($requests, 'name', 'Tên sản phẩm không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:slugs,slug,'.$slug_item->id);
        validateForm($requests, 'category_id', 'Danh mục không được để trống.');
        validateForm($requests, 'quantity', 'Số lượng không được để trống.');
        validateForm($requests, 'price', 'Giá bán không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        $quantity = 0;
        $flash_sale = 0;
        $compare = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
       
        // Chuẩn hóa lại dữ liệu
        if (isset($slide) && !empty($slide)) { $slide = implode(',', $slide); } else { $slide = null; }
        if (isset($related_products) && !empty($related_products)) { $related_products = implode(',', $related_products); } else { $related_products = null; }
        $specifications = base64_encode(json_encode($specifications ?? []));
        $promotion = base64_encode(json_encode($promotion ?? []));
        $combo = !empty($sale) ? json_encode($sale) : '';
        // return $sale;
        $created_at = $created_at ?? date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        // Các giá trị thay đổi
        $compact = compact('promotion','combo', 'sku','name', 'category_id','slug','image', 'slide', 'price', 'price_old','detail', 'related_products', 'quantity','status','insurance', 'specifications', 'video', 'flash_sale', 'compare','updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        $slug_item = DB::table('slugs')
            ->where('table', 'products')
            ->where('table_id', $id)
            ->update([
                'slug' => $slug,
                'updated_at' => $updated_at,
            ]);
        // Lưu bộ lọc của sản phẩm
        if (isset($filters) && !empty($filters)) {
            $this->setFilter($filters, $id);
        } else{
            \Sudo\Ecommerce\Models\ProductFilter::where('product_id', $id)->delete();
        }
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.update_success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getFilter(Request $requests) {
        $category_id = $requests->category_id ?? 0;
        $product_id = $requests->product_id ?? 0;
        $render_html = view('Ecommerce::admin.products.form.product_filter_item', compact('category_id', 'product_id'))->render();
        return [
            'status' => 1,
            'html' => $render_html
        ];
    }
    /**
     * Lưu thông tin bộ lọc của sản phẩm
     */
    public function setFilter($data, $id) {
        $store_data = [];
        \Sudo\Ecommerce\Models\ProductFilter::where('product_id', $id)->delete();
        foreach ($data as $value) {
            $store_data[] = [
                'product_id' => $id,
                'filter_detail_id' => $value
            ];
        }
        \Sudo\Ecommerce\Models\ProductFilter::insert($store_data);
    }
    public function setFilterMap($data, $id) {
        \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $id)->delete();
        $maps = [];
        foreach ($data as $value) {
            $maps[] = [
                'category_id' => $id,
                'filter_id' => $value,
            ];
        }
        \Sudo\Ecommerce\Models\FilterProductCategoryMap::insert($maps);
    }
    public function deleteForever(Request $requests, $id)
    {
        if (!checkRole($this->table_name.'_delete')) {
            return response()->json([
                'status' => 2,
                'message' => __('Core::admin.no_permission')
            ]);
        }
        $checkInOrder = OrderDetail::where('product_id', $id)->exists();
        if ($checkInOrder) {
            return response()->json([
                'status' => 2,
                'message' => __('Có Lỗi xảy ra. Vui lòng thử lại!')
            ]);
        }
        try {
            $this->models->where('id', $id)
            	->where('status', -1)->delete();
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Delete forever products error :'. $e->getMessage());
            return response()->json([
                'status' => 2,
                'message' => __('Theme::general.error_message_catch')
            ]);
        }
        \DB::commit();
        return response()->json([
            'status' => 1,
            'message' => __('Core::admin.delete_success')
        ]);
    }
    public function comboSelect(Request $request) {
        $id = $request->id ?? 'id';
        $name = $request->name ?? 'name';
        $keyword = $request->keyword ?? '';
        $id_not_where = $request->id_not_where ?? [];
        $variant_not = $request->variant_not ?? [];
        $suggest_locale = $request->suggest_locale ?? 'false';
        $lists = Product::with(['product_variants' => function($query) use ($variant_not){
                $query->where('status', 1)
                    ->whereNotIn('id', $variant_not);
            }])
            ->where('products.status',1);
        // Search theo đa ngôn ngữ
        if ($suggest_locale == 'true') {
            $lists = $lists->join('language_metas', 'language_metas.lang_table_id', 'products.id')
                ->where('language_metas.lang_table', 'products')
                ->where('language_metas.lang_locale', Request()->lang_locale ?? \App::getLocale());    
        }
        // Tiếp tục tìm
        $lists = $lists->where($name,'like','%'.$keyword.'%')->orderBy('products.id','DESC')->limit(30)->offset(0)->get();
        if ($lists->count()) {
            $result = [];
            foreach ($lists as $item) {
                $variants = $item->product_variants->whereNotIn('id', $variant_not);
                if(count($variants) > 0) {
                    foreach ($variants as $vr) {
                        $result[] = [ 
                            'id'=>$item->id,
                            'variant_id' => $vr->id,
                            'name'=> $vr->getVariantNameAttribute(),
                            'reguler_price' => $vr->reguler_price > 0 ? $vr->reguler_price : $item->reguler_price,
                            'sale_price' => $vr->sale_price > 0 ? $vr->sale_price : $item->sale_price??0,
                        ];
                    }
                } else {
                    if(!in_array($item->id, $id_not_where)) {
                        $result[] = [ 
                            'id'=>$item->id,
                            'variant_id' => 0,
                            'name'=> $item->$name,
                            'reguler_price' => $item->reguler_price??0,
                            'sale_price' => $item->sale_price??0,
                        ];
                    }
                    
                }
            }
            return response()->json(['status' => 1, 'message' => __('Translate::admin.has_found_data'), 'data' => $result]);
        } else {
            return response()->json(['status' => 0, 'message' => __('Translate::admin.not_found_data')]);
        }
    }
}
