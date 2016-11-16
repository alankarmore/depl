@extends('layout.main')
@section('content')
    <!-- Start banner section -->
    <div class="container-fluid no-padding">
        <div class="inner-banner">
            <img src="{{route('getimage',array('width' => 1366, 'height' => 244, 'folder' => 'cms', 'file' => $pageContent->image))}}">
        </div>
    </div>
    <!-- End banner section -->

    <!-- Start services section -->
    <section class="inner-content margin-top134">
        <div class="container wow fadeInUp">
            <div align="center">
                <h2>Services</h2>
                <div class="green-sep"></div>
            </div>
            @if($pageContent->description)
                <p class="margin-top20">{!! $pageContent->description !!}</p>
            @endif
        </div>

        <div class="col-md-12 margin-top20">
            @foreach($services as $key => $service)
                <?php $key = $key + 1; ?>
                @if($key % 2 != 0)
                <div class="margin-top20 col-md-4 col-sm-12 col-xs-12 wow fadeInLeft">
                    <img src="{{route('getimage',array('width' => 406, 'height' => 265, 'folder' => 'service', 'file' => $service->image))}}" alt="{{$service->title}}" class="img-responsive">
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 wow fadeInRight">
                    <h2 class="tittle"><a href="{{route('service-details',array('name' => $service->slug))}}"> {{ucfirst($service->title)}}</a></h2>
                    {!! substr($service->description,0,800) !!} ...
                </div>
                <div class="clear"></div>
                <div align="center" class="margin-top20"><a href="{{route('service-details',array('name' => $service->slug))}}" class="more-btn wow fadeInTop">Read more</a></div>
                <hr/>
                @else
                    <div class="margin-top20 col-md-8 col-sm-12 col-xs-12 wow fadeInLeft">
                        <h2 class="tittle"><a href="{{route('service-details',array('name' => $service->slug))}}">{{ucfirst($service->title)}}</a></h2>
                        {!! substr($service->description,0,800) !!} ...
                    </div>
                    <div class="margin-top20 col-md-4 col-sm-12 col-xs-12 wow fadeInRight">
                        <img src="{{route('getimage',array('width' => 406, 'height' => 265, 'folder' => 'service', 'file' => $service->image))}}" alt="img" class="img-responsive">
                    </div>
                    <div class="clear"></div>
                    <div align="center" class="margin-top20"><a href="{{route('service-details',array('name' => $service->slug))}}" class="more-btn wow fadeInTop">Read more</a></div>
                    <hr/>
                @endif
            @endforeach
    </section>
    <!-- End services section -->
@endsection