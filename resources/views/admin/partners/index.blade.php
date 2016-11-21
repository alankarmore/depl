@extends('admin.layout.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active"><a href="javascript:void(0);">Partners</a></li>
                <li class="active"></li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Partners</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            @include('admin.messages')
                            <div id="partnerImages">
                                @if($partners->count() > 0)
                                    @foreach($partners as $partner)
                                        <span id="{{$partner->id}}" class="spanImage">
                                                <img src="{{asset('uploads/partners')}}/{{$partner->image}}" width="100" height="100">
                                                <a href="javascript:void(0);" class="removeImage" data-id="{{$partner->id}}">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                            </span>
                                    @endforeach
                                @else
                                    <div id="error" class="alert alert-warning">No partner Images found <a href="{{route('partners.save.images')}}">Click Here</a> to add new partner images</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->
    </div><!--/.main-->
@section('page-script')
    <script>
        $(function(){
            $(document).on('click', ".removeImage", function () {
                var self = $(this);
                var result = null;
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '{{route('partners.images.remove')}}',
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
                        }

                        var size = (".spanImage").size();
                        if(size == 0) {
                            $("#error").show();
                        } else {
                            $("#error").hide();
                        }
                    }
                });
            });
        });

        activeParentMenu('partners');
    </script>
@endsection
@endsection