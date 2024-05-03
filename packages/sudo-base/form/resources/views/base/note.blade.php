{{-- 
	@include('Form::base.note', [
    	'label'				=> $item['label'],
    ])
--}}
@if (isset($label) && !empty($label))
<div class="form-group row" style="margin-top: -15px;">
	@if ($has_full == true)
        <label class="col-lg-12 col-form-label p-0"></label>
    	<div class="col-lg-12">
    @else
        <label class="col-lg-2 col-md-2 col-form-label text-right"></label>
    	<div class="col-lg-10 col-md-10">
    @endif
      	<span class="helper">@lang($label??'')</span>
    </div>
</div>
@endif
