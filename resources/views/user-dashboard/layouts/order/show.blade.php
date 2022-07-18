@extends('user-dashboard.main', ['activePage' => 'profile', 'titlePage' => __('Order')])

@section('title', 'Order Detail')

@section('content')
    <div style="padding : 30px; margin-top : 30px;">
        <div class="card">
            <h5 class="card-header">Order<a target="_blank" href="{{ route('order.pdf', $order->id) }}"
                    class=" btn btn-sm btn-primary shadow-sm float-right"><i class="fas fa-download fa-sm text-white-50"></i>
                    Generate PDF</a>
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
                                @if ($order->status == 'delivered')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_number }}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>Rp. {{ $order->ongkir }}</td>
                                <td>Rp. {{ number_format($order->total_amount, 2) }}</td>
                                <td>
                                    @if ($order->status == 'new')
                                         <span class="badge badge-primary">{{ $order->status }}</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge badge-warning">{{ "DiProses" }}</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge badge-success">{{ "DiKirim" }}</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge badge-danger">{{ "Dibatalkan" }}</span>
                                    @elseif($order->status == 'received')
                                        <span class="badge badge-success">{{"Diterima" }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                    @endif
                                  
                                </td>
                                @if ($order->status == 'delivered')
                                <td>
                                    {{-- <form method="POST" action="{{ route('orderuser.destroy', [$order->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{ $order->id }}
                                            data-toggle="tooltip" data-placement="bottom" title="Delete"><i
                                                class="material-icons">delete</i>
                                        </button>
                                    </form>
                                        --}}
                                    <form action="{{route('user.received.order',$order->id)}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm receivedBtn" data-id={{ $order->id }}
                                            data-toggle="tooltip"  data-placement="bottom" title="Delete"><i
                                                class="material-icons">check</i>
                                        </button>
                                        <input type="hidden" name="status" value="received">
                                    </form>
                                </td>
                            @endif
                               

                            </tr>
                        </tbody>
                    </table>

                    <section class="confirmation_part section_padding">
                        <div class="order_boxes">
                            <div style="margin-top : 4rem; display : flex; justify-content : center;" class="row ">
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
                                                <td>Kota</td>
                                                <td> : {{ $order->city }}</td>
                                            </tr>

                                            <tr>
                                                <td>Kode Post</td>
                                                <td> : {{ $order->post_code }}</td>
                                            </tr>
                                            <tr class="">
                                                <td>Nomor Pembelian</td>
                                                <td> : {{ $order->order_number }}</td>
                                            </tr>
                                            <tr>
                                                <td>tanggal pembelian</td>
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
                                                @php
                                                    $shipping_charge = DB::table('shipping')
                                                        ->where('id', $order->shipping_id)
                                                        ->pluck('price');
                                                @endphp
                                                <td>Ongkir</td>
                                                <td> :Rp. {{ $order->ongkir }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total Jumlah Pembelian</td>
                                                <td> : Rp. {{ number_format($order->total_amount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bukti Transfer</td>
                                                <td> <img src="{{ asset('/storage/' . $order->transfer_evidence) }}"
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
@push('js')
    <!-- Page level plugins -->
    <script src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#product-dataTable').DataTable();

        // Sweet alert

        function deleteData(id) {

        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Apa Anda Yakin ?",
                        text: "Saat Dihapus Data Tidak Dapat Dikembalikan!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("DiBatalkan!");
                        }
                    });
            })

            $('.receivedBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Apa Anda Sudah Menerima Barang ?",
                        // text: "!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("DiBatalkan!");
                        }
                    });
            })
        })

        
    </script>
@endpush
