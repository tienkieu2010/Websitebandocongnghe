$(document).ready(function(){
    $("#search-box").keyup(function(){
        $.ajax({
        type: "GET",
        url: "readProduct.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
        });
    });
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}