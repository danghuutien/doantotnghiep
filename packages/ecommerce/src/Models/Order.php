<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class Order extends BaseModel
{

    protected $guarded = ['id'];

	public function queryAdmin($show_data, $requests) {

		if (isset($requests->customer_name) || isset($requests->customer_phone)) {
			$show_data = $show_data->join('customers', 'customers.id', 'orders.customer_id');

			if (isset($requests->customer_name) && $requests->customer_name != '') {
				$show_data = $show_data->where('customers.name', $requests->customer_name);
			}
			if (isset($requests->customer_phone) && $requests->customer_phone != '') {
				$show_data = $show_data->where('customers.phone', $requests->customer_phone);
			}

			$show_data = $show_data->select('orders.*');
		}
		return $show_data->with(['customer.province.district.ward']);
	}
    public function orderDetail() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

	public function getTotalPrice() {
		return formatPrice($this->total_price, null);
	}

	public function getStatus() {
		switch ($this->status) {
			case '1':
				$status = $this->status;
				$status_text = __('Đơn hàng mới');
				$status_label = '<p class="badge badge-info m-0">'.$status_text.'</p>';
			break;
			case '2': 
				$status = $this->status;
				$status_text = __('Đã tiếp nhận');
				$status_label = '<p class="badge badge-primary m-0">'.$status_text.'</p>';
			break;
			case '3': 
				$status = $this->status;
				$status_text = __('Huỷ');
				$status_label = '<p class="badge badge-danger m-0">'.$status_text.'</p>';
			break;
			case '4': 
				$status = $this->status;
				$status_text = __('Thành công');
				$status_label = '<p class="badge badge-success m-0">'.$status_text.'</p>';
			break;
			case '-1': 
				$status = $this->status;
				$status_text = 'Xóa';
				$status_label = '<p class="badge badge-danger m-0">'.$status_text.'</p>';
			break;
		}
		return [
			'status' 		=> $status,
			'status_text' 	=> $status_text,
			'status_label' 	=> $status_label,
		];
	}

    public function getPaymentStatus() {
        return config('SudoOrder.payment_status')[$this->payment_status] ?? 'Chưa thanh toán';
    }
}
