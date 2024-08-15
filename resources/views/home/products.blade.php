@extends('layout.home')

@section('title', 'List Products')
    
@section('content')

<section>
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="/uploads/{{$product->gambar}}" alt="{{$product->nama_barang}}">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white mt-2" href="/product/{{$product->id}}"><i class="far fa-eye"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body" style="text-align: center;">
                                <a href="/product/{{$product->id}}" class="h3 text-decoration-none">{{$product->nama_barang}}</a>
                                <p class="text-center mb-0">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
</section>


@endsection