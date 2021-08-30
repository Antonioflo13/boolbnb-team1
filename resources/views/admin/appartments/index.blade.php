@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Appartment List')
    
@section('content')
    <section>
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
                                <img src="{{ $appartment->image }}" alt="{{ $appartment->title }}">
                            </td>
                            <td>{{ $appartment->title }}</td>
                            <td>{{ substr($appartment->description, 0,100).'...' }}</td>
                            <td>
                                <a class="btn" href="#">Show</a>
                            </td>
                            <td>
                                <a class="btn" href="#">Edit</a>
                            </td>
                            <td>
                                <a class="btn" href="#">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </article>
    </section>
@endsection