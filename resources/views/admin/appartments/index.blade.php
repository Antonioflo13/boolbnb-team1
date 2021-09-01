@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Appartment List')
    
@section('content')
    <section id="ms_index">
        <article class="container">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th colspan="3" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($appartments as $appartment)
                        <tr>
                            <td>
                                @if (substr($appartment->image, 0, 5) == 'https')
                                    <img src="{{ $appartment->image }}" alt="{{ $appartment->title }}">
                                @else
                                    <img src="{{ asset('storage/' . $appartment->image) }}" alt="{{ $appartment->title }}">
                                @endif
                            </td>
                            <td>{{ $appartment->title }}</td>
                            <td>{{ substr($appartment->description, 0,100).'...' }}</td>
                            <td>
                                <a class="btn" href="{{ route('admin.appartments.show', $appartment->id) }}">Show</a>
                            </td>
                            <td>
                                <a class="btn" href="{{ route('admin.appartments.edit', $appartment->id) }}">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.appartments.destroy', $appartment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn_delete">Delete</button>
                                  </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </article>
    </section>
@endsection