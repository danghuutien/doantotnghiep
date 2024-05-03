{{-- 
	@include('Product::admin.form.price', [
    	'name'				=> $item['name'],
		'value' 			=> $item['value'],
		'required' 			=> $item['required'],
		'label' 			=> $item['label'],
		'placeholder' 		=> $item['placeholder'],
    ])
--}}

@if($class_col != '')
    <div class="{{ $class_col }}">
@endif
    <div class="mb-3 @if($has_row == true) row @endif" style="position: relative;">
        <label for="{{ $name??'' }}" @if($has_row == true) class="col-md-2 col-form-label" @endif>@if($required==1) * @endif @lang($label??'')</label>
        @if($has_row == true) 
            <div class="col-md-3">
        @endif
      	<input type="number" class="form-control" autocomplete="off" name="{{ $name??'' }}" id="{{ $name??'' }}" placeholder="@lang($placeholder??$label??$name??'')" value="{{ old($name)??$value??'' }}">
        <span id="{{$name}}_price" style="line-height: 25px;"></span>
        @if($has_row == true) 
            </div> 
        @endif
    </div>
@if($class_col != '')
    </div>
@endif
<script>
    $(document).ready(function() {
        $('body').on('keyup', '#{{$name}}', function() {
            price = $(this).val();
            $(this).parents('.mb-3').find('#{{$name}}_price').html(formatPrice(price));
        });
        $('#{{$name}}').keyup();
        @if ($required==1)
            validateInput('#{{$name}}', '@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.no_empty')');
        @endif
    });
    // Định dạng giá
    function formatPrice(number) {
        if (number == '') {
            return '';
        } else if (number == 0) {
            return '0';
        } else {
            number += '';
            x = number.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            number = x1 + x2 +"";
            return number;
        }
    }
</script>