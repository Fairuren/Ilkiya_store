@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Product')])

@section('content')
    <!-- DataTales Example -->
    <div style="padding: 40px; padding-top : 70px">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">Daftar Buku</h6>

                <div class="d-flex float-right">
                    <form style="width: 28rem; display : flex; justify-content : center ; align-items : center;"
                        method="post" target="_blank" action="{{ route('allbook.pdf') }}">
                        {{ csrf_field() }}
                        <label style="padding: 0px; margin : 0px; color :rgb(36, 36, 36)" for="">Dari</label>
                        <input required
                            style="margin: 5px; color : rgb(112, 112, 112); border : 1px solid rgb(175, 175, 175) ; border-radius : 4px;"
                            type="date" name="start" />
                        <label style="padding: 0px; margin : 0px; color :rgb(36, 36, 36)" for="">-</label>
                        <input required
                            style="margin: 5px; color : rgb(112, 112, 112); border : 1px solid rgb(175, 175, 175) ; border-radius : 4px;"
                            type="date" name="end" />
                        <button type="submit" class="btn btn-primary btn-sm float-right"><i
                                class="material-icons">download</i> Unduh PDF</button>
                    </form>

                    <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm " data-toggle="tooltip"
                        data-placement="bottom" title="Add User"> <i class="material-icons">add</i> Tambah Buku</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (count($books) > 0)
                        <table class="table" id="product-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Penerbit</th>
                                    <th>Penulis</th>
                                    <th>Stok</th>
                                    {{-- <th>Foto</th> --}}
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Buku</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Penerbit</th>
                                    <th>Penulis</th>
                                    <th>Stok</th>
                                    {{-- <th>Foto</th> --}}
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                @foreach ($books as $product)
                                    {{-- @php
           
              // dd($sub_cat_info);
              $writer=DB::table('writer')->select('name')->where('id',$product->writer_id)->get();
              $publisher=DB::table('publishers')->select('name')->where('id',$product->publisher_id)->get();
              
              @endphp --}}
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $product->name }}</td>

                                        </td>

                                        <td>Rp. {{ $product->price }} </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td> {{ ucfirst($product->publisher->name) }}</td>
                                        <td> {{ ucfirst($product->writer->name) }}</td>
                                        <td>
                                            @if ($product->stock > 0)
                                                <span class="badge badge-primary">{{ $product->stock }}</span>
                                            @else
                                                <span class="badge badge-danger">{{ $product->stock }}</span>
                                            @endif
                                        </td>
                                        {{-- <td>
                        @if ($product->image)
                            @php
                              $image=explode(',',$product->image);
                              // dd($image);
                            @endphp
                            <img src="{{asset('/storage/'.$product->image)}}" class="img-fluid zoom" style="max-width:80px" alt="{{'Gambar'}}">
                        @else
                            <img src="{{asset('/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                        @endif
                    </td> --}}
                                        <td>
                                            @if ($product->status == 'active')
                                                <span class="badge badge-success">{{ $product->status }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $product->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary btn-sm" style="height:30px; width:20px;" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="material-icons">edit</i></a> --}}
                                            <a href="{{ route('product.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm btn-round btn-just-icon">
                                                <i class="material-icons">edit</i>
                                                <div class="ripple-container"></div>
                                            </a>
                                            <form method="POST" action="{{ route('product.destroy', [$product->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm btn-round btn-just-icon dltBtn"
                                                    data-id={{ $product->id }} data-toggle="tooltip"
                                                    data-placement="bottom" title="Delete"><i
                                                        class="material-icons">delete</i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <span style="float:right">{{ $books->links() }}</span>
                    @else
                        <h6 class="text-center">No Products found!!! Please create Product</h6>
                    @endif
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
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
