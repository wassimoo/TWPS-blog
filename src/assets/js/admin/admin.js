$(document).ready(function () {
    $("#saveContent").click(function (e) {
        e.preventDefault();
        var id = document.location.href.match(/[^\/]+$/)[0];
        var title = window.Editor[0].element.innerText;
        var content = window.Editor[1].element.innerHTML;
        var cover = $("#cover img").attr("src");
        $.ajax({
            type: "POST",
            //TODO : change to server url;
            url: "http://localhost/blog/updatecontent",
            data: {
                id: id,
                title: title,
                content: content,
                cover: cover
            },
            datatype: "html",
            success: function (html) {
                if (html == "true")
                    location.reload(true);
                else {
                    window.location.replace("http://localhost/blog/login");
                }
            }
        })
    });
});