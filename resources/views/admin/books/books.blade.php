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
                    <td> {{$d->book_description}} </td>
                    <td> <img src=" {{asset('/storage/image/'.$d->book_image)}}" height="100" width="100" alt="Image"> </td>
                    <td><a href="{{url('admin/books/download?books='.$d->id)}}">download </a></td>
                </tr>
                @endforeach
            
                </tbody>
            </table>
        </div>
    </div>
@endsection