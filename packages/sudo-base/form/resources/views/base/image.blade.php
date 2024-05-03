{{-- 
    @include('Form::base.image', [
        'name'              => $item['name'],
        'value'             => $item['value'],
        'required'          => $item['required'],
        'label'             => $item['label'],
        'title_btn'         => $item['title_btn'],
    ])
--}}

@php
$storage_size_link = env('STORAGE_SIZE_LINK');
$storage_size = env('STORAGE_SIZE');
// Lấy dung lượng lưu trữ hiện tại tính theo byte
if($storage_size_link != '' && $storage_size != ''){
    $content = file_get_contents($storage_size_link);
    $content = json_decode($content, 1);
    $current_size = $content['bytes'];
    $current_size = round($current_size / 1073741824, 1);
}
@endphp

@if($class_col != '')
    <div class="{{ $class_col }}">
@endif
    <div class="mb-3 @if($has_row == true) row @endif">
        <label for="{{ $name??'' }}" @if($has_row == true) class="col-md-2 col-form-label" @endif>@if($required==1) * @endif @lang($label??'')</label>
        @if($has_row == true) 
            <div class="col-md-10">
        @endif
            @if(isset($current_size) && $current_size > $storage_size * 0.9) {{-- Nếu dung lượng hiện tại > 90% dung lượng tổng thì hiển thị cảnh báo --}}
                <div class="message-full-storage-{{$name??''}}" style="font-size: 13px;color: red;padding-bottom: 5px;">Dung lượng lưu trữ ảnh hiện tại của quý khách sắp đầy ( {!! $current_size !!} GB / {!! $storage_size !!} GB). Vui lòng xóa bớt dữ liệu hoặc <a target="_blank" style="color: #428bca;" href="https://sudo.vn">nâng cấp</a> ngay</div>
            @endif
            <div class="image-box" id="image-box-{{$name??''}}" @if($value == '') style="display: none;" @endif>
                <button type="button" class="btn btn-primary btn-sm image-box__btn" 
                    data-image="{{ route('media.index', [
                        'uploads' => 'single',
                        'field_id' => $name??'',
                        'only' => 'image'
                    ]) }}"
                >{!! __('Translate::form.image.change') !!}</button>
                <p class="image-box__remove" data-delete_noremove>{!! __('Translate::form.image.remove') !!}</p>
                <div class="image-box__content" id="{{$name??''}}_box">
                    @php
                        $value = old($name)??$value;
                    @endphp
                    <div class="item" data-delete_box
                        data-image="{{ route('media.index', [
                            'uploads' => 'single',
                            'field_id' => $name??'',
                            'only' => 'image'
                        ]) }}"
                    >
                        <img src="{{ getImage($value??'') }}" alt="">
                        <input type="hidden" value="{{ $value??'' }}" name="{{$name??''}}">
                    </div>
                </div>
            </div>
            <div class="dropzone dz-clickable" id="{{ str_replace(['_'], '', $name??'') }}UploadForm" data-image="{{ route('media.index', [
                        'uploads' => 'single',
                        'field_id' => $name??'',
                        'only' => 'image'
                    ]) }}" style="min-height: auto;@if($value != '') display: none; @endif">
                <div class="dz-message needsclick" style="margin: 0;">
                    <div class="mb-3">
                        <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                    </div>
                    <h4>{!! __('Translate::form.image.drag_and_drop') !!}</h4>
                </div>
            </div>
            <p class="help-text" style="padding-top: 5px;font-size: 12px;">{!! $helper_text??'' !!}</p>
        @if($has_row == true) 
            </div> 
        @endif
    </div>

@if($class_col != '')
    </div>
@endif
<div class="modal" id="modal-message-full-storage">
    <div class="modal-content" style="width: 500px;">
        <div class="modal-close"></div>
        <div class="">
            <div class="message" style="text-align: center;padding: 20px;"></div>
        </div>
    </div>
</div>
<script>
    Dropzone.options.{{ str_replace(['_', '-'], '', $name??'') }}UploadForm = {
        //http://www.dropzonejs.com/#configuration-options
        url:'/admin/media',
        paramName: "files",
        clickable: false,
        maxFilesize: 2, // MB
        uploadMultiple: false,
        parallelUploads: 100, //số file xử lý song song trên 1 request
        maxFiles: 5, //Tối đa 5 file 1 lần
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.svg',
        //autoProcessQueue: false,
        accept: function(file, done) {
            done();
        },
        error: function(file, response) {
            console.log('Up-Error: '+response);
        },
        processing: function (file) {
            var imgLoading = Dropzone.createElement('<img class="img-loading" style="position:absolute;top:-20px;left:calc(50% - 8px);z-index:10;" src="/admin_assets/images/loading.gif" />');
            file.previewElement.append(imgLoading);
            $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone .dz-message').hide();
            $('.message-full-storage-{{$name??''}}').hide();
        },
        success: function(file,response) {
            if(response.status == -1){
                $('.img-loading').remove();
                $('#image-box-{{$name??''}}').hide();
                $('#image-box-{{$name??''}}').find('input').val('');
                $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone').show();
                $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone .dz-preview').remove();
                $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone .dz-message').show();
                $('.message-full-storage-{{$name??''}}').html(response.message);
                $('.message-full-storage-{{$name??''}}').show();
                return false;
            }
            $('.img-loading').remove();
            console.log('Up-Success:');
            console.log(response);
            $('#image-box-{{$name??''}}').find('img').attr('src', response.link);
            $('#image-box-{{$name??''}}').find('input').val(response.link);
            $('#image-box-{{$name??''}}').show();
            $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone').hide();
            $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone .dz-message').show();
            $('#image-box-{{$name??''}}').parents('.mb-3').find('.dropzone .dz-preview').remove();
        }
    };
</script>
<script>
    $(document).ready(function() {
        {{-- Click nút xóa ảnh thì sẽ trả về giá trị ảnh mặc định và value rỗng --}}
        $('body').on('click', '*[data-delete_noremove]', function() {
            $(this).parents('#image-box-{{$name??''}}').hide();
            $(this).parents('#image-box-{{$name??''}}').find('input').val('');
            $(this).parents('.mb-3').find('.dropzone').show();
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