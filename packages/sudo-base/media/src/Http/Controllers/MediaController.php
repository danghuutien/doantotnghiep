<?php
namespace Sudo\Media\Http\Controllers;
use App\Http\Controllers\Controller;

use Log;
use DB;
use Cache;
use Image;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Sudo\Media\Models\Media;

class MediaController extends Controller {
    /* Cấu hình lưu tại config */
    var $disk;
	/**
     * @var array mảng các size theo chiều rộng
     */
    var $imageSize;
    /**
     * @var array mảng các phần mở rộng được chấp nhận
     */
    var $allowed_extension;
    var $allowed_extension_file;
    /**
     * @var int kích thước file cho phép (Byte) (2097152 B = 2 MB)
     */
    var $allowed_size;
    /* Số lượng File phân trang */
    var $paginate;

    function __construct() {
        $this->disk = config('SudoMedia.storage_type');
        $this->imageSize = config('SudoMedia.imageSize');
        $this->allowed_extension = config('SudoMedia.allowed_extension_image');
        $this->allowed_extension_file = config('SudoMedia.allowed_extension_file');
        $this->allowed_size = config('SudoMedia.allowed_size');
        $this->paginate = config('SudoMedia.paginate');

        // Sử dụng middleware để check phân quyền và set ngôn ngữ
        $this->middleware(function ($request, $next) {
            // Đặt lại ngôn ngữ nếu trên url có request setLanguage
            setLanguage($request->setLanguage);

            return $next($request);
        });
    }

	public function view() {
        loadStyleAdmin();
        return view('media::view');
    }
    /*
        View hiển thị chính của Package
        Url = /admin/media?type=image&filter=default
    */

    public function index(Request $request) {
        if ($request->ajax()) {
            // Ajax load image
            $medias = Media::where('status',1);
            if (isset($request->type)) {
                switch ($request->type) {
                    case 'default':  break;
                    case 'image': $medias->where('type',$request->type); break;
                    case 'file': $medias->where('type',$request->type); break;
                }
            }
            if (isset($request->filter)) {
                switch ($request->filter) {
                    case 'default': $medias->orderBy('created_at','desc'); break;
                    case 'name-asc': $medias->orderBy('name','asc'); break;
                    case 'name-desc': $medias->orderBy('name','desc'); break;
                    case 'created_at-asc': $medias->orderBy('created_at','asc'); break;
                    case 'created_at-desc': $medias->orderBy('created_at','desc'); break;
                    case 'size-asc': $medias->orderBy('size','asc'); break;
                    case 'size-desc': $medias->orderBy('size','desc'); break;
                }
            } else {
                $medias->orderBy('created_at','desc');
            }
            if (isset($request->only)) {
                switch ($request->only) {
                    case 'image': $medias->where('type','image'); break;
                    case 'file': $medias->where('type','file'); break;
                }
            }
            if (isset($request->name) && !empty($request->name)) {
                $medias->where('name', 'LIKE', '%'.$request->name.'%');
            }
            $medias = $medias->paginate($this->paginate);

            $count_media = count($medias);
            $render_media = view('media::media-item')->with(['data'=>$medias])->render();
            $media_item =  $render_media;
            $pagination = $medias->appends(request()->all())->links()->toHtml();
            return ['data_length'=>$count_media,'data'=>$media_item,'paginate'=>$pagination];
        } else {
            $medias = [];
            return view('media::index',compact('medias'));
        }
    }
    /* Cập nhật Tittle và Caption */
    public function update(Request $request) {
        Media::EditImage($request);
        return 'Cập nhật thành công';
    }
    /* Ẩn ảnh khỏi danh sách */
    public function destroy(Request $request) {
        $id = $request->id;
        $media = DB::table('medias')->where('id', $id)->first();

        $upload = Storage::disk($this->disk);
        config('SudoMedia.storage_type');
        $path = date('Y',strtotime($media->created_at)).'/'.date('m',strtotime($media->created_at)).'/';
        $imageName = $media->name;
        $path = config('SudoMedia.folder').'/'.$path;
        $upload->delete($path.$imageName);

        // Xóa ảnh resize
        $arrayImageName = explode('.', $imageName);
        foreach($this->imageSize as $key => $value){
            $imageNameResize = $arrayImageName[0].'-'.$key.'.'.$arrayImageName[1];
            dump($imageNameResize);
            $upload->delete($path.$imageNameResize);
        }
        
        DB::table('medias')->where('id', $id)->delete();
        return 'Xóa thành công';
    }
    public function checkUpload(){
        $storage_size_link = env('STORAGE_SIZE_LINK');
        $storage_size = env('STORAGE_SIZE');
        if($storage_size_link == '' || $storage_size == ''){ // Nếu không nhập link lấy size hiện tại hoặc nhập size tối đa thì bỏ qua bước check upload
            return 1;
        }
        $storage_size = $storage_size * 1073741824; // dung lượng tối đa được phép tải lên tính bằng byte

        // Lấy dung lượng lưu trữ hiện tại tính theo byte
        $content = file_get_contents($storage_size_link);
        $content = json_decode($content, 1);
        $current_size = $content['bytes'];

        if($current_size < $storage_size){ // Dung lượng hiện tại nhỏ hơn dung lượng tối đa được phép tải lên
            return 1;
        }
        return 0;
    }

