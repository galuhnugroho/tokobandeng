@extends('layout.home')

@section('content')

    <!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($sliders as $index => $slider)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="/uploads/{{ $slider->gambar }}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-dark" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">{{ $slider->nama_slider }}</h1>
                            <h3 class="h2">{{ $slider->deskripsi }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Optional: Carousel Controls -->
    <a class="carousel-control-prev" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
<!-- End Banner Hero -->


     <!-- Start Featured Product -->
     <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Produk Unggulan</h1>
                    <p>
                        Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        Excepteur sint occaecat cupidatat non proident.
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($products as $product)
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="/product/{{ $product->id }}">
                            <img src="/uploads/{{ $product->gambar }}" class="card-img-top" alt="{{ $product->nama_barang }}">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li class="text-muted text-right">Rp. {{ number_format($product->harga) }}</li>
                            </ul>
                            <a href="/product/{{ $product->id }}" class="h2 text-decoration-none text-dark">{{ $product->nama_barang }}</a>
                            <p class="card-text">
                                {{ $product->deskripsi}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Featured Product -->
@endsection