@extends('Main/main')

@section('title','Home Book')
    
@section('body')

<div class="mb-5" style="padding-top: 10px; padding-bottom:10px; background-color: #f1f1f1" >
    <div class="container bg-color-white">
      <div style="background-color: white">
        <div class="row" style="padding: 30px 30px; margin-top: -10px" >
            <div class="col-lg-9">
                <div style="width: 94%">
                    <div class="media-body">
                        <h5 class="mt-0"> {{$book_detail->book_name}} </h5>
        
                        <i class="fa fa-eye fa-1x" style="color:rgb(173, 173, 173)"> 
                        {{ $book_detail->view }}
                        dilihat
                        </i>
                    
                        <i class="fa fa-download fa-1x" style="color:rgb(173, 173, 173); margin-left:20px;"> 
                        {{ $book_detail->download }}
                        didownload
                        </i>
                        <hr style="size: 10px; border: 1px solid #198ef3; width: 100%">
                        <img src="{{ $book_detail->link_url_type ? $book_detail->book_image : asset('/storage/image/'. $book_detail->book_image) }} " class="img-judul mt-2 mb-2">
                        <p class="font-weight-bold">Siponisis {{ $book_detail->book_name }} : </p> 
                        <p class="mt-3 text-justify">{{ $book_detail->book_description }} </p>
                    </div>
                    <a href="{{url('admin/books/download/'. $book_detail->id_book)}}" class="btn btn-primary" style="width:100%"><i class="fa fa-download"></i> Download File</a>
                </div>
            </div>


                {{-- Most Popular Books Recommended --}}
            <div class="col-lg-3 ">
                <p class="font-weight-bold" style="font-size: 16px">Most Popular View</p>
                @foreach($book_popular_view as $bpv)
                <div class="mb-2" style="background-color: {{ $loop->index % 2 == 0 ? '#f4f4f4' : null }}; padding: 1px 0 5px 0">
                <img src="{{ $bpv->link_url_type ? $bpv->book_image : asset('/storage/image/'. $bpv->book_image) }} " height="50" width="50" class="mr-1 ml-1 d-inline-block">
                <div class=" d-inline-block">
                    <a href="{{url('/book/' . $bpv->id_book )}}" class="font-weight-bold p-0 m-0" style="font-size: 12px; color: #198ef3;"> {{ $bpv->book_name }}</a>
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
                    <a href="{{url('/book/' . $bpd->id_book )}}" class="font-weight-bold p-0 m-0" style="color: #198ef3; font-size: 12px;"> {{ $bpd->book_name }}</a>
                    <p class="p-0 m-0" style="color: #198ef3; font-size: 12px"> {{ $bpd->genre }} </p>
                </div>
                </div>
                @endforeach
            </div>
        </div>  
    </div>
</div>

    <style>
        .img-judul {
            height: 700px;
            width: 100%;
        }
    </style>
@endsection