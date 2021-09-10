@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Inbox')
@section('content')
    <section id="ms_inbox">
        <article  class="container">
            @foreach ($singleAppartmentsMessagges as $singleAppartmentsMessagge)
                @foreach ($singleAppartmentsMessagge as $message)
                    <div class="card">
                        <h3>{{ $message->appartment->title }}</h3>
                        <h4>{{ $message->name }}</h4>
                        <h4>{{ $message->email }}</h4>
                        <button class="ms-btn-filter" type="button" data-toggle="collapse" data-target="#collapseExample{{ $message->id }}" aria-expanded="false" aria-controls="collapseExample">
                            Show Message
                        </button>
                        <div class="collapse mt-3" id="collapseExample{{ $message->id }}">
                            <div class="d-flex justify-content-center align-item-center">
                                <p>{{ $message->message }}</p>
                                <form action="{{ route('admin.inboxdelete.destroy', $message->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn_delete mb-5"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </article>
    </section>
@endsection