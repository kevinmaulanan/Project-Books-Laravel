@extends('main/mainadmin')
@section('title', 'Tambah Books')
    
@section('body')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Form Create Books</h1>

            <form method="post" action="{{url('/admin/books/create')}} " enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="nama">Name Books</label>
                  <input type="text" class="form-control @error('book') is-invalid @enderror" id="book" placeholder="Input Name Buku" name="book">
                  @error('book')
                  <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description"  @error('description') is-invalid @enderror" id="validationTextarea" placeholder="Input Description Book"></textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="inputState">Genre</label>
                    <select id="inputState" name="genre" class="form-control">
                      @foreach($genres as $g)
                        <option value={{ $g->id }}> {{ $g->genre }} </option>
                      @endforeach
                    </select>
                  </div>

                <div class="form-group">
                    <label for="image">Input Image Books</label>
                    <input type="file" name="image" class="form-control-file @error('image') is-invalid-file @enderror"  >
                    @error('image')
                    <div class="invalid-file-feedback text-danger">{{ $message }}</div>
                      @enderror
                </div>

                <div class="form-group">
                    <label for="filepdf">Input File Books</label>
                    <input type="file" name="filepdf" class="form-control-file @error('file') is-invalid-file @enderror"  >
                    @error('filepdf')
                    <div class="invalid-file-feedback text-danger">{{ $message }}</div>
                      @enderror
                </div>

               <button type="submit" class="btn btn-primary">Create Data Book</button>
            </form>
        </div>
    </div>
</div>
@endsection

