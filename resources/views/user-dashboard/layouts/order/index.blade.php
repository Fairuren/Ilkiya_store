@extends('user-dashboard.main', ['activePage' => 'profile', 'titlePage' => __('Pesanan Diterima')])


@section('content')

    <div style="padding : 30px; margin-top : 30px;">
        <div class="container-fluid card">
            @include('user-dashboard.layouts.notification')
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pemesanan</h1>
            </div>
            <div class="row">
                @php
                    $orders = DB::table('orders')
                        ->where('user_id', auth()->user()->id)->where('status', '!=', 'received')
                        ->paginate(100);
                    
                @endphp
                <!-- Order -->
                <div class="col-xl-12 col-lg-12">
                    <table class="table table-bordered" id="product-dataTable"  width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Order No.</th>
                                <th class="text-center">Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pembatalan</th>
                                <th>Jumlah Barang</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N.</th>
                                <th>Order No.</th>
                                <th class="text-center">Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pembatalan</th>
                                <th>Jumlah Barang</th>
                                <th>Status</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ substr($order->created_at, 0 , 10) }}</td>
                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td class="text-center">
                                            {{ $order->cancel_reason ? $order->cancel_reason : '---' }}</td>
                                        <td class="text-center">{{ $order->quantity }}</td>
                                        <td class="text-center">
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
                                        <td>Rp. {{ number_format($order->total_amount, 2) }}</td>

                                        <td class="text-center">
                                            <a href="{{ route('user.order.show', $order->id) }}"
                                                class="btn btn-info btn-sm btn-round btn-just-icon "
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                title="view" data-placement="bottom"><i
                                                    class="material-icons">info</i></a>
                                            @if ($order->status == 'processing' || $order->status == 'new')
                                                <a href="{{ route('user.cancel', $order->id) }}"
                                                    class="btn btn-danger btn-sm btn-round btn-just-icon "
                                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                    title="view" data-placement="bottom"><i
                                                        class="material-icons">cancel</i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="8" class="text-center">
                                    <h4 class="my-4">Anda Belum Membeli Produk Buku</h4>
                                </td>
                            @endif
                        </tbody>
                    </table>

                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>

@endsection

@push('css')
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }

        .zoom {
            transition: transform .2s;
            /* Animation */
        }

        .zoom:hover {
            transform: scale(5);
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
       $('#product-dataTable').DataTable({
            "ordering": false
        });
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
        })
    </script>
@endpush
