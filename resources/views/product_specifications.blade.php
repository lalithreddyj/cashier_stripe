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

        #ProductGrid.grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
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
    <h2>Item Description</h2> 
    <div id="ProductGrid" class="grid">
        @if(!empty($select_product))
            @foreach($select_product as $sel_products_key => $sel_product_array)
            <div class="item">
                <h3 class="center">{{$sel_product_array['name']}}</h3>
                <img src="http://localhost/laravel_cashier_stripe/public/storage/{{$sel_product_array['image_name']}}" alt="No_image" style="margin-left:20%">
                <h3 style="float:left;width:100%">Item Price : <span style="color:green">INR {{$sel_product_array['price']}}</span></h3>
                <h3>Product Description : <span style="color:green"> {{$sel_product_array['description']}}</h3>
            </div>
            @endforeach
            <div class="item">
                @php
                $stripe_key = 'pk_test_51LP58ASAPswXMX1o1TZOLQFcJKGdLMFmTfJGOnqsFP8yi0zviGh9esQf4vRhVTKZiE23PjyAO82sAhJTsWRdJnUX00GSU0kXFP';
                @endphp
                <div class="container" style="margin-top:10%;margin-bottom:10%">
                    <div class="row justify-content-center">
                        <h2>Proceed to check out</h2>
                        <div class="col-md-12">
                            <div class="">
                                <p>Your Total Amount is - {{$select_product[0]['price']}} </p>
                            </div>
                            <div class="card">
                                <form action="{{route('checkout.credit-card')}}"  method="post" id="payment-form">
                                    @csrf                    
                                    <div class="form-group">
                                        <div class="card-header">
                                            <label for="card-element">
                                                Enter your credit card information
                                            </label>
                                        </div>
                                        <div class="card-body">
                                            <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                            <!-- Used to display form errors. -->
                                            <div id="card-errors" role="alert"></div>
                                            <input type="hidden" name="plan" value="" />
                                        </div>
                                    </div>
                                    <div class="card-body"><button id="card-button" style="width:10%;margin-top:40px" class="btn btn-dark" type="submit" data-secret="{{ $intent }}"> Pay </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://js.stripe.com/v3/"></script>
            <script>
                    // Custom styling can be passed to options when creating an Element.
                    // (Note that this demo uses a wider set of styles than the guide below.)

                    var style = {
                        base: {
                            color: '#32325d',
                            lineHeight: '18px',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',
                            fontSize: '16px',
                            '::placeholder': {
                                color: '#aab7c4'
                            }
                        },
                        invalid: {
                            color: '#fa755a',
                            iconColor: '#fa755a'
                        }
                    };
                    
                    const stripe = Stripe('{{ $stripe_key }}', { locale: 'en' }); // Create a Stripe client.
                    const elements = stripe.elements(); // Create an instance of Elements.
                    const cardElement = elements.create('card', { style: style }); // Create an instance of the card Element.
                    const cardButton = document.getElementById('card-button');
                    const clientSecret = cardButton.dataset.secret;
                    
                    cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.
                    
                    // Handle real-time validation errors from the card Element.
                    cardElement.addEventListener('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });
                    
                    // Handle form submission.
                    var form = document.getElementById('payment-form');
                    
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        
                        stripe.handleCardPayment(clientSecret, cardElement, {
                            payment_method_data: {
                                //billing_details: { name: cardHolderName.value }
                            }
                        })
                        .then(function(result) {
                            console.log(result);
                            if (result.error) {
                                // Inform the user if there was an error.
                                var errorElement = document.getElementById('card-errors');
                                errorElement.textContent = result.error.message;
                            } else {
                                console.log(result);
                                form.submit();
                            }
                        });
                    });
                </script>
            </div>
            @else
            <h4 style="color:red">Selected item was removed, we will notify once the item available</h4>
         @endif
    </div>
  

</body></html>