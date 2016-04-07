$(document).ready(function(){
    $("#filter").keyup(function(){
 
        var filter = $(this).val(), count = 0;
 
        $("#books>div").each(function(){
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });
    });
});