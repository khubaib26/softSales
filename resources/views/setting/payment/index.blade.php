<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Credit Card Validation Demo</title>
    <link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('payment-assets/css/styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('payment-assets/css/demo.css') }}">
    @php
        if($invoice->paymentGateway->merchant->name == 'Square'){
            if($invoice->paymentGateway->environment == 1){
    @endphp
    <script src="//web.squarecdn.com/v1/square.js"></script>            
    @php }else{ @endphp
    <script src="//sandbox.web.squarecdn.com/v1/square.js"></script>                      
    @php }} @endphp
</head>

<body>
    <div class="container-fluid">
        <header> 
            <div class="limiter">
                <h3>{{$invoice->brand->name}}</h3>
                <a>{{$invoice->brand->phone}}</a>
                <img src="{{$invoice->brand->logo}}" width="100">
            </div>
        </header>
        <div class="creditCardForm">
            <div class="heading">
                <h1>Confirm Purchase</h1>
            </div>
            <div class="invoice-details">
                <div style="width: 40%;float: left;">
                    <h4>Invoice Number #: {{$invoice->invoice_number}}</h4>                    
                </div>
                <div style="width: 40%;float: right;">
                    <h5>Payment Gateway: {{$invoice->paymentGateway->merchant->name}}</h5>                    
                </div>
            </div>
            <div class="payment">
                @php
                if($invoice->paymentGateway->merchant->name == 'Stripe'){
                    if($invoice->paymentGateway->environment == 1){
                        $stripeData = 'data-stripe-publishable-key='.$invoice->paymentGateway->live_stripe_publishable_key;      
                    }else{
                        $stripeData = 'data-stripe-publishable-key='.$invoice->paymentGateway->test_stripe_publishable_key; 
                    }
                }else{
                    $stripeData = '';
                }
                @endphp
                <!--   -->
                <form id="order_form" method="post" action="{{ route('admin.makeTransaction')}}"   {{ $stripeData }}>
                @csrf
                @method('post')
                <input type="hidden" name="invoice_number" value="{{$invoice->invoice_number}}">
                <input type="hidden" name="amount" value="{{$invoice->amount}}">
                <input type="hidden" name="stripeToken" value=""/>
                <input type="hidden" name="nonce" value="">

                    <div class="form-group owner">
                        <label for="owner">First Name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name">
                    </div>
                    <div class="form-group">
                        <label for="owner">Last Name</label>
                        <input type="text" name="last_name" class="form-control" id="last_name">
                    </div>
                    <div class="form-group owner">
                        <label for="owner">Email</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="owner">phone</label>
                        <input type="text" name="phone" class="form-control" id="phone">
                    </div>
                    <div class="form-group owner">
                        <label for="owner">Address</label>
                        <input type="text" name="address" class="form-control" id="address">
                    </div>
                    <div class="form-group ">
                        <label for="owner">Zip</label>
                        <input type="text" name="Zip" class="form-control" id="zip">
                    </div>
                    @php if($invoice->paymentGateway->merchant->name == 'Square'){ @endphp
                    <div id="payment-form">
						<div id="payment-status-container"></div>
						<div id="card-container"></div>
					</div>
                    @php } else if($invoice->paymentGateway->merchant->name == 'Braintree'){ @endphp    
                        <div id="bt-dropin"></div>
                    @php }else{ @endphp
                    <div class="form-group owner">
                        <label for="owner">Card Name</label>
                        <input type="text" name="card_name" class="form-control" id="owner">
                    </div>
                    <div class="form-group CVV">
                        <label for="cvv">CVV</label>
                        <input type="text" name="card_cvv" class="form-control" id="cvv">
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" name="card_number" class="form-control" id="cardNumber">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select name="card_exp_month" id="card_exp_month">
                            <option value="01">January</option>
                            <option value="02">February </option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="card_exp_year" id="card_exp_year">
                            <option value="2024"> 2024</option>
                            <option value="2025"> 2025</option>
                            <option value="2026"> 2026</option>
                            <option value="2027"> 2027</option>
                            <option value="2028"> 2028</option>
                            <option value="2029"> 2029</option>
                        </select>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="{{ asset('payment-assets/images/visa.jpg') }}" id="visa">
                        <img src="{{ asset('payment-assets/images/mastercard.jpg') }}" id="mastercard">
                        <img src="{{ asset('payment-assets/images/amex.jpg') }}" id="amex">
                    </div>
                    @php } @endphp
                    <div class="form-group" id="pay-now">
                        <input id="nonce" name="payment_method_nonce" type="hidden" />
                        <button type="submit" class="btn btn-default" id="card-button">Confirm</button>
                    </div>
                </form>
            </div>
        </div>

        <p class="examples-note">Here are some dummy credit card numbers and CVV codes so you can test out the form:</p>

        <div class="examples">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Card Number</th>
                            <th>Security Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Visa</td>
                            <td>4716108999716531</td>
                            <td>257</td>
                        </tr>
                        <tr>
                            <td>Master Card</td>
                            <td>5281037048916168</td>
                            <td>043</td>
                        </tr>
                        <tr>
                            <td>American Express</td>
                            <td>342498818630298</td>
                            <td>3156</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('payment-assets/js/jquery.payform.min.js') }}"></script>
    <script src="{{ asset('payment-assets/js/script.js') }}"></script>
   

    @php if($invoice->paymentGateway->merchant->name == 'Stripe'){ @endphp
    <script type="text/javascript" src="//js.stripe.com/v2/"></script> 
    <script type="text/javascript">
        const cardButton = document.getElementById('card-button');
        console.log($('form').data('stripe-publishable-key'));

        cardButton.addEventListener('click', async () => {
            Stripe.setPublishableKey($('form').data('stripe-publishable-key'));
                Stripe.createToken({
                        number: $('#cardNumber').val(),
                        cvc: $('#cvv').val(),
                        exp_month: $('#card_exp_month').val(),
                        exp_year: $('#card_exp_year').val()
                }, stripeResponseHandler);
		});

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('input[name="payment_method_nonce"]').after('<div class="text-center text-danger fontbold">'+response.error.message+'</div>');
                console.log(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $('input[name="stripeToken"]').val(token);
                console.log(token);
                document.getElementById('order_form').submit();
            }
		}
    </script>
    @php } @endphp 
    
    @php if($invoice->paymentGateway->merchant->name == 'Square'){ @endphp
        <script type="module">
                @php if($invoice->paymentGateway->environment == 1){ @endphp
				const payments = Square.payments('{{$invoice->paymentGateway->square_production_application_id}}', '{{$invoice->paymentGateway->square_production_Location_id}}');
                @php }else{ @endphp
                const payments = Square.payments('{{$invoice->paymentGateway->square_sandbox_application_id}}', '{{$invoice->paymentGateway->square_sandbox_location_id}}');
                @php } @endphp    
				const card = await payments.card();
				await card.attach('#card-container');

                // const cardButton = document.getElementById('card-button');
				// cardButton.addEventListener('click', async () => {
                
                document.getElementById('order_form').addEventListener('submit', async function(e) {
                    e.preventDefault(); // Prevent default form submission    
                    const statusContainer = document.getElementById('payment-status-container');
                    try {
                        const result = await card.tokenize();
                        console.log('cxm...'+result);
                        if (result.status === 'OK') {
                            console.log(`Payment token is ${result.token}`);
                            $('input[name="nonce"]').val(result.token);
                            
                            statusContainer.innerHTML = "Payment Successful";
                            console.log('CXM');
                            this.submit();
                            //document.getElementById('order_form').submit();
                        } else {
                            //location.reload();
                            let errorMessage = `Tokenization failed with status: ${result.status}`;
                            if (result.errors) {
                                errorMessage += ` and errors: ${JSON.stringify(
                                result.errors
                                )}`;
                            }
                            throw new Error(errorMessage);
                        }
                    } catch (e) {
                        //location.reload();
                        console.log('cxm error');
                        console.error(e);
                        statusContainer.innerHTML = "Payment Failed";
                    }
				});
		</script>
    @php } @endphp 

    @php if($invoice->paymentGateway->merchant->name == 'Braintree'){ @endphp
        <script src="https://js.braintreegateway.com/web/dropin/1.39.1/js/dropin.min.js"></script>
        
        <script>
        var form = document.querySelector('#order_form');
        var submit = document.querySelector('#card-button');

        braintree.dropin.create({
            authorization: '{{ $clientToken }}',
            container: '#bt-dropin'
        }, function (createErr, instance) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    var nonceInput = document.createElement('input');
                    nonceInput.type = 'hidden';
                    nonceInput.name = 'bt_payment_method_nonce';
                    nonceInput.value = payload.nonce;
                    form.appendChild(nonceInput);

                    form.submit();
                });
            });
        });
    </script>
    @php } @endphp 
</body>
</html>
