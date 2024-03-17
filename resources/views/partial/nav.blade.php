

<!-- Strat navbar-->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-light">
  <div class="container">

  <a class="navbar-brand" href="{{route('index')}}">
  <img src="{{ asset('images/logo.png') }}" alt="logo image">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item

      @if (Route::is('index'))
        active
        @endif

      ">
        <a class="nav-link" href="{{route('index')}}">Trăng chủ <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item
       @if (Route::is('product'))
        active
        @endif
        ">
        <a class="nav-link" href="{{route('product')}}">Sản phẩm</a>
      </li>

        <li class="nav-item
        @if (Route::is('contact'))
        active
        @endif
         ">
        <a class="nav-link" href="{{route('contact')}}">Liên hệ</a>
      </li>

      <li class="nav-item mt-2 ml-5">

        <form class="form-inline my-2 my-lg-0" action="{{route('product.search')}}" method="get">
         <div class="input-group mb-3">
      <input type="text" class="form-control" name="search" placeholder="Tìm kiếm sản phẩm" aria-label="Recipient's username" aria-describedby="button-addon2">

     <div class="input-group-append">
       <button class="btn btn-outline-secondary search-icon-button" type="submit"><i class="fa fa-search"></i> </button>
     </div>
    </div>
  </form>

      </li>


      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      -->

    </ul>



       <!-- Right Side Of Navbar -->
   <ul class="navbar-nav ml-auto">

     <li class="nav-item">
      <a class="nav-link" href="{{ route('product.cart.show') }}">
      <button class="btn btn-danger">
        <span class="mt-1">  Cart  </span>
        <span class="badge badge-warning" id="total_item">
          {{App\Models\Cart::total_item()}}
        </span>
      </button>
      </a>
    </li>
                        <!-- Authentication Links -->
       @guest
       @if (Route::has('login'))
         <li class="nav-item">
           <a class="nav-link" href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
        </li>
       @endif

        @if (Route::has('register'))
         <li class="nav-item">
           <a class="nav-link" href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
         </li>
       @endif
      @else

    <li class="nav-item dropdown">
     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

      <img src="{{ App\Helper\ImageHelper::getUserImage(Auth::user()->id)}}"
       class="img rounded-circle" style="width: 40px">

        {{ Auth::user()->username }}
     </a>

     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


       <a class="dropdown-item" href="{{ route('user.dashboard') }}"

           onclick="event.preventDefault();
          document.getElementById(route('user.dashboard').submit();">
               {{ __('Trang điều khiển') }}
      </a>



       <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
               {{ __('Đăng xuất') }}
      </a>



      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
       @csrf
      </form>
    </div>
   </li>
    @endguest
 </ul>




  </div>
  </div>
</nav>

<!-- End Navbar-->
