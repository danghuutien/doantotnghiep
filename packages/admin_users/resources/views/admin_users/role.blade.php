{{-- 
	@include('Core::admin_users.role', [
        'user_id' => \Auth::guard('admin')->user()->id,
    ]);
--}}
@php
    $permision_all = [];
    $modules = config('SudoModule.modules');
    foreach($modules as $key => $module){
        foreach($module['permision'] as $value){
            $permision_all[$value['type']] = $value['name'];
        }
    }
    if(isset($data_edit)){
        $capabilities = json_decode($data_edit->capabilities, 1);
    }
@endphp
@if (!isset($admin_id) || $admin_id != 1)
<div class="mb3 row">
    <label for="{!! $name??'' !!}" class="col-lg-12 col-md-12">@lang('Translate::admin.role.name')</label>
    <p class="col-lg-12 col-md-12" style="color: #a2a2a2;font-size: 12px;">Vui lòng chọn các quyền (tính năng) sẽ được áp dụng cho tài khoản này</p>
    <div class="role">
        <div class="col-lg-12 col-md-12 role-content">
            <div class="role-head">
                <div class="role-head__title">Tính năng</div>
                <div class="role-head__title">Chọn tất cả <input type="checkbox" class="form-check-input" data-select_all>
                </div>
                @foreach($permision_all as $key => $value)
                    <div class="role-head__title">{!! $value !!}</div>
                @endforeach
            </div>
            <div class="role-body">
                @foreach($modules as $key => $module)
                    @php
                        $array_type = [];
                        foreach($module['permision'] as $value){
                            $array_type[$value['type']] = $value['type'];
                        }
                    @endphp
                    <div class="role-item">
                        <div class="role-item__title">{!! $module['name'] !!}</div>
                        <div class="role-item__permission"><input type="checkbox"  class="form-check-input" name="role[]" data-select_role></div>
                        @foreach($permision_all as $k => $val)
                            <div class="role-item__permission"><input type="checkbox" name="role[]" @if(!in_array($k, $array_type)) disabled style="cursor: no-drop;background: #2a3042;" @endif value="{!! $key.'_'.$k !!}" class="form-check-input" @if(isset($capabilities) && in_array($key.'_'.$k, $capabilities)) checked @endif></div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
    	$(document).ready(function() {
    		select_all = false;
    		$('body').on('click', '*[data-select_all]', function(e) {
    			if (select_all == false) {
    				select_all = true;
    				$('input[name="role[]"]').prop('checked', true);
    			} else {
    				select_all = false;
    				$('input[name="role[]"]').prop('checked', false);
    			}
    		});

    		select_role = false;
    		$('body').on('click', '*[data-select_role]', function(e) {
    			if (select_role == false) {
    				select_role = true;
    				$(this).closest('.role-item').find('input[name="role[]"]').prop('checked', true);
    			} else {
    				select_role = false;
    				$(this).closest('.role-item').find('input[name="role[]"]').prop('checked', false);
    			}
    		});
    	});
    </script>
</div>
@endif