<?php

namespace Sudo\Base\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    /**
     * Query trực tiếp từ models
     * @param models            $show_data: models
     * @param requests          $requests: các giá trị tuyên lên
     */
    public function queryAdmin($show_data, $requests) {
        // DEMO: $show_data = $show_data->where('status', 1);
        return $show_data;
    }

    /**
     * Hàm tạo chung cho toàn bộ Model
     * @param requests          $requests: các giá trị tuyên lên
     * @param number            $id: id bản ghi
     * @param array             $compact: các giá trị đã xử lý dùng để update
     * @param boolean           $has_seo: có sử dụng seos hay không (true có | false không) (mặc định không)
     * @param boolean           $logs: bảng có muốn ghi logs hay không (true có | false không) (mặc định có)
     * @return $id
     */
    public function createRecord($requests, $compact, $has_seo = false, $has_locale = false, $logs = true) {
        // Tên bảng
        $table_name = BaseModel::getTable();
        // Kiểm tra nếu bảng có trường created_at, updated_at thì sẽ tự tạo nếu compact không có
        if (\Schema::hasColumn($table_name, 'created_at')) {
            $compact['created_at'] = $compact['created_at'] ?? date('Y-m-d H:i:s');
        }
        if (\Schema::hasColumn($table_name, 'updated_at')) {
            $compact['updated_at'] = $compact['updated_at'] ?? date('Y-m-d H:i:s');
        }
        // Thêm mới bản ghi và lấy ra ID
        $id = BaseModel::insertGetId($compact);
        // Nếu có seos
        if ($has_seo == true) {
            seos($requests, $table_name, $id);
        }
        // Nếu có đa ngôn ngữ
        if ($has_locale == true) {
            langMetas($requests, $table_name, $id);
        }
        // Nếu có ghi logs
        if ($logs == true) {
            systemLogs('create', $compact, $table_name, $id);
        }
        return $id;
    }

    /**
     * Hàm cập nhật chung cho toàn bộ Model
     * @param requests          $requests: các giá trị tuyên lên
     * @param number            $id: id bản ghi
     * @param array             $compact: các giá trị đã xử lý dùng để update
     * @param boolean           $has_seo: có sử dụng seos hay không (true có | false không) (mặc định không)
     * @param boolean           $logs: bảng có muốn ghi logs hay không (true có | false không) (mặc định có)
     */
    public function updateRecord($requests, $id, $compact, $has_seo = false, $logs = true) {
        // Tên bảng
        $table_name = BaseModel::getTable();
        // Kiểm tra nếu bảng có trường updated_at thì sẽ tự tạo ngày cập nhật nếu compact không có
        if (\Schema::hasColumn($table_name, 'updated_at')) {
            $compact['updated_at'] = $compact['updated_at'] ?? date('Y-m-d H:i:s');
        }
        // Nếu có seos
        if ($has_seo == true) {
            seos($requests, $table_name, $id);
        }
        // Nếu có ghi logs (Phải ghi trước khi cập nhật)
        if ($logs == true) {
            systemLogs('update', $compact, $table_name, $id);
        }
        // Cập nhật bản ghi
        BaseModel::where('id', $id)->update($compact);
    }

    /**
     * Hàm lấy ra modules cấu hình dùng cho Form Menu
     * @param boolean           $has_locale: có sử dụng đa ngôn ngữ hay không (true có | false không) (mặc định không)
     */
    public function getCustomMenu($has_locale = false) {
        $datas = BaseModel::whereIn('status', BaseModel::setCustomMenuStatus());
        if ($has_locale == true) {
            $table_name = BaseModel::getTable();
            $datas = $datas->join('language_metas', 'language_metas.lang_table_id', $table_name.'.id')
                            ->where('lang_table', $table_name)
                            ->where('lang_locale', \App::getLocale());
        }
        $datas = $datas->select(BaseModel::setCustomMenuSelect())->get();
        $menu = [];
        foreach ($datas as $value) {
            $menu[$value->getUrl()] = [
                'id'        => $value->id,
                'name'      => $value->getName()
            ];
        }
        return $menu;
    }
    // status lấy cho menu_form
    public function setCustomMenuStatus() {
        return [ 1 ];
    }
    // Các fields lấy cho select tại menu_form 
    public function setCustomMenuSelect() {
        return ['id', 'name', 'slug'];
    }

    // CÁC HÀM CHUNG LẤY RA GIÁ TRỊ NẾU CÓ

    /**
     * Lấy link mặc định cho toàn bộ modules nếu module đó không có hàm getUrl
     */
    public function getUrl() {
        return '/';
    }

    public function getName() {
        return $this->name ?? '';
    }

    /**
     * Lấy ngày tạo
     * @param string            $format: định dạng ngày
     */
    public function getTime($field = 'created_at', $format = 'H:i:s d/m/Y') {
        if (!empty($this->$field)) {
            return formatTime($this->$field, $format);
        } else {
            return '';
        }
    }

    /**
     * Lấy ra ảnh đại diện
     * @param string            $size: Kích thước ảnh quy định tại config('SudoMedia.imageSize')
     * @param string            $fields: tên trường ảnh [Mặc định là image]
     */
    public function getImage($size = '', $fields = 'image') {
        return getImage($this->$fields ?? '', $size);
    }

    /**
     * Lấy ra mô tả
     * @param string            $fields: tên trường ảnh [Mặc định là detail]
     */
    public function getDesc($number =  170, $fields = 'detail') {
        return cutString(removeHTML($this->$fields), $number);
    }

    //  CÁC HÀM THUỘC HỖ TRỢ DANH MỤC

    /**
     * Lấy ra danh mục cha
     * Nếu không có trả về null
     */
    public function getParent() {
        if ($this->parent_id != 0) {
            $parent = BaseModel::where('id', $this->parent_id)->first();
            return $parent;
        } else {
            return null;
        }
    }

    /**
     * Lấy ra danh mục con (Chỉ lấy danh mục con cấp 1)
     */
    public function getChild() {
        return BaseModel::where('parent_id', $this->id)->orderBy('order','ASC')->get();
    }

    /**
     * Lấy các danh mục ông cha ... dùng cho 1 số trường hợp như hiển thì breadcrumb
     * @return mảng danh mục ông cha của danh mục hiện tại theo thứ tự
     */
    public function getParentIds() {
        $case = [];
        $parents = $this->getParent();
        while($parents) {
            array_unshift($case, $parents);
            $parents = $parents->getParent();
        }
        return $case;
    }

    /**
     * Lấy ra danh mục con (Lấy ra mọi cấp danh mục con)
     */
    public function getChildIds() {
        $ids = [$this->id];
        $childs = $this->getChild();
        if($childs->count()) {
            foreach ($childs as $value) {
                $ids = array_merge($ids, $value->getChildIds());
            }
        }
        return $ids;
    }

    public function scopeActive($query) {
        return $query->where('status', 1);
    }
}
