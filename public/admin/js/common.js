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

$(function () {
    var formExists = $("form").size();
    if(formExists > 0) {
        $("input:first").focus();
    }
    $(window).on('resize', function () {
        if ($(window).width() > 768)
            $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767)
            $('#sidebar-collapse').collapse('hide')
    });

    $("#image").fileupload({
        formData: {'mediatype': $("#mediatype").val()},
        dataType: 'json',
        url: fileTempUpload,
        limitMultiFileUploads: 1,
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
                $("#fileName").val(data.result.fileName);
                $("#uploadwrapper").html('<img src="' + tempPath + data.result.fileName + '" width="100" height="100"/><a href="javascript:void(0);" class="removeuploadmedia deleteMedia" data-file="' + data.result.fileName + '"><i class="glyphicon glyphicon-remove"></i></a>');
            }

            if (data.result.error != null) {
                $("#fileName").val("");
                $("#uploadwrapper").append('<p class="alert alert-error">' + data.result.error + '</p>');
            }
        }
    });

    $(document).on('click', ".removeuploadmedia", function () {
        var container = ($(this).attr('data-container'))?$(this).attr('data-container'):'temp';
        removeUploadedMedia(removeRoute,container);
    });
});

function handelStatusResponse(response, selector, info) {
    if (response.valid) {
        if (response.status) {
            $("#loader").replaceWith(' <a href="javascript:void(0);" title="Change To Inactive" data-status="' + response.status + '" data-id="' + info.id + '" data-object="' + info.object + '" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>');
        } else {
            $("#loader").replaceWith(' <a href="javascript:void(0);" title="Change To Activ" data-status="' + response.status + '" data-id="' + info.id + '" data-object="' + info.object + '" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>');
        }

        $("#reponseMessage").html('<div class="alert alert-success">' + response.message + '</div>');
        return;
    }

    $("#reponseMessage").html('<div class="alert alert-success">' + response.message + '</div>');
}

function sendAjaxRequest(selector, route, data, method, contentType, replace)
{
    var res = null;
    var info = data || {};
    var dataType = contentType || 'JSON';
    var selector = selector;
    var isReplace = replace || 0;
    var type = method || 'GET';
    $.ajax({
        url: route,
        type: type,
        data: info,
        dataType: dataType,
        beforeSend: function () {
            if (isReplace && selector) {
                selector.replaceWith('<span class="glyphicon glyphicon-refresh" aria-hidden="true" id="loader"></span>');
            }
        },
        success: function (response) {
            res = response;
        },
        complete: function () {
            handelStatusResponse(res, selector, info);
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
        pageSize: 10
    });
}

/**
 * Remove uploaded media
 *
 * @param {string} removeRoute
 * @param {string} container
 * @returns {void}
 */
function removeUploadedMedia(removeRoute,container)
{
    var result = null;

    $.ajax({
        url: removeRoute,
        type: "POST",
        dataType: "JSON",
        data: {"file": $("#fileName").val(),"container":container},
        beforeSend: function () {

        },
        success: function (response) {
            result = response;
        },
        complete: function () {
            if (result.valid == true) {
                $("#uploadwrapper").html('');
                $("#fileName").val('');
                $('input[type=file]').closest("form")[0].reset();
            }
        }
    });

}

function activeParentMenu(menu)
{
    $("#"+sidebar-menu+' ul.menu-nav li.parent').removeClass('active')
    var parentMenu = $("#"+menu).parent();
    parentMenu.addClass('active');
    $("ul:first", parentMenu).slideDown();
}

$(document).on('click', '.change-status', function (e) {
    var route = changeStatus;
    var data = {'id': $(this).attr('data-id'), 'object': $(this).attr('data-object'), 'status': $(this).attr('data-status')};
    sendAjaxRequest($(this), route, data, 'POST', 'JSON', 'handelStatusResponse', 1);
});