{{-- 
	@include('Form::base.slug', [
    	'name'				=> $item['name'],
		'value' 			=> $item['value'],
		'required' 			=> $item['required'],
		'label' 			=> $item['label'],
		'extends' 			=> $item['extends'],
        'unique'            => $item['unique'],
		'table' 			=> $item['table'],
    ])
--}}
@php
    $seo_prefix_url = config('app.seo_prefix_url')[$table_name] ?? [];
    $seo_html = $seo_prefix_url['html'] ?? false;
@endphp
@if($class_col != '')
    <div class="{{ $class_col }}">
@endif
    <div class="mb-3 @if($has_row == true) row @endif" style="position: relative;">
        <label for="{{ $name??'' }}" @if($has_row == true) class="col-md-2 col-form-label" @endif style="margin-bottom: 0;">@if($required==1) * @endif @lang($label??'')</label>
        @if($has_row == true) 
            <div class="col-md-10">
        @endif
        <input type="hidden" class="form-control" autocomplete="off" name="{{ $name??'' }}" id="{{ $name??'' }}" value="{{ old($name)??$value??'' }}">
        <div class="slug">
            <div class="slug-content">
                {!! $seo_prefix_url['url'] ?? config('app.url') ?? '' !!}/<span>{{ old($name)??$value??'' }}</span>
            </div>
            @if($seo_html)<span>.html</span>@endif
            <div class="action">
                <a href="javascript:;" title="" class="edit">Edit</a>
                <a href="javascript:;" title="" class="ok">Ok</a>
                <a href="javascript:;" title="" class="cancel">Cancel</a>
            </div>
        </div>
        @if($has_row == true) 
            </div> 
        @endif
    </div>

@if($class_col != '')
    </div>
@endif
@if($has_row != true)
<style>
    img.form-loading{
        top: 25px;
    }
</style>
@endif
<style>
    .slug {
        float: none;
        display: flex;
        align-items: center;
    }
</style>
<script>
    $(document).ready(function() {
        text_error = '@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.is_unique')';
        var get_slug = 1;
        $('body').on('click', '.slug .edit', function(){
            var slug = $('#{{ $name??'' }}').val();
            $('.slug-content span').html('<input type="text" class="edit-slug" value="'+slug+'">');
            $(this).hide();
            $('.slug .ok').show();
            $('.slug .cancel').show();
        });
        $('body').on('click', '.slug .ok', function(){
            var slug = $('body .slug-content .edit-slug').val();
            $('#{{ $name??'' }}').val(convertToSlug(slug));
            $('.slug-content span').html(convertToSlug(slug));
            $('.slug .edit').show();
            $('.slug .ok').hide();
            $('.slug .cancel').hide();
            get_slug = 0;
        });
        $('body').on('click', '.slug .cancel', function(){
            var slug = $('#{{ $name??'' }}').val();
            $('.slug-content span').html(convertToSlug(slug));
            $('.slug .edit').show();
            $('.slug .ok').hide();
            $('.slug .cancel').hide();
        });
        {{-- Nếu bắt buộc --}}
        @if ($required==1)
            validateInput('#{{ $name??'' }}', '@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.no_empty')');
        @endif
        {{-- Nếu có kế thừa từ input khác --}}
        @if (isset($extends) && !empty($extends))
            $('body').on('keyup change', '#{{ $extends??'' }}', function() {
                if(get_slug == 1){
                    value = $(this).val();
                    $('#{{ $name??'' }}').val(convertToSlug(value));
                    $('.slug-content span').html(convertToSlug(value));
                    $('#{{ $name??'' }}').change();
                }
            });
        @endif
        
        {{-- Nếu là duy nhất --}}
        @if (isset($unique) && $unique == 'true')
            $check = null;
            $is_unique = true; // true: không trùng | false: bị trùng
            // nếu input có thay đổi
            $('body').on('keyup change', '#{{ $name??'' }}', function() {
                // giá trị slug
                $value = $('#{{ $name??'' }}').val();
                // Tên bảng
                $table = '{{ $table??$table_name??'' }}';
                // xóa setTimeout $check
                clearTimeout($check);
                // Nếu xác định được giá trị và bảng
                if (!checkEmpty($value) && !checkEmpty($table)) {
                    // lấy sau keyup 1 giây
                    $check = setTimeout(function() {
                        // chuẩn hóa dữ liệu form
                        data = {
                            table: $table,
                            slug: $value,
                        };
                        // load ajax check tồn tại slug
                        loadAjaxPost('{{ route('admin.ajax.check_slug') }}', data, {
                            beforeSend: function(){
                                $('#{{ $name??'' }}').parent().find('.form-loading').remove();
                                $('#{{ $name??'' }}').parent().append(formLoading('loading'));
                            },
                            success:function(result){
                                if (result == 2) {
                                    $('#{{ $name??'' }}').parent().find('.form-loading').remove();
                                    $('#{{ $name??'' }}').parent().append(formLoading('error'));
                                    $is_unique = false;
                                } else {
                                    $('#{{ $name??'' }}').parent().find('.form-loading').remove();
                                    $('#{{ $name??'' }}').parent().append(formLoading('success'));
                                    $is_unique = true;
                                }
                                validateSlug($is_unique, '#{{ $name??'' }}', text_error);
                            },
                            error: function (error) {
                                $('#{{ $name??'' }}').parent().find('.form-loading').remove();
                                $('#{{ $name??'' }}').parent().append(formLoading('error'));
                            }
                        }, 'custom');
                    }, 1000);
                }
            });
            $('body').on('click','button[type=submit]', function(e) {
                if ($is_unique == false) {
                    e.preventDefault();
                    $('#{{ $name??'' }}').parent().append(formHelper(text_error));
                    $('#{{ $name??'' }}').css('border', '1px solid #ff0000');
                }
            });
        @endif
    });
</script>