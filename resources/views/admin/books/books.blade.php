@extends('main.main')

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
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Link</th>
                </tr>
                </thead>
                <tbody>

                @foreach($data as $d)
                <tr>
                    <th scope="row">1</th>
                    <td> {{$d->book_name}} </td>
                    <td> <p align="justify"> {{$d->book_description}}</p> </td>
                    <td> <img src=" {{asset('/storage/image/'.$d->book_image)}}" height="100" width="100" alt="Image"> </td>
                    <td><a href="{{url('admin/books/download?books='.$d->book_link)}}">download </a></td>
                </tr>
                @endforeach
            
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            <nav aria-label="...">
                <ul class="pagination">
    
                <li class="page-item">     
                    <a class="page-link" href="{{url('/students/image?page='.$pref)}}" tabindex="-1">Previous</a>
                </li>
                
                @foreach ($total as $t)
                <li class="page-item @if($t==$active) active @endif  ">
                    <a class="page-link" href="{{url('/students/image?page='.$t)}}"> {{$t}} <span class="sr-only">(current)</span></a>
                </li>
                @endforeach
                    <a class="page-link @if($next>=$active) disable @endif" href="{{url('/students/image?page='.$next)}}" >Next</a>
                </li>
                </ul>
           
            </nav>
        </div>
    

    </div>
@endsection