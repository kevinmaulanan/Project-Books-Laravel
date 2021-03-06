@extends('Main/main')

@section('title', 'Upload Books')

@section('body')
    <div class="container mt-5 mb-5 s">

        <a href=" {{url('admin/books/create')}} " class="btn btn-primary mb-3"> Tambah Data Buku</a> 
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
      
        <div class="table-responsive">
            <table class="table ">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Book</th>
                    <th scope="col">Image</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Link</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $d)
                <tr>
                    <th scope="row"> {{ $loop->index + 1}} </th>
                    <td> {{$d->book_name}} </td>
                    <td> <img src="{{ $d->link_url_type ? $d->book_image : asset('/storage/image/'. $d->book_image) }} " height="100" width="100" alt="Image"> </td>
                    <td> {{$d->genre}}  </td>
                    <td> <p align="justify"> {{$d->book_description}}</p> </td>
                    <td><a href="{{url('admin/books/download/'. $d->id)}}">download </a></td>
                </tr>
                @endforeach
            
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <nav aria-label="...">
                <ul class="pagination">
    
                <li class="page-item  @if($pref==0) disabled @endif">     
                    <a class="page-link" href="{{url('/admin/books?page='.$pref)}}" tabindex="-1">Previous</a>
                </li>
                
                @foreach ($total as $t)
                <li class="page-item @if($t==$active) active @endif  ">
                    <a class="page-link" href="{{url('/admin/books?page='.$t)}}"> {{$t}} <span class="sr-only">(current)</span></a>
                </li>
                @endforeach

                <li class="page-item  @if($active>=$count) disabled @endif"> 
                    <a class="page-link" href="{{url('/admin/books?page='.$next)}}" >Next</a>
                </li>
                </ul>
           
            </nav>
        </div>
    

    </div>
@endsection