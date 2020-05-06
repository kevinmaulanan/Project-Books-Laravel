@extends('Main/main')


@section('title','Home Book')
    
@section('body')

<div style="margin-top: 10px; margin-bottom:10px">
    <div class="container">
        <div class="media">
            <img src=" {{asset('/storage/image/default.png')}} " class="align-self-center mr-3" alt="Responsive image">
            <div class="media-body">
                <h5 class="mt-0">Center-aligned media</h5>
                <i class="fa fa-eye fa-1x" style="color:rgb(173, 173, 173)"> Lihat</i>
                <i class="fa fa-download fa-1x" style="color:rgb(173, 173, 173); margin-left:20px;"> download</i>
        
        
              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
              <p class="mb-0">Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            </div>
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