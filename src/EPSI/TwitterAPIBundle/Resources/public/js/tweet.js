/**
 * Created by Pierre-Antoine on 27/10/2016.
 */
$(document).ready(function(){


    $(".save_tweet").on("click", function(){

        var route = $(this).attr('route');
        var divToHide = $(this).parent();

        $.ajax({
            url: route,
            success: function (response) {
                if(response == "save"){
                    $(divToHide).hide();
                }
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    $(".revome_tweet").on("click", function(){

        var route = $(this).attr('route');
        var divToHide = $(this).parent();
        alert('remove');
        $.ajax({
            url: route,
            success:function (response) {
                if(response == "Removed"){
                    divToHide.hide();
                }
            },
            error: function(error){
                console.log(error);
            }
        })

    });

});