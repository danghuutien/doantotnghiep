{{-- 
	@include('Form::custom.form_custom', [
        'has_full' => true,
        'name' => 'list',
        'value' => $data['list'] ?? [],
        'label' => 'Cấu hình Demo',
        'generate' => [
            [ 'type' => 'image', 'name' => 'image', 'size' => 'Ảnh có kích thước '.'XXXxXXX', ],
            [ 'type' => 'custom', 'generate' => [
                    [ 'type' => 'text', 'name' => 'text_1', 'placeholder' => 'Tiêu đề', ],
                    [ 'type' => 'text', 'name' => 'text_2', 'placeholder' => 'Link', ],
                ]
            ],
            [ 'type' => 'textarea', 'name' => 'textarea', 'placeholder' => 'Mô tả', ],
        ],
    ]);
--}}
@php
	$slug = str_slug($name);
@endphp
<div class="mb-3 @if(isset($has_full) && $has_full == false) row @endif" style="position: relative;">
	<label @if($has_full == false) class="col-md-2 col-form-label" @endif>@lang($label??'')</label>
	@if($has_full == false) 
        <div class="col-md-10">
    @endif
		<div class="table-form">
			<table class="table-form__table" border="1">
				<tbody>
					@if (isset($generate) && !empty($generate))
						@php
							$first_field_name = '';
							if ($generate[0]['type'] == 'custom') {
								$first_field_name = $generate[0]['generate'][0]['name'] ?? '';
							} else {
								$first_field_name = $generate[0]['name'] ?? '';
							}
						@endphp
						@if (isset($value[$first_field_name]) && !empty($value[$first_field_name]))
							@for ($j = 0; $j < count($value[$first_field_name]); $j++)
								<tr>
									@for ($i = 0; $i < count($generate); $i++)
										@switch($generate[$i]['type'] ?? '')
											
											@case('image')
												@php
													$image_name = $slug.'_'.$generate[$i]['name'].'_'.$j;
												@endphp
										        <td class="table-form__table-image">
													<div class="custom-image">
														<input type="hidden" name="{{ $name ?? '' }}[{{ $generate[$i]['name'] ?? '' }}][]" id="input-{{ $image_name ?? '' }}" value="{{ $value[$generate[$i]['name'] ?? ''][$j] ?? '' }}">
														<img data-image="{{ route('media.index', ['uploads' => 'direct','field_id' => $image_name ?? '','only' => 'image'
											            ]) }}" src="{{ getImage($value[$generate[$i]['name'] ?? ''][$j] ?? '') }}" alt="" id="{{ $image_name ?? '' }}">
														<button type="button" data-image="{{ route('media.index', [
											                'uploads' => 'direct',
											                'field_id' => $image_name ?? '',
											                'only' => 'image'
											            ]) }}" class="add-image" title="@lang($generate[$i]['size'] ?? '')"><i class="fas fa-image"></i></button>
														<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
													</div>
													<p class="help-text">@lang($generate[$i]['size'] ?? '')</p>
												</td>
									        @break

											@case('text')
												<td class="table-form__table-text">
													<input class="table-form__control" type="text" name="{{ $name ?? '' }}[{{ $generate[$i]['name'] ?? '' }}][]" placeholder="@lang($generate[$i]['placeholder'] ?? '')" value="{{ $value[$generate[$i]['name'] ?? ''][$j] ?? '' }}">
												</td>
											@break

											@case('textarea')
												<td class="table-form__table-textarea">
													<textarea class="table-form__control" name="{{ $name ?? '' }}[{{ $generate[$i]['name'] ?? '' }}][]" placeholder="@lang($generate[$i]['placeholder'] ?? '')">{{ $value[$generate[$i]['name'] ?? ''][$j] ?? '' }}</textarea>
												</td>
									        @break

									        @case('custom')
												<td class="table-form__table-custom">
													@if (isset($generate[$i]['generate']) && !empty($generate[$i]['generate']))
														@for ($c = 0; $c < count($generate[$i]['generate']); $c++)
															@php
																$child_item = $generate[$i]['generate'][$c];
															@endphp
															@switch($child_item['type'] ?? '')
																@case('image')
																	@php
																		$image_name = $slug.'_'.$child_item['name'].'_'.$j;
																	@endphp
																	<div class="custom-image">
																		<input type="hidden" name="{{ $name ?? '' }}[{{ $child_item['name'] ?? '' }}][]" id="input-{{ $image_name ?? '' }}" value="{{ $value[$child_item['name'] ?? ''][$j] ?? '' }}">
																		<img data-image="{{ route('media.index', ['uploads' => 'direct','field_id' => $image_name ?? '','only' => 'image']) }}" src="{{ getImage($value[$child_item['name'] ?? ''][$j] ?? '') }}" alt="" id="{{ $image_name ?? '' }}">
																		<button type="button" data-image="{{ route('media.index', [
															                'uploads' => 'direct',
															                'field_id' => $image_name ?? '',
															                'only' => 'image'
															            ]) }}" class="add-image" title="{{ $child_item['size'] ?? '' }}"><i class="fas fa-image"></i></button>
																		<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
																	</div>
														        @break

																@case('text')
																	<input class="table-form__control" type="text" name="{{ $name ?? '' }}[{{ $child_item['name'] ?? '' }}][]" placeholder="@lang($child_item['placeholder'] ?? '')" value="{{ $value[$child_item['name'] ?? ''][$j] ?? '' }}">
																@break

																@case('textarea')
																	<textarea class="table-form__control" name="{{ $name ?? '' }}[{{ $child_item['name'] ?? '' }}][]" placeholder="@lang($child_item['placeholder'] ?? '')">{{ $value[$child_item['name'] ?? ''][$j] ?? '' }}</textarea>
														        @break

															@endswitch
														@endfor
													@endif
												</td>
									        @break

										@endswitch
									@endfor
									<td class="table-form__table-action">
										<button type="button" class="bg-danger delete"><i class="fas fa-trash"></i></button>
										<span type="button" class="bg-default"><i class="fas fa-sort"></i></span>
									</td>
								</tr>
							@endfor
						@endif
					@endif
					<tr class="thead">
						@if (isset($has_full) && $has_full == false)
							<td colspan="{{ count($generate ?? []) + 1 }}"><button type="button" class="add add_{{ $slug ?? '' }}"><i class="fas fa-plus"></i></button></td>
						@else
							{{-- <td colspan="{{ count($generate ?? []) }}"><p>@lang($label??'')</p></td> --}}
							<td colspan="{{ count($generate ?? [])+1 }}"><button type="button" class="add add_{{ $slug ?? '' }}"><i class="fas fa-plus"></i></button></td>
						@endif
					</tr>
				</tbody>
			</table>
		</div>
	@if($has_full == false) 
        </div> 
    @endif
