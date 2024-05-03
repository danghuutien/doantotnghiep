@if(isset($data_payon) && !empty($data_payon))
    @php
    $price_arr = [];
    $fee_arr = [];
    foreach($cycle as $key => $value){
      if(isset($data_payon[$value]['error_code']) && $data_payon[$value]['error_code'] == '00'){
        $price_arr[$value] = $price + $data_payon[$value]['data']['fee'];
        $fee_arr[$value] = $data_payon[$value]['data']['fee'];
      }else{
        $price_arr[$value] = $price;
      }
    }
    @endphp
    <div class="infocard">
          <div class="barcard">{{ __('Trả góp qua thẻ') }} <b id="bcard">{!! $card_type??'' !!}</b>, {{ __('ngân hàng') }} <b id="bbank">{!! $bank_code??'' !!}</b></div>
          <div class="paymentMethod">
            	<div>
              		<aside><b>{{ __('Số tháng trả góp') }}</b></aside>
                  @foreach($cycle as $key => $value)
              		<aside>{!! $value??'' !!} tháng</aside>
                  @endforeach
          		</div>
            	<div>
                <aside><b>{{ __('Góp mỗi tháng') }}</b></aside>
                @foreach($cycle as $key => $value)
                <aside>{!! formatPrice($price_arr[$value] / $value) !!}</aside>
                @endforeach
        		  </div>
            	<div id="installtotal">
            		<aside><b>{{ __('Tổng tiền trả góp') }}</b></aside>
                  @foreach($cycle as $key => $value)
            		<aside>{!! formatPrice($price_arr[$value]) !!}</aside>
                  @endforeach
            	</div>
              @if(!empty($fee_arr))
              <div id="installtotal">
                <aside><b>{{ __('Chênh lệnh') }}</b></aside>
                @foreach($cycle as $key => $value)
                  @if($fee_arr[$value] == 0)
                    <aside>0 VNĐ</aside>
                  @else
                    <aside>{!! formatPrice($fee_arr[$value]) !!}</aside>
                  @endif
                @endforeach
              </div>
              @endif
            	<div>
            		<aside><b>{{ __('Chọn mua') }}</b></aside>
                  @foreach($cycle as $key => $value)
                      <aside style="text-align: center;"><input style="width: 18px;height: 18px;cursor: pointer;" type="radio" name="choose_cycle" value="{!! $value??'' !!}"></aside>
                  @endforeach
            	</div>
          </div>
    </div>
    <div class="note">
        @if($bank_code == 'TCB')
       {{ __(' Lưu ý: Đối với Techcombank: Theo quy định của Techcombank, ngân hàng sẽ thu chủ thẻ phí chuyển đổi giao dịch trả góp là 1.1%*Giá trị giao dịch (đã bao gồm VAT, tối đa 150.000VNĐ/1 giao dịch).') }}
        @elseif($bank_code == 'FEC')
        {{ __('Lưu ý: Đối với FE Credit: Theo quy định của Ngân hàng Fe Credit thu phí quản lý giao dịch giao dịch trả góp 0.99% tương ứng với các kỳ hạn 3-6-9-12 tháng.') }}
        @elseif($bank_code == 'MSB')
        {{ __('Lưu ý: Đối với Maritimebank: thu thêm của chủ thẻ phí Quản lý giao dịch trả góp trên số tiền thanh toán, phí sẽ chia đểu ra các kỳ hạn như sau:') }}
        <p>* {{ __('Kỳ hạn 3 tháng và 6 tháng: Ngân hàng thu 1,5% phí / Số tiền thanh toán') }}</p>
        <p>* {{ __('Kỳ hạn 9 tháng và 12 tháng Ngân hàng thu 3% phí / Số tiền thanh toán') }}</p>
        @endif
    </div>
@elseif(isset($data_onepay) && !empty($data_onepay))
    <div class="infocard">
          <div class="barcard">{{ __('Trả góp qua thẻ') }} <b id="bcard">{!! $card_type??'' !!}</b>, {{ __('ngân hàng') }} <b id="bbank">{!! $code_bank[$bank_code] !!}</b></div>
          <div class="paymentMethod">
                <div>
                    <aside><b>{{ __('Số tháng trả góp') }}</b></aside>
                  @foreach($data_onepay as $key => $value)
                    <aside>{!! $value['time']??'' !!} {{ __('tháng') }}</aside>
                  @endforeach
                </div>
                <div>
                <aside><b>{{ __('Góp mỗi tháng') }}</b></aside>
                @foreach($data_onepay as $key => $value)
                <aside>
                    @if($value['fee'] == 0)
                        @php
                            $monthly = (($price??0)/((int)$value['time']??1));                            
                        @endphp
                        {!! formatPrice($monthly,'0VNĐ') !!}
                     @else
                        {!! formatPrice($value['monthly']) !!}
                    @endif
                </aside>
                @endforeach
                  </div>
                <div id="installtotal">
                    <aside><b>{{ __('Tổng tiền trả góp') }}</b></aside>
                  @foreach($data_onepay as $key => $value)
                    <aside>
                        @if($value['fee'] == 0)
                            {!! formatPrice($price ?? 0,'0VNĐ') !!}
                        @else
                            {!! formatPrice($value['monthly']*$value['time']) !!}
                        @endif 
                    </aside>
                  @endforeach
                </div>
                <div id="installtotal">
                    <aside><b>{{ __('Chênh lệnh') }}</b></aside>
                    @foreach($data_onepay as $key => $value)
                        <aside>
                            @if($value['fee'] == 0)
                                {!! '0VNĐ' !!}
                            @else
                                {!! formatPrice($value['fee'] ?? 0,'0VNĐ') !!}
                            @endif
                        </aside>
                    @endforeach
                </div>
                <div>
                    <aside><b>{{ __('Chọn mua') }}</b></aside>
                  @foreach($data_onepay as $key => $value)
                        <aside style="text-align: center;">
                            <input style="width: 18px;height: 18px;cursor: pointer;" type="radio" name="choose_cycle" value="{!! $value['time']??'' !!}">
                        </aside>
                  @endforeach
                </div>
          </div>
    </div>
@endif
