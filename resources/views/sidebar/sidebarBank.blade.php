<div class="row" style="height: 562px;">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 sidebar d-md-block collapse ">
    <h5 style="margin-left : 10px "> {{ $name  }} | {{ $title }}</h5>

  
    <div class="position-sticky pt-0">
      <ul class="nav flex-column ">
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'bank' ? 'active': '' }}" style="font-size: 15px" aria-current="page" href="{{ route('bank.index') }}">
            <span data-feather="mail" style="width: 25px; height: 25px;"></span>
            Pesanan Isi Saldo
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'withdraw' ? 'active': '' }}" style="font-size: 15px" aria-current="page" href="{{ route('bank.withdraw') }}">
            <span data-feather="mail" style="width: 25px; height: 25px;"></span>
            Pesanan Withdraw
          </a>
        </li>
        <p style="color: gray; margin-left : 10px ">Riwayat</p>
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'laporanTopUp'  ? 'active': '' }}" href="{{ route('laporanTopUp') }}" style="font-size: 15px">
            <span data-feather="file-text" style="width: 25px; height: 25px;"></span>
            Laporan Top up
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link {{ $aksi == 'laporanWithdraw'  ? 'active': '' }}" href="{{ route('laporanWithdraw') }}" style="font-size: 15px">
            <span data-feather="file-text" style="width: 25px; height: 25px;"></span>
            Laporan Tarik Tunai
          </a>
        </li>
        <li class="nav-item " style="margin-top: 250px" >
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="nav-link px-3 border-0 bg-white "><span data-feather="log-out" style="width: 25px; height: 25px;"></span> Log Out</button>
            </form>
        
        </li>
       
  </nav>