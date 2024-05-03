<?php 
function getImageMedia($file='',$size='') {
	if ($file == '') {
		return asset('asset_admin/image/default_image.png');
	} else {
        $link = '';
        if (config('SudoMedia.storage_type')  == 'local') {
            // nếu là uploads trên local thì link sẽ lấy theo localhost
            $link = '/'.config('SudoMedia.folder');
        } else {
            // Lấy Domain theo cấu hình domain
            $domain = config('filesystems.disks.'.config('SudoMedia.storage_type').'.domain');
            $link = $domain.'/'.config('SudoMedia.folder');
        }
        if ($size != '') {
            if (in_array($size, array_keys(config('SudoMedia.imageSize')))) {
                $image_array = explode('.',$file);
                $image_name = $image_array[0];
                $image_extension = $image_array[1];
                $file = $image_name.'-'.$size.'.'.$image_extension;
            }
        }
        return $link.'/'.$file;
	}
}

function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . 'GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . 'MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . 'KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . 'B';
    } elseif ($bytes == 1) {
        $bytes = $bytes . 'B';
    } else {
        $bytes = '0B';
    }
    return $bytes;
}

/**
 * Hàm xử lý uploads file cho toàn web
 * @param file          $file: file cần uploads
 * @return 
 */
function uploadFile($file) {
    if (is_file($file)) {
        // Thông tin cấu hình
        $disk = config('SudoMedia.storage_type');
        $imageSize = config('SudoMedia.imageSize');
        $allowed_extension = config('SudoMedia.allowed_extension_image');
        $allowed_extension_file = config('SudoMedia.allowed_extension_file');
        $allowed_size = config('SudoMedia.allowed_size');
        // Lấy thông tin file
        $file_info = pathinfo($file->getClientOriginalName());
        // Lấy thông tin ngày tháng
        $month = date('m');
        $year = date('Y');
        $path = config('SudoMedia.folder').'/'.$year.'/'.$month.'/';
        $folder = config('SudoMedia.folder');
        // Tên file
        $file_name = str_slug($file_info['filename']);
        // Phần mở rộng
        $file_extension = $file_info['extension'];
        // Kích thước
        $file_size = filesize($file);
        // Tên kèm đuôi file
        $file_name_ext = $file_name.'.'.$file_extension;
        // Nếu file nhỏ hơn kích thước mới được xử lý tiếp
        if ($file_size <= $allowed_size) {
            try {
                /* Upload ảnh lên server/local được kết nối với Storage  */
                $upload = Storage::disk($disk);
                // Check trùng tên
                $i=0;
                while($upload->exists($path.$file_name_ext)) {
                    $i++;
                    $file_name_ext = $file_name.'-'.$i.'.'.$file_extension;
                }
                // check đuôi file và up file lên
                if(in_array(strtolower($file_extension), $allowed_extension)) {
                    $image = Image::make($file)->stream();
                    $upload->put($path.$file_name_ext, $image->__toString(), 'public');
                    // resize ảnh với ảnh gốc Mảng resize đặt tại config/SudoMedia
                    foreach($imageSize as $key=>$value) {
                        $image_resize = Image::make($image)->widen($value);
                        $image_resize = $image_resize->stream($file_extension, 60);
                        $image_resize_path = $path.$file_name;
                        if($i > 0) $image_resize_path .= '-'.$i;
                        $image_resize_path .= '-'.$key;
                        $image_resize_path .= '.'.$file_extension;
                        $upload->put($image_resize_path, $image_resize->__toString(),'public');
                    }
                    $file_info = [
                        'name' => $file_name_ext,
                        'size' => $file_size,
                        'type' => 'image',
                        'extention' => $file_extension,
                    ];
                } elseif (in_array(strtolower($file_extension), $allowed_extension_file)) {
                    $upload->put($path.$file_name_ext, file_get_contents($file),'public');
                    $file_info = [
                        'name' => $file_name_ext,
                        'size' => $file_size,
                        'type' => 'file',
                        'extention' => $file_extension,
                    ];
                }
                $oldUrl = '/'.$folder.'/'.$folder;
                $newUrl = '/'.$folder;
                return [
                    'status' => 1,
                    'message' => __('Translate::media.upload_success').$file_name_ext,
                    'file_info' => $file_info,
                    'url' => str_replace($oldUrl, $newUrl, getImageMedia($path.$file_name_ext)),
                ];
            } catch (\Exception $e) {
                Log::error('Upload Fail: '.$file_name_ext);
                Log::error($e);
                return [
                    'status' => 2,
                    'message' => __('Translate::media.upload_fail').$file_name_ext,
                ];
            }
        } else {
            return [
                'status' => 2,
                'message' => __('Translate::media.upload_size_fail'),
            ];
        }
    }
    return [
        'status' => 2,
        'message' => __('Translate::media.no_file_found'),
    ];
}