<div class="compare-title">
	<div class="container">
		<div class="compare-title__left">Đã có <span data-compare_number="compact">{{ count($compares) }}</span> sản phẩm được chọn</div>
		<div class="compare-title__right">Tối đa 3 sản phẩm được so sánh</div>
		<button class="button" id="compare-close" data-compare_close=""></button>
	</div>
</div>
<div class="container">
	@if(count($compares) > 0)
    	<div class="compare-list" id="compare_box">
    		@foreach ($compares as $k => $comp)
    			<div class="compare-list__item" data-id="{{ $k }}" data-category="{{ $comp['cate_id'] ?? 0 }}">
    				<span class="compare-list__item-remove" title="Xóa khỏi danh sách so sánh" onclick="removeCompare('{{ $k }}')" data-compare_delete="{{ $k }}">
    					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
    				</span>
    				<div class="compare-list__item-thumnail">
    					<img src="{{ $comp['image'] ?? '' }}" alt="">
    				</div>
    				<div class="compare-list__item-title">
    					<p>{{ $comp['name'] ?? '' }}</p>
    				</div>
    				<div class="compare-list__item-price">
    					<p><span>{{ $comp['price'] ?? '' }}</span></p>
    				</div>
    			</div>
    		@endforeach
            @if(checkAgent() == 'web')
        		<div class="compare-list__item compare-action">
        			<a href="{{ route('app.products.compare') }}">So sánh ngay <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        		</div>
            @endif
    	</div>
        @if(checkAgent() == 'mobile')
            <div class="compare-action">
                <p class="link cancel flex-center">Hủy so sánh</p>
                <a href="{{ route('app.products.compare') }}" class="link flex-center">So sánh ngay <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </div>
        @endif
	@endif
</div>
