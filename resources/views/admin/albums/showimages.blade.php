@extends('admin.layout.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li ><a href="{{route('office.list')}}">Our Offices</a></li>
                <li class="active">Office Images</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Office Images</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12" id="officeImages">
                            @include('admin.messages')
                            @if($officeImages->count())
                                <ul class="row">
                                    @foreach($officeImages as $officeImage)
                                        <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                                            <p>{{ucwords($officeImage->office->title)}}</p>
                                            <img class="img-responsive" src="{{asset('uploads/office')}}/{{$officeImage->image}}">
                                            <a href="javascript:void(0);" data-id="{{$officeImage->id}}" class="removeOfficeImage"><i class="glyphicon glyphicon-remove"></i></a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                No Images found for. Add images for office  <a href="{{route('office.images')}}">click here</a>
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
        var removeOfficeImage = "{{route('office.images.remove')}}"
        $(function(){
            $("#office_image").fileupload({
                formData: {'mediatype': $("#mediatype").val()},
                dataType: 'json',
                url: fileTempUpload,
                limitMultiFileUploads: 10,
                maxNumberOfFiles: 10,
                sequentialUploads: true,
                replaceFileInput: false,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                beforeSend: function (e) {
                    $("#loading_image").remove();
                    $('p.alert .alert-error').remove();
                    $("input[type='file']").after('<span id="loading_image" class="pull-left" style="margin-left: 5px;"></span>');
                },
                done: function (e, data) {
                    $("#loading_image").remove();
                    if (data.result.valid == 1) {
                        var fileNames = $("#fileName").val() || "";
                        if(fileNames != '') {
                            fileNames +=",";
                        }
                        fileNames += data.result.fileName;
                        $("#fileName").val(fileNames);
                        $("#uploadwrapper").append('<span id="'+data.result.fileName+'"><img src="' + tempPath + data.result.fileName + '" width="100" height="100"/><a href="javascript:void(0);" class="removeMultiple" data-file="' + data.result.fileName + '"><i class="glyphicon glyphicon-remove"></i></a></span>');
                    }

                    if (data.result.error != null) {
                        $fileNames = $("#fileName").val();
                        $("#uploadwrapper").append('<p class="alert-danger">' + data.result.error + '</p>');
                    }
                }
            });


            $(document).on('click', ".removeMultiple", function () {
                var self = $(this);
                var result = null;
                var fileName = $(this).attr('data-file');
                var container = $(this).attr('data-container') || 'temp';
                $.ajax({
                    url: removeRoute,
                    type: "POST",
                    dataType: "JSON",
                    data: {"file": fileName,"container":container},
                    beforeSend: function () {

                    },
                    success: function (response) {
                        result = response;
                    },
                    complete: function () {
                        if (result.valid == true) {
                            self.parent().remove();
                            $('input[type=file]').closest("form")[0].reset();
                        }
                    }
                });
            });

            $(document).on('click', ".removeOfficeImage", function () {
                var confirmed =  confirm('Are you sure?');
                if(confirmed) {
                    var self = $(this);
                    var result = null;
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: removeOfficeImage,
                        type: "POST",
                        dataType: "JSON",
                        data: {"id": id},
                        beforeSend: function () {

                        },
                        success: function (response) {
                            result = response;
                        },
                        complete: function () {
                            if (result.valid == true) {
                                self.parent().remove();
                                if($("ul.row > li").size() == 0) {
                                    $("#officeImages").html('No Images found for. Add images for office  <a href="{{route('office.images')}}">click here</a>');
                                }
                            }
                        }
                    });
                }
            });
        });

        activeParentMenu('office');
    </script>
@endsection
@endsection