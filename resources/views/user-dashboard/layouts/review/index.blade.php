@extends('user-dashboard.main', ['activePage' => 'profile', 'titlePage' => __('Order')])


@section('content')
 <!-- DataTales Example -->

 <div style="padding : 30px; margin-top : 30px;">
 <div class="card shadow mb-4">
 
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Review Lists</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($reviews)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              
              <th>Nama BUku</th>
              <th>Review</th>
              <th>Rate</th>
              <th>Tanggal</th>
          
              <th>Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              
              <th>Nama BUku</th>
              <th>Review</th>
              <th>Rate</th>
              <th>Tanggal</th>
          
              <th>Aksi</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($reviews as $review)
              
                <tr>
                    <td>{{$review->id}}</td>
                    <td>{{$review->book->name}}
                    <td>{{$review->review}}</td>
                    <td>
                     <ul style="list-style:none" class="d-flex">
                          @for($i=1; $i<=5;$i++)
                          @if($review->rating >=$i)
                            <li style="float:left;color:#F7941D;"><i class="material-icons">star</i></li>
                          @endif
                        @endfor
                     </ul>
                    </td>
                    <td>{{$review->created_at->format('M d D, Y g: i a')}}</td>
                  
                    <td>
                        <a href="{{route('user.productreview.edit',$review->id)}}" class="btn btn-info btn-sm btn-round btn-just-icon "   data-toggle="tooltip" title="edit" data-placement="bottom"><i class="material-icons">edit</i></a>
                        <form method="POST" action="{{route('user.productreview.delete',[$review->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm btn-round btn-just-icon dltBtn"   data-id={{$review->id}}  data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="material-icons">delete</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$reviews->links()}}</span>
        @else
          <h6 class="text-center">No reviews found!!!</h6>
        @endif
      </div>
    </div>
</div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('js')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[5,6]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
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
