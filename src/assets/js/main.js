(document).ready(function () {
    $("#login_btn").click(function () {
        var pseudo = $("#pseudo").val();
        var password = $("#password").val();
        var request =
            $.ajax({
                type: "POST",
                url: "login.php",
                data: {
                    id: pseudo,
                    pwd: password
                },
                dataType: "html",
                success: function (html) {
                    if (html == false)
                        $("#incp").show();
                    else
                        window.location.href = "../../index.php";
                }

            });
    });
});