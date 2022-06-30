<div class="sidebar" data-color="green" data-background-color="white"
    data-image="{{ asset('material') }}/img/sidebar-1.jpg">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->

    <div class="logo">
        <a href="https://creative-tim.com/" class="simple-text logo-normal">
            {{-- ADMIN ILKIYA --}}
            {{ Auth::user()->role == 'su' ? 'Pemilik' : 'Admin' }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="true">
                    <i class="material-icons">business_center</i>
                    <p>{{ __('Produk/Buku') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="product">
                    <ul class="nav">
                        <li class="nav-item {{ Request::is('admin/product') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('product.index') }}">
                                <span class="sidebar-mini"> LP </span>
                                <span class="sidebar-normal">{{ __('List Product') }} </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/product/create') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('product.create') }}">
                                <span class="sidebar-mini"> TP </span>
                                <span class="sidebar-normal"> {{ __('Tambah Produk') }} </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/sold') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('book.sold') }}">
                                <span class="sidebar-mini"> BT </span>
                                <span class="sidebar-normal">{{ __('Buku Terjual') }} </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('admin/discount') ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('book.discount') }}">
                                <span class="sidebar-mini"> DB </span>
                                <span class="sidebar-normal"> {{ __('Diskon Buku') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $activePage == 'category' || $activePage == 'add-category' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="true">
                    <i class="material-icons">category</i>
                    <p>{{ __('Kategori Buku') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="category">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('category.index') }}">
                                <span class="sidebar-mini"> LK </span>
                                <span class="sidebar-normal">{{ __('List Kategori') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'category' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('category.create') }}">
                                <span class="sidebar-mini"> TK </span>
                                <span class="sidebar-normal"> {{ __('Tambah Kategori') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $activePage == 'publisher' || $activePage == 'add-publisher' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#publisher" aria-expanded="true">
                    <i class="material-icons">emoji_people</i>
                    <p>{{ __('Penerbit') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="publisher">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'theme' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('publisher.index') }}">
                                <span class="sidebar-mini"> LT </span>
                                <span class="sidebar-normal">{{ __('List Penerbit') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'add-penerbit' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('publisher.create') }}">
                                <span class="sidebar-mini"> TT </span>
                                <span class="sidebar-normal"> {{ __('Tambah Penerbit') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item {{ $activePage == 'writer' || $activePage == 'add-writer' ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#writer" aria-expanded="true">
                    <i class="material-icons">create</i>
                    <p>{{ __('Penulis') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="writer">
                    <ul class="nav">
                        <li class="nav-item{{ $activePage == 'theme' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('writer.index') }}">
                                <span class="sidebar-mini"> LT </span>
                                <span class="sidebar-normal">{{ __('List Penulis') }} </span>
                            </a>
                        </li>
                        <li class="nav-item{{ $activePage == 'add-penerbit' ? ' active' : '' }}">
                            <a class="nav-link" href="{{ route('writer.create') }}">
                                <span class="sidebar-mini"> TT </span>
                                <span class="sidebar-normal"> {{ __('Tambah Penulis') }} </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            @if (Auth::user()->role == 'su')
                <li class="nav-item{{ $activePage == 'user' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="material-icons">bubble_chart</i>
                        <p>{{ __('Pengguna') }}</p>
                    </a>
                </li>
            @endif


            @if (Auth::user()->role == 'su')
                <li class="nav-item{{ Request::is('admin/finance') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('finance') }}">
                        <i class="material-icons">money</i>
                        <p>{{ __('Keuangan') }}</p>
                    </a>
                </li>
            @endif

            <li class="nav-item{{ Request::is('admin/order') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('order.index') }}">
                    <i class="material-icons">list</i>
                    <p>{{ __('Pesanan') }}</p>
                </a>
            </li>
            <li class="nav-item{{ Request::is('admin/order_cancel') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('canceled.view') }}">
                    <i class="material-icons">cancel</i>
                    <p>{{ __('Pesanan DiBatalkan') }}</p>
                </a>
            </li>


            {{-- <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">book</i>
          <p>{{ __('Laporan') }}</p>
        </a>
      </li> --}}

        </ul>
    </div>
</div>
