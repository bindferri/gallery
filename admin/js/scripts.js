$(document).ready(function () {

    var user_href;
    var user_href_splitted;
    var user_id;
    var image_href;
    var image_href_splitted;
    var image_name;

$(".modal_thumbnails").click(function () {
$("#set_user_image").attr('disabled',null);
user_href = $("#user-id").prop('href');
user_href_splitted = user_href.split("=");
user_id = user_href_splitted[user_href_splitted.length - 1];
image_href = $(this).prop("src");
image_href_splitted = image_href.split("/");
image_name = image_href_splitted[image_href_splitted.length - 1];
});
    $("#set_user_image").click(function () {
        $.ajax({
            url: 'includes/ajax_code.php',
            data: {image_name: image_name,user_id: user_id},
            type: "POST",
            success: function (data) {
                if (!data.error){

                }
            }
        });
    });

    $(".info-box-header").click(function () {
        $(".inside").slideToggle("fast");
        $("#toggle").toggleClass("glyphicon-menu-down glyphicon , glyphicon-menu-up glyphicon")
    })

    tinymce.init({selector:'textarea'});
});
