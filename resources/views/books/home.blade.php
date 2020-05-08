@extends('Main/main')

@section('title','Home Book')
    
@section('body')

<div style="margin-top: 10px; margin-bottom:10px">
    <div class="container">

      <div class="row">

        @foreach($data as $da)
        <div class="col-lg-9">
          <div class="media mt-4 mb-5">
              <img src="{{asset('/storage/image/'. $da->book_image)}}" height="200" width="200" class="align-self-center mr-3" alt="Responsive image">
              <div class="media-body">
                <h5 class="mt-0"> {{$da->book_name}} </h5>

                    <i class="fa fa-eye fa-1x" style="color:rgb(173, 173, 173)"> 
                      @foreach($view as $v)
                        @if($v->id_book==$da->id) {{$v->view}} @endif 
                      @endforeach
                      Lihat
                    </i>
                  
                    <i class="fa fa-download fa-1x" style="color:rgb(173, 173, 173); margin-left:20px;"> 
                      @foreach($download as $d)
                        @if($d->id_book==$da->id) {{$d->download}}@endif 
                      @endforeach
                      download
                    </i>
                  <p style="margin-top: 10px;">{{substr($da->book_description,0,300)}}</p>
              
              </div>
          </div>
        </div>
        @endforeach

      </div>

      <div class="mt-3" >
        <nav aria-label="..." >
            <ul class="pagination" style="align-self: center">
            
            <li class="page-item  @if($pref==0) disabled @endif">  
                <a class="page-link" href="{{url('?page='.$pref)}}" tabindex="-1">Previous</a>
            </li>
            
            @foreach ($total as $t)
            <li class="page-item @if($t==$active) active @endif  ">
                <a class="page-link" href="{{url('?page='.$t)}}"> {{$t}} <span class="sr-only">(current)</span></a>
            </li>
            @endforeach

            <li class="page-item  @if($active>=$count) disabled @endif"> 
                <a class="page-link" href="{{url('?page='.$next)}}" >Next</a>
            </li>
            </ul>
         
        </nav>
      </div>
       
    </div>

    
</div>

@endsection