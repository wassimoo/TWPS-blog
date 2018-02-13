
$(document).ready(function () {
    var active = null;
    function fetchData() {
        $(".m-blog_listing").css({"display":"none"});
        $(".parent").css({"display":"block"});
        var pageNum = this.id ? this.id : 1;
        if(active)
            $(active).attr("class","nav");

        active = $("#"+pageNum);
        $(active).attr("class","nav active");

        $.ajax({
            type: "POST",
            url: "bloglist",
            data: {
                page: pageNum
            },
            dataType: "html",
            success: function (html) {
                $(".parent").css({"display":"none"});
                if (html != "false") {
                    $(".m-blog_listing").html(html);
                }
                else {
                    $(".m-blog_listing").html("Cette service n'est pas disponible è ce moment<br> Veuillez ressayer dans quelques instants.");
                }
                $(".m-blog_listing").css({"display":""});
            }
        })
    }
    fetchData();
    $(document).on("click", ".nav", fetchData);
});