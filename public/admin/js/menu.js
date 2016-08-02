$(function () {
    if (parseInt(parentMenus) <= 0) {
        $("#include_in").hide();
    }

    $("#include_in").change(function () {
        selected = $(this).val();
        hideElements(selected);
    });
});

function hideElements(selected)
{
    if (parseInt(selected) >= 1) {
        $(".meta").hide();
    } else {
        $(".meta").show();
    }
}
