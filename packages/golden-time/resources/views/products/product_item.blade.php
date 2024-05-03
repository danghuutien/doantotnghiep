@php
	$item->price = empty($item->price) ? $item->product->price : $item->price;
	$item['price_old'] = empty($item->price) ? $item->product->price_old : $item->product->price;
@endphp
@if($item->getStok() > 0)
	<div class="product_item">
		<div class="product_item__image">
		 	<a href="{{ $item->product->getUrl() }}">
		 		@include('Default::general.components.image', [
		            'src' => resizeWImage($item->product->image, $w ?? 'w300'),
		            'width' => $wS ?? '280px',
		            'height' => $hS ?? '210px',
		            'lazy'   => true,
		            'title'  => $item->product->name ?? ''
		        ])
		 	</a>
		</div>
		<div class="product_item__content">
	        @if($item->product->compare == 1)
	    		<div class="installment_icon mb-7">
	    			<span class="color-white fs-11 fw-600 installment_icon_number">0%</span>
	    			<span class="fs-11 color-white fw-600 text-up installment_icon_text">Trả góp lãi suất 0%</span>
	    		</div>
	        @endif
			<div class="name">
				<a href="{{ $item->product->getUrl() }}">
					<h3 class="fs-16 lh-20">{!! $item->product->name ?? '' !!}</h3>
				</a>
			</div>
			@php
				$price = priceProduct($item);
			@endphp
			<div class="price flex mt-5 mb-5">
				<p class="price_unit fs-16 lh-22 fw-600 color-main">{!! $price['price_format'] !!}</p>
	            @if($item->product->price_old > 0)
	            <p class="price_old fs-14 lh-22"><span>{!! $price['priceOld_format'] !!}</span></p>
	            @endif
			</div>
			<div class="vote_compare flex">
				<div class="vote_item flex">
					<ul class="flex">
					@for($i=1;$i<=5;$i++)
						@if(count($vote_products) && isset($vote_products[$item->product->id]) && $i <= $vote_products[$item->product->id] )
							<li>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M8 12.832L3.29772 15.3042L4.19577 10.0681L0.391548 6.3599L5.64886 5.59596L8 0.832031L10.3511 5.59596L15.6085 6.3599L11.8042 10.0681L12.7023 15.3042L8 12.832Z" fill="#FDA005"/>
								</svg>
							</li>
						@else
						  <li>
						  	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
							<path d="M8.23267 12.3895L8 12.2671L7.76733 12.3895L3.96178 14.3902L4.68858 10.1526L4.73301 9.89354L4.54478 9.71006L1.46603 6.70901L5.72076 6.09077L5.98089 6.05297L6.09723 5.81725L8 1.96181L9.90277 5.81725L10.0191 6.05297L10.2792 6.09077L14.534 6.70902L11.4552 9.71006L11.267 9.89354L11.3114 10.1526L12.0382 14.3902L8.23267 12.3895Z" stroke="#FDA005"/>
							</svg>
						  </li>
						@endif
					@endfor
					</ul>
					<span class="avg_text ml-2 mr-2 fs-14">
						{{ $vote_products[$item->product->id] ?? 0 }}
					</span>
					<p class="count_text fs-14">
						({{ $comment_products[$item->product->id] ?? 0 }})
					</p>
				</div>
				<div class="compare_item" onclick="addCompare('{{ $item->product->id }}', '{{ $item->product->name }}', '{{ resizeWImage($item->product->image, $w ?? 'w300') }}', '{{ $price['price_format']  }}', '{{ $item->product->category_id }}')">
					<p class="compare_product flex"><span class="mr-5">+</span>So sánh</p>
				</div>
				<div class="remaining w-100 color-white">
					<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M153.6 29.9l16-21.3C173.6 3.2 180 0 186.7 0C198.4 0 208 9.6 208 21.3V43.5c0 13.1 5.4 25.7 14.9 34.7L307.6 159C356.4 205.6 384 270.2 384 337.7C384 434 306 512 209.7 512H192C86 512 0 426 0 320v-3.8c0-48.8 19.4-95.6 53.9-130.1l3.5-3.5c4.2-4.2 10-6.6 16-6.6C85.9 176 96 186.1 96 198.6V288c0 35.3 28.7 64 64 64s64-28.7 64-64v-3.9c0-18-7.2-35.3-19.9-48l-38.6-38.6c-24-24-37.5-56.7-37.5-90.7c0-27.7 9-54.8 25.6-76.9z"/></svg>
					Còn {{$item->getMaxProductHas()}}/{{$item->quantity}}
				</div>
			</div>
			@if(!isset($hasBtn))
		        <div class="group_btn">
		            <div class="group_btn_item icon_search">
		                <a href="{{ $item->product->getUrl() }}" title="Xem chi tiết">
		                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		                        <circle cx="15" cy="15" r="15" fill="#D8D8D8"/>
		                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.0765 17.3854L21.1468 20.4556C21.3379 20.6467 21.3379 20.9563 21.1469 21.1473C21.0513 21.2429 20.9261 21.2906 20.801 21.2906C20.6758 21.2906 20.5506 21.2429 20.4551 21.1473L17.3848 18.077C16.467 18.8402 15.2885 19.2999 14.0045 19.2999C11.0848 19.2999 8.70947 16.9247 8.70947 14.0051C8.70947 11.0854 11.0848 8.70996 14.0045 8.70996C16.9241 8.70996 19.2995 11.0854 19.2995 14.0051C19.2995 15.2892 18.8397 16.4677 18.0765 17.3854ZM14.0045 9.68822C11.6242 9.68822 9.68773 11.6248 9.68773 14.0051C9.68773 16.3853 11.6242 18.3217 14.0045 18.3217C16.3847 18.3217 18.3211 16.3853 18.3211 14.0051C18.3211 11.6248 16.3847 9.68822 14.0045 9.68822Z" fill="#1C2E3D"/>
		                    </svg>
		                </a>
		            </div>
		            <div class="group_btn_item icon_cart add-to-cart @if(!$item->product->getStok()) noClick @endif" data-productid="{{ $item->product->id }}" title="Thêm vào giỏ hàng" data-type="2">
		                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
		                    <circle cx="15" cy="15" r="15" fill="#DE0200"/>
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8756 18.6546C16.6207 18.6546 17.3659 18.6556 18.111 18.654C18.3936 18.6534 18.5951 18.4696 18.5982 18.217C18.6014 17.9591 18.3965 17.7723 18.106 17.7701C17.9197 17.7688 17.7335 17.7699 17.5472 17.7699C16.2532 17.7699 14.9593 17.7708 13.6654 17.7689C13.4613 17.7685 13.3 17.8352 13.2054 18.0168C13.0474 18.3201 13.2732 18.6526 13.6402 18.6538C14.3853 18.6563 15.1304 18.6546 15.8756 18.6546V18.6546ZM15.8926 16.0004C14.8349 16.0004 13.7774 15.9994 12.7198 16.0012C12.4693 16.0016 12.2774 16.1668 12.2503 16.3942C12.2241 16.6141 12.3769 16.8233 12.6067 16.873C12.6696 16.8866 12.7367 16.8846 12.8018 16.8846C14.3529 16.8852 15.904 16.8851 17.4551 16.8851C17.9789 16.8851 18.5026 16.8852 19.0264 16.885C19.2331 16.8848 19.3869 16.7965 19.4691 16.611C19.6017 16.3116 19.3736 16.0017 19.0199 16.001C17.9775 15.9992 16.935 16.0004 15.8926 16.0004V16.0004ZM22.2583 13.0217C22.1472 13.3768 22.0323 13.7308 21.9257 14.0871C21.4214 15.7729 20.9196 17.4593 20.4165 19.1455C20.3297 19.4367 20.1908 19.5392 19.8818 19.5392C17.2111 19.5394 14.5405 19.5394 11.8698 19.5392C11.5619 19.5392 11.4207 19.434 11.3378 19.143C10.6331 16.6714 9.92869 14.1997 9.22412 11.728C9.21076 11.6813 9.19594 11.6348 9.17828 11.5766H9.01345C8.43399 11.5766 7.85451 11.5774 7.27502 11.5762C6.98081 11.5756 6.77623 11.3944 6.77444 11.1369C6.77259 10.8786 6.97705 10.6927 7.26924 10.6922C8.00492 10.6911 8.74063 10.6912 9.47631 10.6922C9.75204 10.6926 9.90275 10.8066 9.97853 11.0696C10.0996 11.4898 10.2189 11.9106 10.3393 12.3311C10.3512 12.3729 10.3655 12.414 10.3805 12.4613C11.0356 12.4613 11.6854 12.465 12.335 12.4581C12.4616 12.4568 12.5131 12.4974 12.5597 12.6105C13.208 14.1845 14.764 15.1981 16.5002 15.1049C18.2206 15.0125 19.4139 14.1354 20.1033 12.6033C20.1513 12.4965 20.1968 12.4559 20.3187 12.4581C20.767 12.4662 21.2159 12.4718 21.6639 12.4575C21.9417 12.4487 22.1416 12.5359 22.2583 12.7857V13.0217Z" fill="white"/>
		                    <mask id="mask0_0_437" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="11" y="20" width="4" height="3">
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9556 20.2812H14.5412V22.8978H11.9556V20.2812Z" fill="white"/>
		                    </mask>
		                    <g mask="url(#mask0_0_437)">
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0759 22.8978C12.7509 22.8218 12.4674 22.6772 12.2533 22.4119C11.8821 21.9518 11.8549 21.31 12.1892 20.8348C12.521 20.3631 13.1242 20.1649 13.6646 20.3499C14.2121 20.5373 14.5675 21.0646 14.5397 21.648C14.5118 22.2344 14.0747 22.7481 13.5004 22.8706C13.4732 22.8764 13.4473 22.8886 13.4208 22.8978H13.0759Z" fill="white"/>
		                    </g>
		                    <mask id="mask1_0_437" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="17" y="20" width="3" height="3">
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1074 20.2812H19.6931V22.8978H17.1074V20.2812Z" fill="white"/>
		                    </mask>
		                    <g mask="url(#mask1_0_437)">
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.2279 22.8978C17.8924 22.82 17.6029 22.6675 17.3878 22.3892C17.0291 21.9248 17.0126 21.2927 17.3497 20.8233C17.6826 20.3597 18.2812 20.1665 18.8166 20.3498C19.3592 20.5356 19.7135 21.055 19.6922 21.6336C19.6705 22.2257 19.232 22.747 18.6525 22.8706C18.6253 22.8764 18.5994 22.8886 18.5729 22.8978H18.2279Z" fill="white"/>
		                    </g>
		                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.5485 10.6041C15.3806 10.6041 15.2385 10.6023 15.0965 10.6045C14.8141 10.609 14.6048 10.8061 14.6009 11.0686C14.5969 11.338 14.8083 11.5425 15.098 11.5471C15.2438 11.5495 15.3896 11.5476 15.5484 11.5476C15.5484 11.6995 15.5477 11.8346 15.5486 11.9697C15.5506 12.2761 15.7431 12.4887 16.0192 12.4906C16.2956 12.4925 16.4935 12.2798 16.4962 11.976C16.4975 11.8366 16.4964 11.6971 16.4964 11.5476C16.6526 11.5476 16.7886 11.5486 16.9247 11.5474C17.2309 11.5448 17.4443 11.35 17.4438 11.0747C17.4432 10.7997 17.2295 10.6063 16.9226 10.6043C16.7829 10.6033 16.6432 10.6041 16.4964 10.6041C16.4964 10.44 16.4982 10.2989 16.496 10.1579C16.4915 9.86787 16.2883 9.65814 16.0174 9.66097C15.7527 9.66378 15.5537 9.87114 15.549 10.1521C15.5465 10.2975 15.5485 10.443 15.5485 10.6041M15.9941 14.3781C14.1684 14.3796 12.6763 12.8998 12.6729 11.0843C12.6694 9.25349 14.1666 7.74373 15.9873 7.74219C17.8093 7.74061 19.3097 9.24734 19.3088 11.0776C19.3078 12.8947 17.8195 14.3766 15.9941 14.3781" fill="white"/>
		                </svg>
		            </div>
		        </div>
		    @endif
		</div>
		@if(isset($hasBtn))
			<div class="btn-order mt-18">
				<p class="color-white fs-16 lh-19 f-w-b text-up text-center add-to-cart @if(!$item->product->getStok()) noClick @endif" data-productid="{{ $item->product->id }}">
					<svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M12.3435 14.8C13.3541 14.8 14.3647 14.8015 15.3753 14.7993C15.7585 14.7985 16.0317 14.5491 16.036 14.2066C16.0403 13.8568 15.7625 13.6034 15.3685 13.6005C15.1158 13.5987 14.8632 13.6002 14.6105 13.6002C12.8557 13.6002 11.1008 13.6015 9.34593 13.5988C9.06903 13.5984 8.85037 13.6888 8.72203 13.9351C8.50769 14.3464 8.814 14.7974 9.31174 14.799C10.3223 14.8024 11.3329 14.8 12.3435 14.8ZM12.3665 11.2003C10.9321 11.2003 9.49777 11.1989 8.06346 11.2014C7.72365 11.2019 7.46344 11.426 7.42666 11.7344C7.39108 12.0327 7.59831 12.3164 7.91001 12.3838C7.99528 12.4022 8.08631 12.3996 8.1747 12.3996C10.2784 12.4003 12.382 12.4002 14.4857 12.4002C15.1961 12.4002 15.9064 12.4004 16.6168 12.4C16.897 12.3999 17.1057 12.28 17.2171 12.0284C17.397 11.6224 17.0877 11.202 16.608 11.2012C15.1941 11.1987 13.7803 11.2003 12.3665 11.2003ZM21 7.16044C20.8493 7.64203 20.6935 8.12215 20.549 8.60547C19.865 10.8918 19.1844 13.179 18.5021 15.4658C18.3843 15.8608 18.196 15.9998 17.7769 15.9998C14.1548 16.0002 10.5327 16.0002 6.91064 15.9998C6.493 15.9998 6.30158 15.8572 6.18903 15.4625C5.2333 12.1104 4.27798 8.75812 3.32242 5.40594C3.3043 5.34248 3.2842 5.27953 3.26024 5.20052H3.03669C2.2508 5.20052 1.46488 5.2016 0.678951 5.20004C0.279926 5.19924 0.00245805 4.95343 3.34898e-05 4.60418C-0.00247326 4.25384 0.274831 4.00178 0.671102 4.00114C1.66887 3.99958 2.66668 3.99966 3.66445 4.00114C4.0384 4.00166 4.24281 4.15628 4.34558 4.51287C4.50979 5.08285 4.67158 5.65351 4.83481 6.22377C4.85104 6.28047 4.87036 6.33628 4.89078 6.40046C5.77928 6.40046 6.66046 6.40547 7.54148 6.39614C7.71321 6.39433 7.78315 6.44935 7.84636 6.60276C8.72561 8.73744 10.8359 10.1122 13.1905 9.98579C15.5239 9.8605 17.1423 8.67085 18.0773 6.59302C18.1424 6.44822 18.2042 6.39309 18.3694 6.3961C18.9774 6.40712 19.5862 6.41461 20.1938 6.3953C20.5706 6.38328 20.8417 6.50155 21 6.84043V7.16044Z" fill="white"/>
						<mask id="mask0_0_1295" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="7" y="17" width="4" height="4">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M7.02734 17.0059H10.5341V20.5545H7.02734V17.0059Z" fill="white"/>
						</mask>
						<g mask="url(#mask0_0_1295)">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M8.54673 20.5545C8.10603 20.4515 7.7215 20.2554 7.43115 19.8955C6.92771 19.2715 6.89076 18.4011 7.34423 17.7565C7.79423 17.1168 8.61224 16.848 9.34525 17.0989C10.0877 17.3531 10.5698 18.0682 10.5321 18.8595C10.4942 19.6548 9.90142 20.3515 9.12255 20.5177C9.08564 20.5256 9.05052 20.5421 9.01458 20.5545H8.54673Z" fill="white"/>
						</g>
						<mask id="mask1_0_1295" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="14" y="17" width="4" height="4">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.0139 17.0059H17.5208V20.5545H14.0139V17.0059Z" fill="white"/>
						</mask>
						<g mask="url(#mask1_0_1295)">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M15.5336 20.5545C15.0785 20.449 14.6859 20.2422 14.3942 19.8647C13.9077 19.235 13.8853 18.3776 14.3425 17.741C14.794 17.1122 15.6058 16.8502 16.3319 17.0988C17.0679 17.3508 17.5484 18.0553 17.5195 18.8399C17.49 19.643 16.8953 20.3501 16.1094 20.5177C16.0725 20.5256 16.0374 20.5421 16.0015 20.5545H15.5336Z" fill="white"/>
						</g>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9001 3.88152C11.6724 3.88152 11.4797 3.87905 11.2871 3.88204C10.9041 3.88806 10.6203 4.15541 10.615 4.51147C10.6095 4.87676 10.8961 5.15424 11.2891 5.16048C11.4868 5.16364 11.6846 5.16103 11.9 5.16103C11.9 5.36712 11.899 5.55034 11.9002 5.73351C11.903 6.14905 12.164 6.43743 12.5384 6.44003C12.9134 6.44264 13.1817 6.15414 13.1854 5.74215C13.1872 5.55299 13.1857 5.36378 13.1857 5.16108C13.3975 5.16108 13.582 5.1624 13.7665 5.16082C14.1819 5.15736 14.4713 4.89313 14.4705 4.51968C14.4699 4.14674 14.1799 3.88451 13.7637 3.88169C13.5742 3.88041 13.3848 3.88148 13.1856 3.88148C13.1856 3.65891 13.1881 3.46752 13.1852 3.27627C13.179 2.88295 12.9035 2.59851 12.536 2.60235C12.1771 2.60616 11.9071 2.8874 11.9007 3.26849C11.8974 3.46569 11.9001 3.66297 11.9001 3.88152ZM12.5044 9C10.0283 9.00196 8.00461 6.99495 8.00002 4.53275C7.99529 2.0497 10.026 0.00209705 12.4952 3.34474e-06C14.9663 -0.00213309 17.0013 2.04137 17 4.52361C16.9987 6.98807 14.9802 8.99799 12.5044 9Z" fill="white"/>
					</svg>
					<span>Đặt hàng</span>
				</p>
			</div>
		@endif
	</div>
@endif
