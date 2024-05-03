@if(isset($config_general['faq']['question']) && count($config_general['faq']['question']) > 0)
	<div class="faq">
		<div class="faq_title">
			<span class="fw-600">{!! $faq_title ?? '' !!}</span>
		</div>
		<div class="faq_list">
			@foreach($config_general['faq']['question'] as $k => $question)
			<div class="faq_item">
				<div class="faq_item__qs flex">
					<img src="/assets/images/icon/faq.png" alt="icon faq" width="30px" height="30px">
					<span class="fw-600">{!! $question ?? '' !!}</span>
				</div>
				<div class="faq_item__reply mt-15">
					<span class="lh-26">{!! str_replace(["\r\n", "\n"], '<br>', $config_general['faq']['answer'][$key] ?? '') !!}</span>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endif
