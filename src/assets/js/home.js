
$(document).ready(function () {
   
    var tabs = $('.m-pagination li').length-2;
    var active = null;
    var activeId = null;
   
    function fetchData() {
        $(".m-blog_listing").css({"display":"none"});
        $(".parent").css({"display":"block"});
        activeId = this.id ? this.id : 1;
        if(active)
            $(active).attr("class","nav");

        active = $("#"+activeId);
        $(active).attr("class","nav active");

        $.ajax({
            type: "POST",
            url: "bloglist",
            data: {
                page: activeId
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


    $(document).on("click", ".nav", fetchData);
    $(".fa-arrow-right").click(function(){
        if(parseInt(activeId) >= tabs)
            return; 
        var next = $("#"+ (++activeId));
        next.click();
    });

    $(".fa-arrow-left").click(function(){
        if(parseInt(activeId) == "1")
            return;
        var prev = $("#"+ (--activeId));
        prev.click();
    });


    fetchData();
});