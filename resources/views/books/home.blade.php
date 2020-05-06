@extends('Main/main')


@section('title','Home Book')
    
@section('body')

<div style="margin-top: 10px; margin-bottom:10px">
    <div class="container">

      <div class="row">
        @foreach($data as $d)
        <div class="col-lg-9">
          <div class="media mt-4 mb-5">
              <img src="{{asset('/storage/image/'. $d->book_image)}}" height="200" width="200" class="align-self-center mr-3" alt="Responsive image">
              <div class="media-body">
                <h5 class="mt-0"> {{$d->book_name}} </h5>
                  <i class="fa fa-eye fa-1x" style="color:rgb(173, 173, 173)"> Lihat</i>
                  <i class="fa fa-download fa-1x" style="color:rgb(173, 173, 173); margin-left:20px;"> download</i>
                <p style="margin-top: 10px;">{{ substr($d->book_description,0,300)}}</p>
              
              </div>
          </div>
        </div>
        @endforeach
      </div>
       
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
    </nav>
</div>

@endsection