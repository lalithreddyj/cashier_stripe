<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductsController extends Controller
{
    //
    public function __construct(){

    }
    public function index(){
        $products_list = Product::select(
            'id',
            'name',
            'price',
            'description',
            'image_name'
        )->get()->toArray();
        
        return view('products_page',compact('products_list'));
    }

    public function product_specifications($id=null){
    //    echo decrypt($id);
    // print_r(Auth::user()->name);exit;
       $select_product = Product::select(
        'id',
        'name',
        'price',
        'description',
        'image_name'
    )->where('id',decrypt($id))
    ->get()->toArray();
    // print_r($select_product);
    // Enter Your Stripe Secret
    \Stripe\Stripe::setApiKey('sk_test_51LP58ASAPswXMX1o7Fp70yvADE3YDSRdIcsPh2unhamE50B6VUAKeUhh0VXK766IQ8ldXMWktW2LXjeM9CypnURF00mSUtSTP3');
  
    $payment_intent = \Stripe\PaymentIntent::create( [
        'description' => $select_product[0]['description'],
        'shipping' => [
          'name' => 'Jenny Rosen',
          'address' => [
            'line1' => '510 Townsend St',
            'postal_code' => '98140',
            'city' => 'San Francisco',
            'state' => 'CA',
            'country' => 'US',
          ],
        ],
        'amount' => $select_product[0]['price'],
        'currency' => 'USD',
        'payment_method_types' => ['card'],
      ]);
    $intent = $payment_intent->client_secret;
    return view('product_specifications',compact('select_product','intent'));
    }
    public function afterPayment()
    {
      session::flash('success','Payment successful for the Item!');
        return redirect('/products');
    }
}
