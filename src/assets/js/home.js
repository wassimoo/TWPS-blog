
$(document).ready(function () {
    var active = null;
    function fetchData() {
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
                if (html != "false") {
                    $(".m-blog_listing").html(html);
                }
                else {
                    $(".m-blog_listing").innerHTML = "Cette service n'est pas disponible è ce moment<br> Veuillez ressayer dans quelques instants.";
                }
            }
        })
    }
    fetchData();
    $(document).on("click", ".nav", fetchData);
});


