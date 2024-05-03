@php
    $serviceFooter = $config_general['services'] ?? [];
    $serviceFooterImage = $serviceFooter['image'] ?? [];
    $serviceFooterName = $serviceFooter['name'] ?? [];
    $serviceFooterDesc = $serviceFooter['desc'] ?? [];
    $storeMb = $allStores->where('area', 1);
    $storeMt = $allStores->where('area', 2);
    $storeMn = $allStores->where('area', 3);
@endphp
<div class="nationwide-showroom__system pt-70 pb-89">
	<div class="container">
        @if(count($serviceFooterImage))
    		<div class="service flex">
                @foreach($serviceFooterImage as $kService => $imageService)
        			<div class="item">
        				@include('Default::general.components.image', [
                            'src' => $imageService,
                            'width' => '50px',
                            'height' => '50px',
                            'lazy'   => true,
                            'title'  => ''
                        ])
        				<p class="item-title fs-20 mt-28 lh-24 f-w-b color-white">{{  $serviceFooterName[$kService] ?? '' }}</p>
        				<p class="item-desc fs-16 lh-19 mt-8 color-white">{{  $serviceFooterDesc[$kService] ?? '' }}</p>
        			</div>
                @endforeach
    		</div>
        @endif
		<h2 class="fs-40 lh-48 f-w-b color-white mt-38 text-center w-100">Hệ thống Showroom toàn quốc</h2>
		<div class="system mt-27 flex">
            @if(count($storeMb))
    			<div class="system-item">
    				<div class="system-item__title text-up fs-32 lh-38 f-w-b text-center color-white">Miền Bắc</div>
    				<div class="system-item__content mt-23">
    					<div class="address">
                            @foreach($storeMb as $stmb)
        						<div class="address_item">
        							<p class="address_item__title fs-20 lh-24 f-w-b">{{ $stmb->getName() }}</p>
        							<p class="address_item__desc fs-16 lh-22 mt-7">{{ $stmb->getAddress() }}</p>
        							<p class="address_item__phone fs-16 lh-19 mt-7"><span class="f-w-b">Điện thoại:</span> {{ $stmb->phone }}</p>
        							<a class="see_details fs-16 lh-19 mt-8" style="display: block;" href="{{ $stmb->getUrl() }}">Xem chi tiết</a>
        						</div>
                            @endforeach
    					</div>
    				</div>
    			</div>
            @endif
            @if(count($storeMt))
			<div class="system-item">
				<div class="system-item__title text-up fs-32 lh-38 f-w-b text-center color-white">Miền Trung</div>
				<div class="system-item__content mt-23">
					<div class="address">
						@foreach($storeMt as $stmt)
                            <div class="address_item">
                                <p class="address_item__title fs-20 lh-24 f-w-b">{{ $stmt->getName() }}</p>
                                <p class="address_item__desc fs-16 lh-22 mt-7">{{ $stmt->getAddress() }}</p>
                                <p class="address_item__phone fs-16 lh-19 mt-7"><span class="f-w-b">Điện thoại:</span> {{ $stmt->phone }}</p>
                                <a class="see_details fs-16 lh-19 mt-8" style="display: block;" href="{{ $stmt->getUrl() }}">Xem chi tiết</a>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
            @endif
            @if(count($storeMn))
			<div class="system-item">
				<div class="system-item__title text-up fs-32 lh-38 f-w-b text-center color-white">Miền Nam</div>
				<div class="system-item__content mt-23">
					<div class="address">
						@foreach($storeMn as $stmn)
                            <div class="address_item">
                                <p class="address_item__title fs-20 lh-24 f-w-b">{{ $stmn->getName() }}</p>
                                <p class="address_item__desc fs-16 lh-22 mt-7">{{ $stmn->getAddress() }}</p>
                                <p class="address_item__phone fs-16 lh-19 mt-7"><span class="f-w-b">Điện thoại:</span> {{ $stmn->phone }}</p>
                                <a class="see_details fs-16 lh-19 mt-8" style="display: block;" href="{{ $stmn->getUrl() }}">Xem chi tiết</a>
                            </div>
                        @endforeach
					</div>
				</div>
			</div>
            @endif
		</div>
	</div>
</div>
