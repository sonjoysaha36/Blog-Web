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
      .custom-link{
        margin-right: 3%;
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
.filled-heart {
    fill: green;
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
      <div class="container-fluid">
        <div class="container">
           <div class="row">
              <div class="col-lg-8">
                 <div class="position-relative mb-3">
                  <h1 class="" style="font-size: xx-large;
                  font-weight: bold;">{{$blog->title}}...</h1>
                    <img class="img-fluid w-100" src="/blog_picture/{{$blog->image}}" style="height: 50vh;
                    padding: 5px;">
                    <div class="card-img-overlay d-flex align-items-start justify-content-end">
                <h1 style="margin-top: 2%; background: #dbdada; padding: 5px; border-radius: 12px;" class="card-title"><a href="{{url('add_cart',$blog->id)}}"><i class="fa-regular fa-floppy-disk" style="font-size: 25px;"></i></a></h1>
                </div>
                    <div class="bg-white border border-top-0 p-4">
                       <div class="mb-3">
                          <span style="background: #e7ee23;" class="badge text-dark badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                             >{{$category->category_name}}</span>
                             <span style="position: absolute;
                             right: 4%;">
                                <span class="text-body" href="">Date : {{$blog->created_at}}</span>
                             </span>
                       </div>
                       
                       {!!$blog->description!!}
                    </div>
                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                       <div class="d-flex align-items-center">
                        <i style="font-size: larger;
                        
                        margin-right: 5%;" class="fa-regular fa-user"></i>
                          <span style="font-weight: bold"> {{$user->name}}</span>
                       </div>
                       <div class="d-flex align-items-center">
                          <span class="ml-3"><i class="fa-regular fa-heart"></i> {{$like}} &nbsp</span>
                          <span class="ml-3"> <i class="far fa-comment mr-2"></i> {{$commentCount}}</span>
                       </div>
                    </div>
                 </div>
                 
                 <span style="font-size: x-large;">
                  <a style="text-decoration: none;" href="{{ url('add_like', $blog->id) }}">
                    <i style="    color: #23d412;" class="fa-regular fa-heart"></i>
                  </a>
                  &nbsp Like this blog
                </span>


                
                
                 <!-- Comment List Start -->
                 <div class="mb-3">
                  <div class="section-title mb-0" style="font-size: larger;
                  font-weight: bold;">
                      <h4 class="m-0 text-uppercase">{{$commentCount}} Comments</h4>
                  </div>
                  <div class="bg-white border border-top-0 p-4">
                    @foreach ($comment as $comments)
                      <div class="media mb-4">
                          
                          <div class="media-body">
                              <h6><a class="text-secondary font-weight-bold" href="">{{$comments->name}}</a> <small><i>{{$comments->created_at}}</i></small></h6>
                              <p>{{$comments->comment}}</p>
                              @if ($usertype == 1)
                                <a href="{{url('hide_comment',$comments->id)}}" class="btn btn-sm btn-outline-secondary">Hide this Comment</a>
                              @endif
                          </div>
                      </div>
                    @endforeach
                      
                  </div>
              </div>
              <!-- Comment List End -->
              <!-- Comment Form Start -->
            <div class="mb-3">
              <div class="section-title mb-0" style="font-size: larger;
              font-weight: bold;">
                  <h4 class="m-0 text-uppercase font-weight-bold">Leave a comment</h4>
              </div>
              <div class="bg-white border border-top-0 p-4">
                  <form action="{{url('add_comment')}}" method="POST" class="p-2 bg-light border rounded-3">
                    @csrf
                      <input type="hidden" name="blog_id" value="{{$blog->id}}">
                      <div class="form-group">
                          <label for="message">Message *</label>
                          <textarea name="comment" id="message" cols="30" rows="5" class="form-control"></textarea>
                      </div>
                      <div class="form-group mb-0" style="    margin-top: 2%;">
                          <input type="submit" value="Leave a comment"
                              class="btn btn-outline-primary font-weight-semi-bold py-2 px-3">
                      </div>
                  </form>
              </div>
          </div>
          <!-- Comment Form End -->
              

              </div>
              <div class="col-lg-4 mb-3" style="margin-top: 1%;">
                <div class="section-title mb-0" style="    padding-left: 3%;">
                    <h4 class="m-0 text-uppercase" style="font-size: xx-large;
                    font-weight: bold;">Related News</h4>
                </div>
                <div class="bg-white border border-top-0 p-3">
                    @foreach ($related_blog as $item)
                        
                    <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                        
                        <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                            <div class="mb-2">
                                <a class="h6 m-0 text-dark text-uppercase font-weight-bold" style="text-decoration: none;" href="{{url('read',$item->id)}}">{{substr($item->title,0,28)}}...</a>
                                {{-- <a class="text-body" href=""><small>Jan 01, 2045</small></a> --}}
                            </div>
                            <a class="p m-0 text-dark" style="text-decoration: none;" href="{{url('read',$item->id)}}">{!!substr($item->description,0,60)!!}...</a>
                        </div>
                    </div>
                    @endforeach

                    
                </div>
            </div>
            <!-- Popular News End -->
            
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
