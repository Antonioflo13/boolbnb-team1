@extends('layouts.app')
@section('title', config('app.name', 'BoolBnB').' | Appartment List')
@section('content')
<section id="ms_show">
    <article class="container my-3">

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        <div>
            <div class="d-flex align-items-center justify-content-between">
                <h1>{{ $appartment->title }}</h1>
                <div class="d-flex align-items-center">
                    @if (!$appartment->visible) 
                        {{-- pallino rosso --}}
                        {{-- <i class="fas fa-circle mr-2"></i> --}}
                        <span class="mr-3"><i class="fas fa-circle mr-2"></i> Not Available</span>
                    @else
                        {{-- pallino verde --}}
                        
                        <span class="mr-3"><i class="fas fa-circle mr-2"></i>Available</span>
                    @endif
                    @if (count($appartment->promotions) > 0 && $appartment->promotions[0]->pivot->end_promotion >= date("Y-m-d H:i:s"))
                        <strong>
                            <div id="demo" class="mr-3"></div>
                        </strong>
                    @endif
                    <a href="{{ route('admin.promotions', $appartment->id) }}" class="mr-5"><i class="fas fa-sort-amount-up-alt mr-2"></i> Upgrade</a>
                    <a href="#" class="btn">Preview listing</a>
                </div>
            </div>
            {{-- edit collection --}}
            <div class="my-4">
                <div class="row mx-3">
                    {{-- edit menu --}}
                    <div class="col-sm-8 col-lg-3 mb-3">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a href="#" class="list-group-item disabled" aria-disabled="true">Listing Details</a>
                        <a class="list-group-item list-group-item-action active" id="list-photos-list" data-toggle="list" href="#list-photos" role="tab" aria-controls="photos">Photos</a>
                        <a class="list-group-item list-group-item-action" id="list-listing-basics-list" data-toggle="list" href="#list-listing-basics" role="tab" aria-controls="listing-basics">Listing Basics</a>
                      </div>
                    </div>
                    {{-- /edit menu --}}
                    <div class="col-sm-8 col-lg-8 mb-3">
                        {{-- edit specifications --}}
                        <div class="tab-content" id="nav-tabContent">

                            {{-- photos --}}
                            <div class="tab-pane fade show active" id="list-photos" role="tabpanel" aria-labelledby="list-photos-list">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4>Photos</h4>
                                    <a href="{{ route('admin.appartments.edit', $appartment->id) }}">Edit<i class="fas fa-chevron-right ml-2"></i></a>
                                </div>
                                @if (substr($appartment->image, 0, 5) == 'https')
                                    <img src="{{ $appartment->image }}" alt="{{ $appartment->title }}">
                                @else
                                    <img src="{{ asset('storage/' . $appartment->image) }}" alt="{{ $appartment->title }}">
                                @endif
                            </div>
                            {{-- /photos --}}

                            {{-- Listing basics --}}
                            <div class="tab-pane fade" id="list-listing-basics" role="tabpanel" aria-labelledby="list-listing-basics-list">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h4>Listing basics</h4>
                                    <a href="{{ route('admin.appartments.edit', $appartment->id) }}">Edit</a>
                                </div>
                                <div class="my-3">
                                    <h5>Listing Title</h5>
                                    <p>{{ $appartment->title }}</p>
                                </div>
                                <div class="my-3">
                                    <h5>Listing Description</h5>
                                    <p>{{ $appartment->description }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between my-3">
                                    <h5>Number of guest</h5>
                                    <p>{{ $appartment->beds_number }}</p>
                                </div>
                                <div class="my-3">
                                    <h5>Listing Status</h5>
                                    @if (!$appartment->visible) 
                                        {{-- pallino rosso --}}
                                        <span class="mr-5 indicator"><i class="fas fa-circle mr-2"></i> Not Available</span>
                                    @else
                                        {{-- pallino verde --}}
                                        <span class="mr-5 indicator"><i class="fas fa-circle mr-2"></i> Available - Guest can find your listing in search result and request or book available dates.</span>
                                    @endif
                                </div>
                                <div class="my-3">
                                    <h5>Amenities</h5>
                                    @foreach ($appartment->services as $service)
                                        <p>{{ $service->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            {{-- /Listing basics --}}
                        </div>
                        {{-- /edit specifications --}}
                    </div>
                </div>
            </div>
            {{-- /edit collection --}}
        </div>
    </article>
</section>

<script>
    // Assign a php variable to js
    var endPromotion = "<?php echo $appartment->promotions[0]->pivot->end_promotion; ?>";

    // Set the date we're counting down to
    var countDownDate = new Date(endPromotion).getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
    
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
    
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
      // Display the result in the element with id="demo"
      document.getElementById("demo").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    
      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
      }
    }, 1000);
</script>
@endsection