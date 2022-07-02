@extends('client.layout.master')

@section('title', 'Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Beranda<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">

            <form method="post" class="form" action="{{ route('cart.order') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">

                    <div class="col-lg-8 col-12">
                        <div class="checkout-form">
                            <h2>Silahkan Checkout Di Bawah</h2>
                            <p>Isi Data Diri DI bawah Untuk Checkout</p>
                            <!-- Form -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Nama Depan<span>*</span></label>
                                        <input style="border : 1px solid black;" type="text" name="first_name"
                                            placeholder="Isi Nama Depan" value="{{ old('first_name') }}"
                                            value="{{ old('first_name') }}">
                                        @error('first_name')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Nama Belakang<span>*</span></label>
                                        <input style="border : 1px solid black;" type="text" name="last_name"
                                            placeholder="Isi Nama Depan" value="{{ old('lat_name') }}">
                                        @error('last_name')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Alamat Email<span>*</span></label>
                                        <input style="border : 1px solid black;" type="email" name="email"
                                            placeholder="Isi Email Anda" value="{{ old('email') }}">
                                        @error('email')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Nomor Telepon <span>*</span></label>
                                        <input style="border : 1px solid black;" type="number" name="phone"
                                            placeholder="ISi Nomor Telepon Anda" required value="{{ old('phone') }}">
                                        @error('phone')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Alamat Rumah<span>*</span></label>
                                        <input style="border : 1px solid black;" type="text" name="address"
                                            placeholder="Isi Alamat Anda" value="{{ old('address') }}">
                                        @error('address')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Kode Pos</label>
                                        <input style="border : 1px solid black;" type="text" name="post_code"
                                            placeholder="Isi Kode Pos" value="{{ old('post_code') }}">
                                        @error('post_code')
                                            <span class='text-danger'>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <!--/ End Form -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="order-details">
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>TOTAL </h2>
                                <div class="content">
                                    <ul>
                                        <li class="order_subtotal" data-price="{{ Helper::totalCartPrice() }}">
                                            Harga<span>Rp. <span
                                                    id="order_subtotal">{{ number_format(Helper::totalCartPrice(), 2) }}</span></span>
                                        </li>
                                        <li> Total Barang<span id="total_item">{{ Helper::cartCount() }}</span></li>

                                        <li class="shipping">

                                            @if ($kota->json())
                                                <select id="shipping" name="shipping" class="nice-select">
                                                    <option style="margin-right : 10px;" value="">Silahkan Pilih Kota
                                                        anda</option>
                                                    @foreach ($kota->json()['rajaongkir']['results'] as $shipping)
                                                        <option value="{{ $shipping['city_id'] }}">
                                                            {{ $shipping['city_name'] }}</option>
                                                        {{-- <option value="{{$shipping->id}}" class="shippingOption" data-price="{{$shipping->price}}">{{$shipping->type}}: Rp. {{$shipping->price}}</option> --}}
                                                    @endforeach
                                                </select>
                                            @else
                                                <span></span>
                                            @endif

                                        </li>
                                        <li>Ongkir Rp. <span name="ongkir" id="ongkir">0</span></li>
                                        <input type="hidden" name="ongkir" id="ongkir_value" value="0">
                                        <input type="hidden" name="city" id="city" value="">
                                        <li>Total<span>Rp. <span name="total" id="total"></span></span></li>
                                        <li>

                                            <p style="padding : 0px; margin : 0px;">* Pengiriman Menggunakan JNE</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Order Widget -->
                            <div class="single-widget">
                                <h2>Pembayaran</h2>
                                <div class="single-widget payement">
                                    <div class="content">

                                        <img width={{ 50 }} src="{{ asset('/img/bni.png') }}"></img>
                                        <p> NO REKENING : 0776622323(BNI)</P>
                                        <img style="margin-top : 20px;" width={{ 50 }}
                                            src="{{ asset('/img/dana.png') }}"></img>
                                        <p> NO DANA : 0822-5456-6670(Abdullah Mubarak)</P>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="checkbox">
                                        {{-- <label class="checkbox-inline" for="1"><input name="updates" id="1" type="checkbox"> Check Payments</label> --}}
                                        <form-group>
                                            <input id="thumbnail" class="form-control" type="file"
                                                name="transfer_evidence" value="{{ old('transfer_evidence') }}">
                                            <p>*) Upload Bukti Pembayaran</p>
                                        </form-group>
                                        @error('transfer_evidence')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <!--/ End Order Widget -->
                            <!-- Payment Method Widget -->

                            <!--/ End Payment Method Widget -->
                            <!-- Button Widget -->
                            <div class="single-widget get-button">
                                <div class="content">
                                    <div class="button">
                                        <button type="submit" id="pay-button" class="btn">Checkout</button>
                                    </div>
                                </div>
                            </div>
                            <!--/ End Button Widget -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!--/ End Checkout -->

    <!-- Start Shop Newsletter  -->


    <!-- End Shop Newsletter -->
