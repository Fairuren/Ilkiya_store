<!DOCTYPE html>
<html>

<head>
    <title>Order @if ($order)
            - {{ $order->cart_id }}
        @endif
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    @if ($order)
        <style type="text/css">
            .invoice-header {
                background: #f7f7f7;
                padding: 10px 20px 10px 20px;
                border-bottom: 1px solid gray;
            }

            .site-logo {
                margin-top: 20px;
            }

            .invoice-right-top h3 {
                padding-right: 20px;
                margin-top: 20px;
                color: green;
                font-size: 30px !important;
                font-family: serif;
            }

            .invoice-left-top {
                border-left: 4px solid green;
                padding-left: 20px;
                padding-top: 20px;
            }

            .invoice-left-top p {
                margin: 0;
                line-height: 20px;
                font-size: 16px;
                margin-bottom: 3px;
            }

            thead {
                background: green;
                color: #FFF;
            }

            .authority h5 {
                margin-top: -10px;
                color: green;
            }

            .thanks h4 {
                color: green;
                font-size: 25px;
                font-weight: normal;
                font-family: serif;
                margin-top: 20px;
            }

            .site-address p {
                line-height: 6px;
                font-weight: 300;
            }

            .table tfoot .empty {
                border: none;
            }

            .table-bordered {
                border: none;
            }

            .table-header {
                padding: .75rem 1.25rem;
                margin-bottom: 0;
                background-color: rgba(0, 0, 0, .03);
                border-bottom: 1px solid rgba(0, 0, 0, .125);
            }

            .table td,
            .table th {
                padding: .30rem;
            }
        </style>
        <div class="invoice-header">
            <div class="float-left site-logo">
                {{-- <img src="{{asset('public/images/logo.png')}}" alt=""> --}}
                <h1>ILKIYA</h1>
            </div>
            <div class="float-right site-address">
                <h4>ILKIYA BOOK STORE</h4>
                <p>Jl. Benua anyar komplek sa'wanah RT. 04 No.42, Banjarmasin Utara</p>
                <p>Phone: <a href="tel:{{ env('APP_PHONE') }}">0859-2574-1784</a></p>
                <p>Email: <a href="mailto:{{ env('APP_EMAIL') }}">ilika@gmail.com</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="invoice-description">
            <div class="invoice-left-top float-left">
                <h6>Kepada Pelanggan : </h6>
                <h3>{{ strtoupper($order->first_name) }} {{ strtoupper($order->last_name) }}</h3>
                <div class="address">

                    <p>
                        <strong>Alamat: </strong>
                        {{ $order->address }}, {{ $order->city }}
                    </p>

                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                </div>
            </div>
            <div class="invoice-right-top float-right" class="text-right">
                <h3>Tanggal :{{ $order->cart_id }}</h3>
                <p>{{ $order->created_at->format('D d m Y') }}</p>
                {{-- <img class="img-responsive" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate(route('admin.product.order.show', $order->id )))}}"> --}}
            </div>
            <div class="clearfix"></div>
        </div>
        <section class="order_details pt-3">
            <div class="table-header">
                <h5>Rincian Pesanan</h5>
            </div>
            <table class="table table-bordered table-stripe">
                <thead>
                    <tr>
                        <th scope="col" class="col-6">Judul Buku</th>
                        <th scope="col" class="col-3">Jumlah</th>
                        <th scope="col" class="col-3 text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->cart as $cart)
                        @php
                            $product = DB::table('books')
                                ->select('name')
                                ->where('id', $cart->book_id)
                                ->get();
                        @endphp
                        <tr>
                            <td><span>
                                    @foreach ($product as $pro)
                                        {{ $pro->name }}
                                    @endforeach
                                </span></td>
                            <td>x{{ $cart->quantity }}</td>
                            <td><span>Rp. {{ number_format($cart->price, 2) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col" class="empty"></th>
                        <th scope="col" class="text-right">Subtotal:</th>
                        <th scope="col"> <span>Rp. {{ number_format($order->sub_total, 2) }}</span></th>
                    </tr>
                    {{-- @if (!empty($order->coupon))
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Discount:</th>
          <th scope="col"><span>-{{$order->coupon->discount(Helper::orderPrice($order->id, $order->user->id))}}{{Helper::base_currency()}}</span></th>
        </tr>
      @endif --}}
                    <tr>
                        <th scope="col" class="empty"></th>
                        <th scope="col" class="text-right ">Ongkir:</th>
                        <th><span>Rp. {{ number_format($order->ongkir, 2) }}</span></th>
                    </tr>
                    <tr>
                        <th scope="col" class="empty"></th>
                        <th scope="col" class="text-right">Total:</th>
                        <th>
                            <span>
                                Rp. {{ number_format($order->total_amount, 2) }}
                            </span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </section>
        <div class="thanks mt-3">
            <h4>Terima Kasih Sudah Berbelanja Disini !!</h4>
        </div>
        <div class="authority float-right mt-5">
            {{-- <p>-----------------------------------</p> --}}
            <p class="text-center font-bold">Ilkiya Store</p>
            <h5>Abdullah Mubarak:</h5>
        </div>
        <div class="clearfix"></div>
    @else
        <h5 class="text-danger">Invalid</h5>
    @endif
</body>

</html>
