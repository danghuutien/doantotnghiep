@extends('Default::web.layouts.app')
@section('content')
	<div class="contact">
		@include('Default::web.layouts.breadcrumb')
		<div class="container">
			<div class="contact-show flex mt-31">
				<div class="contact_content">
					<h2 class="fs-28 lh-36 f-w-b">{{ $setting_contact['title'] ?? '' }}</h2>
					<p class="desc mt-12 fs-16 lh-24">
						{{ $setting_contact['description'] ?? '' }}
					</p>
					<ul class="mt-17">
						<li class="flex">
							<svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6.325C0 2.8 2.89792 0 6.5 0C10.1021 0 13 2.8 13 6.325C13 9.275 8.53125 14.275 7.15 15.725C7.01458 15.875 6.79792 16 6.5 16C6.28333 16 5.98542 15.925 5.85 15.725C4.46875 14.25 0 9.325 0 6.325ZM1.43542 6.325C1.43542 8.2 4.03542 11.725 6.5 14.4C8.96458 11.725 11.5646 8.2 11.5646 6.325C11.5646 3.6 9.31667 1.325 6.5 1.325C3.68333 1.325 1.43542 3.525 1.43542 6.325Z" fill="#DE0200"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4 6C4 4.34579 5.34579 3 7 3C8.65421 3 10 4.34579 10 6C10 7.65421 8.65421 9 7 9C5.34579 9 4 7.65421 4 6ZM5.51402 6C5.51402 6.81308 6.18692 7.48598 7 7.48598C7.81308 7.48598 8.48598 6.81308 8.48598 6C8.48598 5.18692 7.81308 4.51402 7 4.51402C6.18692 4.51402 5.51402 5.18692 5.51402 6Z" fill="#DE0200"/>
							</svg>
							<p class="address"><span class="f-w-b">Trụ sở chính:</span> {{ $setting_contact['headquarters_contact'] ?? '' }}</p>
						</li>
						<li class="flex">
							<svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6.325C0 2.8 2.89792 0 6.5 0C10.1021 0 13 2.8 13 6.325C13 9.275 8.53125 14.275 7.15 15.725C7.01458 15.875 6.79792 16 6.5 16C6.28333 16 5.98542 15.925 5.85 15.725C4.46875 14.25 0 9.325 0 6.325ZM1.43542 6.325C1.43542 8.2 4.03542 11.725 6.5 14.4C8.96458 11.725 11.5646 8.2 11.5646 6.325C11.5646 3.6 9.31667 1.325 6.5 1.325C3.68333 1.325 1.43542 3.525 1.43542 6.325Z" fill="#DE0200"/>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4 6C4 4.34579 5.34579 3 7 3C8.65421 3 10 4.34579 10 6C10 7.65421 8.65421 9 7 9C5.34579 9 4 7.65421 4 6ZM5.51402 6C5.51402 6.81308 6.18692 7.48598 7 7.48598C7.81308 7.48598 8.48598 6.81308 8.48598 6C8.48598 5.18692 7.81308 4.51402 7 4.51402C6.18692 4.51402 5.51402 5.18692 5.51402 6Z" fill="#DE0200"/>
							</svg>
							<p class="address"><span class="f-w-b">Chi nhánh HCM:</span> {{ $setting_contact['address_contact'] ?? '' }}</p>
						</li>
						<li class="flex">
							<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.7083 11.9274L13.0454 10.8187L11.5672 9.83338C11.2819 9.64357 10.8985 9.70579 10.6878 9.97614L9.77312 11.1521C9.57663 11.4072 9.22316 11.4806 8.94139 11.3246C8.32071 10.9793 7.58674 10.6542 5.96729 9.03271C4.34783 7.41117 4.02068 6.67929 3.67542 6.05861C3.51941 5.77684 3.59274 5.42337 3.84791 5.22691L5.02385 4.31219C5.29417 4.1016 5.35642 3.7182 5.16661 3.43288L4.21154 2.00013L3.07258 0.291677C2.87873 0.000879496 2.49066 -0.0864242 2.19096 0.09331L0.877418 0.881328C0.522431 1.09048 0.261487 1.42821 0.148637 1.8245C-0.210569 3.13414 -0.28299 6.02316 4.34704 10.6532C8.97707 15.2832 11.8658 15.2106 13.1755 14.8513C13.5718 14.7385 13.9095 14.4776 14.1186 14.1225L14.9067 12.809C15.0864 12.5093 14.9991 12.1213 14.7083 11.9274Z" fill="#DE0200"/>
								<path d="M8.24998 3.49999C10.5961 3.5026 12.4974 5.40385 12.5 7.74999C12.5 7.88805 12.6119 8 12.75 8C12.8881 8 13 7.88808 13 7.74999C12.9971 5.12784 10.8722 3.00289 8.25001 3C8.11195 3 8 3.11192 8 3.25001C7.99997 3.38804 8.11189 3.49999 8.24998 3.49999Z" fill="#DE0200"/>
								<path d="M7.28573 4.57145C9.02063 4.57349 10.4265 5.9794 10.4285 7.71427C10.4285 7.87206 10.5565 8 10.7143 8C10.8721 8 11 7.87209 11 7.71427C10.9976 5.66393 9.3361 4.00236 7.28573 4C7.12794 4 7 4.12791 7 4.28573C7 4.44354 7.12791 4.57145 7.28573 4.57145Z" fill="#DE0200"/>
								<path d="M7.37497 5.74999C8.41001 5.75122 9.24874 6.58995 9.24997 7.62498C9.24997 7.83208 9.41785 8 9.62498 8C9.83208 8 10 7.83212 10 7.62498C9.99834 6.17594 8.82406 5.00166 7.37502 5C7.16792 5 7 5.16788 7 5.37502C6.99996 5.58211 7.16784 5.74999 7.37497 5.74999Z" fill="#DE0200"/>
							</svg>
							<p  class="lh-26">
								Hotline: <a class="phone f-w-b" href="tel:{{ $setting_contact['hotline_contact'] ?? '' }}">{{ $setting_contact['hotline_contact'] ?? '' }}</a>
							</p>
						</li>
						<li class="flex">
							<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M14.4935 0H1.50649C0.675325 0 0 0.676123 0 1.50827V9.49173C0 10.3239 0.675325 11 1.50649 11H14.4935C15.3247 11 16 10.3239 16 9.49173V1.50827C16 0.676123 15.3247 0 14.4935 0ZM14.4935 0.910165C14.6234 0.910165 14.7273 0.93617 14.8312 1.01418L8.36364 4.9409C8.12987 5.07092 7.87013 5.07092 7.63636 4.9409L1.16883 1.01418C1.27273 0.962175 1.37662 0.910165 1.50649 0.910165H14.4935ZM1.50649 10.0638H14.4935C14.8052 10.0638 15.0909 9.80378 15.039 9.46572V1.92435L8.80519 5.72104C8.54545 5.87707 8.25974 5.95508 7.97403 5.95508C7.68831 5.95508 7.4026 5.87707 7.14286 5.72104L0.909091 1.92435V9.46572C0.909091 9.80378 1.19481 10.0638 1.50649 10.0638Z" fill="#DE0200"/>
							</svg>
							<p  class="lh-26">
								<a class="mail" href="mailto:{{ $setting_contact['email_contact'] ?? '' }}">{{ $setting_contact['email_contact'] ?? '' }}</a>
							</p>
						</li>
						<li class="flex">
							<svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M14.7545 4.25C14.7545 4.8875 14.5379 5.525 14.1048 6.02969C14.7545 7.09219 15.0252 8.2875 14.9982 9.5625C14.9982 13.6797 11.6682 17 7.49908 17C3.32992 17 0 13.6797 0 9.5625C0 8.2875 0.297797 7.09219 0.947537 6.02969C0.514377 5.525 0.297797 4.8875 0.297797 4.25C0.297797 2.68281 1.59728 1.40781 3.19455 1.43438C4.06087 1.43438 4.92719 1.85938 5.44157 2.49688C5.76671 2.37725 6.1376 2.31748 6.48556 2.26141C6.60116 2.24278 6.71424 2.22456 6.82227 2.20469V1.43438H6.09131C5.65815 1.43438 5.36035 1.14219 5.36035 0.717188C5.36035 0.292188 5.65815 0 6.09131 0H8.961C9.39416 0 9.69195 0.265625 9.69195 0.690625C9.69195 1.11563 9.39416 1.40781 8.961 1.40781H8.23004V2.17812C8.74442 2.25781 9.17758 2.3375 9.61073 2.47031C10.1251 1.83281 10.9914 1.40781 11.8578 1.40781C13.455 1.40781 14.7545 2.68281 14.7545 4.25ZM13.2926 4.25C13.2926 3.47969 12.6429 2.84219 11.8578 2.84219C11.56 2.84219 11.2892 2.89531 11.1268 3.05469C11.9119 3.47969 12.6429 4.0375 13.2114 4.75469C13.2114 4.67137 13.2336 4.57353 13.2548 4.48015C13.2741 4.39491 13.2926 4.31338 13.2926 4.25ZM1.75971 4.25C1.75971 3.47969 2.40945 2.84219 3.19455 2.84219C3.49235 2.84219 3.76308 2.92188 3.97966 3.05469C3.19455 3.47969 2.4636 4.0375 1.81386 4.75469C1.81386 4.67137 1.79906 4.57353 1.78494 4.48015L1.78494 4.48015C1.77204 4.39491 1.75971 4.31338 1.75971 4.25ZM1.46191 9.5625C1.46191 12.8828 4.14209 15.5922 7.52615 15.5922C10.9102 15.5922 13.5904 12.9094 13.5904 9.5625C13.5904 6.21562 10.9102 3.53281 7.52615 3.53281C4.19624 3.53281 1.46191 6.24219 1.46191 9.5625Z" fill="#DE0200"/>
								<path d="M10.2819 9.73953H8.15426V6.75349C8.15426 6.30698 7.8617 6 7.43617 6C7.01064 6 6.71809 6.30698 6.71809 6.75349V9.73953C6.29255 9.73953 6 10.0465 6 10.493C6 10.9395 6.29255 11.2465 6.71809 11.2465C6.71809 11.693 7.01064 12 7.43617 12C7.8617 12 8.15426 11.693 8.15426 11.2465H10.2819C10.7074 11.2465 11 10.9395 11 10.493C10.9734 10.0186 10.7074 9.73953 10.2819 9.73953Z" fill="#DE0200"/>
							</svg>
							<p  class="time_work flex">
								Giờ làm việc: {!! $setting_contact['time_work'] ?? '' !!}
							</p>
						</li>
						<li class="flex">
							<img src="/assets/images/icon/icon-fanpage.png" alt="">
							<p  class="lh-26">
								Fanpage: <a href="{!! $setting_contact['fanpage_contact'] ?? '' !!}" class="link_fanpage">{!! $setting_contact['fanpage_contact'] ?? '' !!}</a>
							</p>
						</li>
					</ul>
				</div>
				<div class="contact_form">
					<h2 class="fs-28 lh-36 f-w-b text-center">Liên hệ với chúng tôi</h2>
					<div class="contact_form__infor mt-25">
						<form action="javascript:;" id="form_contact" class="form_content">
						<div class="form-group">
							<div class="form-row">
								<input class="lh-24 w-100 input_field form-control" type="text" name="name" placeholder="Họ và tên">
								<p class="err_show null">Họ tên không được để trống</p>
							</div>
							<div class="form-row mt-12">
								<input class="lh-24 w-100 input_field form-control" id="phone_contact" type="text" name="phone" placeholder="Số điện thoại">
								<p class="err_show null">Số điện thoại không được để trống</p>
								<p class="err_show phone">Số điện thoại không đúng định dạng</p>
							</div>
							<div class="form-row mt-12">
								<input class="lh-24 w-100 input_field form-control" id="mail_contact" type="text" name="email" placeholder="Email">
								<p class="err_show null">Mail không được để trống</p>
								<p class="err_show email">Email không đúng định dạng</p>
							</div>
							<div class="form-group w-100 mt-12 mb-12">
								<textarea name="content" id="note_contact" class="form-control flex w-100 lh-24" placeholder="Nhập nội dung"></textarea>
								<p class="err_show null">Nội dung không được để trống</p>
							</div>
							<div class="form-group w-100">
								<button type="submit" onclick="contact('form_contact','contact')" class="color-white w-100 fs-16 lh-24 text-center">Gửi yêu cầu liên hệ</button>
							</div>
						</div>
						</form>
					</div>	
				</div>
			</div>
			<div class="contact-map w-100 mt-58 mb-86">
				<div class="grey-section google-map w-100" id="googlemaps">
					{!! $setting_contact['iframe_map'] ?? '' !!}
		        </div>
			</div>
		</div>
	</div>
@endsection
