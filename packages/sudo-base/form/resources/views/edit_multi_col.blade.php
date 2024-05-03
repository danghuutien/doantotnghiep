@extends('Core::layouts.app')

@section('title') @lang('Translate::form.edit') @lang($module_name) @endsection
@section('content')

<form action="{!! route('admin.'.$table_name.'.update', $id) !!}" class="form-horizontal" enctype="multipart/form-data" method="post">
	<div class="row">
		{{method_field('PUT')}}
		@include('Form::generate')
		@if (isset($has_seo) && $has_seo == true)
			@include('Form::metaseo', [
				'type' 			=> $table_name,
				'type_id' 		=> $id
			])
		@endif
	</div>
</form>

@endsection