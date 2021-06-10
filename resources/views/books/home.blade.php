@extends('Main/main')

@section('title','Home Book')
    
@section('body')

<div style="padding-top: 10px; padding-bottom:10px; background-color: #f1f1f1" >
    <div class="container bg-color-white">
      <div style="background-color: white">
        <div class="row" style="padding: 30px 30px; margin-top: -10px" >
          <div class="col-lg-9">
            <div class="row" style="width: 95%">
              <h2>Latest Update </h2>
              <hr style="size: 10px; border: 1px solid #198ef3; width: 100%">
              @foreach($data as $da)
              <div class="col-lg-11">
                <div class="media mt-1 mb-1">
                    <img src="{{ $da->link_url_type ? $da->book_image : asset('/storage/image/'. $da->book_image) }} " height="200" width="200" class="align-self-center mr-3" alt="Responsive image">
                    <div class="media-body">
                      <h5 class="mt-0"> {{$da->book_name}} </h5>
      
                        <i class="fa fa-eye fa-1x" style="color:rgb(173, 173, 173)"> 
                          {{ $da->view }}
                          dilihat
                        </i>
                      
                        <i class="fa fa-download fa-1x" style="color:rgb(173, 173, 173); margin-left:20px;"> 
                          {{ $da->download }}
                          didownload
                        </i>
                        <p class="mt-1 text-justify">{{substr($da->book_description,0,300)}} 
                          <a href="{{url('/book/' . $da->id_book )}}">Lihat selanjutnya</a>
                        </p>
                    </div>
                </div>
                <hr>
              </div>
              @endforeach
            </div>
          </div>
          <div class="col-lg-3 ">
            <p class="font-weight-bold" style="font-size: 16px">Most Popular View</p>
            @foreach($book_popular_view as $bpv)
            <div class="mb-2" style="background-color: {{ $loop->index % 2 == 0 ? '#f4f4f4' : null }}; padding: 1px 0 5px 0">
              <img src="{{ $bpv->link_url_type ? $bpv->book_image : asset('/storage/image/'. $bpv->book_image) }} " height="50" width="50" class="mr-1 ml-1 d-inline-block">
              <div class=" d-inline-block">
                <a href="{{url('/book/' . $bpv->id_book )}}" class="font-weight-bold p-0 m-0" style="font-size: 12px; color: #198ef3;"> {{ $bpv->book_name }} </a>
                <p class="p-0 m-0" style="color: #198ef3; font-size: 12px"> {{ $bpv->genre }} </p>
              </div>
            </div>
            @endforeach
            
            <br>
            <p class="font-weight-bold mt-2" style="font-size: 16px; ">Most Popular Download</p>
            @foreach($book_popular_download as $bpd)
            <div class="mb-2" style="background-color: {{ $loop->index % 2 == 0 ? '#f4f4f4' : null }}; padding: 1px 0 5px 0">
              <img src="{{ $bpd->link_url_type ? $bpd->book_image : asset('/storage/image/'. $bpd->book_image) }} " height="50" width="50" class="mr-1 ml-1 d-inline-block">
              <div class=" d-inline-block">
                <a href="{{url('/book/' . $bpd->id_book )}}" class="font-weight-bold p-0 m-0" style="font-size: 12px; color: #198ef3;"> {{ $bpd->book_name }}</a>
                <p class="p-0 m-0" style="color: #198ef3; font-size: 12px"> {{ $bpd->genre }} </p>
              </div>
            </div>
            @endforeach
          </div>
  
        </div>
        <div class="mt-3 pb-4" >
          <nav aria-label="..." >
              <ul class="pagination justify-content-center" style="align-self: center">
              
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
</div>

@endsection