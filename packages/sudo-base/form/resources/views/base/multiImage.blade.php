{{-- 
	@include('Form::base.multiImage', [
    	'name'				=> $item['name'],
		'value' 			=> $item['value'],
		'required' 			=> $item['required'],
		'label' 			=> $item['label'],
		'title_btn' 		=> $item['title_btn'],
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
        <div class="image-box">
            <button type="button" class="btn btn-primary btn-sm image-box__btn" 
                data-image="{{ route('media.index', [
                    'uploads' => 'multiple',
                    'field_id' => $name??'',
                    'only' => 'image'
                ]) }}"
            >@lang('Translate::form.choose') @lang($title_btn??$label??'')</button>
            <div class="image-box__content multi-image-box__content" id="{{$name??''}}_box">
                @php
                    $value = old($name)??$value;
                @endphp
                @if (isset($value) && !empty($value))
                    @foreach ($value as $v)
                        <div class="item" data-delete_box>
                            <img src="{{ getImage($v??'') }}" alt="">
                            <input type="hidden" value="{{ $v??'' }}" name="{{$name??''}}[]">
                            <span class="item-delete" data-delete_nocomfirm><i class="fa fa-trash"></i></span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @if($has_row == true) 
            </div> 
        @endif
    </div>

@if($class_col != '')
    </div>
@endif
<script>
    $(document).ready(function() {
        {{--Cho phép sắp xếp --}}
        $('#{{$name??''}}_box').sortable().disableSelection();
        $('#{{$name??''}}_box').bind("sortstart", function(event, ui) {
            ui.placeholder.css("visibility", "visible");
            ui.placeholder.css("border", "1px dotted #e3e3e3");
            ui.placeholder.css("background", "transparent");
        });
        {{-- Nếu bắt buộc --}}
        @if ($required==1)
            $('body').on('click','button[type=submit]', function(e) {
                if($('input[name="{{$name??''}}[]"]').length == 0) {
                    e.preventDefault();
                    $('#{{$name??''}}_box').find('.error').remove();
                    $('#{{$name??''}}_box').append(formHelper('@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.no_empty')'));
                }
            });
        @endif
    });
</script>