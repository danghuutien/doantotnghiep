<div class="form-group row" style="display: inline-block;vertical-align: top;">
	<label class="col-form-label">{{ __('Chọn nhãn') }}: </label>
	<div class="type_salary form-radio">
		<div class="form-radio__group">
			<input type="radio" id="no_label" name="type_label" value="0" class="btn-radio" checked="">
			<label for="no_label">{{ __('Bỏ chọn') }}</label>
		</div>
		<div class="form-radio__group">
			<input type="radio" id="one_one" name="type_label" value="1" class="btn-radio" {{ @$type_label == 1 ? 'checked' : '' }}>
			<label for="one_one">{{ __('Mua 1 tặng 1') }}</label>
		</div>
		<div class="form-radio__group">
			<input type="radio" id="gift" name="type_label" value="2" class="btn-radio" {{ @$type_label == 2 ? 'checked' : '' }}>
			<label for="gift">{{ __('Hộp quà') }}</label>
		</div>
		
	</div>	
</div>
<div class="form-group row one_one">
	<label class="col-form-label" for="related_products">{{ __('* Chọn sản phẩm tặng kèm') }}</label>
	<div class="one_one_select suggest">
		<input type="hidden" name="product_gift_id" value="{{ $check->product_id ?? 0 }}">
		<input type="hidden" name="vr_gift_id" value="{{ $check->variant_id ?? 0 }}">
		<input type="hidden" name="buy_get_name" value="{{ $check->name ?? '' }}">
		<select name="product_gift" id="" class="form-control select_product">
			<option value="0">{{ __('--Bạn chưa chọn sản phẩm--') }}</option>
			@foreach($products as $key => $value)
				<option value="{{ $value['product_id'] }}_{{ $value['variant_id'] ?? 0 }}" data-product_id="{{ $value['product_id'] }}" data-variant_id="{{ $value['variant_id'] ?? 0 }}">{{ $value['name'] ?? '' }}</option>
			@endforeach
		</select>
	</div>
</div>
<div class="form-group gift-detail">
	<label class="col-form-label" for="related_products">{{ __('* Nhập mã quà tặng') }}</label>
	<input type="text" class="form-control" autocomplete="off" name="gift_code" placeholder="Mã quà tặng" value="{{ $check->code ?? '' }}">

	<label class="col-form-label" for="related_products">{{ __('Nhập tên quà tặng') }}</label>
	<input type="text" class="form-control" autocomplete="off" name="gift_name" placeholder="Tên quà tặng" value="{{ $check->name ?? '' }}">

	{{-- <div class="form-group row">
		<label for="image" class="col-lg-12 col-form-label">Chọn Ảnh quà tặng</label>
		<div class="image-box">
			<button type="button" class="btn btn-primary btn-sm image-box__btn" data-image="{{ asset('/') }}admin/media?uploads=single&amp;field_id=gift_image&amp;only=image">Chọn ảnh</button>
			<div class="image-box__content" id="gift_image_box">
	            <div class="item" data-delete_box="" data-image="{{ asset('/') }}admin/media?uploads=single&amp;field_id=gift_image&amp;only=image">
				    <img src="{{ getImage($check->image ?? '', 'small') }}" alt="">
				    <input type="hidden" value="" name="gift_image">
				    <span class="item-delete" data-delete_noremove=""><i class="fa fa-trash"></i></span>
				</div>
			</div>
		</div>
	</div> --}}
</div>
<script>
	$(document).ready(function() {
		$('.select_product').select2();
		$('select[name="product_gift"]').on('change', function(){
			var product_id = $(this).find('option:selected').data('product_id');
			var variant_id = $(this).find('option:selected').data('variant_id');
			var name = $(this).find('option:selected').text();
			$('input[name="product_gift_id"]').val(product_id);
			$('input[name="vr_gift_id"]').val(variant_id);
			$('input[name="buy_get_name"]').val(name);
		});
		@if(isset($type_label) && $type_label == 1 && isset($check))
			$('select[name="product_gift"] option').each(function(){
				var product_id = $(this).data('product_id');
				var variant_id = $(this).data('variant_id');
				if(product_id == parseInt('{{ $check->product_id ?? 0 }}') && parseInt('{{ $check->variant_id ?? 0 }}') != 0 && variant_id == parseInt('{{ $check->variant_id ?? 0 }}')) {
					$('select[name="product_gift"]').val(product_id+'_'+variant_id);
					$('select[name="product_gift"]').change();
				} else if(product_id == parseInt('{{ $check->product_id ?? 0 }}') && parseInt('{{ $check->variant_id ?? 0 }}') == 0) {
					$('select[name="product_gift"]').val(product_id+'_0').change();
				}
			});
		@endif
		select_label({{ @$type_label??0 }});
		$('input[name="type_label"]').on('click', function(){
			var type_label = $(this).val();
			select_label(type_label);
		});
	});
	function select_label(type_label=0){
		if(type_label == 1) {
			$('.one_one').css('display','block');
			$('.gift-detail').css('display','none');
			$('.gift-detail').find('img').attr('src', '');
			$('.gift-detail').find('input').val('');
		} else if(type_label == 2) {
			$('.gift-detail').css('display','block');
			$('.one_one').css('display','none');
			$('.one_one').find('input').val('');
			$('select[name="product_gift"]').val(0).change();
		}else {
			$('.one_one').css('display','none');
			$('.one_one').find('input').val('');
			$('.gift-detail').css('display','none');
			$('.gift-detail').find('img').attr('src', '');
			$('.gift-detail').find('input').val('');
			$('select[name="product_gift"]').val(0).change();
		}
	}
</script>