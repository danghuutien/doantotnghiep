@if(isset($config_general['banner_ads_sb']) && $config_general['banner_ads_sb'] != '')
	<div class="sitebar_ads mt-25">
		<a href="{{ $config_general['banner_ads_link'] ?? '' }}">
			<img src="{{ resizeWImage($config_general['banner_ads_sb'], 'w380') }}" alt="{{ getAlt($config_general['banner_ads_sb']) ?? '' }}" width="380" height="660" loading="lazy">
		</a>
	</div>
@endif