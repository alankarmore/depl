@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{asset('assets/images/banner1.jpg')}}">
        </div>
    </div>
    <!-- End banner section -->
    <!-- Start about section -->
    <section class="inner-about margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>Job Details</h2>
                <div class="green-sep"></div>
            </div>

        </div>
        @if (session('success'))
            <div class="col-md-12 col-sm-12 col-xs-12 alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="col-md-6">
            <div class="container career-block">

                <div class="row career">
                    <div class="col-sm-3">
                        <h4 class="name">Job Title:</h2>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <h5>{{ucwords($job->title)}}</h5>
                    </div>
                </div>
                <div class="row career">
                    <div class="col-sm-3">
                        <h4 class="name">Location:</h2>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <h5>{{ucwords($job->location)}}</h5>
                    </div>
                </div>
                <div class="row career">
                    <div class="col-sm-3">
                        <h4 class="name">Experience Required:</h2>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <h5>{{$job->experience}} Years</h5>
                    </div>
                </div>
                <div class="row career">
                    <div class="col-sm-3">
                        <h4 class="name">Skills Required:</h2>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <h5>{{ucwords($job->skills)}}</h5>
                    </div>
                </div>
                <div class="row career">
                    <div class="col-sm-3">
                        <h4 class="name">Qualification Required:</h2>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <h5>{{ucwords($job->qualification)}}</h5>
                    </div>
                </div>
                <div class="row career">
                    <div class="col-sm-3">
                        <h4 class="name">Job Description:</h2>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <h5>{!! nl2br($job->description) !!}</h5>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection