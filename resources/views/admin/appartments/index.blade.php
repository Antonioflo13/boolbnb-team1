@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Appartment List')
    
@section('content')
    <section id="ms_index">
        <article class="container">
            @foreach ($appartments as $appartment)
                <div class="box_card">
                    @if (substr($appartment->image, 0, 5) == 'https')
                        <img src="{{ $appartment->image }}" alt="{{ $appartment->title }}">
                    @else
                        <img src="{{ asset('storage/' . $appartment->image) }}" alt="{{ $appartment->title }}">
                    @endif

                    <h1>{{ $appartment->title }}</h1>
                    <p>{{ substr($appartment->description, 0,100).'...' }}</p>

                    <div class="btn_card">
                        <a class="btn" href="{{ route('admin.appartments.show', $appartment->id) }}">Show</a>
                    </div>
                </div>
            @endforeach
        </article>
    </section>
@endsection