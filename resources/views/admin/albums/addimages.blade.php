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
            <h1 class="page-header">Add Images For Offices</h1>
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
                                <input type="text" name="name" id="name" value="{{old('name')?old('name'):""}}"  class="form-control"/>
                                <span class="alert-danger">{{$errors->first('name')}}</span>
                            </div>
                            <div class="form-group">
                                <label>New Image</label>
                                <input type="file" name="cover_image" id="cover_image" accept="image/*" />
                                <input type="hidden" name="mediatype" id="mediatype" value="cover_image" />
                                <input type="hidden" name="fileName" id="fileName" value=""  />
                                <span class="alert-danger">{{$errors->first('office_image')}}</span>
                            </div>
                            <div id="uploadwrapper"></div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <a href="{{route('office.list')}}" class="btn btn-default">Cancel</a>
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
        $("#cover_image").fileupload({
            formData: {'mediatype': $("#mediatype").val()},
            dataType: 'json',
            url: fileTempUpload,
            limitMultiFileUploads: 1,
            maxNumberOfFiles: 1,
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
                        self.parent().remove();
                        $('input[type=file]').closest("form")[0].reset();
                    }
                }
            });
        });
    });

    activeParentMenu('office');
</script>
@endsection
@endsection