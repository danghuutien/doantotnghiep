@extends('Core::layouts.app')

@section('title') @lang('Translate::form.edit') @lang($module_name) @endsection

@section('content')

<form action="{!! route('admin.'.$table_name.'.update', $id) !!}" class="form-horizontal" enctype="multipart/form-data" method="post">
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<p class="card-title-desc">@lang('Những trường đánh dấu * là bắt buộc')</p>
				{{method_field('PUT')}}
				@include('Form::generate')
			</div>
		</div>
	</div>
	@if (isset($has_seo) && $has_seo == true)
		@include('Form::metaseo', [
			'type' 			=> $table_name,
			'type_id' 		=> $id
		])
	@endif
</div>
</form>

@endsection