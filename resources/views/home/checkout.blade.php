@extends('layout.home')

@section('title', 'Checkout')

@section('content')

<section>
    <div class="container my-5">
        <h1 class="mb-4">Checkout</h1>
        <form name="checkout" class="checkout ecommerce-checkout row" method="POST" action="/payments">
            <div class="row g-3">
                @csrf
                <input type="hidden" name="id_order" value="{{$orders->id}}">
                <!-- Informasi Pengiriman -->
                <div class="col-md-6">
                    <h3>Informasi Pengiriman</h3>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Provinsi</label>
                        <select name="provinsi" id="provinsi" class="form-control provinsi"
                        rel="calc_shipping_state">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinsi->rajaongkir->results as $provinsi)
                        <option value="{{$provinsi->province_id}}">{{$provinsi->province}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Kota</label>
                        <select name="kabupaten" id="kota" class="form-control kota"
                        rel="calc_shipping_state">

                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Detail Alamat</label>
                        <input type="text" class="form-control" placeholder value name="detail_alamat"
                                    id="billing_first_name">
                    </div>
                    <div class="mb-3">
                        <label for="kode-pos" class="form-label">Atas Nama</label>
                        <input type="text" class="form-control" placeholder value name="atas_nama"
                                    id="billing_first_name">
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control" placeholder value name="no_rekening"
                                    id="billing_first_name">
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Nominal Transfer</label>
                        <input type="text" class="form-control" placeholder value name="jumlah"
                                    id="billing_first_name">
                    </div>
                </div>

                <!-- Rincian Belanja -->
                <div class="col-md-6">
                    <h3>Rincian Belanja</h3>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <div>Total</div>
                            <span class="amount">Rp{{number_format($orders->grand_total)}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <input id="payment_method_bacs" type="radio" class="input-radio"
                            name="payment_method" value="bacs" checked="checked">
                            <label for="payment_method_bacs">Direct Bank Transfer</label>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <p>No. Rekening</p>
                        </li>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                        </div>
                    
                    </ul>
                </div>
            </div>
        </form>
    </div>

</section>

@endsection

@push('js')
<script>
    $(function(){
            $('.provinsi').change(function(){
            $.ajax({
            url : '/get_kota/' + $(this).val(),
            success : function (data){
            data = JSON.parse(data)
            option = ""
            data.rajaongkir.results.map((kota)=> {
            option += `<option value=${kota.city_id}>${kota.city_name}</option>`
            })
            $('.kota').html(option)
            }
            });
            });
        })
</script>
@endpush