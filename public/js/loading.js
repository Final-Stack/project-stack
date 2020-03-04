$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#wait").show()
    });
    $(document).ajaxComplete(function () {
        $("#wait").hide();
    });
});
