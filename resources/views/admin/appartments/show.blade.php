@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Appartment List')
@section('content')
    <section id="ms_show">
        <article class="d-flex">
            <img src="{{ $appartment->image }}" alt="{{ $appartment->title }}">
        </article>
        <article class="container my-3 d-flex">
            <div>
                <div class="d-flex align-items-center">
                    <h1>{{ $appartment->title }}</h1>
                    <h5 class="ml-5">{{ $appartment->user->name }}</h5>
                </div>
                <p>{{ $city }}</p>
                <div class="d-flex">
                    <p class="mr-3">{{ $appartment->rooms_number }} rooms</p>
                    <p class="mr-3">{{ $appartment->beds_number }} beds</p>
                    <p class="mr-3">{{ $appartment->bathrooms_number }} bathrooms</p>
                </div>
                <p>{{ $appartment->description }}</p>
            </div>
            <aside class="ml-4">
                <h4>Messages</h4>
                @foreach ($appartment->messages as $message)
                    <h5>Name</h5>
                    <h6>{{ $message->name }}</h6>
                    <h5>Email</h5>
                    <h6>{{ $message->email }}</h6>
                    <h5>Message</h5>
                    <h6>{{ $message->message }}</h6>
                @endforeach
            </aside>
        </article>
    </section>
@endsection