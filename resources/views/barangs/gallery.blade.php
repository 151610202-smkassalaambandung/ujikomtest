<!DOCTYPE html>
<html>
<head>


    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="{{asset('/css/thumbnail-gallery.css')}}">

</head>
<body>

<div class="container gallery-container">


    <p class="page-description text-center"><h1>FURNITURE</h1></p>
    
    <div class="tz-gallery">

        <div class="row">
            @php
            use App\Barang;
            $barang = Barang::paginate(6);
            @endphp
            @foreach($barang as $data)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    @if(isset($data->cover) && $data->cover != null)
                    <a class="lightbox" href="{{url('img/'.$data->cover)}}">
                        <img src="{{asset('img/'.$data->cover)}}" alt="{{$data->name}}">
                    </a>
                    @else
                    <a class="lightbox" href="{{url('img/no-picture.png')}}">
                        <img src="{{asset('img/no-picture.jpg')}}" alt="no-picture">
                    </a>
                    @endif
                    <div class="caption">
                        <h3>{{$data->nama_barang}}</h3>
                        <p>Rp.{{$data->harga}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="row">
            <center>
                <div class="col-md-12">
                    {!! $barang->render() !!}
                </div>
            </center>
        </div>

    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
</body>
</html>