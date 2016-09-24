@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{asset('assets/images/banner1.jpg')}}">
        </div>
    </div>
    <!-- End banner section -->
    <!-- Start services section -->
    <section class="inner-content margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>{{ucfirst($project->title)}}</h2>
                <div class="green-sep"></div>
            </div>
            <p class="margin-top20">{!! $project->description !!}</p>
        </div>
    </section>
    <!-- End services section -->
@endsection