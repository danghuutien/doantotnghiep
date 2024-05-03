@extends('Default::web.layouts.app')
@section('content')
    @include('Default::web.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
    <div class="sale">
        <div class="container">
            <div class="sale_content w-100">
                <h1 class="sale_content_title w-100">Giỏ hàng</h1>
                @if(count($carts))
                    <div class="sale_content_table">
                        @include('Default::web.sale.table')
                    </div>
                    @if(isset($errors) && !empty($errors->first()))
                        <div class="alert_none">
                            <p class="flex">{{$errors->first()??''}}</p>
                        </div>
                    @endif
                    <form action="{{ route('app.sale.payment') }}" method="POST" id="form_checkout" class="sale_content_payment w-100">
                        @csrf
                        <div class="content">
                            <p class="content_title text-up">Thông tin Khách hàng</p>
                            <div class="radio flex-center-left">
                                <label for="male" class="radio-field flex-center-left">
                                    <input type="radio" checked class="radio-field__input" name="gender" value="1" id="male">
                                    <span>Anh</span>
                                </label>
                                <label for="feemale" class="radio-field flex-center-left">
                                    <input type="radio" class="radio-field__input" name="gender" value="2" id="feemale">
                                    <span>Chị</span>
                                </label>
                            </div>
                            <div class="input flex-center-between">
                                <div class="input-field">
                                    <input type="text" class="form-control" placeholder="* Họ tên" name="name" required="" />
                                    <p class="validate-message validate-name err_show null">Vui lòng điền họ tên!</p>
                                </div>
                                <div class="input-field">
                                    <input type="text" class="form-control" placeholder="* Số điện thoại" name="phone" required="" />
                                    <p class="validate-message validate-phone err_show null">Vui lòng điền số điện thoại!</p>
                                    <p class="validate-message check-phone err_show phone">Số điện thoại không đúng định dạng!</p>
                                </div>
                            </div>
                            <p class="content_title text-up">CHỌN CÁCH THỨC NHẬN HÀNG</p>
                            <div class="radio flex-center-left">
                                <label for="ship" class="radio-field flex-center-left">
                                    <input type="radio" checked class="radio-field__input" name="shipping_method" value="1" id="ship">
                                    <span>Giao hàng tận nơi</span>
                                </label>
                                <label for="store" class="radio-field flex-center-left">
                                    <input type="radio" class="radio-field__input" name="shipping_method" value="2" id="store">
                                    <span>Nhận hàng tại Showroom</span>
                                </label>
                            </div>
                            <div class="input flex-center-between">
                                <div class="input-field">
                                    <div class="select-box">
                                        <select name="province_id" id="province_id" class="form-control" onchange="loadDestination('#province_id', '{{ route('app.ajax.loadDestination') }}', '#district_id', 'Tỉnh thành là bắt buộc', 'province');">
                                            <option value="" selected>* Chọn tỉnh/ thành phố</option>
                                            @foreach ($provinces as $pr)
                                                <option value="{{ $pr->id }}">{{ $pr->name }}</option>
                                            @endforeach
                                        </select>
                                        <p class="validate-message validate-province err_show null">Vui lòng chọn tỉnh/ thành phố nhận hàng!</p>
                                    </div>
                                </div>
                                <div class="input-field">
                                    <div class="select-box">
                                        <select name="district_id" id="district_id" class="form-control" onchange="loadDestination('#district_id', '{{ route('app.ajax.loadDestination') }}', '#list_ward', 'Quận huyện là bắt buộc', 'district');">
                                            <option value="" selected>* Chọn Quận/ huyện</option>
                                        </select>
                                        <p class="validate-message validate-district err_show null">Vui lòng chọn quận/ huyện nhận hàng!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="input flex-center-between">
                                <div class="input-field">
                                    <div class="select-box">
                                        <select name="ward_id" id="list_ward" class="form-control">
                                            <option value="" selected>* Chọn phường/ xã</option>
                                        </select>
                                        <p class="validate-message validate-district err_show null">Vui lòng chọn phường/ xã nhận hàng!</p>
                                    </div>
                                </div>
                                <div class="input-field">
                                    <input type="text" class="form-control" placeholder="Địa chỉ" name="address" required=""/>
                                    <p class="validate-message validate-address err_show null">Vui lòng điền địa chỉ nhận hàng!</p>
                                </div>
                            </div>
                            <div class="text-field addition">
                                <textarea name="note" cols="30" rows="5"placeholder="Yêu cầu khác (không bắt buộc)"></textarea>
                            </div>
                        </div>
                        @if($installment === 'installment')
                            <div class="action flex-center">
                                <input type="hidden" name="payment_method" id="payment_method" value="3">
                                <button class="action_button button_order blue" type="submit" value="3" name="payment_method">
                                    <p class="action_button_name text-up">THANH TOÁN TRẢ GÓP</p>
                                    <p class="action_button_txt">Công ty Tài chính Hoặc qua thẻ tín dụng</p>
                                </button>
                            </div>
                        @else
                            <div class="action flex-center step-one">
                                <input type="hidden" name="payment_method" id="payment_method">
                                <button class="action_button button_order" type="submit" value="1" name="payment_method">
                                    <p class="action_button_name text-up">THANH TOÁN KHI NHẬN HÀNG</p>
                                    <p class="action_button_txt">Kiểm tra hàng trước khi trả tiền</p>
                                </button>
                                <button class="action_button choose-type-payment" type="text" value="-1" name="payment_method">
                                    <p class="action_button_name text-up">THANH TOÁN ONLINE</p>
                                    <p class="action_button_txt">Bằng thẻ ATM nội địa, Visa, master, JCB, QR</p>
                                </button>

                                @if($checkInstallment)
                                    <button class="action_button button_order blue" type="submit" value="3" name="payment_method">
                                        <p class="action_button_name text-up">THANH TOÁN TRẢ GÓP</p>
                                        <p class="action_button_txt">Công ty Tài chính Hoặc qua thẻ tín dụng</p>
                                    </button>
                                @endif
                            </div>
                            <div class="action flex-center step-two" style="display: none">
                                <button class="action_button button_order" type="submit" value="2" name="payment_method">
                                    <p class="action_button_name text-up">THANH TOÁN ONLINE</p>
                                    <p class="action_button_txt">Bằng thẻ ATM nội địa</p>
                                </button>
                                <button class="action_button button_order" type="submit" value="4" name="payment_method">
                                    <p class="action_button_name text-up">THANH TOÁN ONLINE</p>
                                    <p class="action_button_txt">Bằng thẻ Visa, master, JCB</p>
                                </button>
                                <button class="action_button button_order" type="submit" value="5" name="payment_method">
                                    <p class="action_button_name text-up">THANH TOÁN ONLINE</p>
                                    <p class="action_button_txt">Bằng mã QR</p>
                                </button>
                            </div>
                        @endif
                        <div class="more">
                            <p class="text-center"><a href="{{ route('app.home') }}">Mua thêm sản phẩm khác</a></p>
                        </div>
                    </form>
                @else
                    <div class="alert_none">
                        <p>Giỏ hàng của bạn đang trống!</p>
                        <a href="{{ route('app.home') }}" >Tiếp tục mua hàng</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
