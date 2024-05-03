@extends('Default::web.layouts.app')
@section('head')
	<script type="application/ld+json">
	    {
	        "@graph": [{
                "@context": "http://schema.org/",
				"@type": "Product",
                "sku": "{{$product->sku ?? $product->id}}",
                "id": "{{$product->id}}",
                "mpn": "Toshiko",
                "name": "{{$product->name}}",
                "description": "{{ cutString(removeHTML($product->detail),150) }}",
                "image": "{{getImage($product->image)}}",
                "brand": "{{$product->name}}",
                "aggregateRating": {
                    "@type": "AggregateRating",
                    "ratingValue": "{{$vote_products[$product->id]??5}}",
                    "reviewCount": "{{$count_comment ?? 1}}"
                },
                "review": {
                    "@type": "Review",
                    "author": "Toshiko",
                    "reviewRating": {
                        "@type": "Rating",
                        "bestRating": "5",
                        "ratingValue": "1",
                        "worstRating": "1"
                    }
                },
                "offers": {
                    "@type": "Offer",
                    "priceCurrency": "VND",
                    "priceValidUntil": "{{ date('Y-m-d', strtotime($product->created_at)) }}",
                    "price": "{{ $product->price > 0 ? $product->price : $product->price_old }}",
                    "availability": "http://schema.org/InStock",
                    "url": "{{$product->getUrl()}}",
                    "warranty": {
                        "@type": "WarrantyPromise",
                        "durationOfWarranty": {
                            "@type": "QuantitativeValue",
                            "value": "6 tháng",
                            "unitCode": "ANN"
                        }
                    },
                    "itemCondition": "mới",
                    "seller": {
                        "@type": "Organization",
                        "name": "{{config('app.name')}}"
                    }
                }
            },
            {
                "@context": "http://schema.org",
                "@type": "WebSite",
                "name": "{{config('app.name')}}",
                "url": "{{config('app.url')}}"
            }
        ]
    }
