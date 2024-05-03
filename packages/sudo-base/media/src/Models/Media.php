<?php

namespace Sudo\Media\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Media extends Model
{
    protected $table = 'medias';

    protected $fillable = [
        'user_id', 'name', 'size', 'title', 'caption', 'type', 'extention', 'status'
    ];
    public function getPath() {
        $created_at = $this->created_at;
        $year = $created_at->format('Y');
        $month = $created_at->format('m');
        $path = $year.'/'.$month.'/';
        return $path;
    }
	public function getImage($size='medium') {
		if (isset($this->name)) {
            if (in_array($this->extention,config('SudoMedia.allowed_extension_file'))) {
                if ($this->extention == 'gif') {
                    $image = getImageMedia($this->getPath().$this->name);
                } else {
                    $image = '/platforms/media/img/file/image-'.$this->extention.'.png';
                }
                return $image;
            } else {
                $image = getImageMedia($this->getPath().$this->name,$size);
                return $image;
            }
		} else {
			return getImageMedia();
		}
	}
    public function getUrl() {
        if (isset($this->name)) {
            $image = getImageMedia($this->getPath().$this->name);
            return $image;
        } else {
            return getImageMedia();
        }
    }
    
    public function getSize() {
    	return formatSizeUnits($this->size);
    }
    public function getCreatedAt() {
    	return $this->created_at->format('H:i d/m/Y');
    }
    public function getUpdatedAt() {
    	return $this->updated_at->format('H:i d/m/Y');
    }
    public function getTitle() {
    	return $this->title??'';
    }
    public function getCaption() {
    	return $this->caption??'';
    }
    /*
        Thêm Ảnh vào DB
        $file = [
            'name' => $image_name,
            'size' => $file_size,
            'type' => 'file',
            'extention' => $file_extension,
        ];
    */
    public static function AddFile($file) {
        $file = json_decode(json_encode($file));
        $time = date('Y-m-d H:i:s');
        $media_id = Media::insertGetId([
            'user_id' => Auth::guard('admin')->user()->id??0,
            'name' => $file->name,
            'size' => $file->size,
            'type' => $file->type,
            'extention' => $file->extention,
            'title' => '',
            'caption' => '',
            'status' => 1,
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        return $media_id;
    }
    public static function EditImage($request) {
        Media::where('id',$request->id)->update([
            'title' => $request->title,
            'caption' => $request->caption,
        ]);
    }
    public static function ChangeStatus($id,$status) {
        Media::where('id',$id)->update([
            'status' => $status,
        ]);
    }
}