</div>
<script>
$(document).ready(function() {
	$('.table-form__table tbody').sortable();
	
	$('body').on('click', '.table-form__table .delete', function(e) {
		e.preventDefault();
        $(this).closest('tr').remove();
	});

	$('body').on('click', '.remove-image', function(e) {
		e.preventDefault();
		parent = $(this).closest('.custom-image');
		parent.find('input[type=hidden]').val('');
		parent.find('img').attr('src', '{{getImage()}}');
	});

	$('body').on('click','.add_{{ $slug ?? '' }}',function(e) {
		e.preventDefault();
		image_number = $(this).closest('.table-form__table').find('tbody').find('.table-form__table-image').length;
		html = `
			<tr>
				@if (isset($generate) && !empty($generate))
					@for ($i = 0; $i < count($generate); $i++)
						@switch($generate[$i]['type'] ?? '')
							@case('image')
						        <td class="table-form__table-image">
									<div class="custom-image">
										<input type="hidden" name="{{ $name ?? '' }}[{{ $generate[$i]['name'] ?? '' }}][]" id="input-{{$slug.'_'.$generate[$i]['name']}}_${image_number}" value="">
										<img data-image="{{ route('media.index', [
											'uploads' => 'direct',
											'only' => 'image'
										]) }}&field_id={{$slug.'_'.$generate[$i]['name']}}_${image_number}" src="{{ getImage() }}" alt="" id="{{$slug.'_'.$generate[$i]['name']}}_${image_number}">
										<button type="button" data-image="{{ route('media.index', [
											'uploads' => 'direct',
											'only' => 'image'
										]) }}&field_id={{$slug.'_'.$generate[$i]['name']}}_${image_number}" class="add-image" title="@lang($generate[$i]['size'] ?? '')"><i class="fas fa-image"></i></button>
										<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
									</div>
									<p class="help-text">@lang($generate[$i]['size'] ?? '')</p>
								</td>
					        @break

							@case('text')
								<td class="table-form__table-text">
									<input class="table-form__control" type="text" name="{{ $name ?? '' }}[{{ $generate[$i]['name'] ?? '' }}][]" placeholder="@lang($generate[$i]['placeholder'] ?? '')" value="">
								</td>
							@break

							@case('textarea')
								<td class="table-form__table-textarea">
									<textarea class="table-form__control" name="{{ $name ?? '' }}[{{ $generate[$i]['name'] ?? '' }}][]" placeholder="@lang($generate[$i]['placeholder'] ?? '')"></textarea>
								</td>
					        @break

					        @case('custom')
								<td class="table-form__table-custom">
									@if (isset($generate[$i]['generate']) && !empty($generate[$i]['generate']))
										@for ($c = 0; $c < count($generate[$i]['generate']); $c++)
											@php
												$child_item = $generate[$i]['generate'][$c];
											@endphp
											@switch($child_item['type'] ?? '')
												@case('image')
													<div class="custom-image">
														<input type="hidden" name="{{ $name ?? '' }}[{{ $child_item['name'] ?? '' }}][]" id="input-{{$slug.'_'.$child_item['name']}}_${image_number}" value="">
														<img src="{{ getImage() }}" alt="" id="{{$slug.'_'.$child_item['name']}}_${image_number}">
														<button type="button" data-image="{{ route('media.index', [
											                'uploads' => 'direct',
											                'only' => 'image'
											            ]) }}&field_id={{$slug.'_'.$child_item['name']}}_${image_number}" class="add-image" title="{{ $child_item['size'] ?? '' }}"><i class="fas fa-image"></i></button>
														<button type="button" class="remove-image"><i class="fas fa-times"></i></button>
													</div>
										        @break

												@case('text')
													<input class="table-form__control" type="text" name="{{ $name ?? '' }}[{{ $child_item['name'] ?? '' }}][]" placeholder="@lang($child_item['placeholder'] ?? '')" value="">
												@break

												@case('textarea')
													<textarea class="table-form__control" name="{{ $name ?? '' }}[{{ $child_item['name'] ?? '' }}][]" placeholder="@lang($child_item['placeholder'] ?? '')"></textarea>
										        @break

											@endswitch
										@endfor
									@endif
								</td>
					        @break

						@endswitch
					@endfor
				@endif
				<td class="table-form__table-action">
					<button type="button" class="bg-danger delete"><i class="fas fa-trash"></i></button>
					<span type="button" class="bg-default"><i class="fas fa-sort"></i></span>
				</td>
			</tr>
		`;
		$(this).closest('table').find('tbody .thead').before(html);
		$('.table-form__table tbody').sortable();
	});
});
</script>