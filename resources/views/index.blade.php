@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        @if($slogans)
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($slogans as $key => $slogan)
            <li data-target="#myCarousel" data-slide-to="{{$key}}" class="@if(0 == $key) active @endif"></li>
            @endforeach
        </ol>
        @endif
        @if($slogans)
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($slogans as $key => $slogan)
            <div class="item @if(0 == $key) active @endif">
                <div class="carousel-caption">
                    <h3>{{strtoupper($slogan->main_phrase)}}</h3>
                    <p>{{ucwords($slogan->sub_phrase)}}</p>
                </div>
            </div>
            @endforeach
        </div>
        @endif

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
            @if(!empty($projects) && $projects->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <!-- Start team content -->
                    <div class="team-content">
                        <ul class="team-grid">
                            @foreach($projects as $project)
                            <li>
                                <img src="{{route('getimage',array('width' => 345, 'height' => 426, 'folder' => 'project', 'file' => $project->image))}}" alt="{{ucwords($project->title)}}" class="team-item wow fadeInUp img-responsive" >
                                <div class="team-info">
                                    <p><a href="{{route('project-details',array('name' => $project->slug))}}">{{ucwords($project->title)}}</a></p>
                                    <p>{{substr(strip_tags($project->description),0,135)}}...</p>
                                </div>
                            </li>
                             @endforeach
                        </ul>
                    </div>
                    <!-- End team content -->
                </div>
            </div>
        </div>
        @endif
    </section>
    <!-- End about section -->

    <!-- Start About Us action -->
    <section id="about-to-action">
        <div class="about-to-overlay">
            <div class="container">
                <div class="about-to-content wow fadeInUp">
                    <h2>Find More About Us</h2>
                    <div class="green-sep"></div>
                    {!! substr($aboutus->description,0,1000) !!}...
                </div>
            </div>
        </div>
    </section>
    <!-- End About Us action -->

    <!-- Start Services action -->
    @if($services)
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
                            @foreach($services as $service)
                                <li class="all-services wow fadeInUp">
                                    <div>
                                        <img src="{{route('getimage',array('width' => 343, 'height' => 264, 'folder' => 'service', 'file' => $service->image))}}" alt="{{ucwords($service->title)}}">
                                        <div class="service-head">{{ucwords($service->title)}}</div>
                                        <p>{{strip_tags(substr($service->description,0,66))}}</p>
                                        <div align="center"><a href="{{route('service-details',array('name' => $service->slug))}}" title="{{ucwords($service->title)}}" class="learn-more">Read More</a></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- End Services content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- Start Services action -->

    <!-- Start what we are section -->
    @if($whatWeAre)
    <section id="service">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="service-area">
                        <div class="title-area">
                            <div align="center"><img src="{{asset('assets/images/we-icon.png')}}"></div>
                            <h2 class="white-font">What we are</h2>
                            <span class="tittle-line"></span>
                            <p>{!! $whatWeAre->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
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
@endsection