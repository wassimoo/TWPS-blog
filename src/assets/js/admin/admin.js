$(document).ready(function () {

    var active1 = false;
    var active2 = false;
    var active3 = false;
    var active4 = false;

    $('.parent2').on('mousedown touchstart', function () {

        if (!active1) $(this).find('.logout').css({ 'background-color': 'gray', 'transform': 'translate(0px,125px)' });
        else $(this).find('.logout').css({ 'background-color': 'dimGray', 'transform': 'none' });
        if (!active2) $(this).find('.med').css({ 'background-color': 'gray', 'transform': 'translate(-60px,105px)' });
        else $(this).find('.med').css({ 'background-color': 'darkGray', 'transform': 'none' });
        if (!active3) $(this).find('.new').css({ 'background-color': 'gray', 'transform': 'translate(-105px,60px)' });
        else $(this).find('.new').css({ 'background-color': 'silver', 'transform': 'none' });
        if (!active4) $(this).find('.upload').css({ 'background-color': 'gray', 'transform': 'translate(-125px,0px)' });
        else $(this).find('.upload').css({ 'background-color': 'silver', 'transform': 'none' });
        active1 = !active1;
        active2 = !active2;
        active3 = !active3;
        active4 = !active4;

    });

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