@endsection
@push('styles')
    <style>
        li.shipping {
            display: inline-flex;
            width: 100%;
            font-size: 14px;
        }

        li.shipping .input-group-icon {
            width: 100%;
            margin-left: 10px;
        }

        .input-group-icon .icon {
            position: absolute;
            left: 20px;
            top: 0;
            line-height: 40px;
            z-index: 3;
        }

        .form-select {
            height: 30px;
            width: 100%;
        }

        .form-select .nice-select {
            border: none;
            border-radius: 0px;
            height: 40px;
            background: #f6f6f6 !important;
            padding-left: 45px;
            padding-right: 40px;
            width: 100%;
        }

        .list li {
            margin-bottom: 0 !important;
        }

        .list li:hover {
            background: #F7941D !important;
            color: white !important;
        }

        .form-select .nice-select::after {
            top: 14px;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('frontend/js/nice-select/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("select.select2").select2();
        });
        $('select.nice-select').niceSelect();
    </script>
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        $(document).ready(function() {
            $('#shipping').change(function() {
                /* Get from elements values */

                let values = $(this).val();
                let weight = $('#total_item').text();
                let order_subtotal = $('#order_subtotal').text();
                $('#city').val($(this).find(':selected').text());



                $('#ongkir').text("Loading...");
                $.ajax({
                    url: "{{ route('check_ongkir') }}",
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        weight: weight * 400,
                        destination: values,

                    },
                    success: function(response) {
                        // console.log(response);
                        console.log(response)
                        $('#ongkir').text(numberWithCommas(response['rajaongkir'].results[0][
                            'costs'
                        ][0]['cost'][0]['value']));
                        $('#ongkir_value').val(response['rajaongkir'].results[0]['costs'][0][
                            'cost'
                        ][0]['value']);
                        $('#total').text(numberWithCommas(parseFloat(order_subtotal.replace(
                            /[^\d\.\-]/g, "")) + parseFloat(response['rajaongkir']
                            .results[0]['costs'][0]['cost'][0]['value'])));
                        // You will get response from your PHP page (what you echo or print)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            })
        });
    </script>

    <script>
        function showMe(box) {
            var checkbox = document.getElementById('shipping').style.display;
            // alert(checkbox);
            var vis = 'none';
            if (checkbox == "none") {
                vis = 'block';
            }
            if (checkbox == "block") {
                vis = "none";
            }
            document.getElementById(box).style.display = vis;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.shipping select[name=shipping]').change(function() {
                let cost = parseFloat($(this).find('option:selected').data('price')) || 0;
                let subtotal = parseFloat($('.order_subtotal').data('price'));
                let coupon = parseFloat($('.coupon_price').data('price')) || 0;
                // alert(coupon);
                $('#order_total_price span').text('$' + (subtotal + cost - coupon).toFixed(2));
            });

        });
    </script>
@endpush
