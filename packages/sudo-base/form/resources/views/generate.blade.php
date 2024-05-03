@csrf
@foreach ($data_form as $item)
	@switch($item['form_type'])

		@case('title') 
			@include('Form::base.title', [
	        	'label'				=> $item['label'],
	        ])
		@break

		@case('note')
			@include('Form::base.note', [
	        	'label'				=> $item['label'],
	        ])
		@break

		@case('disable') 
			@include('Form::base.disable', [
	        	'value'				=> $item['value'],
	        	'label'				=> $item['label'],
	        	'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break
		
		@case('card') 
			<div class="{{ $item['col'] ?? '' }}">
				<div class="card">
					<div class="card-body">
						@if($item['title'] != '')<h4 class="card-title">@lang($item['title'] ?? '')</h4>@endif
						@if($item['desc'] != '')<p class="card-title-desc">@lang($item['desc'] ?? '')</p>@endif
		@break

		@case('endCard')
					{{-- end card-body --}}
					</div>
				{{-- end card --}}
				</div>
			{{-- end col --}}
			</div>
		@break

		@case('col') 
			<div class="{{ $item['class'] ?? '' }}">
		@break

		@case('endCol') 
			</div>
		@break

		@case('row') 
			<div class="row">
		@break

		@case('endRow')
			</div>
		@break

		@case('tab')
			@include('Form::base.tab', [
	        	'label'					=> $item['label'],
				'list_tab' 				=> $item['list_tab'],
				'list_class' 			=> $item['list_class'],
				'has_full' 				=> $item['has_full'],
	        ])
		@break

		@case('endTab')
			@if($item['has_full'] == false)
				</div>
			@endif
			</div>
		@break

		@case('contentTab')
			<div class="tab-content tab-content__{{ $item['class'] }}">
		@break

		@case('endContentTab')
			</div>
		@break

		@case('lang') 
			@include('Form::base.lang', [
	        	'table_name'		=> $item['table_name'],
	        	'has_row'			=> $item['has_row'],
	        	'class_col'			=> $item['class_col'],
	        ])
		@break

		@case('startGroup')
	        @include('Form::base.startGroup', [
	        	'id'				=> $item['id'],
				'label' 			=> $item['label'],
	        ])
        @break

        @case('endGroup')
	        @include('Form::base.endGroup')
        @break

	    @case('text')
	        @include('Form::base.text', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
	        ])
        @break

        @case('number')
	        @include('Form::base.number', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
				'convert_number' 	=> $item['convert_number'],
	        ])
        @break

        @case('email')
	        @include('Form::base.email', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
	        ])
        @break

		@case('hidden') 
			@include('Form::base.hidden', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
	        ])
		@break

		@case('password') 
			@include('Form::base.password', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'confirm' 			=> $item['confirm'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('passwordGenerate') 
			@include('Form::base.passwordGenerate', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'confirm' 			=> $item['confirm'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('slug') 
			@include('Form::base.slug', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'extends' 			=> $item['extends'],
				'unique' 			=> $item['unique'],
				'table' 			=> $item['table'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('textarea') 
			@include('Form::base.textarea', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'row' 				=> $item['row'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'disable' 			=> $item['disable'],
	        ])
		@break
			
		@case('editor') 
			@include('Form::base.editor', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('select') 
			@include('Form::base.select', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'select2' 			=> $item['select2'],
				'disabled' 			=> $item['disabled'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col']
	        ])
		@break

		@case('multiSelect') 
			@include('Form::base.multiSelect', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'placeholder' 		=> $item['placeholder'],
				'select2' 			=> $item['select2'],
				'disabled' 			=> $item['disabled'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('checkbox')
			@include('Form::base.checkbox', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'checked' 			=> $item['checked'],
				'label' 			=> $item['label'],
				'class_col' 		=> $item['class_col']
	        ])
		@break

		@case('multiCheckbox')
			@include('Form::base.multiCheckbox', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col']
	        ])
		@break

		@case('radio')
			@include('Form::base.radio', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'label' 			=> $item['label'],
				'options' 			=> $item['options'],
				'class_col' 		=> $item['class_col']
	        ])
		@break

		@case('tags') 
			@include('Form::base.tags', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
				'auto_click' 		=> $item['auto_click'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('image') 
			@include('Form::base.image', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'title_btn' 		=> $item['title_btn'],
				'helper_text' 		=> $item['helper_text'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('multiImage') 
			@include('Form::base.multiImage', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'title_btn' 		=> $item['title_btn'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('datepicker') 
			@include('Form::base.datepicker', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('datetimepicker') 
			@include('Form::base.datetimepicker', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('suggest') 
			@include('Form::base.suggest', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
	        	'suggest_table' 	=> $item['suggest_table'], 
	        	'suggest_id' 		=> $item['suggest_id'], 
	        	'suggest_name' 		=> $item['suggest_name'],
	        	'suggest_locale' 	=> $item['suggest_locale'],
	        	'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
	        ])
		@break

		@case('multiSuggest') 
			@include('Form::base.multiSuggest', [
	        	'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'required' 			=> $item['required'],
				'label' 			=> $item['label'],
				'placeholder' 		=> $item['placeholder'],
	        	'suggest_table' 	=> $item['suggest_table'], 
	        	'suggest_id' 		=> $item['suggest_id'], 
	        	'suggest_name' 		=> $item['suggest_name'],
	        	'suggest_locale' 	=> $item['suggest_locale'],
	        	'has_row' 			=> $item['has_row'],
				'class_col' 		=> $item['class_col'],
				'lang_locale' 		=> $item['lang_locale'],
	        ])
		@break

		@case('custom')
			@include($item['template'], $item['param'])
		@break

		@case('customMenu') 
			@include($item['template'], [
				'name'				=> $item['name'],
				'value' 			=> $item['value'],
				'label' 			=> $item['label'],
			])
		@break
		
		@case('action')
			@include('Form::base.action', [
	        	'type'				=> $item['type'],
	        	'preview'			=> $item['preview'],
	        	'exit_url'			=> $item['exit_url'],
	        	'custom'			=> $item['custom'],
	        ])
		@break

		@case('actionInline')
			@include('Form::base.actionInline', [
	        	'type'				=> $item['type'],
	        ])
		@break

	@endswitch
@endforeach