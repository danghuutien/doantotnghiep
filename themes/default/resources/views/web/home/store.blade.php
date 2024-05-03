@php
    $storeMb = $allStores->where('area', 1);
    $storeMt = $allStores->where('area', 2);
    $storeMn = $allStores->where('area', 3);
@endphp
<div class="showroom-system mt-62">
    <div class="container">
        <div class="showroom-system__title w-100">
            <h2 class="f-w-b">Hệ thống Showroom toàn quốc</h2>
        </div>
        <div class="showroom-system__content w-100 mt-28">
            <div class="top flex">
                <div class="top-left">
                    <h4 class="btn-top active" data-id="#store_mb">Miền Bắc</h4>
                    <h4 class="btn-top" data-id="#store_mt">Miền Trung</h4>
                    <h4 class="btn-top" data-id="#store_mn">Miền Nam</h4>
                </div>
                <div class="top-right">
                    <input type="text" id="suggest_shop" class="form-control mr-11" name="keyword" autocomplete="off" placeholder="Tìm cửa hàng"/>
                    <button class="btn btn-search color-white flex-center find-store" type="submit" aria-label="Cửa hàng gần bạn" name="btn-search">
                        @if(checkAgent() == 'web')
                            Cửa hàng gần bạn
                        @else
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6575 11.723L16.8063 15.8717C17.0645 16.1298 17.0645 16.5483 16.8064 16.8064C16.6773 16.9355 16.5081 17 16.339 17C16.1699 17 16.0007 16.9355 15.8717 16.8064L11.7228 12.6576C10.4826 13.6888 8.89011 14.31 7.15507 14.31C3.20974 14.31 0 11.1004 0 7.15527C0 3.20984 3.20974 0 7.15507 0C11.1003 0 14.3101 3.20984 14.3101 7.15527C14.3101 8.8904 13.6888 10.4829 12.6575 11.723ZM7.15508 1.3219C3.93864 1.3219 1.3219 3.93874 1.3219 7.15527C1.3219 10.3715 3.93864 12.9881 7.15508 12.9881C10.3714 12.9881 12.9881 10.3715 12.9881 7.15527C12.9881 3.93874 10.3714 1.3219 7.15508 1.3219Z" fill="white"></path>
                            </svg>
                        @endif
                    </button>
                </div>
            </div>
            <div class="bottom flex">
                <div class="contents">
                    @if(count($storeMb))
                        <div class="bottom-list list-store active" id="store_mb">
                            @foreach($storeMb as $stmb)
                                <div class="bottom-list__item store-item" data-map="{{ $stmb->iframe ?? '' }}">
                                    <h5 class="title fs-20 lh-24 f-w-b">{{ $stmb->getName() }}</h5>
                                    <p class="desc fs-16 lh-19">{{ $stmb->getAddress() }}</p>
                                    <p class="phone fs-16 lh-19"><span class="f-w-b">Điện thoại:</span> {{ $stmb->phone }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if(count($storeMt))
                        <div class="bottom-list list-store" id="store_mt">
                            @foreach($storeMt as $stmt)
                                <div class="bottom-list__item store-item" data-map="{{ $stmt->iframe ?? '' }}">
                                    <h5 class="title fs-20 lh-24 f-w-b">{{ $stmt->getName() }}</h5>
                                    <p class="desc fs-16 lh-19">{{ $stmt->getAddress() }}</p>
                                    <p class="phone fs-16 lh-19"><span class="f-w-b">Điện thoại:</span> {{ $stmt->phone }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if(count($storeMn))
                        <div class="bottom-list list-store" id="store_mn">
                            @foreach($storeMn as $stmn)
                                <div class="bottom-list__item store-item" data-map="{{ $stmn->iframe ?? '' }}">
                                    <h5 class="title fs-20 lh-24 f-w-b">{{ $stmn->getName() }}</h5>
                                    <p class="desc fs-16 lh-19">{{ $stmn->getAddress() }}</p>
                                    <p class="phone fs-16 lh-19"><span class="f-w-b">Điện thoại:</span> {{ $stmn->phone }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="map">
                    {!! $setting_home['map_showroom'] ?? '<iframe title="map" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d7821456.064698897!2d104.09132812500002!3d16.822866027593047!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2sus!4v1670379997216!5m2!1svi!2sus" width="671" height="767" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>' !!}
                </div>
            </div>
        </div>
    </div>
</div>
