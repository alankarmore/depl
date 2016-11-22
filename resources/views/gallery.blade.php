@extends('layout.main')
@section('content')
    <div class="container-fluid no-padding">
        <div class="row">
            <div class="col-md-12">
                <!-- Start welcome area -->
                <div class="welcome-area">
                    @if($albumName)
                        <a href="{{route('gallery')}}" class="pull-right button">Back to Gallery</a>
                    @endif
                    <div class="title-area">
                        <h2 class="tittle wow fadeInUp">@if($albumName) {{$albumName}} @else Gallery @endif</h2>
                        <div class="green-sep"></div>
                    </div>
                </div>
                <!-- End welcome area -->
            </div>
        </div>
    </div>
    <!-- Start about section -->
    <div class="container ">
        <div class="row" id="officeImages">
            @if(!empty($albumImages) && $albumName != null)
                <ul class="row">
                    @foreach($albumImages as $albumImage)
                        <li class="col-lg-2 col-md-2 col-md-3 margin-top40">
                            <img class="img-responsive" src="{{route('getimage',array('width' => 800, 'height' => 600, 'folder' => 'albums', 'file' => $albumImage['image']))}}" />
                        </li>
                    @endforeach
                </ul>
            @elseif($albums && $albumName == null)
                @foreach($albums as $album)
		    @if(isset($album->albumImages) && $album->albumImages->count() > 0)
                    <div class="col-md-4">
                        <a href="{{route('gallery',array('album' => $album->slug))}}"><h2>{{ucwords($album->name)}}</h2></a>
                        <a href="{{route('gallery',array('album' => $album->slug))}}" class="gallery">
                            <img class="img-responsive" src="{{route('getimage',array('width' => 800, 'height' => 600, 'folder' => 'albums', 'file' => $album->albumImages->first()->image))}}" />
                        </a>
                    </div>
		    @endif
                @endforeach
            @else
                <div class="margin-top40"><a href="{{route('gallery')}}" class="pull-right button">Back to Gallery</a></div>
                <div class="alert alert-warning margin-top20">Opps! No Images found or may be you have chosen wrong Album </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
    <script>
        $(document).ready(function(){
            $('li img').on('click',function(){
                var src = $(this).attr('src');
                var img = '<img src="' + src + '" class="img-responsive"/>';

                //start of new code new code
                var index = $(this).parent('li').index();

                var html = '';
                html += img;
                html += '<div style="height:25px;clear:both;display:block;">';
                html += '<a class="controls next" href="'+ (index+2) + '">next &raquo;</a>';
                html += '<a class="controls previous" href="' + (index) + '">&laquo; prev</a>';
                html += '</div>';

                $('#myModal').modal();
                $('#myModal').on('shown.bs.modal', function(){
                    $('#myModal .modal-body').html(html);
                    //new code
                    $('a.controls').trigger('click');
                })
                $('#myModal').on('hidden.bs.modal', function(){
                    $('#myModal .modal-body').html('');
                });
            });
        })

        $(document).on('click', 'a.controls', function(){
            var index = $(this).attr('href');
            var src = $('ul.row li:nth-child('+ index +') img').attr('src');

            $('.modal-body img').attr('src', src);

            var newPrevIndex = parseInt(index) - 1;
            var newNextIndex = parseInt(newPrevIndex) + 2;

            if($(this).hasClass('previous')){
                $(this).attr('href', newPrevIndex);
                $('a.next').attr('href', newNextIndex);
            }else{
                $(this).attr('href', newNextIndex);
                $('a.previous').attr('href', newPrevIndex);
            }

            var total = $('ul.row li').length + 1;
            //hide next button
            if(total === newNextIndex){
                $('a.next').hide();
            }else{
                $('a.next').show()
            }
            //hide previous button
            if(newPrevIndex === 0){
                $('a.previous').hide();
            }else{
                $('a.previous').show()
            }


            return false;
        });
    </script>
@endsection
@endsection
