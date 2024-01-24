<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Blogweb</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <script
      src="https://kit.fontawesome.com/4c44cda4ea.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="home/css/style.css">
    <style>
      #Cart{
      fill:green;
      }
      
      
      .card{
        transition:0.5s;
        cursor:pointer;
      }
      .card-title{  
        font-size:20px;
        transition:1s;
        cursor:pointer;
      }
      .card-title i{  
        font-size:15px;
        transition:1s;
        cursor:pointer;
        color:#ffa710
      }
      .card-title i:hover{
        transform: scale(1.25) rotate(100deg); 
        color:#18d4ca;
        
      }
      .card:hover{
        transform: scale(1.05);
        box-shadow: 10px 10px 15px rgba(0,0,0,0.3);
      }
      

     
      .card:hover::before, .card:hover::after, .card:focus::before, .card:focus::after {
        transform: scale3d(1, 1, 1);
      }
      .tag {
        align-self: flex-start;
        padding: .25em .75em;
        border-radius: 1em;
        font-size: .75rem;
      }

      .tag + .tag {
        margin-left: .5em;
      }

      .tag-blue {
        background: #56CCF2;
        background: linear-gradient(to bottom, #2F80ED, #56CCF2);
        color: #fafafa;
      }
      .carousel-control-prev,
.carousel-control-next {
    height: 44px;
    width: 40px;
    background: #7ac400;
    margin: auto 0;
    border-radius: 4px;
    opacity: 0.8;
}
.carousel-control-prev:hover,
.carousel-control-next:hover {
    background: #78bf00;
    opacity: 1;
}
.carousel-control-prev i,
.carousel-control-next i {
    font-size: 36px;
    position: absolute;
    top: 50%;
    display: inline-block;
    margin: -19px 0 0 0;
    z-index: 5;
    left: 0;
    right: 0;
    color: #fff;
    text-shadow: none;
    font-weight: bold;
}
.carousel-control-prev i {
    margin-left: -2px;
}
.carousel-control-next i {
    margin-right: -4px;
}
.carousel-indicators {
    bottom: -50px;
}


.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}


    </style>
  </head>
  <body>
    {{-- first nav bar --}}
    @include('home.header')
    @if(session()->has('message'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="btn-close btn-success" data-bs-dismiss="alert" aria-label="Close">X</button>
              </div>
              @endif
    {{-- Slider --}}
    <div>


    
    <div style="margin-top: 2%">
      <h2 class="mt-2" style="margin-bottom: 1%; font-size: 1.5rem; font-family: SFProDisplaySemibold; text-align: center;">
        {{$heading}} <b>BLOGS</b>
      </h2>
        <div class="mt-2" style="margin-left: 3%; margin-right: 3%;">
        
          <div class="row">
            @foreach ($blog as $item)
            
            <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
              <a style="text-decoration: none;
              color: black;" href="{{url('read',$item->id)}}">
                <div class="card card-block" style="padding-left: 5px; padding-right: 5px;">
                  
                    <img style="border-radius: 5px; padding-top: 3px; height: 150px; width: 100%;" src="/blog_picture/{{ $item->image }}" alt="Photo of this blog">
                    {{-- <div class="card-img-overlay d-flex align-items-start justify-content-end">
                      <h1 style="background: #dbdada; padding: 5px; border-radius: 12px;" class="card-title"><a href="{{url('add_cart',$item->id)}}"><i class="fa-regular fa-floppy-disk" style="font-size: 25px;"></i></a></h1>
                    </div> --}}
                  
                  <span class="tag tag-blue" style="margin: auto; margin-top: 4px;">{{$item->name}}</span>
                  <h2 class="card-title mb-2" style="font-weight: bold;">{{substr($item->title,0,20)}}...</h2>
                  <span class="card-text" style="min-height: 110px;">{!!substr($item->description,0,100)!!}...</span>
                  <br>
                  
                  
                  <span style="position: absolute; bottom: 5px; right: 5px;">
                    <small>{{$item->created_at}}</small>
                  </span>
                </div>
              </a>
            </div>
          
            @endforeach
          </div>
          {{-- <div style="display: flex; justify-content: center; margin-top: 20px;">
            {{ $blog->links(null, ['class' => 'pagination-links']) }}
          </div> --}}
          <div style="   text-align: center;">
            <a href="{{ $blog->previousPageUrl() }}" style="text-decoration: none; color: blue; font-weight: bold;">Previous</a>
            <a href="{{ $blog->nextPageUrl() }}" style="text-decoration: none; color: green; font-weight: bold; margin-left: 5px;">Next</a>
      
            <span>{{$blog->hasMorePages()}}</span>
            
      
          </div>
          
          
          
        </div>
        
        
    </div>
  </div>
    {{-- footer --}}
    @include('home.footer')
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
