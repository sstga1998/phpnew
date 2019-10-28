<?php 
session_start();
include_once("model/user.php");
if (!isset($_SESSION["user"]))
    header("location:login.php");
include_once("header.php")
?>                 
<?php 
include_once("nav.php")
?>
<?php 

echo "<h1>Bài số 6</h1>" 
?>
<button onclick="testAjax();" type="button">Test Javascript</button>
<div id="contentAjax">

</div>
<?php 
include_once("footer.php")
?>
<script>
    function testAjax(){
        var a = "Xin chào";
        //alert(a);
        //document.getElementById("contentAjax").innerHTML=a;
        var contentElement = document.getElementById("contentAjax");
        console.log(contentElement);
        contentElement.innerHTML=a;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status==200){
                // var user = JSON.parse(this.responseText);
                // var str = "<ul>";
                // str +="<li>";
                // str += "userName:" + user.userName;
                // str +="</li>";

                // str +="<li>";
                // str += "passWord:" + user.passWord;
                // str +="</li>";

                // str +="<li>";
                // str += "fullName:" + user.fullName;
                // str +="</li>";
                // str +="</ul>";
                // document.getElementById("contentAjax").innerHTML= str;
                document.getElementById("contentAjax").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "testajax.php?username=abc", true);
        xhttp.send();
    }
</script>