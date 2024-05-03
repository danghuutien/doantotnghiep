<?php

namespace Sudo\CallMeBack\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Sudo\CallMeBack\Models\CallMeBack;

class CallMebackController extends Controller
{
    public function phone(Request $request){
    	$data = $request->all();
		$created_at = $updated_at = date('Y-m-d H:i:s');

        $newUser = CallMeBack::updateOrCreate([
            'phone' => $data['phone'],
        ],[
            'name' => $data['name'] ?? '',
            'current_page' => $data['url'],
            'active_status' => 0,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
        $result['message'] = __('Thành công! Chúng tôi sẽ gọi lại cho bạn!');
    	return json_encode($result);
    }
}
