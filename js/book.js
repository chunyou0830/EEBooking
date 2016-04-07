var xmlHTTP;

function $_xmlHttpRequest()
{   
    if(window.ActiveXObject)
    {
        xmlHTTP=new ActiveXObject("Microsoft.XMLHTTP");
    }
    else if(window.XMLHttpRequest)
    {
        xmlHTTP=new XMLHttpRequest();
    }
}

function book(action, bid, sid){    
    $_xmlHttpRequest();
    xmlHTTP.open("GET", "/booking/books/orderop.php?action="+action+"&bid="+bid+"&sid="+sid, true);
    
    xmlHTTP.onreadystatechange=function check_user()
    {
        if(xmlHTTP.readyState == 4)
        {
            if(xmlHTTP.status == 200)
            {
                if(action == "order"){
                    $("#btn"+bid).attr("disabled","disabled");
                    $("#btn"+bid).text("已訂購");
                }
                else if(action == "delete"){
                    //$("#row"+bid).hide();
                    location.reload();
                }
            }
        }
    }
    if(action=="delete"){
        if(confirm("確認刪除？"))
            xmlHTTP.send();
    }
    else{
        xmlHTTP.send();
    }
}


$(document).ready(function(){
    $("#submit").click(function(){

    $uid = $("#uid").val();
    $name = $("#name").val();
    $sid = $("#sid").val();
    $email = $("#email").val();
    $password = $("#password").val();
    $fb_id = $("#fb_id").val();
    $fb_token = $("#fb_token").val();
    
    $_xmlHttpRequest();
    xmlHTTP.open("GET", "../admin/user.php?action=update&uid="+$uid+"&sid="+$sid+"&name="+$name+"&sid="+$sid+"&email="+$email+"&password="+$password+"&fb_id="+$fb_id+"&fb_token="+$fb_token, true);
    
    xmlHTTP.onreadystatechange=function check_user()
    {
        if(xmlHTTP.readyState == 4)
        {
            if(xmlHTTP.status == 200)
            {
                var str=xmlHTTP.responseText;
                console.log(str);
            }
        }
    }
    xmlHTTP.send();

    });
});