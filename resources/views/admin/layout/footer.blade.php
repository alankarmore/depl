<script src="{{asset('admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('admin/js/lumino.glyphs.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script>
!function ($) {
    $.ajaxPrefilter(function (options, originalOptions, xhr) { // this will run before each request
        var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using
        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
        }
    });
    $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
        $(this).find('em:first').toggleClass("glyphicon-minus");
    });
    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
}(window.jQuery);

$(window).on('resize', function () {
    if ($(window).width() > 768)
        $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
    if ($(window).width() <= 767)
        $('#sidebar-collapse').collapse('hide')
});
function handelStatusResponse(response,selector) {
    console.log(response,selector);
}


function sendAjaxRequest(selector,route,data,method,contentType,replace) 
{
    var res = null;
    var info = data || {};
    var dataType = contentType || 'JSON';
    var selector = selector;
    var isReplace = replace || 0;
    var type = method || 'GET';
    $.ajax({
       url:route,
       type:type,
       data:info,
       dataType:dataType,
       beforeSend:function(){
            if(isReplace && selector) {
                selector.replaceWith('L...');
            }
       },
       success:function(response){
           res = response;
       },
       complete:function(){
           handelStatusResponse(res,selector);
       }
    });
}
function generateTable(selector, route, sortColumn, sortOrder) {
    $("#" + selector).bootstrapTable({
        url: route,
        contentType: 'application/x-www-form-urlencoded',
        queryParams: function (p) {
            return {
                limit: p.limit,
                offset: p.offset,
                search: (p.search) ? p.search : "",
                sort: p.sort,
                order: p.order
            };
        },
        method: 'post',
        pagination: true,
        sidePagination: 'server',
        search: true,
        sortName: sortColumn,
        sortOrder: sortOrder,
        cache: false,
        pageSize: 10,
    });
}


</script>