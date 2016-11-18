@extends('admin.layout.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li ><a href="{{route('albums.list')}}">Albums</a></li>
                <li class="active">New Album</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create New Album & Add images in it</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            @include('admin.messages')
                            <form role="form" name="frmAlbum" id='frmAlbum' enctype="multipart/form-data" action="{{route('album.save.images')}}" method="POST">
                                <div class="form-group">
                                    <label>Album Name</label>
                                    <input type="text" name="title" id="title" value="{{old('title')?old('title'):""}}"  class="form-control"/>
                                    <span class="alert-danger">{{$errors->first('title')}}</span>
                                </div>
                                <div class="form-group">
                                    <label>New Image</label>
                                    <input type="file" name="images" id="images" accept="image/*" multiple/>
                                    <input type="hidden" name="mediatype" id="mediatype" value="images" />
                                    <input type="hidden" name="fileName" id="fileName" value=""  />
                                </div>
                                <div id="uploadwrapper" style="margin-bottom: 10px;"></div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <a href="{{route('albums.list')}}" class="btn btn-default">Cancel</a>
                                    <button name="submit" type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
    </div><!--/.main-->
@section('page-script')
    <script>
        $(function(){
            $("#images").fileupload({
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
                $.ajax({
                    url: removeRoute,
                    type: "POST",
                    dataType: "JSON",
                    data: {"file": fileName},
                    beforeSend: function () {

                    },
                    success: function (response) {
                        result = response;
                    },
                    complete: function () {
                        if (result.valid == true) {
                            $fileNames = $("#fileName").val().split(",");
                            var index = $fileNames.indexOf(fileName);
                            if (index > -1) {
                                $fileNames.splice(index, 1);
                                $("#fileName").val($fileNames.join(","));
                            }

                            self.parent().remove();
                        }
                    }
                });
            });
        });

        activeParentMenu('office');
    </script>
@endsection
@endsection