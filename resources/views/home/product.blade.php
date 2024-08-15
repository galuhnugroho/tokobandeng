@extends('layout.home')

@section('title', 'Product')

@section('content')

<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <!-- Tombol Kembali -->
            <div class="col-12 mt-3">
                <a href="{{ url('/products') }}" class="btn btn-secondary">
                    &larr; Kembali
                </a>
            </div>
            <!-- End Tombol Kembali -->

            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="/uploads/{{$product->gambar}}" alt="Card image cap" id="product-detail">
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2" style="font-weight: bold">{{$product->nama_barang}}</h1>
                        <p class="h3 py-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>

                        <h6>Deskripsi:</h6>
                        <p>{{$product->deskripsi}}</p>
                        <h6>Bahan:</h6>
                        <p>{{$product->bahan}}</p>

                        <div class="col-auto">
                            <ul class="list-inline pb-3">
                                <h6 class="list-inline-item">Ukuran: </h6>
                                @php
                                    $sizes = explode(',', $product->ukuran);
                                @endphp

                                @foreach ($sizes as $size)
                                <input type="radio" name="sizes" id="size-{{$size}}" value="{{$size}}" class="size">
                                <label for="size-{{$size}}" style="margin-right: 20px">{{$size}}</label>
                                @endforeach
                            </ul>
                        </div>

                        <form id="product-form" method="POST">
                            @csrf
                            <input type="hidden" name="product-title" value="{{$product->nama_barang}}">
                            <input type="hidden" name="product-id" value="{{$product->id}}">
                            <input type="hidden" name="product-price" value="{{$product->harga}}">
                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                            
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Jumlah
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="btn btn-success" id="btn-minus">-</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="badge bg-secondary" id="var-value">1</span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="btn btn-success" id="btn-plus">+</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="button" class="btn btn-success btn-lg add-to-cart">Tambah Ke Keranjang</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->


@endsection

@push('js')
<script>
   $(function(){
    // Mendeklarasikan variabel yang dibutuhkan
    let quantity = parseInt($('#var-value').text());

    // Menambah event listener untuk tombol minus
    $('#btn-minus').click(function() {
        if (quantity > 1) {
            quantity--;
            $('#var-value').text(quantity);
        }
    });

    // Menambah event listener untuk tombol plus
    $('#btn-plus').click(function() {
        quantity++;
        $('#var-value').text(quantity);
    });

    // Event listener untuk tombol tambah ke keranjang
    $('.add-to-cart').click(function(e){
        e.preventDefault(); // Menghindari submit form secara default

        let id_member = {{ Auth::guard('webmember')->user()->id }};
        let id_barang = {{$product->id}};
        let jumlah = quantity;
        let size = $('input[name="sizes"]:checked').val(); // Mengambil nilai ukuran yang dipilih
        let total = {{$product->harga}} * jumlah;
        let is_checkout = 0;

        // Cek apakah size sudah dipilih
        if (!size) {
            alert("Silakan pilih ukuran terlebih dahulu!");
            return;
        }

        $.ajax({
            url: '/add_to_cart',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            data: {
                id_member: id_member,
                id_barang: id_barang,
                jumlah: jumlah,
                size: size,
                total: total,
                is_checkout: is_checkout,
            },
            success: function(data) {
                window.location.href = '/cart';
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("Terjadi kesalahan saat menambah ke keranjang.");
            }
        });
    });
});


</script>
@endpush