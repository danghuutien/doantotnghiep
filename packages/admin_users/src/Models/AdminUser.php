<?php

namespace Sudo\AdminUser\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Sudo\Base\Models\BaseModel;

class AdminUser extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Notifiable, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google2fa_secret',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Kiểm tra phân quyền admin của tại khoản
     * @param string $role: quyền cần kiểm tra 
     */
    public function hasRole($role) {
        if ($this->id == 1) {
            return true;
        } else {
            $array_role = $this->getRole();
            // Quyền cho toàn bộ tài khoản đăng nhập truy cập
            $role_default = [ 'home', 'media_view' ];
            $array_role = array_merge($role_default, $array_role);
            // Kiểm tra quyền
            if(in_array($role, $array_role)) {
                return true;
            } else{
                return false;
            }
        }
    }

    /**
     * Lấy ra mảng các quyền
     */
    public function getRole() {
        if (!empty($this->capabilities)) {
            return json_decode($this->capabilities);
        } else {
            return [];
        }
    }

    /**
     * Lấy ra tên hiển thị của tài khoản admin 
     */
    public function getName() {
        return $this->display_name ?? $this->name;
    }

    /**
     * Lấy ra ảnh đại diện của tài khoản admin 
     */
    public function getAvatar($size=null) {
        return getImage($this->avatar, $size, getImageFile('core/img/img_avatar.png'));
    }

    /**
     * 
     */
    public function queryAdmin($show_data, $requests) {
        $show_data = $show_data->where('id', '<>', 1);
        return $show_data;
    }

    /**
     * Ecrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        if ($value == '')
        {
            return false;
        }
        return decrypt($value);
    } 
}
