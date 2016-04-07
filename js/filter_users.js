$(document).ready(function(){
    $("#filter").keyup(function(){
 
        var filter = $(this).val(), count = 0;
 
        $("#list>tr").each(function(){
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            }
            else {
                $(this).show();
            }
        });
    });
});