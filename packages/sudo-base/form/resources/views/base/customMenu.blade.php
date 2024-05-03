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
<div class="row config-menu">
	<div class="col-lg-12 p-0">	
		<div class="card card-info" id="{{$name ?? ''}}_wrap">
			<div class="card-header" data-bs-toggle="collapse" data-parent="#{{$name ?? ''}}_wrap" href="#{{$name ?? ''}}_box" class="collapsed" aria-expanded="false" style="cursor: pointer;">
				<h4 class="card-title">@lang($label ?? '')</h4>
			</div>
			<div class="panel-collapse collapse show" id="{{$name ?? ''}}_box">
				<div class="card-body row">

					<div class="col-xl-4 col-lg-4 col-md-12 p-0">
						@include('Form::base.components.customMenuSitebar', [ 
							'type' => 'custom_link',
							'label' => __('Translate::form.menu.custom_link'),
						])
						
						@if (isset(config('app.menu_form.menu_link')[\App::getLocale()]) && !empty(config('app.menu_form.menu_link')[\App::getLocale()]))
						@include('Form::base.components.customMenuSitebar', [ 
							'type' => 'fix_link',
							'label' => __('Translate::form.menu.fix_link'),
							'option' => config('app.menu_form.menu_link')[\App::getLocale()] ?? [],
						])
						@endif

						@if (!empty(config('app.menu_form.table_link')))
							@foreach (config('app.menu_form.table_link') as $table => $option)
								@include('Form::base.components.customMenuSitebar', [ 
									'type' => 'table_link',
									'label' => __($option['name'] ?? ''),
									'table' => $table,
									'option' => $table_link[$table] ?? [],
								])
							@endforeach
						@endif
					</div>

					<div class="col-xl-6 col-lg-6 col-md-12">
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
									    		'table_link' => $table_link ?? []
									    	];
								    	@endphp
								    	@include('Form::base.components.customMenuValue', $data)
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

	    changeMenu('#{{ $name ?? '' }}');
	});
</script>