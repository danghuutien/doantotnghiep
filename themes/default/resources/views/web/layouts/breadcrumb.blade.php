@if(isset($breadcrumb) && count($breadcrumb) > 0)
	<div class="breadcrumb w-100 pt-20 pb-20">
		<div class="container">	
			<ul itemscope itemtype="https://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
					<a itemprop="item" href="/">
						<span itemprop="name">Trang chủ</span>
					</a>
				</li>
				@foreach($breadcrumb as $key => $value)
					<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
						<a itemprop="item" href="{{ $value['link'] ?? 'javascript:;'}}">
							<span itemprop="name">{!! $value['name'] ?? ''!!}</span>
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>				
@endif