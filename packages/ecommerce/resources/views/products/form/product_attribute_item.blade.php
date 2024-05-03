@if (!isset($category_id) || $category_id == 0)
	<h5 class="p-2" style="font-weight: normal;">@lang('Vui lòng chọn <strong>Danh mục</strong> để hiển thị')</h5>
@else
	@php
		$attribute_product_category_maps = getAttributeCategoryMap($category_id);
		$attribute_array_id = $attribute_product_category_maps->pluck('attribute_id')->toArray();
		$attributes = \Sudo\Product\Models\Attribute::whereIn('id', $attribute_array_id)->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
		$attribute_details = collect(\Sudo\Product\Models\AttributeDetail::whereIn('attribute_id', $attribute_array_id)->orderBy('order', 'asc')->get());
		$product_attributes = \Sudo\Product\Models\ProductAttribute::where('product_id', $product_id ?? 0)->pluck('price', 'attribute_detail_id')->toArray();
		$product_attID = \Sudo\Product\Models\ProductAttribute::where('product_id', $product_id ?? 0)->pluck('attribute_detail_id')->toArray();
	@endphp
	@if (isset($attributes) && count($attributes) > 0)
		@foreach ($attributes as $attr)
			<div class="card card-pink collapsed-card mb-2">
				<div class="card-header text-sm" data-card-widget="collapse" style="padding: 5px 13px;">
					<div class="card-title">@lang($attr->name)</div>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
					</div>
				</div>
				<div class="card-body">
					@foreach ($attribute_details->where('attribute_id', $attr->id) as $details)
						<div class="form-group row">
						    <label for="att{{$details->id}}" class="col-lg-3 col-md-12 col-form-label text-right">
								<input type="checkbox" name="attID[]" class="btn-checkbox mr-1" value="{{$details->id}}" id="att{{$details->id}}" {{ in_array($details->id, $product_attID) ? 'checked' : '' }}>
						    	{{ $details->name ?? '' }}</label>
					        <div class="col-lg-6 col-md-12">
					            <input type="number" id="attprice_{{$details->id}}" class="form-control" autocomplete="off" name="attributes[{{$details->id}}]" placeholder="Giá thuộc tính" min="0" value="{{ $product_attributes[$details->id] ?? '' }}">
					    	</div>
					    	<div class="col-lg-3 col-md-12">
					    		<span id="attprice_{{$details->id}}_price" style="line-height: 38px;">{{ 
					    		formatPrice( $product_attributes[$details->id] ?? 0, '0đ') }}</span>
							    <script>
							        $(document).ready(function() {
							            $('body').on('keyup', '#attprice_{{$details->id}}', function() {
							                price = $(this).val();
							                $('#attprice_{{$details->id}}_price').html(formatPrice(price));
							            });
							        });
							        // Định dạng giá
							        function formatPrice(number) {
							            if (number == '') {
							                return '';
							            } else if (number == 0) {
							                return '0đ';
							            } else {
							                number += '';
							                x = number.split('.');
							                x1 = x[0];
							                x2 = x.length > 1 ? '.' + x[1] : '';
							                var rgx = /(\d+)(\d{3})/;
							                while (rgx.test(x1)) {
							                    x1 = x1.replace(rgx, '$1' + '.' + '$2');
							                }
							                number = x1 + x2 +"đ";
							                return number;
							            }
							        }
							    </script>
					    	</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
	@else
		<h5 class="p-2" style="font-weight: normal;">@lang('Thuộc tính tạm thời không khả dụng!') @lang('Vui lòng') <a href="{{ route('admin.attributes.index') }}" target="_blank">@lang('Thêm thuộc tính')</a> @lang('hoặc chọn thuộc tính tại') <a href="{{ route('admin.product_categories.edit', $category_id) }}" target="_blank">@lang('Danh mục')</a></h5>
	@endif
@endif