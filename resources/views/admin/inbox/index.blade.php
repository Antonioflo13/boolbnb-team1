@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Inbox')
@section('content')
    <section id="ms_inbox">

        {{-- popup --}}
        @foreach ($singleAppartmentsMessagges as $singleAppartmentsMessagge)
        <div id="ms_popup">
            <div id="{{ $singleAppartmentsMessagge->id }}" class="popup" style="height: calc(100vh - 229.25px)">
                <div class="popupcontainer">
                        <p>Are you sure you want to delete this apartment? <strong>"{{ $singleAppartmentsMessagge->name }}{{ $singleAppartmentsMessagge->appartment->title }}"
                        <div class="d-flex">
                            <form action="{{ route('admin.inboxdelete.destroy', $singleAppartmentsMessagge->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn_delete">Delete</button>
                            </form>
                            <button class="btn btn_delete" onclick="popdown()">No</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
        {{-- /popup --}}

        <article  class="container">
            @if (count($singleAppartmentsMessagges) == 0)
                <div class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 229.25px)">
                    <h2>No Messages Found</h2>
                </div>
            @else
                @foreach ($singleAppartmentsMessagges as $singleAppartmentsMessagge)
                        <div class="card">
                            <h3>{{ $singleAppartmentsMessagge->appartment->title }}</h3>
                            <h4>{{ $singleAppartmentsMessagge->name }}</h4>
                            <div class="d-flex">
                                <textarea name="" id="area" cols="30" rows="1" disabled>{{ $singleAppartmentsMessagge->email }}</textarea>
                                <button onclick="copy('area')" class="ml-3"><i class="far fa-copy"></i></button>
                            </div>
                            <button class="ms-btn-filter" type="button" data-toggle="collapse" data-target="#collapseExample{{ $singleAppartmentsMessagge->id }}" aria-expanded="false" aria-controls="collapseExample">
                                Show Message
                            </button>
                            <div class="collapse mt-3" id="collapseExample{{ $singleAppartmentsMessagge->id }}">
                                <div>
                                    <p>{{ $singleAppartmentsMessagge->message }}</p>
                                        <button class="btn btn_delete mb-5" onclick="popup({{$singleAppartmentsMessagge->id}})"><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                @endforeach
            @endif

            {{-- paginate --}}
            <div class="d-flex justify-content-center align-items-center">
                <div class="paginator p-3">{{$messages->links()}}</div>
            </div>
            {{-- /paginate --}}

        </article>
    </section>

    <script>
        //popup
        function popup(res) {
        document.getElementById(res).className = "PopupPanel";
        };

        function popdown() {
            document.getElementsByClassName("PopupPanel")[0].className = "popup";
        }

        //copy e-mail
        function copy(text) {
            var input = document.createElement('input');
            var area = document.getElementById(text).value;
            input.setAttribute('value', area);
            document.body.appendChild(input);
            input.select();
            var risultato = document.execCommand('copy');
            document.body.removeChild(input);
            return risultato;
        }
    </script>
@endsection