
@extends('layouts.main')

@section('title', 'Landing Page')

@section('content')
<section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categories of The Month</h1>
                <p>
                Your best investment options for these coming months are here.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/Arte.jpg" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Art</h5>
                <p class="text-center"><a class="btn btn-success">Go Offer</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/WirelessEarbuds.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Tech</h2>
                <p class="text-center"><a class="btn btn-success">Go Offer</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/SmartCyclingHelmet.jpg" class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Sports</h2>
                <p class="text-center"><a class="btn btn-success">Go Offer</a></p>
            </div>
        </div>
    </section>

    
@endsection