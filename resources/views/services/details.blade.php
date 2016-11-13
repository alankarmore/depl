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
                <h2>{{ucfirst($service->title)}}</h2>
                <div class="green-sep"></div>
            </div>
            <p class="margin-top20">{!! $service->description !!}</p>
        </div>
        @if(isset($workFlows) && !empty($workFlows))
        <div class="col-md-12 margin-top20">
            <div class = "container">
                <div class="panel-group" id="accordion">
                    @foreach($workFlows as $workFlow)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <a class="" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$workFlow->id}}">
                            <h4 class="panel-title accordion-toggle">
                                    <span class="services-tittle">{{ucfirst($workFlow->title)}}</span>
                            </h4>
</a>
                        </div>
                        <div id="collapse{{$workFlow->id}}" class="panel-collapse collapse">
                            <div class="panel-body">{!! $workFlow->description !!}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div> <!-- end container -->
        </div>
            @endif
    </section>
    <!-- End services section -->
@endsection
