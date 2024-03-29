@extends('client.layout.master')

@section('meta')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name='copyright' content=''>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="online shop, purchase, cart, ecommerce site, best online shopping">
    <meta name="og:description" content="{{ $product_detail->summary }}">
    <meta property="og:url" content="{{ route('product-detail', $product_detail->slug) }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $product_detail->name }}">
    <meta property="og:image" content="{{ $product_detail->image }}">
    <meta property="og:description" content="{{ $product_detail->description }}">
@endsection
@section('title', 'E-SHOP || PRODUCT DETAIL')
@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{ route('home') }}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="">Detail Buku</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Shop Single -->
    <section class="shop single section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <section id="addToCart">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <!-- Images slider -->
                                <div class="flexslider-thumbnails">
                                    <ul class="slides">
                                        @php
                                            $photo = explode(',', $product_detail->image);
                                            // dd($photo);
                                        @endphp
                                        @foreach ($photo as $data)
                                            <li data-thumb="{{ $data }}" rel="adjustX:10, adjustY:">

                                                <img src="{{ asset('/storage/images/' . $photo[0]) }}"
                                                    alt="{{ $data }}">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End Images slider -->
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="product-des">
                                <!-- Description -->
                                <div class="short">
                                    <h4>{{ $product_detail->name }}</h4>
                                    <div class="rating-main">
                                        <ul class="rating">
                                            @php
                                                $rate = ceil($product_detail->getReview->avg('rating'));
                                            @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($rate >= $i)
                                                    <li><i class="fa fa-star"></i></li>
                                                @else
                                                    <li><i class="fa fa-star-o"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <a href="#"
                                            class="total-review">({{ $product_detail['getReview']->count() }}) Ulasan</a>
                                    </div>
                                    @php
                                        $after_discount = $product_detail->price - ($product_detail->price * $product_detail->discount) / 100;
                                    @endphp
                                    <p class="price"><span class="discount">Rp.
                                            {{ number_format($after_discount, 2) }}
                                        </span>
                                        @if ($product_detail->discount > 0)
                                            <s>Rp. {{ number_format($product_detail->price, 2) }}</s>
                                        @endif
                                    </p>
                                    <div style="margin-top : 15px">
                                        <h5 style="margin: 0; padding : 0;">Sinopsis : </h5>
                                        <p style="margin: 0; padding : 0;" class="description">{!! $product_detail->summary !!}</p>
                                    </div>
                                  
                                </div>
                                <!--/ End Description -->
                                <!-- Color -->
                                {{-- <div class="color">
												<h4>Available Options <span>Color</span></h4>
												<ul>
													<li><a href="#" class="one"><i class="ti-check"></i></a></li>
													<li><a href="#" class="two"><i class="ti-check"></i></a></li>
													<li><a href="#" class="three"><i class="ti-check"></i></a></li>
													<li><a href="#" class="four"><i class="ti-check"></i></a></li>
												</ul>
											</div> --}}
                                <!--/ End Color -->
                                <!-- Size -->

                                <!--/ End Size -->
                                <!-- Product Buy -->
                              
                                    <div class="product-buy">
                                    <form action="{{ route('single-add-to-cart') }}" method="POST">
                                        @csrf
                                        <div class="quantity">
                                            <h6>Jumlah Buku :</h6>
                                            <!-- Input Order -->
                                            <div class="input-group">
                                                <div class="button minus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        disabled="disabled" data-type="minus" data-field="quant[1]">
                                                        <i class="ti-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                                <input type="text" name="quant[1]" class="input-number" data-min="1"
                                                    data-max="1000" value="1" id="quantity">
                                                <div class="button plus">
                                                    <button type="button" class="btn btn-primary btn-number"
                                                        data-type="plus" data-field="quant[1]">
                                                        <i class="ti-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!--/ End Input Order -->
                                        </div>
                                      
                                        <div class="add-to-cart mt-4">
                                            <button type="submit" class="btn">Tambahkan Ke Keranjang</button>
                                            {{-- <a href="{{route('add-to-wishlist',$product_detail->slug)}}" class="btn min"><i class="ti-heart"></i></a> --}}
                                        </div>
                                    </form>

                                    {{-- <p class="cat">Category :<a href="{{route('product-cat',$product_detail->cat_info['slug'])}}">{{$product_detail->cat_info['name']}}</a></p> --}}

                                    <p class="availability">Sisa Barang : @if ($product_detail->stock > 0)
                                            <span class="badge badge-success">{{ $product_detail->stock }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $product_detail->stock }}</span>
                                        @endif
                                    </p>
                                    </div>
                              
                                <!--/ End Product Buy -->
                            </div>
                        </div>
                    </div>
                </section>
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="single-des">
                            <h6>Deskripsi Buku :</h6>
                            <p>{!! $product_detail->description !!}</p>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-12">
                            <div style="margin-top: 2px">
                                <p>ISBN : {{$product_detail->isbn}}</p>
                                <img style="height: 100px; padding : 0; margin : 0; margin-left : -10px" src="https://www.periplus.com/image/icon-product-detail/isbn-barcode.png"/>
                            </div>

                            <div class="preview" style="margin-top: 2px; text-align : center;">
                               <h3>Preview Book</h3>
                               <div class="d-flex w-100 " style="margin: 32px 0px; justify-content : center; align-items : center;">
                                   <i style="font-size: 7rem;" class="material-icons c_icon c_icon_min">chevron_left</i>
                                    <div class="w-100 d-flex" style="flex-direction : column; border: 1px solid black; padding : 12px; min-height : 32rem; justify-content : center; align-items : center;" id="preview">
                                    </div>
                                    <i style="font-size: 7rem;" class="material-icons c_icon c_icon_plus">chevron_right</i>
                               </div>
                               <h6 id="page" style="margin : 0px ; padding : 0px;">Page : </h6>
                            </div>

                     

                            <div class="product-info">
                                <div class="nav-main">
                                    <!-- Tab Nav -->
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li style="border : 1px solid black;" class="nav-item"><a class="nav-link"
                                                data-toggle="tab" role="tab">Ulasan</a></li>
                                    </ul>
                                    <!--/ End Tab Nav -->
                                </div>
                                <div>
                                    <!-- Description Tab -->

                                    <!--/ End Description Tab -->
                                    <!-- Reviews Tab -->
                                    <div>
                                        <div class="tab-single review-panel">
                                            <div class="row">
                                                <div class="col-12">

                                                    <!-- Review -->
                                                    <div class="comment-review">
                                                        <div class="add-review">
                                                            <h5>Tambahkan Ulasan</h5>
                                                            <p></p>
                                                        </div>
                                                        <h4>Rating <span class="text-danger">*</span></h4>
                                                        <div class="review-inner">
                                                            <!-- Form -->
                                                            @auth
                                                                <form class="form" method="post"
                                                                    action="{{ route('review.store', $product_detail->slug) }}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="rating_box">
                                                                                <div class="star-rating">
                                                                                    <div class="star-rating__wrap">
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-1" type="radio"
                                                                                            name="rating" value="1">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-1"
                                                                                            title="1 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-2" type="radio"
                                                                                            name="rating" value="2">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-2"
                                                                                            title="2 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-3" type="radio"
                                                                                            name="rating" value="3">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-3"
                                                                                            title="3 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-4" type="radio"
                                                                                            name="rating" value="4">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-4"
                                                                                            title="4 out of 5 stars"></label>
                                                                                        <input class="star-rating__input"
                                                                                            id="star-rating-5" type="radio"
                                                                                            name="rating" value="5">
                                                                                        <label
                                                                                            class="star-rating__ico fa fa-star-o"
                                                                                            for="star-rating-5"
                                                                                            title="5 out of 5 stars"></label>
                                                                                        @error('rating')
                                                                                            <span
                                                                                                class="text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="form-group">
                                                                                <label>Ulasan </label>
                                                                                <textarea name="review" rows="6" placeholder=""></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 col-12">
                                                                            <div class="form-group button5">
                                                                                <button type="submit"
                                                                                    class="btn">Submit</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <p class="text-center p-5">
                                                                    You need to <a href="{{ route('login.form') }}"
                                                                        style="color:rgb(54, 54, 204)">Login</a> OR <a
                                                                        style="color:blue"
                                                                        href="{{ route('register.form') }}">Register</a>

                                                                </p>
                                                                <!--/ End Form -->
                                                            @endauth
                                                        </div>
                                                    </div>

                                                    <div class="ratting-main">
                                                        <div class="avg-ratting">
                                                            {{-- @php 
																			$rate=0;
																			foreach($product_detail->rate as $key=>$rate){
																				$rate +=$rate
																			}
																		@endphp --}}
                                                            <h4>{{ ceil($product_detail->getReview->avg('rating')) }}
                                                                <span>(Keseluruhan)</span>
                                                            </h4>
                                                            <span>Dari {{ $product_detail->getReview->count() }}
                                                                Komentar</span>
                                                        </div>
                                                        @foreach ($product_detail['getReview'] as $data)
                                                            <!-- Single Rating -->
                                                            <div class="single-rating">


                                                                <div class="d-flex">
                                                                    <img style="border-radius: 50%;"
                                                                        src="{{ asset('/img/avatar.png') }}"
                                                                        alt="avatar.jpg">
                                                                    <div style="margin-left : 12px;" class="">
                                                                        <h6>{{ $data->userInfo['name'] }}</h6>
                                                                        <div class="ratings">
                                                                            <ul class="rating">
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    @if ($data->rating >= $i)
                                                                                        <li><i class="fa fa-star"></i></li>
                                                                                    @else
                                                                                        <li><i class="fa fa-star-o"></i>
                                                                                        </li>
                                                                                    @endif
                                                                                @endfor
                                                                            </ul>
                                                                            <div class="rate-count">
                                                                                (<span>{{ $data->rating }}</span>)</div>
                                                                        </div>
                                                                        <p style="font-size : 20px;">{{ $data->review }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <!--/ End Single Rating -->
                                                        @endforeach
                                                    </div>

                                                    <!--/ End Review -->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Reviews Tab -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Shop Single -->

    <!-- Start Most Popular -->

    <!-- End Most Popular Area -->


    <!-- Modal -->
    <div class="modal fade" id="modelExample" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            class="ti-close" aria-hidden="true"></span></button>
                </div>
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <!-- Product Slider -->
                            <div class="product-gallery">
                                <div class="quickview-slider-active">
                                    <div class="single-slider">
                                        <img src="images/modal1.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal2.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal3.png" alt="#">
                                    </div>
                                    <div class="single-slider">
                                        <img src="images/modal4.png" alt="#">
                                    </div>
                                </div>
                            </div>
                            <!-- End Product slider -->
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="quickview-content">
                                <h2>Flared Shift Dress</h2>
                                <div class="quickview-ratting-review">
                                    <div class="quickview-ratting-wrap">
                                        <div class="quickview-ratting">
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="yellow fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <a href="#"> (1 customer review)</a>
                                    </div>
                                    <div class="quickview-stock">
                                        <span><i class="fa fa-check-circle-o"></i> in stock</span>
                                    </div>
                                </div>
                                <h3>$29.00</h3>


                                <div class="quickview-peragraph">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad
                                        impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo
                                        ipsum numquam.</p>
                                </div>
                                <div class="size">
                                    <div class="row">

                                        <div class="col-lg-6 col-12">
                                            <h5 class="title">Color</h5>
                                            <select>
                                                <option selected="selected">orange</option>
                                                <option>purple</option>
                                                <option>black</option>
                                                <option>pink</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="quantity">
                                    <!-- Input Order -->
                                    <div class="input-group">
                                        <div class="button minus">
                                            <button type="button" class="btn btn-primary btn-number" disabled="disabled"
                                                data-type="minus" data-field="quant[1]">
                                                <i class="ti-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="qty" class="input-number" data-min="1"
                                            data-max="1000" value="1">
                                        <div class="button plus">
                                            <button type="button" class="btn btn-primary btn-number" data-type="plus"
                                                data-field="quant[1]">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ End Input Order -->
                                </div>
                                <div class="add-to-cart">
                                    <a href="#" class="btn">Add to cart</a>
                                    <a href="#" class="btn min"><i class="ti-heart"></i></a>
                                    <a href="#" class="btn min"><i class="fa fa-compress"></i></a>
                                </div>
                                <div class="default-social">
                                    <h4 class="share-now">Share:</h4>
                                    <ul>
                                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                        <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

@endsection
@push('styles')
    <style>
      

        /* Rating */
        .rating_box {
            display: inline-flex;
        }

        .star-rating {
            font-size: 0;
            padding-left: 10px;
            padding-right: 10px;
        }

        .star-rating__wrap {
            display: inline-block;
            font-size: 1rem;
        }

        .star-rating__wrap:after {
            content: "";
            display: table;
            clear: both;
        }

        .star-rating__ico {
            float: right;
            padding-left: 2px;
            cursor: pointer;
            color: #F7941D;
            font-size: 16px;
            margin-top: 5px;
        }

        .star-rating__ico:last-child {
            padding-left: 0;
        }

        .star-rating__input {
            display: none;
        }

        .star-rating__ico:hover:before,
        .star-rating__ico:hover~.star-rating__ico:before,
        .star-rating__input:checked~.star-rating__ico:before {
            content: "\F005";
        }

        .c_icon:hover{
            color :rgb(54, 54, 204);
            cursor: pointer;
        }
    </style>
@endpush


@push('js')
<script type="text/javascript">
    let sites = {!! json_encode($preview->toArray()) !!};
    let curr  = 0;
    $('#page').html(`Page ${curr + 1}`)
    $('#preview').html(sites[curr].preview)
    $('.c_icon_plus').click(function(){
        if(curr <=6){
            curr ++
            $('#page').html(`Page ${curr + 1}`)
           return $('#preview').html(sites[curr].preview)
        }

        return $('#preview').html('<div><h3>Maaf Untuk Lanjut Anda harus membeli buku</h3><a href="#addToCart" style="color : white; margin-top : 12px;" class="btn">Beli</a href="."><div>')
    })

    $('.c_icon_min').click(function(){
        if(curr > 0){
            curr --
            $('#page').html(`Page ${curr + 1}`)
           return $('#preview').html(sites[curr].preview)
        }
        
    })

</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script>
        $('.cart').click(function(){
            var quantity=$('#quantity').val();
            var pro_id=$(this).data('id');
            // alert(quantity);
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							document.location.href=document.location.href;
						});
                    }
                }
            })
        });
    </script> --}}
@endpush
