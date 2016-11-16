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
                <h2>Our Major Projects</h2>
                <div class="green-sep"></div>
            </div>
            @if(!empty($pageContent->description))
                <p class="margin-top20">{!! $pageContent->description !!}</p>
            @endif
        </div>

        <div class="col-md-12 margin-top20">
            @foreach($projects as $key => $project)
                <?php $key = $key + 1; ?>
                @if($key % 2 != 0)
                <div class="margin-top20 col-md-4 col-sm-12 col-xs-12 wow fadeInLeft">
                    <img src="{{route('getimage',array('width' => 406, 'height' => 265, 'folder' => 'project', 'file' => $project->image))}}" alt="{{$project->title}}">
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12 wow fadeInRight">
                    <h2 class="tittle"><a href="{{route('project-details',array('name' => $project->slug))}}"> {{ucfirst($project->title)}}</a></h2>
                    {!! substr($project->description,0,800) !!} ...
                </div>
                <div class="clear"></div>
                <div align="center" class="margin-top20"><a href="{{route('project-details',array('name' => $project->slug))}}" class="more-btn wow fadeInTop">Read more</a></div>
                <hr/>
                @else
                    <div class="margin-top20 col-md-8 col-sm-12 col-xs-12 wow fadeInLeft">
                        <h2 class="tittle"><a href="{{route('project-details',array('name' => $project->slug))}}">{{ucfirst($project->title)}}</a></h2>
                        {!! substr($project->description,0,800) !!} ...
                    </div>
                    <div class="margin-top20 col-md-4 col-sm-12 col-xs-12 wow fadeInRight">
                        <img src="{{route('getimage',array('width' => 406, 'height' => 265, 'folder' => 'service', 'file' => $project->image))}}" alt="img">
                    </div>
                    <div class="clear"></div>
                    <div align="center" class="margin-top20"><a href="{{route('project-details',array('name' => $project->slug))}}" class="more-btn wow fadeInTop">Read more</a></div>
                    <hr/>
                @endif
            @endforeach
    </section>
    <!-- End services section -->
@endsection