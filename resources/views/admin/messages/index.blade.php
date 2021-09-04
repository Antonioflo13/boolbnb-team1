@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Inbox')
@section('content')
    <section id="ms_messages">
        <article class="container">
            <div class="row">
                <div class="col-4">
                  <div class="list-group" id="list-tab" role="tablist">
                    @foreach ($messages as $message)
                    @php
                        $name = str_replace(" ", "", $message->name);
                    @endphp
                        <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#{{ $name }}" role="tab" aria-controls="home">
                            <h5>{{ $message->appartment->title }}</h5>
                            <h6>{{ $message->name }}</h6>
                        </a>
                    @endforeach
                  </div>
                </div>
                <div class="col-8">
                    @foreach ($messages as $message)   
                        @php
                            $name = str_replace(" ", "", $message->name);
                        @endphp
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade" id="{{ $name }}" role="tabpanel" aria-labelledby="list-home-list">{{ $message->message }}</div>
                        </div>
                    @endforeach
                </div>
              </div>
        </article>
    </section>
@endsection