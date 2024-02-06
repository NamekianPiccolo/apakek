<div class="row" style="height: 562px;">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 sidebar d-md-block collapse ">
    <h5 style="margin-left : 10px "> {{ $name  }} | {{ $title }}</h5>

  
    <div class="position-sticky pt-0">
      <ul class="nav flex-column ">
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'dashboard' ? 'active': '' }}" style="font-size: 15px" aria-current="page" href="{{ route('customer.index') }}">
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'dashboard' ? 'active': '' }}" style="font-size: 15px" aria-current="page" href="{{ route('customer.index') }}">
            <span data-feather="home" style="width: 25px; height: 25px;"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'produk' ? 'active': '' }}" style="font-size: 15px" href="{{ route('customer.produk') }}">
            <span data-feather="shopping-bag" style="width: 25px; height: 25px;" ></span>
            Product
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'topUp'  ? 'active': '' }}" href="{{ route("customer.topUp") }}" style="font-size: 15px">
            <span data-feather="credit-card" style="width: 25px; height: 25px;"></span>
            Top Up
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'withdraw'  ? 'active': '' }}" href="{{ route('tampilWithDraw') }}" style="font-size: 15px">
            <span data-feather="briefcase" style="width: 25px; height: 25px;"></span>
            WithDraw
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'cart'  ? 'active': '' }}" href="/customer/keranjang" style="font-size: 15px">
            <span data-feather="shopping-cart" style="width: 25px; height: 25px;"></span>
            Cart
          </a>
        </li>
        <p style="color: gray; margin-left : 10px ">Riwayat</p>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'laporanTopUp'  ? 'active': '' }}" href="/customer/keranjang" style="font-size: 15px">
            <span data-feather="file-text" style="width: 25px; height: 25px;"></span>
            Laporan Top up
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'laporanTarikTunai'  ? 'active': '' }}" href="/customer/keranjang" style="font-size: 15px">
            <span data-feather="file-text" style="width: 25px; height: 25px;"></span>
            Laporan Tarik Tunai
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'laporanTarikTunai'  ? 'active': '' }}" href="/customer/keranjang" style="font-size: 15px">
            <span data-feather="file-text" style="width: 25px; height: 25px;"></span>
            Laporan Transaksi
          </a>
        </li>
        <li class="nav-item " style="margin-top: 50px" >
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="nav-link px-3 border-0 bg-white "><span data-feather="log-out" style="width: 25px; height: 25px;"></span> Log Out</button>
            </form>
        
        </li>
       
  </nav>