</script>
@endsection
@section('content')
@include('Default::web.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
@php
    $slides = explode(',', $product->slide??'');
    array_unshift($slides,$product->image);
    if(empty($slides[0])) unset($slides[0]);
    if(empty($slides[1])) unset($slides[1]);
    $price = priceProduct($product);
    // $vote = $vote_products[$product->id] ?? 0;
    // $comment_count = $comment_products[$product->id] ?? 0;
    $specifications = json_decode(base64_decode($product->specifications), 1);
	$promotions = $config_product['promotion']['desc'] ?? [];
@endphp
<style>
	@media (max-width: 1025px) {
	.container{
		display: block !important;
	
	}}
</style>
<div class="product_single pt-25 w-100 pb-15">
	<div class="container">
		<div class="product_single__title flex w-100">
		 	<div class="vote single_left flex">
		 		<ul class="flex">
					@for($i=1;$i<=5;$i++)
					@if(count($vote_products) && $i <= ($vote_products[$product->id] ?? 0) )
						<li>
							<svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
						</li>
					@else
					  <li>
					  	<svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
					  </li>
					@endif
					@endfor
				</ul>
				<span class="avg_text mr-5">
					{{ $vote_products[$product->id] ?? 0 }}
				</span>
				<p class="count_text mr-20">
					({{ $count_comment ?? 0 }} đánh giá)
				</p>
				<p class="compare_product flex" onclick="addCompare('{{ $product->id }}', '{{ $product->name }}', '{{ $product->getImage('medium') }}', '{{ $price['price_format']  }}', '{{ $product->category_id }}')"><span class="mr-5">+</span>So sánh sản phẩm</p>
		 	</div>
		 	<div class="single_name single_right">
		 		<h1 class="fs-40 lh-50">{!! $product->name ?? ' ' !!}</h1>
		 	</div>
		</div>
		<div class="product_single__image w-100 flex">
			<div class="left single_left">
				<div class="images_list_for">
                    @if (count($slides) > 0)
                        @foreach ($slides as $k => $slide)
                        <div class="item {{ checkAgent() }}">
                            <img id="img-hover-{{$k}}" src="{{ resizeWImage($slide, 'w500') }}" loading="lazy" width="500" height="500" alt="{{ getAlt($slide) }}">
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="left_bottom flex mt-15">
                	@if (count($slides) > 0)
                    <div class="images_list_nav">
                        @foreach ($slides as $k => $slide)
                            <div class="item flex-center">
                                <img src="{{ resizeWImage($slide, 'w100') }}" loading="lazy" width="100" height="100" alt="{{ getAlt($slide) }}">
                            </div>
                        @endforeach
                       
                    </div>
                	@endif
                	<div class="specifications text-center">
                        <img src="/assets/images/icon/tskt.png" loading="lazy" width="40" height="30" alt="icon">
                        <p class="fs-12 lh-15">Thông số kỹ thuật</p>
                    </div>
                </div>
			</div>
			<div class="right single_right">
				@if($product->flash_sale == 1)
				<div class="right_price flash_sale mb-20">
					<p class="price_unit fs-36 lh-22 fw-600 color-white">{!! $price['price_format'] !!}</p>
                    @if($product->price_old > 0)
                    <p class="price_old fs-20 lh-18 color-white">GNY: <span>{!! $price['priceOld_format'] !!}</span></p>
                    @endif
				</div>
				@else
					<div class="right_price flex mb-25">
						<p class="price_unit fs-36 lh-22 fw-600 color-main">{!! $price['price_format'] !!}</p>
                        @if($product->price_old > 0)
                        <p class="price_old fs-20 lh-18">GNY: <span>{!! $price['priceOld_format'] !!}</span></p>
                        @endif
					</div>
				@endif
				<div class="right_ship flex mb-20">
					<div class="free_ship right_ship__item flex">
						<img src="/assets/images/icon/free_ship.png" alt="icon free ship" class="mr-5" width="37" height="21">
						<span>Miễn phí vận chuyển</span>
					</div>
					<div class="insurance right_ship__item flex">
						<img src="/assets/images/icon/bao_hanh.png" alt="icon bao hanh" class="mr-10" width="17" height="22">
						<span>Bảo hành {!! $product->insurance ?? '' !!}</span>
					</div>
				</div>
				<div class="right_promotion mb-15">
					<span class="fw-600 f-w-b">
						<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M190.5 68.8L225.3 128H224 152c-22.1 0-40-17.9-40-40s17.9-40 40-40h2.2c14.9 0 28.8 7.9 36.3 20.8zM64 88c0 14.4 3.5 28 9.6 40H32c-17.7 0-32 14.3-32 32v64c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H438.4c6.1-12 9.6-25.6 9.6-40c0-48.6-39.4-88-88-88h-2.2c-31.9 0-61.5 16.9-77.7 44.4L256 85.5l-24.1-41C215.7 16.9 186.1 0 154.2 0H152C103.4 0 64 39.4 64 88zm336 0c0 22.1-17.9 40-40 40H288h-1.3l34.8-59.2C329.1 55.9 342.9 48 357.8 48H360c22.1 0 40 17.9 40 40zM32 288V464c0 26.5 21.5 48 48 48H224V288H32zM288 512H432c26.5 0 48-21.5 48-48V288H288V512z"/></svg>
						Khuyến mãi
					</span>
					<div class="right_promotion__detail">
						@foreach($promotions as $promotion)
							<span class="mt-10">
								<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
								{{$promotion}}
							</span>
						@endforeach
						<?php 
							$privatePromotions = json_decode(base64_decode($product->promotion ?? ''), 1);
						?>
						@foreach($privatePromotions['desc'] ?? [] as $promotion)
							<span class="mt-10">
								<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
								{{$promotion}}
							</span>
						@endforeach
					</div>
				</div>
				
				<div class="right_form mb-15">
					<span class="fw-600">
						Để lại số điện thoại, chúng tôi sẽ tư vấn cho Quý khách!
					</span>
					<form action="javascript:;" class="mt-8">
						<div class="form-group flex">
							<input type="text" name="phone" placeholder="Nhập số điện thoại của bạn">
							<input type="hidden" name="product_id" class="product_id" value="{{ $product->id }}">
							{{-- <input type="hidden" name="name" class="name" value="{{ $product->getName() }}"> --}}
							<button type="submit"  class="fw-600 color-white fs-14 phone_order">
								Gửi
							</button>
						</div>
					</form>
				</div>
				
				@if(count($combos ?? []) > 0)
					<div class="right_buy_combo mb-20">
						<div>
							<span class="fw-600 fs-20 lh-22">
								Mua theo combo
							</span>
						</div>
						@foreach($combos ?? [] as $combo)
							<div class="combo-product flex">
								<div class="box-image">
									<img src="{{$combo->getImage()}}" alt="">
								</div>
								<div class="combo-product__detail">
									<div class="title fw-500 fs-22 mb-10">
										{{$combo->name}}
									</div>
									<div class="price">
										<span class="sale-price fw-500 fs-20">{{formatPrice(floatval($combo['price_sale']))}}</span>
										<span class="sale-price_old fw-500 fs-20">{{formatPrice(floatval($combo->price ))}}</span>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@endif
                @if($product->getStok())
    				<div class="right_action flex mb-25">
						@if(count($combos)>0)
							<?php 
								$comboProduct = $combos->pluck( 'price_sale','id');
								$comboProduct[$product->id] = $product->price;
							?>
							<div class="btn btn-order add-to-cart" data-type="3" data-productid="{{ $comboProduct }}" style="flex: 0 0 100%; width: 100%; margin-bottom: 10px;" >
								<p class="color-white text-up fs-20 fw-600 lh-24 mb-4">Mua combo</p>
								<p class="color-white lh-18">Giao tận nhà</p>
								<p class="color-white lh-18">Hoặc nhận tại showroom</p>
							</div>
    					@endif
    					<div class="btn btn-order add-to-cart" data-productid="{{ $product->id }}" data-type="{{$product->checktype() ?? 1}}"
						@if(!$product->compare)
							style="flex: 0 0 100%; width: 100%; margin-right: 0;" 
						@endif
    					>
    						<p class="color-white text-up fs-20 fw-600 lh-24 mb-4"> Mua ngay</p>
    						<p class="color-white lh-18">Giao tận nhà</p>
    						<p class="color-white lh-18">Hoặc nhận tại showroom</p>
    					</div>
    					@if($product->compare)
    					<div class="btn btn-installment add-to-cart" data-productid="{{ $product->id }}" data-type="Installment">
							<p class="color-white text-up fs-20 fw-600 lh-24 mb-4">trả góp</p>
							<p class="color-white lh-18">Công ty Tài chính</p>
							<p class="color-white lh-18">Hoặc 0% qua thẻ tín dụng</p>
    					</div>
    					@endif
    				</div>
                @else
                    <div class="right_action mb-25">
                        <p class="alert_none">Sản phẩm tạm hết hàng!</p>
                    </div>
                @endif
				@if(isset($config_product['certification']['image_item']) && count($config_product['certification']['image_item']) > 0)
				<div class="right_certification mb-15">
					<div class="right_certification__title">
						<span class="color-main text-up fw-600">Giấy chứng nhận & giải thưởng</span>
					</div>
					<div class="right_certification__content flex">
						@foreach($config_product['certification']['image_item'] as $key =>$certifi)
						<div class="certification">
							<img src="{{ resizeWImage($certifi, 'w100') }}" alt="{{ getAlt($certifi) ?? '' }}" width="100" height="45">
							<p class="fs-8 lh-12 fw-600">{!! $config_product['certification']['title'][$key] ?? '' !!}</p>
						</div>
						@endforeach
					</div>
				</div>
				@endif
				<div class="right_hotline">
					<p>Tư vấn mua hàng: <a href="tel:{{ $config_general['hotline'] ?? '18001891' }}" class="color-main fw-600">{{ $config_general['hotline'] ?? '18001891' }}</a></p>
					<p>Tư vấn Bảo hành: <a href="tel:{{ $config_general['hotline_insurance'] ?? '1800558879' }}" class="color-main fw-600">{{ $config_general['hotline_insurance'] ?? '1800558879' }}</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="single_bottom mt-60">
	<div class="container">
		<div class="single_bottom__detail flex"> 
			<div class="detail_left">
				@if($product->video != '')
				<div class="detail_left__video mb-30">
					<a href="{!! $product->video !!}" class="venobox" data-vbtype="video" data-autoplay="true">
						<img class="default lazy thumnail_video" src="{!! getThumbnail(getIdVideo($product->video), 'big') !!}" alt="thumnail video">
						<div class="icon_play">
							<svg xmlns="http://www.w3.org/2000/svg" width="67" height="67" viewBox="0 0 67 67" fill="none"><g filter="url(#filter0_d_0_12941)"><circle cx="33.5" cy="31.5" r="28.5" stroke="white" stroke-width="2"/><path fill-rule="evenodd" clip-rule="evenodd" d="M27 23L41 32L27 41V23V23Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><filter id="filter0_d_0_12941" x="0" y="0" width="67" height="67" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB"><feFlood flood-opacity="0" result="BackgroundImageFix"/><feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/><feOffset dy="2"/><feGaussianBlur stdDeviation="2"/><feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.5 0"/><feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_0_12941"/><feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_0_12941" result="shape"/></filter></defs>
							</svg>
						</div>
					</a>
				</div>
				@endif
				<span class="fw-600 fs-28 lh-22">
					Mô tả sản phẩm
				</span>
				<div class="detail_left__show mt-25 mb-35">
					<div class="css-content">
						{!! $product->detail ?? '' !!}
					</div>
					<div class="view_more mt-15 w-100 text-center">
						<span class="color-main view_more_text">Xem thêm</span>
					</div>
				</div>
				<div class="question-show {{checkAgent()}}">
					@include('Default::general.components.faq', ['faq_title' => 'FAQ'])
				</div>
				<div class="rating box mt-40">
		            <p class="box_title fs-28 lh-22 fw-600">Bình luận và Đánh giá sản phẩm</p>
		            @include('Comment::list', [
						'type' => 'products',
						'type_id' => $product->id,
						'regulation_link' => '#',
						'no_comment_text' => 'Hãy để lại bình luận của bạn tại đây!'
					])	
		        </div>
				@if(isset($relate_products) && count($relate_products)>0)
					<div class="category-block mt-49" id="relate_products">
						<div class="category-block__title">
							<h2 class="f-w-b">{{ __('Sản phẩm liên quan')}}</h2>
						</div>
						<div class="category-block__content owl-carousel mt-37">
							@include('Default::web.products.list-item',  ['products' => $relate_products])
						</div>
					</div>
				@endif
			</div>
			<div class="detail_right">
				@if(isset($config_product['outstanding_brand']['image_item']) && count($config_product['outstanding_brand']['image_item']) > 0)
				<div class="outstanding mb-35 flex">
					@foreach($config_product['outstanding_brand']['image_item'] as $i => $out_img)
					<div class="outstanding_item">
						<div class="outstanding_item__img">
							<img src="{{ resizeWImage($out_img, 'w400') }}" loading="lazy" width="400" height="190" alt="{{ getAlt($out_img) ?? '' }}">
						</div>
						<div class="outstanding_item__content text-center">
							<span class="fw-600 lh-22 color-white">{!! $config_product['outstanding_brand']['title'][$i] ?? '' !!}</span>
						</div>
					</div>
					@endforeach
				</div>
				@endif
				<div class="ads_showroom">
					<div class="ads_showroom__sticky">
						@if(isset($config_product['banner_ads']) && $config_product['banner_ads'] != '')
						<div class="product_ads mb-35">
							<a href="{{ $config_product['banner_ads_link'] ?? '#' }}" target="_blank">
								<img src="{{ resizeWImage($config_product['banner_ads'], 'w400') }}" loading="lazy" width="400" height="580" alt="{{ getAlt($config_product['banner_ads']) ?? '' }}">
							</a>
						</div>
						@endif
						<div class="showrooms">
							<span class="text-up color-main fs-24 lh-30 fw-600">Hệ thống showroom toàn quốc</span>
							<a href="/he-thong-cua-hang" class="color-white fw-600 lh-19 text-up flex mt-22">
								<img src="/assets/images/icon/map.png" alt="icon map" class="mr-10">
								Tìm cửa hàng gần nhất
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="specifications_popup">
	<div class="specifications_popup__content">
		@if(isset($specifications['title']) && count($specifications['title']) > 0)
		<span class="fs-20 fw-600">Thông số kỹ thuật</span>
		<ul class="specification_list">
			@foreach($specifications['title'] as $s => $spe_title)
			<li class="specification flex">
				<span>{!! $spe_title ?? '' !!}</span>
				<span>{!! $specifications['value'][$s] ?? '' !!}</span>
			</li>
			@endforeach
		</ul>
		@else
		<span>Đang cập nhật ...</span>
		@endif
		<div class="specification_close close_popup">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="20" height="20"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z" fill="#DE0200"/></svg></button/></svg>
		</div>
	</div>
</div>
@endsection
