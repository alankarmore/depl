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
                <h2>Careers</h2>
                <div class="green-sep"></div>
            </div>

        </div>
        @if (session('success'))
            <div class="col-md-12 col-sm-12 col-xs-12 alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="col-md-12 col-sm-12 col-xs-12 alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="contact-right wow fadeInRight">
                <h2>Send your Resume</h2>
                <form action="{{route('post-careers')}}" class="contact-form" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" maxlength="100" required="required" value="{{ old('first_name')?old('first_name'):'' }}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" maxlength="100" required="required" value="{{ old('last_name')?old('last_name'):'' }}">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter Email" required="required" name="email" id="email"  value="{{ old('email')?old('email'):'' }}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Your Message" name="message" id="message"  maxlength="300" required="required">{{ old('message')?old('message'):'' }}</textarea>
                    </div>
                    <div>
                        <input type="file" name="file" id="file" required="required" >
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button type="submit" data-text="SUBMIT" class="button button-default"><span>SUBMIT</span></button>
                </form>
            </div>
        </div>
    </section>
@endsection