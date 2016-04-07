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

function order_status(action, oid){    
    $_xmlHttpRequest();
    xmlHTTP.open("GET", "/booking/books/orderop.php?action="+action+"&oid="+oid, true);
    xmlHTTP.onreadystatechange=function check_user()
    {
        if(xmlHTTP.readyState == 4)
        {
            if(xmlHTTP.status == 200)
            {
                $("#status-ordered-"+oid).removeClass("active");
                $("#status-ordered-"+oid).removeClass("btn-primary");
                $("#status-ordered-"+oid).addClass("btn-info");
                $("#status-arrived-"+oid).removeClass("active");
                $("#status-arrived-"+oid).removeClass("btn-primary");
                $("#status-arrived-"+oid).addClass("btn-info");
                $("#status-recieved-"+oid).removeClass("active");
                $("#status-recieved-"+oid).removeClass("btn-primary");
                $("#status-recieved-"+oid).addClass("btn-info");
                $("#status-"+action+"-"+oid).addClass("active");
                $("#status-"+action+"-"+oid).removeClass("btn-info");
                $("#status-"+action+"-"+oid).addClass("btn-primary");

                //location.reload();
            }
        }
    }
    xmlHTTP.send();
}