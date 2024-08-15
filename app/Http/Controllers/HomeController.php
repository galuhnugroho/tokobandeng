<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        $products = Product::skip(0)->take(1)->get();
        return view('home.index', compact('sliders', 'products'));
    }

    public function products(){
        $products = Product::all();
        return view('home.products', compact('products'));
    }

    public function add_to_cart(Request $request)
    {
        $input = $request->all();
        Cart::create($input);
    }

    public function delete_from_cart(Cart $cart)
    {
        $cart->delete();
        return redirect('/cart');
    }

    public function product($id_product){
        $product = Product::find($id_product);
        return view('home.product', compact('product'));
    }

    public function cart()
    {
        if (!Auth::guard('webmember')->user()) {
            return redirect('/login_member');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ffa09c76e419e5df58d7427ffea8a563"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $provinsi = json_decode($response);

        $carts = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout', 0)->get();
        $cart_total = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout', 0)->sum('total');

        return view('home.cart', compact('carts', 'provinsi', 'cart_total'));
    }

    public function get_kota($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=10",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ffa09c76e419e5df58d7427ffea8a563"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function get_ongkir($destination, $weight)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=344&destination=" . $destination . "&weight=" . $weight . "&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: ffa09c76e419e5df58d7427ffea8a563"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    public function checkout_orders(Request $request)
    {
        $id = DB::table('orders')->insertGetId([
            'id_member' => $request->id_member,
            'invoice' => date('ymds'),
            'grand_total' => $request->grand_total,
            'status' => 'Baru',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        for ($i = 0; $i < count($request->id_produk); $i++) {
            DB::table('order_details')->insert([
                'id_order' => $id,
                'id_produk' => $request->id_produk[$i],
                'jumlah' => $request->jumlah[$i],
                'size' => $request->size[$i],
                'total' => $request->total[$i],
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        Cart::where('id_member', Auth::guard('webmember')->user()->id)->update([
            'is_checkout' => 1
        ]);

        return response()->json([
            'success' => true,
            'id' => $id
        ]);
    }

    public function checkout()
    {
        $orders = Order::where('id_member', Auth::guard('webmember')->user()->id)->where('id',request()->query('id'))->first();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: ffa09c76e419e5df58d7427ffea8a563"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $provinsi = json_decode($response);

        return view('home.checkout', compact('orders', 'provinsi'));
    }

    public function payments(Request $request)
    {
        Payment::create([
            'id_order' => $request->id_order,
            'jumlah' => $request->jumlah,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => "",
            'detail_alamat' => $request->detail_alamat,
            'status' => 'MENUNGGU',
            'no_rekening' => $request->no_rekening,
            'atas_nama' => $request->atas_nama,
        ]);

        return redirect('/orders');
    }


    public function orders(){
        $orders = Order::where('id_member', Auth::guard('webmember')->user()->id)->get();
        $payments = Payment::whereIn('id_order', $orders->pluck('id')->toArray())->get();
        return view('home.orders', compact('orders', 'payments'));
    }

    public function pesanan_selesai(Order $order)
    {
        $order->status = 'Selesai';
        $order->save();

        return redirect('/orders');
    }

    public function about(){
        return view('home.about');
    }
    
    public function profile(){
        return view('home.profile');
    }
}
