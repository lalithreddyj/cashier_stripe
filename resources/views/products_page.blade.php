<html><head>
    <title></title>
  </head>
  <style>
        #ProductGrid {
        display: grid;
        grid-template-columns: 100%;
        grid-gap: 15px;
        height: 80%;
        }
        #ProductGrid .item {
        padding: 10px;
        border: 1px solid #ddd;
        }
        #ProductGrid .item:nth-child(odd) { background: #f7f7f7; }

        #ProductGrid.grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        * {
        font-family: arial, sans-serif;
        box-sizing: border-box;
        }
        .center{
        margin: auto;
        width: 50%;
        padding: 10px;
        color:green;
        }
        img {
        height: 250px;
        width: 250px;
        border-radius: 50%;
        }

  </style>
  <body style="">   
  @if(Session::has('success'))
        <div class="alert alert-success" style="color:green">
            {{Session::get('success')}}
        </div>
    @endif
    <h2>Products List</h2> 
    <div id="ProductGrid" class="grid">
        @if(!empty($products_list))
            @foreach($products_list as $products_key => $product_array)
            <div class="item">
                <h3 class="center">{{$product_array['name']}}</h3>
                <img src="http://localhost/laravel_cashier_stripe/public/storage/{{$product_array['image_name']}}" alt="No_image" style="margin-left:20%">
                <h3 style="float:left;width:100%">Item Price : <span style="color:green">INR {{$product_array['price']}}</span></h3>
                <h3>Proceed to buy : <button><a href="{{url('/product_specifications').'/'.encrypt($product_array['id'])}}">Buy Now</a></button></h3>
            </div>
            @endforeach
            @else
            <h4 style="color:red">No products to display</h4>
         @endif
    </div>
  

</body></html>