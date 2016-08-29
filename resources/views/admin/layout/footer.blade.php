<script src="{{asset('admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('admin/js/lumino.glyphs.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/custom.min.js')}}"></script>
<script src="{{asset('admin/js/fileupload/jquery.ui.widget.js')}}"></script>
<script src="{{asset('admin/js/fileupload/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('admin/js/fileupload/jquery.fileupload.js')}}"></script>
<script type="text/javascript">
    var fileTempUpload = '{{route("file.temp.upload")}}';
    var removeRoute = '{{route("file.temp.remove")}}';
    var tempPath = '{{asset("uploads/temp")}}/';
    var changeStatus = '{{route("change.status")}}';
</script>
<script src="{{asset('admin/js/common.js')}}"></script>