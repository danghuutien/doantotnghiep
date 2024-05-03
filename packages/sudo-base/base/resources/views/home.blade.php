@extends('Core::layouts.app')
@section('title') @lang('Chào mừng bạn đến với trang quản trị') @endsection
@section('content')
	{{-- <div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<div class="x_panel">
                        <div class="x_content">
                            <h4>Hướng dẫn quản trị</h4>
						    <ul>
						        <li>Quản lý các Modules theo các danh mục Modules bên trái</li>
						        <li>Nội dung các Modules được hiển thị ở khung bên phải</li>
						        <li>Có thể mở rộng màn hình module bằng cách mở rộng/thu nhỏ thanh điều hướng ở header</li>
						        <li>Icon user : Truy cập Module quản lý thông tin cá nhân - Thoát phiên đăng nhập</li>
						    </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	<div class="dashboard">
		<div class="dashboard__content" style="background: #fff;border-radius: 10px;padding: 10px;">
			<div class="dashboard__content--title" style="padding: 10px 0;border-bottom: 2px solid #E6E9ED;">
				<span style="font-size: 25px;">{{ __('Hệ thống quản trị') }}</span>
			</div>
			<div class="dashboard__content--tutorials" style="padding: 10px 0;">
				<span class="tutorials">{{ __('Hướng dẫn quản trị') }}</span>
				<ul class="tutorials__list">
					<li>{{ __('Quản lý các Modules theo các danh mục Modules bên trái.') }}</li>
					<li>{{ __('Nội dung các Modules được hiển thị ở khung bên phải') }}</li>
					<li>{{ __('Icon user : Truy cập Module quản lý thông tin cá nhân - Thoát phiên đăng nhập') }}</li>
				</ul>
			</div>
			<div class="dashboard__content--tutorials" style="padding: 10px 0;">
				<span class="tutorials">{{ __('Hướng dẫn tính năng thêm, sửa, xóa') }}</span>
				<ul class="tutorials__list">
					<li>{{ __('1. Thêm: Click vào mục thêm mới tại module hoặc vào trang danh sách và click vào nút thêm mới để thêm, nhập đầy đủ thông tin và thêm mới') }}</li>
					<li>{{ __('2. Sửa: Tại trang danh sách, click vào tên hoặc hành động sửa (icon sửa) tương ứng để sửa, nhập đầy đủ thông tin và sửa') }}</li>
					<li>{{ __('3. Xóa: Tại trang danh sách, hành động xóa (icon xóa) tương ứng để xóa') }}</li>
				</ul>
			</div>
			<div class="dashboard__content--tutorials" style="padding: 10px 0;">
				<span class="tutorials">{{ __('Hướng dẫn sử dụng các nút hành động tại trang chi tiết') }}</span>
				<ul class="tutorials__list">
					<li>{{ __('1. Thêm mới: Sau khi nhập xong dữ liệu click vào thêm mới để thêm, sau khi click vào thêm mới thì mặc định về hiển thị chi tiết cái vừa thêm (vào trang sửa) ') }}</li>
					<li>{{ __('2. Cập nhật: Sửa lại dữ liệu, sau đó click vào cập nhật để lưu lại thông tin') }}</li>
					<li>{{ __('3. Cập nhật và Thoát: Sửa dữ liệu, lưu lại và thoát ra trang danh sách') }}</li>
					<li>{{ __('4. Thoát: Thoát khỏi hành động đang thực hiện mà không lưu thông tin') }}</li>
				</ul>
			</div>
			<div class="dashboard__content--tutorials" style="padding: 10px 0;">
				<span class="tutorials">{{ __('Một số lưu ý chung') }}</span>
				<ul class="tutorials__list">
					<li>{{ __('1. Đường dẫn: Đường dẫn mặc định lấy theo tiêu đề (hoặc tên), có thể sửa đường dẫn tùy ý bằng cách click vào Edit bên đường dẫn. Lưu ý: đường dẫn là duy nhất, không được trùng nhau') }}</li>
					<li>{{ __('2. Thời gian: Thời gian xuất bản và thời gian cập nhật đang được lấy mặc định thời gian thêm mới và sửa hiện tại ') }}</li>
					<li>{{ __('3. Trạng thái: Hiện tại mặc định đang để trạng thái hoạt động, click vào button để thay dổi trạng thái') }}</li>
				</ul>
			</div>
			<span style="font-size: 18px; font-weight: 600; display: block; margin: 20px 0;">Dưới đây là ví dụ 1 số module, các module còn lại xử lý tương tự</span>
			<div class="dashboard__content--product module">
				<div class="product">
					<div class="module__title product__title">
						<span>{{ __('Module Ecommerce') }}</span>
					</div>
					<div class="product__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Để tạo sản phẩm cần làm theo các bước sau:') }}</span>
							<ul class="steps">
								<li>{{ __('Bước 1: Tạo bộ lọc') }}</li>
								<li>{{ __('Bước 2: Tạo danh mục sản phẩm') }}</li>
								<li>{{ __('Bước 3: Tạo sản phẩm') }}</li>
							</ul>
							<span class="title">{{ __('1. Tạo bộ lọc') }}</span>
							<ul class="steps">
								<li>{{ __('1.1 Thêm, Sửa bộ lọc theo nhóm bộ lọc') }}
									<ul class="steps__list">
										<li>{{ __('Click vào bộ lọc, tại đây hiển thị danh sách nhóm bộ lọc; chọn thêm mới để thêm hoặc click vào tên (hoặc nút sửa) để sửa bộ lọc') }}</li>
										<li>{{ __('Điền tên nhóm Bộ lọc: (VD: Trọng lượng)') }}</li>
										<li>{{ __('Click vào dấu + để thêm nhiều hơn 1 chi tiết bộ lọc (ví dụ: 1kg) cho nhóm bộ lọc , click vào nút thùng rác ở trên góc phải để xóa') }}</li>
									</ul>
								</li>
								<li>{{ __('1.2 Xóa bộ lọc') }}
									<ul class="steps__list">
										<li>{{ __('Xóa nhóm bộ lọc bằng cách click vào nút xóa tương ứng tại trang danh sách') }}</li>
										<li>{{ __('Xóa chi tiết bộ lọc bằng cách vào sửa nhóm bộ lọc và xóa ') }}</li>
									</ul>
								</li>
							</ul>
							<span class="title">{{ __('2. Tạo danh mục sản phẩm: Thêm, sửa, xóa danh mục sản phẩm như đã hướng dẫn trên') }}</span>
							<ul class="steps">
								<li>{{ __('Lưu ý khi thêm, sửa: Chọn danh mục cha nếu Danh mục đó có Danh mục cha, không có không phải chọn.') }}</li>
								<li>{{ __('Chọn nhóm bộ lọc cho danh mục') }}</li>
							</ul>
							
							<span class="title">{{ __('3. Tạo sản phẩm: Thêm, sửa, xóa sản phẩm như đã hướng dẫn trên') }}</span>
							<ul class="steps">
								<li>{{ __('Một số lưu ý khi nhập các trường thông tin cho sản phẩm: ') }}
									<ul>
										<li>{{ __('Giá thị trường (nếu có) > giá bán') }}</li>
										<li>{{ __('Danh mục: Chọn 1 hoặc nhiều danh mục cho sản phẩm') }}</li>
										<li>{{ __('Quản lý kho hàng: Tích chọn quản lý kho để nhập số lượng') }}</li>
										<li>{{ __('Bộ lọc: chọn bộ lọc tương ứng cho từng sản phẩm') }}</li>
									</ul>
								</li>
							</ul>
							<span class="title">{{ __('Đơn hàng') }}</span>
							<ul class="steps">
								<li>{{ __('Thống kê toàn bộ đơn hàng') }}</li>
								<li>{{ __('Quản trị viên có quyền được xem chi tiết đơn hàng, xóa đơn hàng') }}</li>
								<li>{{ __('Vào xem đơn hàng để thay đổi trạng thái đơn hàng và tải thông tin chi tiết đơn') }}</li>
							</ul>
							<span class="title">{{ __('Tính năng chỉnh sửa đơn hàng') }}</span>
							<ul class="steps">
								<li>{{ __('Để chỉnh sửa đơn hàng thì đơn hàng phải ở trạng thái đã tiếp nhận') }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--post module">
				<div class="module-post">
					<div class="module__title post__title">
						<span>{{ __('Module bài viết') }}</span>
					</div>
					<div class="post__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Để sử dụng module bài viết làm theo các bước sau:') }}</span>
							<ul class="steps">
								<li>{{ __('B1: Tạo danh mục bài viết') }}</li>
								<li>{{ __('B2: Tạo bài viết') }}</li>
							</ul>
							<span class="title">{{ __('1. Tạo danh mục bài viết') }}</span>
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa danh mục bài viết như đã hướng dẫn trên') }}</li>
							</ul>
							<span class="title">{{ __('2. Tạo bài viết') }}</span>
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa bài viết như đã hướng dẫn trên') }}</li>
								<li>{{ __('1 bài viêt có thể chọn 1 hoặc nhều danh mục') }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--voucher module">
				<div class="voucher">
					<div class="module__title voucher__title">
						<span>{{ __('Module mã giảm giá') }}</span>
					</div>
					<div class="voucher__content module__content">
						<div class="module__content--title">
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa mã giảm giá như đã hướng dẫn trên') }}</li>
								<li>{{ __('Kiểu giảm giá gồm 2 kiểu: Tiền và Phần trăm, nếu chọn kiểu là tiền thì nhập số tiền (ví dụ: 50.000đ thì nhập 50000); nếu là Phần trăm thì nhập số phần trăm (ví dụ 20% thì nhập 20) được giảm tại trường Giá trị bên dưới') }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--page module">
				<div class="page">
					<div class="module__title page__title">
						<span>{{ __('Module giờ vàng giá sốc') }}</span>
					</div>
					<div class="module__goldentime module__content">
						<div class="module__content--title">
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa giờ vàng giá sốc như đã hướng dẫn trên')}}</li>
							</ul>
							<span class="title">{{ __('Lưu ý') }}</span>
							<ul class="steps">
								<li>{{ __('Nhập tất cả các thông tin yêu cầu không được bỏ trống') }}</li>
								<li>{{ __('Thời gian bắt đầu cần phải bé hơn thời gian kết thúc') }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--page module">
				<div class="page">
					<div class="module__title page__title">
						<span>{{ __('Module Cửa hàng') }}</span>
					</div>
					<div class="module__goldentime module__content">
						<div class="module__content--title">
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa cửa hàng như đã hướng dẫn trên')}}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--page module">
				<div class="page">
					<div class="module__title page__title">
						<span>{{ __('Module trang đơn') }}</span>
					</div>
					<div class="module__goldentime module__content">
						<div class="module__content--title">
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa Trang đơn như đã hướng dẫn trên')}}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--link module">
				<div class="link">
					<div class="module__title link__title">
						<span>{{ __('Module link đồng bộ') }}</span>
					</div>
					<div class="link__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Đây là module quản lý link đồng bộ') }}</span>
							<ul class="steps">
								<li>{{ __('Những link đã tồn tại trên hệ thống nhưng đã được sửa thì cần điều hướng lại link') }}</li>
								<li>{{ __('Liên kết nguồn chính là link cũ, Liên kết đich là link mới') }}</li>
								<li>{{ __('Lưu ý khi nhập link: thay domain bằng dấu / (ví dụ: ta có link đầy đủ như sau : http://toshiko.vn/blog/preserve.html thì chỉ nhập /blog/preserve.html') }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--slide module">
				<div class="slide">
					<div class="module__title slide__title">
						<span>{{ __('Module quản lý slide') }}</span>
					</div>
					<div class="slide__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Đây là module quản lý Baner slides ở trang chủ') }}</span>
							<ul class="steps">
								<li>{{ __('Thêm, sửa, xóa slide như đã hướng dẫn trên') }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--contact module">
				<div class="contact">
					<div class="module__title contact__title">
						<span>{{ __('Module Liên hệ') }}</span>
					</div>
					<div class="contact__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Thống kê lại toàn bộ khách hàng đã gửi liên hệ từ website') }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--admin module">
				<div class="admin">
					<div class="module__title admin__title">	
						<span>{{ __('Module Tài khoản quản trị') }}</span>
					</div>
					<div class="admin__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Đây là module quản lý các tài khoản quản trị') }}</span>
							<ul class="steps">
								<li>{{ __('Thống kê danh sách các tài khoản quản trị') }}</li>
								<li>{{ __('Thêm mới, sửa tài khoản quản trị') }}
									<ul>
										<li>{{ __('Nhập thông tin tài khoản') }}</li>
										<li>{{ __('Các trường có đấu (*) là bắt buộc') }}</li>
										<li>{{ __('Phân quyền cho tài khoản tại các module: QTV chọn quyền cho tài khoản tại mục phân quyền; tài khoản có những quyền nào thì được thực hiện các chức năng tương ứng với các quyền đó tại các module') }}</li>
										<li>{{ __('Đối với chức năng đổi mật khẩu cho tài khoản quản trị cũng giống với chức năng đổi mật khẩu của tài khoản người dùng') }}</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard__content--setting module">
				<div class="setting">
					<div class="module__title setting__title">	
						<span>{{ __('Module giao diện') }}</span>
					</div>
					<div class="setting__content module__content">
						<div class="module__content--title">
							<span class="title">{{ __('Đây là module cấu hình trên Website') }}</span>
							<span class="title">{{ __('Giao diện (Cấu hình giao diện hiển thị)') }}</span>
							<ul class="steps">
								<li>{{ __('Giao diện website: cấu hình những phần hiển thị chung trên web như header footer, ..') }}</li>
								<li>{{ __('Menu: Cấu hình menu header, footer,.... Thêm menu theo các danh mục có sẵn hoặc tự tạo liên kết. Tạo vị trí hiển thị menu bằng cách kéo thả, dí chuột vào menu và kéo lên hoặc xuống tại vị trí mong muốn; kéo sang phải để tạo menu con với cha liền trước. Đối với menu con nên tạo có quy chuẩn để hiển thị đẹp, nếu muốn hiển thị ảnh thì thêm ảnh cho tất cả các menu con tại cấp cha tương ứng và ngược lại cho phần hiển thị text.') }}</li>
								<li>{{ __('Trang chủ: Cấu hình những thông tin tại trang chủ') }}</li>
								<li>{{ __('Tương tự với các trang liên hệ, danh mục tin tức, trang sản phẩm,... : Cấu hình thông tin hiển thị') }}</li>
							</ul>
							<span class="title">{{ __('Cài đặt') }}</span>
							<ul class="steps">
								<li>{{ __('Dashboard') }}
									<ul>
										<li>{{ __('Cài đặt thông tin riêng công ty') }}</li>
									</ul>
								</li>
								<li>{{ __('Email') }}
									<ul>
										<li>{{ __('Cấu hình email gửi, nhận thông báo từ website, nội dung email gửi đi') }}</li>
									</ul>
								</li>
								<li>{{ __('Mã chuyển đổi') }}
									<ul>
										<li>{{ __('Cấu hình mã html chèn vào các thẻ') }}</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style>
		.module {	
			margin-bottom: 10px;
		}
		.module	.module__title {
			height: 45px;
			width: 100%;
			background: rgba(52,152,219,.88);
			border-radius: 5px;
			line-height: 45px;
			padding: 0 10px;
			cursor: pointer;
		}
		.module	.module__title span {
			color: #fff;
		}
		.module__content {
			padding: 10px;
			display: none;
		}
		.module__content .title {
			font-size: 20px;
			font-weight: 500;
		}
	</style>
	<script>
		$(document).ready(function () {
			$('.module__title').on('click', function(){
				$(this).parent().find('.module__content').slideToggle();
			});
		});
	</script>
@endsection