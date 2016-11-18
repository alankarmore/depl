@extends('admin.layout.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li ><a href="{{route('albums.list')}}">Albums</a></li>
                <li class="active">{{ucwords($album->name)}} Images</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ucwords($album->name)}} Images</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12" id="officeImages">
                            @include('admin.messages')
                            @if($album->albumImages && $album->albumImages->count())
                                <ul class="row">
                                    @foreach($album->albumImages as $albumImage)
                                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                            <img class="img-responsive" src="{{asset('uploads/albums')}}/{{$albumImage->image}}" />
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                No Images found for. Add images <a href="{{route('albums.images')}}">click here</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->


        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div><!--/.main-->
@section('page-script')
    <style>
        #officeImages ul {
            padding:0 0 0 0;
            margin:0 0 0 0;
        }
        #officeImages ul li {
            list-style:none;
            margin-bottom:25px;
        }
        #officeImages ul li img {
            cursor: pointer;
        }
        .modal-body {
            padding:5px !important;
        }
        .modal-content {
            border-radius:0;
        }
        .modal-dialog img {
            text-align:center;
            margin:0 auto;
        }
        .controls{
            width:50px;
            display:block;
            font-size:11px;
            padding-top:8px;
            font-weight:bold;
        }
        .next {
            float:right;
            text-align:right;
        }
        /*override modal for demo only*/
        .modal-dialog {
            max-width:500px;
            padding-top: 90px;
        }
        @media screen and (min-width: 768px){
            .modal-dialog {
                width:500px;
                padding-top: 90px;
            }
        }
        @media screen and (max-width:1500px){
            #ads {
                display:none;
            }
        }
    </style>
    <script src="{{asset('admin/js/photo-gallery.js')}}"></script>
    <script>
        activeParentMenu('albums');
    </script>
@endsection
@endsection