<?php

namespace Sudo\Theme\Models;

class Setting extends BaseModel {
	
	public $timestamps = false;

	/**
	 * Lưu hoặc cập nhật dữ liệu cấu hình
	 * @param requests 		$requests: dữ liệu truyền từ form lên
	 * @param string 		$setting_name: Key cấu hình
	 */
	public function postData($requests, $setting_name) {
		// Chuyển requests sang mảng
		$data = $requests->all();
		// Bỏ giá trị không cần thiết
		$unset = [ '_token', 'redirect', 'setLanguage' ];
		foreach ($unset as $value) {
			unset($data[$value]);
		}
		// mã hóa data
		$locale = $data['locale'] ?? getLocale();
		$data = base64_encode(json_encode($data));
		if (Setting::where('key', $setting_name)->where('locale', $locale)->exists()) {
			Setting::where('key', $setting_name)->where('locale', $locale)->update([
				'value' 	=> $data
			]);
		} else {
			Setting::insert([
				'key' 		=> $setting_name,
				'locale' 	=> $locale,
				'value' 	=> $data
			]);
		}
		// Xóa Cache setting nếu đã lưu
		\Cache::pull('setting_'.$setting_name.'_'.getLocale());
	}

	/**
	 * Lấy dữ liệu cấu hình theo tên và ngôn ngữ
	 * @param string 		$setting_name: Key cấu hình
	 * @param string 		$locale: ngôn ngữ lấy tại config('app.language')
	 */
	public function getData($setting_name, $locale = null) {
		// Ngôn ngữ hiện tại
		$locale = $locale ?? getLocale();
		$option = Setting::where('key', $setting_name)->where('locale', $locale)->first();
		$data = [];
		if (!empty($option)) {
			$data = json_decode(base64_decode($option->value), true);
		}
		return $data;
	}

}