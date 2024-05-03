<?php 

/**
 * Tự động cập nhật tags
 * @param array         $tags: mảng text chứa các tags VD: ['tags 1', 'tags 2']
 * @param string        $tag_table: tên bảng
 * @param number        $tag_table_id: id của bảng
 */
function tags($tags, $tag_table, $tag_table_id) {
    // Xóa tags maps trước
    \Sudo\Tag\Models\TagMap::where('tag_table', $tag_table)->where('tag_table_id', $tag_table_id)->delete();
    foreach ($tags as $tag) {
        // Định dạng lại tên tags
        $tag = ucfirst(mb_strtolower(trim($tag)));
        // Nếu tên tags không trống thì sử lý tiếp
        if (!empty($tag)) {
            $check_exists = \Sudo\Tag\Models\Tag::where('slug', str_slug($tag))->first();
            if (empty($check_exists)) {
                $tag_id = \Sudo\Tag\Models\Tag::insertGetId([
                    'name'          => $tag,
                    'slug'          => str_slug($tag),
                    'status'        => 1,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
                \DB::table('seos')->insert([
                    'type'          => 'tags',
                    'type_id'       => $tag_id,
                    'title'         => '',
                    'description'   => '',
                    'robots'        => 'Index,Follow',
                ]);
            } else {
                $tag_id = $check_exists->id;
                \Sudo\Tag\Models\Tag::where('id', $tag_id)->update([
                    'name'          => $tag,
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]);
            }
            \Sudo\Tag\Models\TagMap::insert([
                'tag_table'         => $tag_table,
                'tag_table_id'      => $tag_table_id,
                'tag_id'            => $tag_id,
            ]);
        }
    }
}

/**
 * Danh sách tags theo bảng và id
 * @param string        $tag_table: tên bảng
 * @param number        $tag_table_id: id của bảng
 */
function getTagList($tag_table, $tag_table_id) {
    $tag_maps = \Sudo\Tag\Models\TagMap::where('tag_table', $tag_table)->where('tag_table_id', $tag_table_id)->get();
    $tags = \Sudo\Tag\Models\Tag::whereIn('id', $tag_maps->pluck('tag_id')->toArray())->get();
    return $tags;
}