{{-- 
    @include('Form::base.image', [
        'name'              => $item['name'],
        'value'             => $item['value'],
        'required'          => $item['required'],
        'label'             => $item['label'],
        'title_btn'         => $item['title_btn'],
    ])
--}}

<div class="form-group row">
    @if ($has_full == true)
        <label for="{{ $name??'' }}" class="col-lg-12 col-form-label">@if($required==1) * @endif @lang($label??'')</label>
        <div class="col-lg-12">
    @else
        <label for="{{ $name??'' }}" class="col-lg-3 col-md-12 col-form-label text-right">@if($required==1) * @endif @lang($label??'')</label>
        <div class="col-lg-8 col-md-12">
    @endif
        <div class="image-box">
        	<button type="button" class="btn btn-primary btn-sm image-box__btn" 
                data-image="{{ route('media.index', [
                    'uploads' => 'single',
                    'field_id' => $name??'',
                    'only' => 'file'
                ]) }}"
            >@lang('Translate::form.choose') @lang($title_btn??$label??'')</button>
            <div class="image-box__content" id="{{$name??''}}_box">
                @php
                    $value = old($name)??$value;
                @endphp
                <div class="item" data-delete_box
                    data-image="{{ route('media.index', [
                        'uploads' => 'single',
                        'field_id' => $name??'',
                        'only' => 'file'
                    ]) }}"
                >
                    <img src="{{ getImage($value??'') }}" alt="">
                    <input type="hidden" value="{{ $value??'' }}" name="{{$name??''}}">
                    <span class="item-delete" data-delete_noremove><i class="fa fa-trash"></i></span>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            {{-- Click nút xóa ảnh thì sẽ trả về giá trị ảnh mặc định và value rỗng --}}
            $('body').on('click', '*[data-delete_noremove]', function() {
                $(this).closest('*[data-delete_box]').find('img').attr('src', '{{ getImageDefault() }}');
                $(this).closest('*[data-delete_box]').find('input').val('');
            });
            {{-- Nếu bắt buộc --}}
            @if ($required==1)
                $('body').on('click','button[type=submit]', function(e) {
                    if($('input[name={{$name??''}}]').length == 0) {
                        e.preventDefault();
                        $('#{{$name??''}}_box').find('.error').remove();
                        $('#{{$name??''}}_box').append(formHelper('@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.no_empty')'));
                    }
                });
            @endif
        });
    </script>
</div>