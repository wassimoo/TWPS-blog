$(document).ready(function(){
    $("#1").trigger("click");

    $(".nav").click(function(){
        var pageNum  = this.id;
      $.ajax({
          type: "POST",
          url: "bloglist",
          data:{
              page : pageNum
          },
          dataType: "html",
          success: function (html) {
              if(html != "false"){
                  $(".m-blog_listing").html(html);
              }
              else{
                  $(".m-blog_listing").innerHTML = "Cette service n'est pas disponible è ce moment<br> Veuillez ressayer dans quelques instants."; 
              }
          }
      })
    });
});