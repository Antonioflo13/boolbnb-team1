@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Promotions')
@section('content')
    <section id="ms_promotions">
        <div class="container">
            <h1>Promotion for {{ $appartment->title }}</h1>
        <div class="promotion_cards">
            @foreach ($promotions as $promotion)
                <div class="card">
                    <h2>{{ $promotion->title }}</h2>
                    <h1>{{ $promotion->price }} €</h1>
                    <h4> {{ $promotion->hours }} hours of sponsorship</h4>
                    <a href="{{ route('admin.payment', [$promotion->id, $appartment->id]) }}" class="btn">Sponsorship</a>
                </div>
                @endforeach
        </div>
            <br>
            <div id="card_secondary">
                <h3>Sponsorship detail</h3>
                    <ul>
                        <li>
                            <h4>
                                It appears on the Homepage in the “Featured Apartments” section.
                            </h4>
                        </li>
                        <li>
                            <h4>
                                On the search page, it is always placed before an unsponsored apartment that meets the same search characteristics.
                            </h4>
                        </li>
                    </ul>
            </div>
        </div>
    </section>
@endsection
    
