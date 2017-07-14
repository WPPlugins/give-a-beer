var xPPLink = "";
function xGABSend(xFile,xLink){
    loadXMLDoc(xFile);
    xPPLink = xLink;
}
/*
///-----------------------------------------------------
//----------------------httprequest---------------------
///-----------------------------------------------------
*/

var xmlhttp;
var httpID = "xGABReturn";

function loadXMLDoc(url)
{
    xmlhttp=null;
    if (window.XMLHttpRequest)
    {// code for Firefox, Opera, IE7, etc.
        xmlhttp=new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if (xmlhttp!=null)
    {
        xmlhttp.onreadystatechange=state_Change;
        xmlhttp.open("GET",url,true);
        xmlhttp.send(null);
    }
    else
    {
        alert("Your browser does not support XMLHTTP.");
    }
}

function state_Change()
{
    if (xmlhttp.readyState==4)
    {// 4 = "loaded"
        if (xmlhttp.status==200)
        {// 200 = "OK"
            document.getElementById(httpID).innerHTML=xmlhttp.responseText;
            if(xPPLink!=""){
                document.location = xPPLink;
            }
        }
        else
        {
            alert("Problem retrieving data:" + xmlhttp.statusText);
        }
    }
}