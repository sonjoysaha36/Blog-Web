<h2 class="mt-2" style="margin-bottom: 1%; font-size: 1.5rem; font-family: SFProDisplaySemibold; text-align: center;">
  POPULAR <b>BLOGS</b>
</h2>
  <div class="mt-2" style="margin-left: 3%; margin-right: 3%;">
  
    <div class="row">
      @foreach ($blogs as $item)
      
      <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
        <a style="text-decoration: none;
        color: black;" href="{{url('read',$item->id)}}">
          <div class="card card-block" style="padding-left: 5px; padding-right: 5px;">
            
              <img style="border-radius: 5px; padding-top: 3px; height: 150px; width: 100%;" src="/blog_picture/{{ $item->image }}" alt="Photo of this blog">
              {{-- <div class="card-img-overlay d-flex align-items-start justify-content-end">
                <h1 style="background: #dbdada; padding: 5px; border-radius: 12px;" class="card-title"><a href="{{url('add_cart',$item->id)}}"><i class="fa-regular fa-floppy-disk" style="font-size: 25px;"></i></a></h1>
              </div> --}}
            
            
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
    
  </div>
  