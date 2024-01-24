<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4c44cda4ea.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    
    
    <style>
      .div_center{
        text-align: center;
        padding-top: 40px;
        color: white;
      }
      .h2_font{
        font-size: 40px;
        padding-bottom: 40px;
      }
      .input_color{
        color: black;
      }
      .resize{
        height: 80px;
        border-radius: 10%;
      }
      .scrollable-table {
          max-height: 600px;
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
              <div class="scrollable-table" style="margin-top: 10px;">
                <table class="table table-dark table-striped align-middle ">
                  <tr>
                      <th>Blog Title</th>
                      <th>Blog Description</th>
                      
                      <th>Approve Blog</th>
                      
                      <th>image</th>
                      <th>Action</th>
                  </tr>
                  @foreach ($data as $item)
                  <tr>
                      <td>{{ $item->title }}</td>
                      <td>{!! substr($item->description, 0, 150) !!}...</td>
                      
                      <td>
                          <!-- Add a hidden input field to store the item ID -->
                          <input type="hidden" name="item_id" value="{{ $item->id }}">
                          <!-- Use a checkbox with a unique ID for each row -->
                          <div class="form-check form-switch">
                              <input class="form-check-input feature-toggle" type="checkbox" role="switch" id="featureToggle{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                              <!-- Label for the switch -->
                              <label class="form-check-label" for="featureToggle{{ $item->id }}"></label>
                          </div>
                      </td>
                      
                    
                      <td>
                          <img class="resize" src="/blog_picture/{{ $item->image }}" alt="">
                      </td>
                      <td>
                          <div class="d-flex">
                              <a href="{{ url('edit_product', $item->id) }}"><?xml version="1.0" ?><svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></a>
                              <a onclick="return confirm('Are You Sure To Delete This')" class="ms-1" href="{{ url('delete_blog', $item->id) }}"><svg fill="#FFFFFF" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                width="24px" height="24px" viewBox="0 0 482.428 482.429"
                                xml:space="preserve">
                             <g>
                               <g>
                                 <path d="M381.163,57.799h-75.094C302.323,25.316,274.686,0,241.214,0c-33.471,0-61.104,25.315-64.85,57.799h-75.098
                                   c-30.39,0-55.111,24.728-55.111,55.117v2.828c0,23.223,14.46,43.1,34.83,51.199v260.369c0,30.39,24.724,55.117,55.112,55.117
                                   h210.236c30.389,0,55.111-24.729,55.111-55.117V166.944c20.369-8.1,34.83-27.977,34.83-51.199v-2.828
                                   C436.274,82.527,411.551,57.799,381.163,57.799z M241.214,26.139c19.037,0,34.927,13.645,38.443,31.66h-76.879
                                   C206.293,39.783,222.184,26.139,241.214,26.139z M375.305,427.312c0,15.978-13,28.979-28.973,28.979H136.096
                                   c-15.973,0-28.973-13.002-28.973-28.979V170.861h268.182V427.312z M410.135,115.744c0,15.978-13,28.979-28.973,28.979H101.266
                                   c-15.973,0-28.973-13.001-28.973-28.979v-2.828c0-15.978,13-28.979,28.973-28.979h279.897c15.973,0,28.973,13.001,28.973,28.979
                                   V115.744z"/>
                                 <path d="M171.144,422.863c7.218,0,13.069-5.853,13.069-13.068V262.641c0-7.216-5.852-13.07-13.069-13.07
                                   c-7.217,0-13.069,5.854-13.069,13.07v147.154C158.074,417.012,163.926,422.863,171.144,422.863z"/>
                                 <path d="M241.214,422.863c7.218,0,13.07-5.853,13.07-13.068V262.641c0-7.216-5.854-13.07-13.07-13.07
                                   c-7.217,0-13.069,5.854-13.069,13.07v147.154C228.145,417.012,233.996,422.863,241.214,422.863z"/>
                                 <path d="M311.284,422.863c7.217,0,13.068-5.853,13.068-13.068V262.641c0-7.216-5.852-13.07-13.068-13.07
                                   c-7.219,0-13.07,5.854-13.07,13.07v147.154C298.213,417.012,304.067,422.863,311.284,422.863z"/>
                               </g>
                             </g>
                             </svg></a>
                             <a href="{{ url('details', $item->id) }}" class="ms-1"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg">
                              <path d="M17 4H17.2C18.9913 4 19.887 4 20.4435 4.5565C21 5.11299 21 6.00866 21 7.8V8M17 20H17.2C18.9913 20 19.887 20 20.4435 19.4435C21 18.887 21 17.9913 21 16.2V16M7 4H6.8C5.00866 4 4.11299 4 3.5565 4.5565C3 5.11299 3 6.00866 3 7.8V8M7 20H6.8C5.00866 20 4.11299 20 3.5565 19.4435C3 18.887 3 17.9913 3 16.2V16" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round"/>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8149 12C18.8149 11.4637 18.6892 11.2462 18.4379 10.8112C17.5834 9.33247 15.6561 7 12 7C8.34395 7 6.41664 9.33247 5.56212 10.8112C5.31077 11.2462 5.18509 11.4637 5.18509 12C5.18509 12.5363 5.31077 12.7538 5.56212 13.1888C6.41664 14.6675 8.34395 17 12 17C15.6561 17 17.5834 14.6675 18.4379 13.1888C18.6892 12.7538 18.8149 12.5363 18.8149 12ZM12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3432 9 9.00001 10.3431 9.00001 12C9.00001 13.6569 10.3432 15 12 15Z" fill="#FFFFFF"/>
                              </svg></a>
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </table>
              
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      var toggleSwitches = document.querySelectorAll('.feature-toggle');
                      toggleSwitches.forEach(function(toggleSwitch) {
                          toggleSwitch.addEventListener('change', function() {
                              var productID = toggleSwitch.closest('tr').querySelector('[name="item_id"]').value;
                              var isFeature = toggleSwitch.checked ? 1 : 0; // Convert true/false to 1/0
                              var data = {
                                  _token: '{{ csrf_token() }}',
                                  status: isFeature
                              };
                              axios.patch('/products/' + productID + '/toggle-feature', data)
                                  .then(function(response) {
                                      // Handle the response, e.g., update the UI based on the new feature status
                                      console.log(response.data);
                                      Swal.fire({
                                      icon: 'success',
                                      title: 'Success',
                                      text: 'Status updated successfully.',
                                      showConfirmButton: false,
                                      timer: 1500
                                    });
                                  })
                                  .catch(function(error) {
                                      // Handle the error
                                      console.error(error);
                                      Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'An error occurred while updating the Status.',
                                        showConfirmButton: false,
                                        timer: 1500
                                      });
                                  });
                          });
                      });
                  });

              </script>
              
              
                
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