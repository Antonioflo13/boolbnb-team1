@extends('layouts.app')
@section('content')

<section id="ms_payment_checkout">

    <article class="container">

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
        
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @csrf
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="http://127.0.0.1:8000/admin/appartments/{{$appartment->id}}">
                        <i class="fas fa-arrow-left fa-2x"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        
        <div class="flex-center position-ref full-height box_payment">

            <div class="appartament_information">
                <h3>Appartment name : <br> <span>{{ $appartment->title}}</span></h3>
                <img src="http://127.0.0.1:8000/storage/{{$appartment->image}}" alt="image">
                <h4>Promotion : <span>{{$promotion->title}}</span></h4>


            </div>
        
            <div class="content">
                <form method="post" id="payment-form" action="{{ route('admin.payment', [$promotion->id, $appartment->id]) }}">
        
                    <section class="price">
                        <label for="amount">
                            <span class="input-label">Amount</span>
                            <div class="input-wrapper amount-wrapper">
                                {{-- <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10"> --}}
                                <div>
                                    {{ $promotion->price }} €
                                </div>
                            </div>
                        </label>
        
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>
        
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button" type="submit">
                        <span>
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </article>
</section>
    <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = "{{ $token }}";

            braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
            }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
                });
            });
            });
        </script>
@endsection
