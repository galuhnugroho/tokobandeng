@extends('layout.home')

@section('title', 'Cart')

@section('content')

<section class="h-100 gradient-custom">
    <div class="container py-5">
      <form class="form-cart">
        <input type="hidden" name="id_member" value="{{Auth::guard('webmember')->user()->id}}">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Keranjang</h5>
            </div>
            <div class="card-body">
              <!-- Single item -->
              @foreach ($carts as $cart)
              <input type="hidden" name="id_produk[]" value="{{$cart->product->id}}">
              <input type="hidden" name="jumlah[]" value="{{$cart->jumlah}}">
              <input type="hidden" name="size[]" value="{{$cart->size}}">
              <input type="hidden" name="total[]" value="{{$cart->total}}">
              <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <!-- Image -->
                  <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="/uploads/{{$cart->product->gambar}}"
                      class="w-100" alt="{{$cart->product->nama_barang}}" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  <!-- Image -->
                </div>

                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                  <!-- Data -->
                  <p><strong>{{$cart->product->nama_barang}}</strong></p>
                  <p>Ukuran: {{$cart->size}}</p>
                  <button type="button" onclick="window.location.href='/delete_from_cart/{{$cart->id}}'" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip"
                    title="Remove item">
                    <i class="fas fa-trash"></i>
                  </button>
                  <!-- Data -->
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <!-- Quantity -->
                  <div class="d-flex mb-4" style="max-width: 300px">
                    {{-- <button class="btn btn-primary px-3 me-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                      <i class="fas fa-minus"></i>
                    </button> --}}

                    <div class="form-outline">
                      <input id="form1" min="0" name="quantity" value="{{ $cart->jumlah }}" type="number" class="form-control" />
                      <label class="form-label" for="form1">Jumlah</label>
                    </div>

                    {{-- <button class="btn btn-primary px-3 ms-2"
                      onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                      <i class="fas fa-plus"></i>
                    </button> --}}
                  </div>
                  <!-- Quantity -->

                  <!-- Price -->
                  <p class="text-start text-md-center">
                    <strong>{{ "Rp" . number_format($cart->product->harga)}}</strong>
                  </p>
                  <!-- Price -->
                </div>
              </div>
              @endforeach
              <!-- Single item -->

              <hr class="my-4" />
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-body">
                <p><strong>Perhitungan Ongkir</strong></p>
                <hr class="my-4" />

                <div class="mb-3">
                  <label for="provinsi" class="form-label">Pilih Provinsi</label>
                  <select name="provinsi" id="provinsi" class="form-select provinsi">
                      <option value="" disabled selected>Pilih Provinsi</option>
                      <!-- Options will be dynamically loaded based on selected province -->
                      @foreach ($provinsi->rajaongkir->results as $provinsi)
                      <option value="{{$provinsi->province_id}}">{{$provinsi->province}}</option>
                       @endforeach
                  </select>
              </div>
        
                <div class="mb-3">
                    <label for="kota" class="form-label">Pilih Kota</label>
                    <select name="kota" id="kota" class="form-select kota">
                        <option value="" disabled selected>Pilih Kota</option>
                        <!-- Options will be dynamically loaded based on selected province -->
                    </select>
                </div>

                <div class="mb-3">
                    <input type="text" class="input-text berat" placeholder="Berat" name="berat" id="Berat">
                </div>
        
                {{-- <!-- Dropdown for District -->
                <div class="mb-3">
                    <label for="district" class="form-label">Select District</label>
                    <select id="district" class="form-select">
                        <option value="" disabled selected>Select District</option>
                        <!-- Options will be dynamically loaded based on selected city -->
                    </select>
                </div> --}}
        
                <!-- Update Button -->
                {{-- <button type="button" class="btn btn-secondary" >Update</button> --}}
                <div class="order-total">

                  <p>
                    <a href="#" name="calc_shipping" class="btn btn-secondary update-total">
                      Update Total
                    </a>
                  </p>
                  <input type="hidden" name="grand_total" class="grand_total">
                </div>
            </div>
        </div>

        </div>
        <div class="col-md-4">
          <div class="card mb-4 cart-totals">
            <div class="card-header py-3">
              <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Produk
                  <span class="amount cart-total">Rp{{number_format($cart_total, 0, ',', '.') }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Pengiriman
                  <span class="shipping-cost">0</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Total Harga</strong>
                  </div>
                  <input type="hidden" name="grand_total" class="grand_total">
                  <strong><span class="amount grand-total">0</span></strong>
                </li>
              </ul>
            <div class="mb-3">
              <a href="#" class="btn btn-primary btn-lg btn-block checkout"> Checkout</a>
            </div>
          </div>
        </div>
      </div>
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
                    data = JSON.parse(data);
                    let options = "";
                    data.rajaongkir.results.map((kota)=> {
                        options += `<option value="${kota.city_id}">${kota.city_name}</option>`;
                    });
                    $('.kota').html(options);
                }
            });
        });

        $('.update-total').click(function(e){
            e.preventDefault();
            $.ajax({
                url : '/get_ongkir/' + $('.kota').val() + '/' + $('.berat').val(),
                success : function (data){
                    data = JSON.parse(data);

                    let shippingCost = parseInt(data.rajaongkir.results[0].costs[0].cost[0].value);
                    let cartTotal = parseInt($('.cart-total').text().replace(/[^0-9]/g, '')); // Remove non-numeric characters
                    let grandTotal = shippingCost + cartTotal;

                    $('.shipping-cost').text("Rp" + shippingCost.toLocaleString('id-ID')); // Format currency
                    $('.grand-total').text("Rp" + grandTotal.toLocaleString('id-ID')); // Format currency
                    $('.grand_total').val(grandTotal);
                }
            });
        });

      $('.checkout').click(function(e){
            e.preventDefault();
            $.ajax({
                url : '/checkout_orders',
                method : 'POST',
                data : $('.form-cart').serialize(),
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                success : function(response){
                    location.href = '/checkout?id=' + response.id;
                }
            });
        });
    });
</script>
@endpush
