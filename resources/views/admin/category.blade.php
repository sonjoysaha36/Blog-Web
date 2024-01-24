<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4c44cda4ea.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <style>
      .div_center{
        text-align: center;
        padding-top: 40px;
        color: white;
      }
      .div_center_form{
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
      .h2_font{
        font-size: 40px;
        padding-bottom: 40px;
      }
      .input_color{
        color: black;
      }
      .resize{
        width: 80px;
        height: 80px;
        padding: 4px;
        border-radius: 10%;
      }
      .scrollable-table {
          max-height: 300px;
          overflow-y: scroll;
        }
    </style>
</head>
  <body>
    <div class="row min-vh-100">
        {{-- sidebar --}}
        @include('admin.sidebar')
        <div class="col-md-10">
          {{-- navbar --}}
           @include('admin.navbar') 
           @if(session()->has('message'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session()->get('message')}}
                <button type="button" class="btn-close btn-success" data-bs-dismiss="alert" aria-label="Close">X</button>
              </div>
              @endif
            <div class="row min-vh-100 bg-black">
              
              
              <div class="div_center">
                <h2 class="h2_font">Add Category</h2>
                <form action="{{url('add_category')}}" method="POST" enctype="multipart/form-data" class="col-md-5 div_center_form">
                  @csrf
                  <div class="mb-3">
                    <label for="title" class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category" id="" placeholder="Write course title" required>
                  </div>
                  
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Category Image Here</label>
                    <input class="form-control" type="file" name="image" required id="formFile">
                  </div>
                  
                  
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <div class="scrollable-table">
                <table class="table table-dark table-striped">
                  <tr>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  {{-- {{dd($data);}} --}}
                  @foreach ($data as $data)
                  <tr>
                    <td>{{$data->category_name}}</td>
                    <td>
                      <img class="resize bg-white" src="/category_picture/{{$data->image}}" alt="">
                    </td>
                    <td><a onclick="return confirm('Are You Sure To Delete This')" class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a></td>
                  </tr>
                  @endforeach
                </table>
              </div>
                             
            </div>
              
          </div>

    </div> 
        <div class="container-fluid bg-dark text-light ">
            <p class="text-center mb-0">Copyright Blogweb 2023 | All right reserved</p>
        </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>