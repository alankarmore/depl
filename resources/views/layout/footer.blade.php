<!-- Start Contact section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="contact-left wow fadeInLeft">
                    <h2>Useful Links</h2>
                    <ul class="footer-links">
                        <li><a href="{{route('page-content',array('pageName' => 'about-us'))}}">about us</a></li>
                        {{--<li><a href="#">Networks</a></li>--}}
                        <li><a href="{{route('services')}}">Services</a></li>
                        <li><a href="{{route('contactus')}}">Contact</a></li>
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
                    <p>{!! $siteConfig['SITE_ADDRESS']!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact section -->

<!-- Start Footer -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-top-area">
                        <a class="footer-logo" href="{{route('/')}}"><img src="{{asset('uploads')}}/{{$siteConfig['SITE_LOGO']}}" alt="{{$siteConfig['SITE_NAME']}}"></a>
                        <div class="footer-social">
                            <a class="facebook" href="#"><span class="fa fa-facebook"></span></a>
                            <a class="twitter" href="#"><span class="fa fa-twitter"></span></a>
                            <a class="google-plus" href="#"><span class="fa fa-google-plus"></span></a>
                            <a class="youtube" href="#"><span class="fa fa-youtube"></span></a>
                            <a class="linkedin" href="#"><span class="fa fa-linkedin"></span></a>
                            <a class="dribbble" href="#"><span class="fa fa-dribbble"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>{!! $siteConfig['COPYRIGHT_MESSAGE'] !!}.</p>
    </div>
</footer>
<!-- End Footer -->

<!-- initialize jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Bootstrap -->
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<!-- Slick Slider -->
<script type="text/javascript" src="{{asset('assets/js/slick.js')}}"></script>
<!-- Counter -->
<script type="text/javascript" src="{{asset('assets/js/waypoints.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.counterup.js')}}"></script>
<!-- mixit slider -->
<script type="text/javascript" src="{{asset('assets/js/jquery.mixitup.js')}}"></script>
<!-- Add fancyBox -->
<script type="text/javascript" src="{{asset('assets/js/jquery.fancybox.pack.js')}}"></script>
<!-- Wow animation -->
<script type="text/javascript" src="{{asset('assets/js/wow.js')}}"></script>

<!-- Custom js -->
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
