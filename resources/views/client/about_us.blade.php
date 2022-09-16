@extends('client.layout.master')

@section('title', 'E-SHOP || About Us')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a>Beranda<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a>Tentang Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- About Us -->
    <section class="about-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="about-content">

                        <h3>Selamat Datang di <span>Ilkiya Store</span></h3>
                        <p>Toko Buku ilkiya Merupakan distributor penjualan buku yang terletak di Jl. Benua anyar komplek
                            sa'wanah RT. 04 No.42, Banjarmasin Utara – kalimantan selatan .
                            Nama pemilik toko adalah Abdillah Mubarak Nurin, toko buku ilkiya didirikan pada tahun 12 april
                            2017.
                            Toko buku ini bergerak dalam bidang penyedian buku terutama untuk memenuhi kebutuhan pelanggan
                            yang ketika ingin membeli maupun mencari buku maupun novel yang ingin di minati oleh pelanggan
                        </p>

                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-img overlay">
                        {{-- <div class="button">
								<a href="https://www.youtube.com/watch?v=nh2aYrGMrIE" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
							</div> --}}
                        <img src="{{ asset('/img/toko.jpg') }}" alt="toko.jpg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us -->




@endsection
