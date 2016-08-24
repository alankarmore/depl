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
                <h2>Contact Us</h2>
                <div class="green-sep"></div>
            </div>

        </div>

        <section id="news">
            <div class="counter-overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Start news area -->
                            <div class="news-area">
                                <div class="news-conten">
                                    <!-- Start news slider -->
                                    <div class="news-slider">
                                        <!-- single slide -->
                                        <div class="single-slide">
                                            <div><img src="assets/images/office1.jpg" alt="office" width="1366px" height="244px"></div>
                                        </div>
                                        <div class="single-slide">
                                            <div><img src="assets/images/office2.jpg" alt="office" width="1366px" height="244px"></div>
                                        </div>
                                        <div class="single-slide">
                                            <div><img src="assets/images/office3.jpg" alt="office" width="1366px" height="244px"></div>
                                        </div>
                                        <div class="single-slide">
                                            <div><img src="assets/images/office4.jpg" alt="office" width="1366px" height="244px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Start Google Map -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- End Google Map -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="contact-right wow fadeInRight">
                <h2>Send a message</h2>
                <form action="{{route('post-contact')}}" class="contact-form" method="POST">
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
                        <input type="text" class="form-control" placeholder="Subject" name="subject" id="subject" maxlength="150" required="required" value="{{ old('subject')?old('subject'):'' }}">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Your Message" name="message" id="message"  maxlength="300" required="required">
                             {{ old('message')?old('message'):'' }}
                        </textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <button type="submit" data-text="SUBMIT" class="button button-default"><span>SUBMIT</span></button>
                </form>
            </div>
        </div>
    </section>
    <!-- End about section -->
    </section>
    <!-- End about section -->
@section('page-script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.autoplay').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false
            });
        });

    </script>
@endsection
@endsection