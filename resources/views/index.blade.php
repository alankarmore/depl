@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            <div class="item active">
                <div class="carousel-caption">
                    <h3>SMART CITIES</h3>
                    <p>Integrated Solutions for Efficient Cities</p>
                </div>
            </div>

            <div class="item">
                <div class="carousel-caption">
                    <h3>SMART CITIES</h3>
                    <p>Integrated Solutions for Efficient Cities</p>
                </div>
            </div>

            <div class="item">
                <div class="carousel-caption">
                    <h3>SMART CITIES</h3>
                    <p>Integrated Solutions for Efficient Cities</p>
                </div>
            </div>

            <div class="item">
                <div class="carousel-caption">
                    <h3>SMART CITIES</h3>
                    <p>Integrated Solutions for Efficient Cities</p>
                </div>
            </div>

        </div>

    </div>
    <!-- End banner section -->


    <!-- Start about section -->
    <section id="about">
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="col-md-12">
                    <!-- Start welcome area -->
                    <div class="welcome-area">
                        <div class="title-area">
                            <h2 class="tittle wow fadeInUp">We are Premier Telecom Turnkey Project Management Company!</h2>
                        </div>
                    </div>
                    <!-- End welcome area -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Start team content -->
                    <div class="team-content">
                        <ul class="team-grid">
                            <li>
                                <div class="team-item team-img-1 wow fadeInUp">
                                    <div class="team-info">
                                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
                                        <a href="#"><span class="fa fa-facebook"></span></a>
                                        <a href="#"><span class="fa fa-twitter"></span></a>
                                        <a href="#"><span class="fa fa-pinterest"></span></a>
                                        <a href="#"><span class="fa fa-rss"></span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="team-item team-img-2 wow fadeInUp">
                                    <div class="team-info">
                                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
                                        <a href="#"><span class="fa fa-facebook"></span></a>
                                        <a href="#"><span class="fa fa-twitter"></span></a>
                                        <a href="#"><span class="fa fa-pinterest"></span></a>
                                        <a href="#"><span class="fa fa-rss"></span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="team-item team-img-3 wow fadeInUp">
                                    <div class="team-info">
                                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
                                        <a href="#"><span class="fa fa-facebook"></span></a>
                                        <a href="#"><span class="fa fa-twitter"></span></a>
                                        <a href="#"><span class="fa fa-pinterest"></span></a>
                                        <a href="#"><span class="fa fa-rss"></span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="team-item team-img-4 wow fadeInUp">
                                    <div class="team-info">
                                        <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever</p>
                                        <a href="#"><span class="fa fa-facebook"></span></a>
                                        <a href="#"><span class="fa fa-twitter"></span></a>
                                        <a href="#"><span class="fa fa-pinterest"></span></a>
                                        <a href="#"><span class="fa fa-rss"></span></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- End team content -->
                </div>
            </div>
        </div>
    </section>
    <!-- End about section -->

    <!-- Start About Us action -->
    <section id="about-to-action">
        <div class="about-to-overlay">
            <div class="container">
                <div class="about-to-content wow fadeInUp">
                    <h2>Find More About Us</h2>
                    <div class="green-sep"></div>
                    <p>Dinesh Engineers Pvt. Ltd. is one of the Premier Telecom Turnkey Project Management Company, which stands at par with other leading Telecom Service Providers.
                        It has been a saga of commitment to quality, sheer hard work and customer orientation that has helped Dinesh Engineers Pvt. Ltd. to achieve today's position.
                        A strong customer-focused approach and constant quest for highest quality have enabled the Company to attain and sustain the growth for nearly Twenty years.
                    </p>
                    <p>
                        Dinesh Engineers Pvt. Ltd is also a registered Infrastructure Provider (IP-1) with Government Of India, Ministry of Communications & IT , Department of Telecommunications,
                        to establish and maintain the assets such as Dark Fibers, Right of Way, Duct Space for the purpose to grant on Lease/Rent/Sale basis to the Licensees of
                        Telecom Services, on mutually agreed terms and conditions.</p>

                </div>
            </div>
        </div>
    </section>
    <!-- End About Us action -->

    <!-- Start Services action -->
    <section id="our-services">
        <div class="container-fluid no-padding">
            <div class="row">
                <div class="col-md-12">
                    <div class="team-area">
                        <div class="title-area wow fadeInUp">
                            <h2>Our Services</h2>
                            <div class="green-sep margin-bottom40"></div>
                        </div>
                        <!-- Start team content -->
                        <ul class="services">
                            <li class="all-services wow fadeInUp">
                                <div>
                                    <img src="{{asset('assets/images/services-5.jpg')}}">
                                    <div class="service-head">Telecom Infrastructure</div>
                                    <p>
                                        Sed feugiat porttitor nunc, non dignissim
                                        ipsum vestibulum in. Donec in blandit dolor.
                                        Vivamus a fringilla lorem
                                    </p>
                                    <div align="center"><a href="#" class="learn-more">Learn more</a></div>
                                </div>
                            </li>
                            <li class="all-services wow fadeInUp">
                                <div>
                                    <img src="{{asset('assets/images/services-6.jpg')}}">
                                    <div class="service-head">Fiber Network</div>
                                    <p>
                                        Sed feugiat porttitor nunc, non dignissim
                                        ipsum vestibulum in. Donec in blandit dolor.
                                        Vivamus a fringilla lorem
                                    </p>
                                    <div align="center"><a href="#" class="learn-more">Learn more</a></div>
                                </div>
                            </li>
                            <li class="all-services wow fadeInUp">
                                <div>
                                    <img src="{{asset('assets/images/services-7.jpg')}}">
                                    <div class="service-head">Infrastructure Maintenance</div>
                                    <p>
                                        Sed feugiat porttitor nunc, non dignissim
                                        ipsum vestibulum in. Donec in blandit dolor.
                                        Vivamus a fringilla lorem
                                    </p>
                                    <div align="center"><a href="#" class="learn-more">Learn more</a></div>
                                </div>
                            </li>
                            <li class="all-services wow fadeInUp">
                                <div>
                                    <img src="{{asset('assets/images/services-8.jpg')}}">
                                    <div class="service-head">Fiber Maintenance</div>
                                    <p>
                                        Sed feugiat porttitor nunc, non dignissim
                                        ipsum vestibulum in. Donec in blandit dolor.
                                        Vivamus a fringilla lorem
                                    </p>
                                    <div align="center"><a href="#" class="learn-more">Learn more</a></div>
                                </div>
                            </li>
                        </ul>
                        <!-- End Services content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Services action -->

    <!-- Start what we are section -->
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="service-area">
                        <div class="title-area">
                            <div align="center"><img src="{{asset('assets/images/we-icon.png')}}"></div>
                            <h2 class="white-font">What we are</h2>
                            <span class="tittle-line"></span>
                            <p>Dinesh Engineers Pvt. Ltd. Undertake various Telecom Projects on turnkey basis such as Out Station Plant (OSP) ,
                                laying of Optical Fiber Cable (OFC) through HDPE Ducts buried at a depth of more than
                                1.6 meter by using Open Trench method and more than 2 meters depth by employing Horizontal Directional Drilling ( HDD ).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End what we are section -->

    <!-- Start Clients section -->
    <section id="client">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="title-area">
                            <div align="center"><img src="{{asset('assets/images/clients-icon.png')}}"/></div>
                            <h2>Our Clients</h2>
                            <div class="green-sep"></div>
                            <div class="client-area margin-top70">
                                <ul class="client-table">
                                    <li><img src="{{asset('assets/images/tata.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/bsnl.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/reliance.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/telenor.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/aircel.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/videocon.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/alcatel_lucent.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/mts.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/reliance.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/telenor.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/aircel.png')}}" alt="client logo"></li>
                                    <li><img src="{{asset('assets/images/videocon.png')}}" alt="client logo"></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Clients section -->
    <!-- Start News section -->
    <section id="news">
        <div class="counter-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Start news area -->
                        <div class="news-area">
                            <div class="news-area">
                                <div align="center"><img src="assets/images/news-icon.png"/></div>
                                <h2>Latest News</h2>
                                <div class="green-sep"></div>
                            </div>
                            <div class="news-conten">
                                <!-- Start news slider -->
                                <div class="news-slider">
                                    <!-- single slide -->
                                    <div class="single-slide">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoquat. Duis aute irure d olor in reprehenderit</p>
                                    </div>
                                    <!-- single slide -->
                                    <div class="single-slide">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamcoquat. Duis aute irure d olor in reprehenderit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End news section -->
    <!-- Start Contact section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="contact-left wow fadeInLeft">
                        <h2>Useful Links</h2>
                        <ul class="footer-links">
                            <li><a href="#">about us</a></li>
                            <li><a href="#">Networks</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="contact-left wow fadeInRight">
                        <h2>SOCIAL NETWORK</h2>
                        <p>
                            Follow Us If you want to be kept up to date
                            about what’s going on, minute by minute,
                            then search for Grant and give us a follow!
                        </p>
                        <ul class="social-links">
                            <li><a href="#" class="twitter-icon">&nbsp;</a></li>
                            <li><a href="#" class="facebook-icon">&nbsp;</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="contact-left wow fadeInRight">
                        <h2>Contact Us</h2>
                        <p>
                            25, Lorem Lis Street, Orange
                            California, US
                            Phone: 800 123 3456 <br>
                            Fax: 800 123 3456 <br>
                            Email: info@anybiz.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact section -->
@endsection