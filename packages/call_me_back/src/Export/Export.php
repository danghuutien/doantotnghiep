<?php 
namespace Sudo\CallMeBack\Export;

use Sudo\CallMeBack\Models\CallMeBack;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Export implements FromView
{
    public function view(): View
    {
        return view('CallMeBack::admin.export', [
            'data' => CallMeBack::all(),
            'status' => config('app.status'),
            'active_status' => [0 => 'Chờ xử lý', 1 => 'Đã gọi khách']
        ]);
    }
}