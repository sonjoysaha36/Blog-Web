<div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand fs-3 fw-bold" href="{{url('/')}}">BlogWeb</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              ><i class="fa-brands fa-dropbox"></i>
              CATEGORIES
            </a>
            <ul class="dropdown-menu">
              @foreach ($data as $data)
                  
              
              <li><a class="dropdown-item" href="{{url('category_blog',$data->id)}}">{{$data->category_name}}</a></li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('post_blog')}}"
              ><i class="fa-solid fa-book"></i> Post Blog</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/all_blogs')}}"
              ><i class="fa-solid fa-book-open"></i> All Blogs</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/contact')}}"
              ><i class="fa-solid fa-address-card"></i> Contact Us</a
            >
          </li>
        </ul>
        {{-- <a href=""><img class="icon mx-2" src="/home/image/cart.png" alt=""></a> --}}
        <a type="button" class="btn btn-outline-light position-relative mx-2" href="{{url('show_cart')}}">
          {{-- <img class="icon" src="/home/image/cart.png" alt=""> --}}
          <i class="fa-solid fa-clock"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{$carts}}
          </span>
        </a>
        
        <form action="{{url('search')}}" method="get" class="d-flex" role="search">
          @csrf
          <input
            class="form-control me-2"
            type="search"
            name="search"
            placeholder="Search"
            aria-label="Search"
          />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
      @if (Route::has('login'))
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-2">
        @auth
        <li class="nav-item">
          <x-app-layout>
  
          </x-app-layout>
        </li>
        @else
      <li class="nav-item custom-link" style="">
        <a class="btn btn-primary" id="logincss" href="{{ route('login') }}"
          >Login</a
        >
      </li>
      <li class="nav-item">
        <a class="btn btn-success" href="{{ route('register') }}"
          >Register</a
        >
      </li>
      @endauth
    </ul>

    @endif
    </div>
  </nav>
</div>
{{-- second nav bar --}}
<div>
  
  <nav class="navbar-danger bg-danger">
    <div class="container-fluid">
      <marquee direction="scroll">
      <ul class="nav d-flex justify-content-around">
        <li class="nav-item">
          <a class="nav-link text-white" href="">Personal blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="">Business/Corporate blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="">News blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="">Affiliate / Review blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="">Tutorial blogs</a>
        </li>
        
      </ul>
    </marquee>
    </div>
  </nav>

</div>