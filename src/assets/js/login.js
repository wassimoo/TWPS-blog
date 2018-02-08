$(document).ready(function () {
    $("#login_btn").click(function(e) {
        e.preventDefault();
        var pseudo = $("#pseudo").val();
        var password = $("#password").val();
        var request =
            $.ajax({
                type: "POST",
                url: "validate",
                data: {
                    id: pseudo,
                    pwd: password
                },
                dataType: "html",
                success: function (html) {
                    if(html != "true")
                        $("#incp").show();
                    else
                    window.location.replace("home");
            }
            });
    });
});