@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Promotions')
@section('content')
    <section id="ms_promotions">
        <div class="container">
            <h1>Promotion for {{ $appartment->title }}</h1>
            @foreach ($promotions as $promotion)
                <div>
                    <h4>{{ $promotion->title }} {{ $promotion->price }} € {{ $promotion->hours }} hours of sponsorship</h4>
                    <a href="{{ route('admin.getToken', [$promotion->id, $appartment->id]) }}" class="btn">Sponsorship</a>
                </div>
                @endforeach
                <h3>Sponsorship detail</h3>
                <ul>
                    <li>
                        <h4>
                            Appare in Homepage nella sezione “Appartamenti in Evidenza”.
                        </h4>
                    </li>
                    <li>
                        <h4>
                            Nella pagina di ricerca, viene posizionato sempre prima di un
                            appartamento non sponsorizzato che soddisfa le stesse caratteristiche di ricerca.
                        </h4>
                    </li>
                </ul>
        </div>
    </section>
@endsection
    