    /* Thên ảnh */
    public function store(Request $request) {
        if($request->hasFile('files')) {
            $files = $request->files;
            $check_size = 0;
            foreach ($files as $file) {
                if (filesize($file) > $this->allowed_size) $check_size = 1;
            }
            if ($check_size == 1) {
                header('HTTP/1.0 403');
                die(__('Translate::media.upload_size_fail'));
            } else {
                $check_upload = $this->checkUpload();
                if($check_upload == 0){
                    return [
                        'status' => -1,
                        'message' => 'Dung lượng lưu trữ của quý khách đã đầy, xin vui lòng xóa bớt dữ liệu hoặc <a target="_blank" style="color: #428bca;" href="https://sudo.vn">nâng cấp</a> ngay',
                        'media_id' => $media_id??0,
                        'link' => $link ?? '',
                    ];
                }
                foreach ($files as $file) {
                    // Lấy thông tin file
                    $file_info = pathinfo($file->getClientOriginalName());
                    // Lấy thông tin ngày tháng
                    $month = date('m');
                    $year = date('Y');
                    $path = config('SudoMedia.folder').'/'.$year.'/'.$month.'/';
                    // Tên file
                    $file_name = str_slug($file_info['filename']);
                    // Phần mở rộng
                    $file_extension = $file_info['extension'];
                    // Kích thước
                    $file_size = filesize($file);
                    //Tên kèm đuôi file
                    $file_name_ext = $file_name.'.'.$file_extension;
                    try {
                        /* Upload ảnh lên server/local được kết nối với Storage  */
                        $upload = Storage::disk($this->disk);
                        // Check trùng tên
                        $i=0;
                        while($upload->exists($path.$file_name_ext)) {
                            $i++;
                            $file_name_ext = $file_name.'-'.$i.'.'.$file_extension;
                        }
                        // check đuôi file và up file lên
                        if(in_array(strtolower($file_extension),$this->allowed_extension)) {
                            $image = Image::make($file)->stream();
                            $upload->put($path.$file_name_ext, $image->__toString(), 'public');
                            // resize ảnh với ảnh gốc Mảng resize đặt tại config/SudoMedia
                            foreach($this->imageSize as $key=>$value) {
                                $image_resize = Image::make($image)->widen($value);
                                $image_resize = $image_resize->stream($file_extension, 100);
                                $image_resize_path = $path.$file_name;
                                if($i > 0) $image_resize_path .= '-'.$i;
                                $image_resize_path .= '-'.$key;
                                $image_resize_path .= '.'.$file_extension;
                                $upload->put($image_resize_path, $image_resize->__toString(),'public');
                            }
                            $file_add = [
                                'name' => $file_name_ext,
                                'size' => $file_size,
                                'type' => 'image',
                                'extention' => $file_extension,
                            ];
                        } elseif (in_array(strtolower($file_extension),$this->allowed_extension_file)) {
                            $upload->put($path.$file_name_ext, file_get_contents($file),'public');
                            if (in_array($file_extension, [ 'gif' ])) {
                                $type_file = 'image';
                            } else {
                                $type_file = 'file';
                            }
                            $file_add = [
                                'name' => $file_name_ext,
                                'size' => $file_size,
                                'type' => $type_file,
                                'extention' => $file_extension,
                            ];
                        }
                        if (isset($file)) { 
                            $media_id = Media::AddFile($file_add);
                            if($this->disk == 's3'){
                                $link = config('filesystems.disks.s3.domain').'/'.$path.$file_name_ext;
                            }
                        }
                        return [
                            'status' => 1,
                            'message' => __('Translate::media.upload_success').$file_name_ext,
                            'media_id' => $media_id??0,
                            'link' => $link ?? '',
                        ];
                    } catch (\Exception $e) {
                        Log::error('Upload Fail: '.$file_name_ext);
                        Log::error($e);
                        return [
                            'status' => 2,
                            'message' => __('Translate::media.upload_fail').$file_name_ext,
                        ];
                    }
                }
            }
        }
    }
}