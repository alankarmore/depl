<!-- BEGAIN PRELOADER -->
{{--<div id="preloader">
    <div class="loader">&nbsp;</div>
</div>--}}
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
                    <a class="navbar-brand logo" href="{{route('/')}}"><img src="{{asset('uploads')}}/{{$siteConfig['SITE_LOGO']}}" alt="{{$siteConfig['SITE_NAME']}}"> <span class="blue-text">Dinesh</span> Engineers Pvt. Ltd.</a>
                    <div class="pull-right">
                        <ul class="social-links">
                            <li>
                                <a href="#"><img src="assets/images/email.png" align="absmiddle" alt="Email"> Email us</a>
                            </li>
                            <li><a href="#" class="twitter-icon">&nbsp;</a></li>
                            <li><a href="#" class="facebook-icon">&nbsp;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse no-padding">
                <div class="container">
                    <ul id="top-menu" class="nav navbar-nav main-nav menu-scroll">
                    </ul>
                </div>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</section>
<!-- End menu section -->