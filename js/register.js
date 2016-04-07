$(document).ready(function(){
$sid = true;
$password_check = true;

    $("#password_not_match").hide();
    $("#sid_not_match").hide();

    $("#password_check").keyup(function(){
        if($("#password_check").val() != $("#password").val()){
            $("#password_not_match").show();
            $password_check = false;
            chk();
        }
        else{
            $("#password_not_match").hide();
            $password_check = true;
            chk();
        }
    });

    $("#password").focusout(function(){
        if($("#password_check").val() != $("#password").val()){
            $("#password_not_match").show();
            $password_check = false;
            chk();
        }
        else{
            $("#password_not_match").hide();
            $password_check = true;
            chk();
        }
    });

    $("#sid").focusout(function(){
        if($("#sid").val().length != 9){
            $("#sid_not_match").show();
            $sid = false;
            chk();
        }
        else{
            $("#sid_not_match").hide();
            $sid = true;
            chk();
        }
    });
});



function chk(){
    if($sid && $password_check){
        $("#submit").removeClass("disabled");
        $("#submit").prop('disabled', false);
    }
    else{
        $("#submit").addClass("disabled");
        $("#submit").prop('disabled', true);
    }
}