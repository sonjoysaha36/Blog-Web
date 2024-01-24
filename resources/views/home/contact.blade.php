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
    <div class="container" style="margin-top: 2%">
      <div class="row">
        <div class="col">
          <div class="card mb-5">
            <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Contact Us.
            </div>
            <div class="card-body">
              <form action="{{url('feedback')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp"
                    placeholder="Enter name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                    placeholder="Enter email" required>
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                    anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" name="message" id="message" rows="6" required></textarea>
                </div>
                <div class="mx-auto">
                  <button type="submit" class="btn btn-primary text-right">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-4">
          <div class="card bg-light mb-3">
            <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address
            </div>
            <div class="card-body">
              <p>Malibagh, Dhaka</p>
              <p>451 Golbagh</p>
              <p>Bangladesh</p>
              <p>Email : blogweb@gmail.com</p>
              <p>Tel. +88 01 95 21 96 50 3</p>
  
            </div>
  
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
