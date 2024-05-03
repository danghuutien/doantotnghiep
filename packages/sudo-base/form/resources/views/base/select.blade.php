{{-- 
	@include('Form::base.select', [
    	'name'				=> $item['name'],
		'value' 			=> $item['value'],
		'required' 			=> $item['required'],
		'label' 			=> $item['label'],
		'options' 			=> $item['options'],
		'select2' 			=> $item['select2'],
		'disabled' 			=> $item['disabled'],
    ])
--}}

@if($class_col != '')
    <div class="{{ $class_col }}">
@endif
    <div class="mb-3 @if($has_row == true) row @endif">
        <label for="{{ $name??'' }}" @if($has_row == true) class="col-md-2 col-form-label" @endif>@if($required==1) * @endif @lang($label??'')</label>
        @if($has_row == true) 
            <div class="col-md-10">
        @endif
        <select class="form-control form-select" name="{{ $name??'' }}" id="{{ $name??'' }}">
            @foreach ($options as $key => $option)
                <option value="{{ $key??'' }}"
                    {{-- chọn hay không --}}
                    @if (isset($value) && !empty($value))
                        @if ($key == $value) selected @endif
                    @endif
                    {{-- Có ẩn chọn hay không --}}
                    @if (isset($disabled) && !empty($disabled))
                        @foreach ($disabled as $dis)
                            @if ($dis == $key) disabled="disabled"  @endif
                        @endforeach
                    @endif
                >@lang($option??'')</option>
            @endforeach
        </select>
        @if($has_row == true)
            </div> 
        @endif
    </div>

@if($class_col != '')
    </div>
@endif
<script>
    $(document).ready(function() {
        {{-- Nếu có giá trị select2 --}}
        @if (isset($select2) && $select2 == 1)
            $('#{{ $name??'' }}').select2();
        @endif
        {{-- Nếu bắt buộc --}}
        @if ($required==1)
            validateSelect('#{{ $name??'' }}', '@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.is_select')')
        @endif
    });
</script>