<!-- BEGAIN PRELOADER -->
<div id="preloader">
    <div class="loader">&nbsp;</div>
</div>
<!-- END PRELOADER -->

<!-- SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
<!-- END SCROLL TOP BUTTON -->


<!-- Start menu section -->
<section id="menu-area">
    <nav class="navbar navbar-default main-navbar" role="navigation">
        <div class="container-fluid no-padding">
            <div class="container">
                <div class="navbar-header">
                    <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- LOGO -->
                    <a class="navbar-brand logo" href="{{route('/')}}"><img src="{{asset('uploads')}}/{{$siteConfig['SITE_LOGO']}}" alt="{{$siteConfig['SITE_NAME']}}"> <span class="logo-text">Dinesh Engineers Pvt. Ltd.</span> </a>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse no-padding">
                <div class="container">
                    <ul id="top-menu" class="nav navbar-nav main-nav menu-scroll">
                        <li><a href="{{route('/')}}" @if($currentRoute == '/')class="active"@endif>Home</a></li>
                        <li><a href="{{route('page-content',array('pageName' => 'about-us'))}}" @if($currentRoute == 'page-content')class="active"@endif>ABOUT US</a></li>
                        <li><a href="{{route('networks')}}" @if($currentRoute == 'networks')class="active"@endif>NETWORK</a></li>
                        <li><a href="{{route('projects')}}" @if($currentRoute == 'projects')class="active"@endif>PROJECTS</a></li>
                        <li><a href="{{route('services')}}" @if($currentRoute == 'services')class="active"@endif>SERVICES</a></li>
                        {{--<li><a href="#">Clients</a></li>--}}
                        <li><a href="{{route('careers')}}" @if($currentRoute == 'careers' || $currentRoute == 'job-details')class="active"@endif>Careers</a></li>
                        <li><a href="{{route('contactus')}}" @if($currentRoute == 'contactus')class="active"@endif>CONTACT</a></li>
                    </ul>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</section>
<!-- End menu section -->