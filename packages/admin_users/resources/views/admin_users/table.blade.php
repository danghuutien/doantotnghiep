@include('Table::components.image',['image' => $value->getAvatar()])
@include('Table::components.text',['text' => $value->name])
@include('Table::components.text',['text' => $value->email])
<td style="width: 440px;">
	{{-- Check có SudoModule không --}}
	@if (!empty(config('SudoModule.modules')))
		<div class="auth-box">
			{{-- Lặp sudo module để lấy từng module --}}
			@foreach (config('SudoModule.modules') as $key => $modules)
				{{-- Check xem có phân quyền không => có thì hiển thị --}}
				@if (isset($modules['permision']) && !empty($modules['permision']))
					<div class="auth">
						<p class="auth-title">@lang($modules['name']??$module_name[$key]??'')</p>
						<div class="auth-list">
							{{-- Lấy từng quyền --}}
							@foreach ($modules['permision'] as $permision)
								<div class="item
									@if (in_array($key.'_'.$permision['type'], $value->getRole()) || $value->id == 1) active @endif
								">@lang($permision['name']??$module_name[$permision['type']]??'')</div>
							@endforeach
						</div>
					</div>
				@endif
			@endforeach
		</div>
	@endif
</td>