 <style type="text/css">

    .cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }
    * html .cf { zoom: 1; }
    *:first-child+html .cf { zoom: 1; }

    .small { color: #666; font-size: 0.875em; }
    .large { font-size: 1.25em; }

/**
 * Nestable
 */

 .dd { position: relative; display: block; margin: 0; padding: 0; list-style: none; font-size: 13px; line-height: 20px; border: none;}

 .dd-list { display: flex;flex-wrap: wrap; position: relative; margin: 5px 0px; padding: 0; list-style: none; }
 .dd-list .dd-list { padding-left: 30px; }
 .dd-collapsed .dd-list { display: none; }

 .dd-item,
 .dd-empty,
 .dd-placeholder { display:flex; align-items: center; position: relative; margin-right: 10px; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

 .dd-handle { white-space:nowrap;display: block; height: 30px;color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px;min-width:130px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
    linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}
.dd-placeholder{
    margin-left: 10px;
}
.dd-dragel { position: absolute; pointer-events: none; z-index: 9999;min-width:130px;}
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
    box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

 .nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

 #nestable-menu { padding: 0; margin: 20px 0; }

 #nestable-output,
 #nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

 #nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

 .dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
    border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }
.remove {
    width: 30px;
    height: 30px;
}
.tags-item{
    margin:5px 0px 5px 10px;
}
/**
 * Socialite
 */
 .socialite { display: block; float: left; height: 35px; }
</style>

<div class="row mb-3" id="drag_{{ $name??'' }}">
    @if ($has_full == true)
    <label for="{{ $name??'' }}" class="col-lg-12 col-form-label">@if($required==1) * @endif @lang($label??'')</label>
    <div class="col-lg-12 suggest">
    @else
        <label for="{{ $name??'' }}" class="col-md-2 col-form-label">@if($required==1) * @endif @lang($label??'')</label>
        <div class="col-md-10 suggest">
    @endif
        <input type="text" class="form-control" autocomplete="off" id="{{ $name??'' }}_input" placeholder="@lang($placeholder??$label??$name??'')" value="{{ $data->$suggest_name??'' }}">
        <div class="suggest-result"><ul></ul></div>

        <ol class="col-lg-8 col-md-10 offset-lg-3 offset-md-2 tags dd-list" id="{{ $name??'' }}_box">
            @php
                $value = old($name)??$value;
                if (is_array($value)) {
                    $id_array = $value;
                } else {
                    $id_array = explode(',', $value);
                }
                $ids_ordered = implode(',', $id_array);
                if(!empty($ids_ordered)) {
                    $data = \DB::table($suggest_table)->whereIn('id', $id_array)
                    ->orderByRaw("FIELD(id, $ids_ordered)")->get();
                }
            @endphp
            @if(isset($data))
                @foreach ($data as $item)
                    <li class="tags-item dd-item" data-id="{{ $item->id }}">
                         <input type="hidden" name="{{ $name??'' }}[]" value="{{ $item->$suggest_id??'' }}" >
                         <div class="tags-item__text dd-handle">{{ $item->$suggest_name??'' }}</div>
                         <div class="tags-item__remove remove" data-delete_tags><i class="fa fa-trash"></i></div>
                     </li>
                 @endforeach
             @endif
        </ol>
     </div>
 <script>
    $(document).ready(function() {
        {{-- Xóa tags item --}}
        $('body').on('click', '*[data-delete_tags]', function() {
            $(this).closest('.tags-item').remove();
        });
        {{-- Nếu tìm kiếm tại form --}}
        suggest = null;
        $('body').on('keyup', '#{{ $name??'' }}_input', function(e) {
            keyword = $(this).val();
            clearTimeout(suggest);
            e = $(this);
            if (keyword.length > 0) {
                suggest = setTimeout(function() {
                    {{-- Chuẩn hóa data --}}
                    data = {
                        table: '{{$suggest_table??''}}', 
                        id: '{{$suggest_id??''}}', 
                        name: '{{$suggest_name??''}}', 
                        suggest_locale: '{{$suggest_locale??'0'}}',
                        keyword: keyword
                    };
                    {{-- Không tìm theo sản phẩm đã lấy --}}
                    id_not_where = [];
                    $.each($('input[name="{{ $name??'' }}[]"]') ,function() {
                        id_not_where.push($(this).val());
                    });
                    if(!checkEmpty(id_not_where)) {
                        data.id_not_where = id_not_where;
                    }
                    loadAjaxPost('{{ route('admin.ajax.suggest_search') }}', data, {
                        beforeSend: function(){},
                        success:function(result){
                            if (result.status == 1) {
                                list = '';
                                $.each(result.data, function(index, item) {
                                    list += `<li class="suggest-item" data-suggest_{{$name??''}} data-id="${item.id}">${item.name}</li>`;
                                });
                                e.closest('.suggest').find('.suggest-result').css('display','block').find('ul').html(list);
                            } else {
                                alertText('@lang('Translate::form.no_data_finding')', 'error');
                            }
                        },
                        error: function (error) {}
                    }, 'progress');
                }, 1000);
            }
        });
        {{-- Nếu click vào item sẽ lấy giá trị tại item đó --}}
        $('body').on('click','*[data-suggest_{{$name??''}}]',function(e) {
            e.preventDefault();
            $(this).css('display', 'none');
            id = $(this).data('id');
            text = $(this).text();
            $('#{{ $name??'' }}_box').append(`
                <div class="tags-item dd-item" data-id="${id}" >
                <input type="hidden" name="{{ $name??'' }}[]" value="${id}">
                <div class="tags-item__text dd-handle">${text}</div>
                <div class="tags-item__remove remove" data-delete_tags><i class="fa fa-trash"></i></div>
                </div>
                `);
            $('#{{$name??''}}_box').find('.error').remove();
            $('#{{ $name??'' }}_input').css('border', '1px solid #ced4da');
        });
        {{-- Nếu click ra vùng bất kỳ thì ẩn box suggest --}}
        $(document).bind('click', function(e) {
            var clicked = $(e.target);
            if (!clicked.parent('ul').parent().hasClass('suggest-result'))
                $('.suggest-result').css('display','none').find('ul').empty();
        });
        {{-- Nếu bắt buộc --}}
        @if ($required==1)
        $('body').on('click','button[type=submit]', function(e) {
            $('#{{ $name??'' }}_input').css('border', '1px solid #ced4da');
            $('#{{$name??''}}_box').find('.error').remove();
            if($('input[name="{{$name??''}}[]"]').length == 0) {
                e.preventDefault();
                $('#{{$name??''}}_box').append(formHelper('@lang($label??$placeholder??$name??'') @lang('Translate::form.valid.no_empty')'));
                $('#{{ $name??'' }}_input').css('border', '1px solid #ff0000');
            }
        });
        @endif
    });
    // js kéo thả
    $(document).ready(function()
    {
        $('#{{ $name??'' }}_box').sortable();
    });
</script>
</div>
