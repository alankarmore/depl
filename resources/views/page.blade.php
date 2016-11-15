@extends('layout.main')
@section('content')

    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{route('getimage',array('width' => 1366, 'height' => 244, 'folder' => 'cms', 'file' => $pageContent->image))}}">
        </div>
    </div>
    <!-- End banner section -->
   <!-- Start about section -->
    <section class="inner-about margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>{{ucwords($pageContent->title)}}</h2>
                <div class="green-sep"></div>
            </div>
            <p class="margin-top20">{!! substr($pageContent->description,0,624) !!}</p>
        </div>
        <!-- Start call to action -->
        <section id="call-to-action">
            <img src="{{asset('assets/images/banner2.jpg')}}" alt="img">
            <div class="call-to-overlay">
                <div class="container">
                    <div class="call-to-content wow fadeInUp">
                        <p>In the recent past we have diversified and entered in to Gas Pipe laying Projects awarded by Mahanagar Gas Limited ( MGL ).</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End call to action -->
        <div class="container wow fadeInUp">
            <p>{!! substr($pageContent->description,624) !!}</p>
        </div>
    </section>
    <!-- End about section -->
   <!-- Start team section -->
    @if($pageContent->id == 2)
    <section id="inner-team">
        <img src="{{asset('assets/images/banner3.jpg')}}" alt="img">
        <div class="team-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow fadeInUp">
                        <!-- Start team area -->
                        <div class="team-innerarea">
                            <div align="center">
                                <h2>{{ ucfirst($subcontent->title) }}</h2>
                                <div class="green-sep"></div>
                            </div>
                            <p>{!! $subcontent->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End team section -->
   <!-- Start project section -->
    @if($members)
    <section id="projects">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div align="center">
                        <h2>Our Team</h2>
                        <div class="green-sep"></div>
                    </div>
                    <!-- Start project area -->
                    <div class="project-area wow fadeInUp">
                        <div class="project-conten">
                            <!-- Start project slider -->
                            <div class="project-slider">
                                <!-- single slide -->
                                @foreach($members as $member)
                                <div class="single-slide">
                                    <div class="col-md-4 col-sm-12 col-xs-12"><div class="project-thumb"><img class="project-thumb" src="{{route('getimage',array('width' => 345, 'height' => 426, 'folder' => 'member', 'file' => $member->image))}}" alt="img"></div></div>
                                    <div class="col-md-8 col-sm-12 col-xs-12"><div class="project-details">
                                            <h2>{{ucfirst($member->first_name)}} {{ucfirst($member->last_name)}}</h2>
                                            <div class="about-project">Designation: <span class="text-green">{{ucfirst($member->designation)}}</span></div>
                                            <p>
                                                Description : {{$member->description}}.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!-- End project section -->
    {{-- <section id="organization">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="margin-bottom40" align="center">
                        <h2>Organization Chart</h2>
                        <div class="green-sep"></div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12 wow fadeInLeft"><img src="{{asset('assets/images/chart1.jpg')}}" alt="img"></div>
                    <div class="col-md-6 col-sm-12 col-xs-12 wow fadeInRight"><img src="{{asset('assets/images/chart2.jpg')}}" alt="img"></div>
                </div>
            </div>
        </div>
    </section> --}}
{{--    <section id="registration">
        <div align="center"><a href="#" class="register-btn">Registration</a></div>
        <img class="margin-top70" src="assets/images/footer.png" alt="img">
    </section>--}}

@endsection
