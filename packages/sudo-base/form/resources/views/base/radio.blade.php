{{-- 
    @include('Form::base.radio', [
        'name'              => $item['name'],
        'value'             => $item['value'],
        'label'             => $item['label'],
        'options'           => $item['options'],
    ])
--}}
{{-- <div class="form-group row">
    @if ($has_full == true)
        <label for="{{ $name??'' }}" class="col-lg-12 col-form-label">@lang($label??'')</label>
        <div class="col-lg-12">
    @else
        <label for="{{ $name??'' }}" class="col-lg-3 col-md-12 col-form-label text-right">@lang($label??'')</label>
        <div class="col-lg-8 col-md-12">
    @endif
        <div class="form-radio">
            @php $value = old($name)??$value; @endphp
            @foreach ($options as $key => $option)
                <div class="form-radio__group">
                    <input type="radio" class="btn-radio" name="{{ $name??'' }}" id="{{ $name??'' }}_{{ $key ?? 0 }}" value="{{ $key ?? 0 }}" 
                        @if ($key == $value) checked @endif
                    >
                    <label for="{{ $name??'' }}_{{ $key ?? 0 }}">{{ __($option ?? '') }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}


<div class="mb-3 row">
    <label for="{{ $name??'' }}" class="@if($class_col == 'col-lg-12') col-md-2 @else col-md-4 @endif col-form-label">@lang($label??'')</label>
    <div class="@if($class_col == 'col-lg-12') col-md-10 @else col-md-8 @endif" style="padding-left: 0;">
        <div class="form-radio" style="margin-left: 18px;">
            @php $value = old($name)??$value; @endphp
            @foreach ($options as $key => $option)
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="{{ $name??'' }}" id="{{ $name??'' }}_{{ $key ?? 0 }}" value="{{ $key ?? 0 }}" 
                        @if ($key == $value) checked @endif style="font-size: 18px;">
                    <label style="padding-top: 4px;" class="form-check-label" for="{{ $name??'' }}_{{ $key ?? 0 }}">{{ __($option ?? '') }}</label>
                </div>
            @endforeach
        </div>
    </div> 
</div>