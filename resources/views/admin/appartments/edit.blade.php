@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Edit' . ' ' . $appartment->title)

@section('content')
    <section id="ms_form">
        <div class="container">

            <div class="come_back">
                <a class="nav-link" href="http://127.0.0.1:8000/admin/appartments/{{ $appartment->id }}">
                    <i class="fas fa-arrow-right fa-2x"></i>
                </a>
            </div>

            <h1>Edit {{ $appartment->title }}</h1>
            <form class="form_primary" action="{{ route('admin.appartments.update', $appartment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- TITLE --}}
                <div class="form-group">
                    <label for="title">Appartment Name</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter appartment name" value="{{ old('title', $appartment->title) }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /TITLE --}}

                {{-- ADDRESS --}}
                <div class="form-group">
                    <label for="address">Full Address</label>
                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address" value="{{ old('address', $appartment->address) }}">
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /ADDRESS --}}

                {{-- ROOMS NUMBER --}}
                <div class="form-group">
                    <label for="rooms_number">Rooms Number</label>
                    <input name="rooms_number" type="number" class="form-control @error('rooms_number') is-invalid @enderror" id="rooms_number" placeholder="Enter rooms number" value="{{ old('rooms_number', $appartment->rooms_number) }}">
                    @error('rooms_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /ROOMS NUMBER --}}

                {{-- BATHROOMS NUMBER --}}
                <div class="form-group">
                    <label for="bathrooms_number">Bathrooms Number</label>
                    <input name="bathrooms_number" type="number" class="form-control @error('bathrooms_number') is-invalid @enderror" id="bathrooms_number" placeholder="Enter bathrooms number" value="{{ old('bathrooms_number', $appartment->bathrooms_number) }}">
                    @error('bathrooms_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /BATHROOMS NUMBER --}}

                {{-- BEDS NUMBER --}}
                <div class="form-group">
                    <label for="beds_number">Beds Number</label>
                    <input name="beds_number" type="number" class="form-control @error('beds_number') is-invalid @enderror" id="beds_number" placeholder="Enter beds number" value="{{ old('beds_number', $appartment->beds_number) }}">
                    @error('beds_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /BEDS NUMBER --}}

                {{-- SQUARE METERS --}}
                <div class="form-group">
                    <label for="square_meters">Square meters</label>
                    <input name="square_meters" type="number" class="form-control @error('square_meters') is-invalid @enderror" id="square_meters" placeholder="Enter square meters" value="{{ old('square_meters', $appartment->square_meters) }}">
                    @error('square_meters')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /SQUARE METERS --}}

                {{-- DESCRIPTION --}}
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5" placeholder="Enter description">{{ old('description', $appartment->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /DESCRIPTION --}}

                {{-- VISIBILITY --}}
                <div class="form-group">
                    <label for="visible">Visibility</label>
                    <select name="visible" class="form-control @error('visible') is-invalid @enderror" id="visible">
                        <option value="" selected disabled>-- Visible / Hidden --</option>
                        <option value="visible" {{ 'visible' == old('visible', $appartment->visible)? 'selected':'' }}>Visible</option>
                        <option value="hidden" {{ 'hidden' == old('visible', $appartment->visible)? 'selected':'' }}>Hidden</option>
                    </select>
                    @error('visible')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /VISIBILITY --}}

                 {{-- SERVICES --}}
                 <div class="form-group width_100">
                    @foreach ($services as $service)
                        <div class="form-check form-check-inline">
                            @if ($errors->any())
                                <input name="services[]" class="form-check-input @error('services') is-invalid @enderror" type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}" {{ in_array($service->id, old('services', []))? 'checked':'' }}>
                            @else
                                <input name="services[]" class="form-check-input @error('services') is-invalid @enderror" type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}" {{ $appartment->services->contains($service->id)? 'checked':'' }}>
                            @endif
                            <label class="form-check-label" for="service-{{ $service->id }}">{{ $service->name }}</label>
                        </div>
                    @endforeach
                    <div>
                        @error('services')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                {{-- /SERVICES --}}


                {{-- IMAGE --}}
                <div class="form-group">
                    <div class="img">
                        @if (substr($appartment->image, 0, 5) == 'https')
                            <img src="{{ $appartment->image }}" alt="{{ $appartment->title }}">
                        @else
                            <img src="{{ asset('storage/' . $appartment->image) }}" alt="{{ $appartment->title }}">
                        @endif
                    </div>
                    <input name="image" type="file" class="form-control-file" id="image">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- /IMAGE --}}

                {{-- BUTTONS --}}
                <div class="width_100">
                    <button type="submit">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
                {{-- /BUTTONS --}}
            </form>
        </div>
    </section>
@endsection