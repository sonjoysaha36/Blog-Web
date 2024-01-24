<div class="" style="margin-left: 2%; margin-right: 2%">
  <div class="row" style="margin-top: 15px;">
    <div class="col-md-12">
      <h2 style="margin-bottom: 1%; font-size: 1.5rem; font-family: SFProDisplaySemibold; text-align: center;">
        All <b>Categories</b>
      </h2>
      <div style="text-align: center; color: red;" id="timer"></div>
      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
        <div class="carousel-inner">
          @php $count = 0; @endphp
          @foreach ($data as $flashsell)
            @if ($count % 4 == 0)
              <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                <div class="row">
            @endif
            <div class="col-sm-3 my-1">
              <a href="#" class="card-link" style="    color: black; text-decoration: none;">
              <div class="card-wrapper container-sm d-flex justify-content-around">
                <div class="card" style="width: 18rem;">
                  <img style="padding: 5px; height: 168px;" src="/category_picture/{{ $flashsell->image }}" class="card-img-top" alt="...">
                  <div class="card-img-overlay d-flex align-items-center justify-content-center">
                    <h5 style="background: #dbdada;
                    padding: 5px;
                    border-radius: 12px;" class="card-title text-center">{{$flashsell->category_name}}</h5>
                  </div>
                </div>
              </div>
              </a>
            </div>
            
            @php $count++; @endphp
            @if ($count % 4 == 0 || $loop->last)
                </div>
              </div>
            @endif
            
          @endforeach
          
        </div>
        <a class="carousel-control-prev" href="#myCarousel" style="background:#a0a8a8; border-radius: 50%;" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" style="background:#a0a8a8; border-radius: 50%;" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $(".wish-icon i").click(function() {
      $(this).toggleClass("fa-heart fa-heart-o");
    });
    
    // Automatically scroll the carousel after 2 seconds
    setInterval(function() {
      $("#myCarousel").carousel("next");
    }, 5000);
  });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
