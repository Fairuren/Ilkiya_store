@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Order Detail')])

@section('content')



    <div style="padding: 40px; padding-top : 70px">
        <div class="card">
            <h5 class="card-header">Order<a href="{{ route('order.pdf', $order->id) }}"
                    class=" btn btn-sm btn-primary shadow-sm float-right"><i class="material-icons">download</i> Unduh
                    Invoice</a>
                <a target="blank" href="{{ route('get_order_detail.pdf', $order->id) }}"
                    class=" btn btn-sm btn-primary shadow-sm float-right"><i class="material-icons">download</i> Unduh
                    Detail Pesanan Pelanggan</a>
            </h5>

            <div class="card-body">
                @if ($order)
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Order No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Quantity</th>
                                <th>Charge</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->ongkir }}</td>
                                <td>Rp. {{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if ($order->status == 'new')
                                        <span class="badge badge-primary">{{ $order->status }}</span>
                                    @elseif($order->status == 'process')
                                        <span class="badge badge-warning">{{ $order->status }}</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge badge-success">{{ $order->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('order.edit', $order->id) }}"
                                        class="btn btn-info btn-sm btn-round btn-just-icon " data-toggle="tooltip"
                                        title="edit" data-placement="bottom"><i class="material-icons">edit</i></a>
                                    {{-- <form method="POST" action="{{route('order.destroy',[$order->id])}}">
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm btn-round btn-just-icon " data-id={{$order->id}}  data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="material-icons">delete</i></button>
                </form> --}}
                                </td>

                            </tr>
                        </tbody>
                    </table>

                    <section class="confirmation_part section_padding">
                        <div class="order_boxes">
                            <div style="display: flex; justify-content : center;" class="row">
                                <div class="col-lg-6 col-lx-4">
                                    <div class="order-info">
                                        <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                                        <table class="table">
                                            <tr class="">
                                                <td>Nama</td>
                                                <td> : {{ $order->first_name }} {{ $order->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td> : {{ $order->email }}</td>
                                            </tr>
                                            <tr>
                                                <td>Telepon</td>
                                                <td> : {{ $order->phone }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td> : {{ $order->address }}</td>
                                            </tr>

                                            <tr>
                                                <td>Kode Pos</td>
                                                <td> : {{ $order->post_code }}</td>
                                            </tr>
                                            <tr class="">
                                                <td>Nomor Pembelian</td>
                                                <td> : {{ $order->order_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Pembelian</td>
                                                <td> : {{ $order->created_at->format('D d M, Y') }} at
                                                    {{ $order->created_at->format('g : i a') }} </td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Pembelian</td>
                                                <td> : {{ $order->quantity }}</td>
                                            </tr>
                                            <tr>
                                                <td>Status Pembelian</td>
                                                <td> : {{ $order->status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ongkir</td>
                                                <td> : Rp. {{ $order->ongkir }}</td>
                                            </tr>

                                            <tr>
                                                <td>Total Jumlah Pembelian</td>
                                                <td> : Rp. {{ number_format($order->total_amount, 2) }}</td>
                                            </tr>

                                            <tr>
                                                <td>Bukti Transfer
                                                    :
                                                <td> <img style="min-height: 40rem;"
                                                        src="{{ asset('/storage/' . $order->transfer_evidence) }}"
                                                        class="img-fluid zoom" style="max-width:80px"
                                                        alt="{{ 'Gambar' }}"></td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </section>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .order-info,
        .shipping-info {
            background: #ECECEC;
            padding: 20px;
        }

        .order-info h4,
        .shipping-info h4 {
            text-decoration: underline;
        }
    </style>
@endpush
