@php
	$table_link = [];
	if (!empty(config('app.menu_form.table_link'))) {
		foreach (config('app.menu_form.table_link') as $table => $option) {
			$models = new $option['models'];
			$data_option = $models->getCustomMenu($option['has_locale'] ?? false);
			$table_link[$table] = $data_option;
		}
	}
@endphp
<div class="row">
	<div class="col-lg-12 p-0">
		<div class="card card-info" id="{{$name ?? ''}}_wrap">
			<div class="card-header" data-toggle="collapse" data-parent="#{{$name ?? ''}}_wrap" href="#{{$name ?? ''}}_box" class="collapsed" aria-expanded="false" style="cursor: pointer;">
				<h4 class="card-title">@lang($label ?? '')</h4>
			</div>
			<div class="panel-collapse collapse show" id="{{$name ?? ''}}_box">
				<div class="card-body row">

					<div class="col-xl-3 col-lg-5 col-md-12 p-0">
						@include('Default::admin.settings.base.Components.customMenuSitebar', [
							'type' => 'custom_link',
							'label' => __('Translate::form.menu.custom_link'),
						])

						@if (isset(config('app.menu_form.menu_link')[\App::getLocale()]) && !empty(config('app.menu_form.menu_link')[\App::getLocale()]))
							@include('Default::admin.settings.base.Components.customMenuSitebar', [
                                'type' => 'fix_link',
                                'label' => __('Translate::form.menu.fix_link'),
                                'option' => config('app.menu_form.menu_link')[\App::getLocale()] ?? [],
                            ])
						@endif

						@if (!empty(config('app.menu_form.table_link')))
							@foreach (config('app.menu_form.table_link') as $table => $option)
								@include('Default::admin.settings.base.Components.customMenuSitebar', [
									'type' => 'table_link',
									'label' => __($option['name'] ?? ''),
									'table' => $table,
									'option' => $table_link[$table] ?? [],
								])
							@endforeach
						@endif
					</div>

					<div class="col-xl-5 col-lg-7 col-md-12">
						<div class="nestable">
							<input type="hidden" name="{{ $name ?? '' }}" value="">
							<div class="nestable-action">
								<p class="nestable-action__text">@lang('Translate::form.menu.structure')</p>
								<div class="nestable-action__group">
									<button type="button" class="nestable-action__btn plus" data-nestable_action="expandAll" href="#{{ $name ?? '' }}"><i class="fas fa-plus"></i></button>
									<button type="button" class="nestable-action__btn minus" data-nestable_action="collapseAll" href="#{{ $name ?? '' }}"><i class="fas fa-minus"></i></button>
								</div>
							</div>

							<div class="dd" id="{{ $name ?? '' }}">
								<ol class="dd-list">
									@if (isset($value) && !empty($value))
										@php
											$value = json_decode($value);
                                            $data = [
                                                'datas' => $value ?? [],
                                                'menu_link' => config('app.menu_form.menu_link')[\App::getLocale()] ?? [],
                                                'table_link' => $table_link ?? [],
                                                'image_box' => true
                                            ];
										@endphp
										@include('Default::admin.settings.base.Components.customMenuValue', $data)
									@endif
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery(document).ready(function() {

		// Sinh nestable vaf update lại input mỗi khi thay đổi
		$('#{{ $name ?? '' }}').nestable({
			group: 1
		}).on('change', function() {
			{{$name?? ''}}_value = window.JSON.stringify($('#{{ $name ?? '' }}').nestable('serialize'));
			$('input[name={{ $name ?? '' }}]').val({{$name?? ''}}_value);
		});
		$('input[name={{ $name ?? '' }}]').val(window.JSON.stringify($('#{{ $name ?? '' }}').nestable('serialize')));

		changeMenuCustom('#{{ $name ?? '' }}');
		@if(isset($addScript) && $addScript === 1)
			$('body').on('click', '.btn-menu-submit',function(event) {
				event.preventDefault();
				type = $(this).data('type');
				id_name = $(this).data('name');
				name = $(this).closest('.card-body').find('.menu-name').val();
				desc = $(this).closest('.card-body').find('.menu-desc').val();
				thumbnail = $(this).closest('.card-body').find('.image-box__content input').val();
				link = $(this).closest('.card-body').find('.menu-link').val();
				target = $(this).closest('.card-body').find('.menu-target').val();
				rel = $(this).closest('.card-body').find('.menu-rel').val();
				data = {
					type: type,
					name: name,
					desc: desc,
					thumbnail: thumbnail,
					link: link,
					target: target,
					rel: rel
				};
				switch(type) {
					case 'custom_link':
						html = generateMenu(data);
					break;
					case 'fix_link':
						html = generateMenu(data);
					break;
					case 'table_link':
						table = $(this).closest('.card-body').find('.menu-table').val();
						id = $(this).closest('.card-body').find('.menu-link option:selected').data('id');
						if (!checkEmpty(table)) { data.table = table; }
						if (!checkEmpty(id)) { data.id = id; }
						html = generateMenu(data);
					break;
				}
				$('#'+id_name).children('.dd-list').append(html);
				$('#'+id_name).change();
				$(this).closest('.card-body').find('input.menu-name').val('');
				$(this).closest('.card-body').find('input.menu-desc').val('');
				$(this).closest('.card-body').find('input.menu-link').val('');
				$(this).closest('.card-body').find('.image-box__content input').val('');
				$(this).closest('.card-body').find('.image-box').hide();
				$(this).closest('.card-body').find('.image-box').siblings('.dropzone').show();
				$(this).closest('.card-body').find('select.menu-link').prop('selectedIndex',0);
				$(this).closest('.card-body').find('select.menu-target').prop('selectedIndex',0);
				$(this).closest('.card-body').find('select.menu-rel').prop('selectedIndex',0);
			});
		@endif

		$('body .image-box__content').one('DOMSubtreeModified', function(){
		    console.log('changed');
		    let id_item = $(this).attr('id');
			setTimeout(function(){
				let src = $('#'+id_item).find('input').val();
				$('#'+id_item).closest('li').attr('data-thumbnail', src).data('thumbnail', src);
				$('#'+id_item).closest('div.dd').change();
			})
		});
		$('body .image-box__remove').on('click', function(){
			let _this = $(this);
			setTimeout(function(){
				_this.closest('li').attr('data-thumbnail', '').data('thumbnail', '');
				_this.closest('div.dd').change();
			})
		});
	});
	function changeMenuCustom(element) {
	array_class = ['name','link','desc','thumbnail','target','rel'];

	$.each(array_class, function(index, item) {
		$('body').on('change keyup', element+' .menu-'+item ,function() {
			value = $(this).val();
			if (item == 'link') {
				id = $(this).find('option:selected').data('id');
				if (!checkEmpty(id)) {
					$(this).closest('.dd-item').attr('data-id', id).data('id', id);
					console.log('change');
				}
			}
			console.log(element)
			$(this).closest('.dd-item').attr('data-'+item, value).data(item, value)
	    	$(element).change();
	    });
	});
}
</script>