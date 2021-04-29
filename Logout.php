<?php 
session_unset();		
session_start(); 

?>
<html style="" class="js flexbox flexboxlegacy canvas canvastext webgl touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths gr__academicanalytics_ca"><head>
<title> AsLim Tool </title>
<link rel="shortcut icon" href="images/AsLim_Icon.ico">
<link rel="stylesheet" href="style_sheets/hover.css">
<link rel="stylesheet" href="style_sheets/jquery-ui-1.10.4.custom.css">
<link rel="stylesheet" href="style_sheets/jquery.dataTables.min.css">
<link rel="stylesheet" href="style_sheets/style.css">
<link rel="stylesheet" href="style_sheets/tooltipster.css">
<script src="js/aat.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.checkboxes-1.0.6.min.js"></script>
<script src="js/json2.js"></script>
<script src="js/jquery.json-2.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/jquery.session.js"></script>
<script src="js/jquery.alphanum.js"></script>
<script src="js/jquery.tooltipster.min.js"></script>
<script src="js/modernizr-latest.js"></script>
</head>

<body id="second" onload="bodyOnLoad(); makeTableScroll();" data-gr-c-s-loaded="true" waid71fa0d88-5390-4b5b-a2f4-e45fa93d85e2="SA password protect entry checker">
<hr style="height:5px;color:#8B0000; background-color:#8B0000;">
<div id="page" class="one-sidebar">
<div id="header">
<div id="logo-title">
<h1 id="site-name"><a href="#" title="Home"><img src="./images/AsLim_Logo_New.png" alt="AsLim"></a>
</h1>
</div>
   
    
<div class="menu withprimary ">
<div id="primary" class="clear-block">

</div>
</div>
</div>
<hr style="height:5px;color:#8B0000; background-color:#8B0000;">

<div id="container" class="withleft clear-block">
<div id="main-wrapper">
<div id="main" class="clear-block">
<div class="messages status"> <p class="helptext"><span style="color: blue;"><strong>You have logged out.</strong></span></p>
                 <p class="helptext"><em>AsLim - Affective States and Learning Styles Identification and Measurement Tool is a tool for automatic detection of the affective states and the learning styles from students' behavior and preferences in Learning Management Systems. This tool has been developed to facilitate the teachers so that they can get the proper feedback about how their students are behaving in a course and to help the course designers in the identification of the difficult and inappropriate learning material. AsLim is keeping track of the students' behavior by using their data stored in Moodle databases.</em></p></div>
<div class="messages error"><h2>Access Denied</h2>
        	<p>You are getting this message for one or more of the following reasons:
           </p><ul>
           <li>You entered an invalid URL</li>
           <li>You are not authorized to view this page</li>
           <li>You used an external source to view this page</li>
           <li>Your session has expired</li>
           <li>You hit the refresh button</li>
           </ul><p></p></div>
<div id="CenterContent" class="content"><div id="loginform" style="clear: left;"><form action="Logout.php" method="POST">
<table>
<tbody><tr><td width="120"><label>Username (Moodle):</label></td><td><input style="width:186px;" type="text" name="field_login" value=""></td></tr>
<tr><td><label>Password (Moodle):</label></td><td><input style="width:186px;" type="password" name="field_pwd" value=""></td></tr>
<tr><td><label>Host name:</label></td><td><input style="width:186px;" type="text" name="field_host" value=""></td></tr>
<tr><td><label>MySQL Username:</label></td><td><input style="width:186px;" type="text" name="field_Username" value=""></td></tr>
<tr><td><label>MySQL Password:</label></td><td><input style="width:186px;" type="password" name="field_Password" value=""></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="btnSubmit" value="Login" method="post" class="glow" ></td></tr>
</tbody></table><input type="hidden" name="submit"></form></div>
</div>
</div>
</div>

<div id="sidebar-left" class="sidebar">

<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">Please enter your Moodle user name and password
                    then click the 'Login' button.<br><br>Contact your Moodle
                    administrator for any login issues.


</p></div>

</div>
</div>
</div>
<div id="footer">© copyright COMSATS Institute of Information Technology, Attock.
</div></div>
</div>

</body></html>


<?php
if (isset($_POST['btnSubmit']))
{
    $UserName=$_POST['field_login'];
    $Email=$_POST['field_pwd'];
    $host=$_POST['field_host'];
    $mysql_username=$_POST['field_Username'];
    $mysql_password=$_POST['field_Password'];
    $_SESSION['host']=$host;
    $_SESSION['mysql_username']=$mysql_username;
    $_SESSION['mysql_password']=$mysql_password;
    $con= new mysqli($_SESSION['host'],$_SESSION['mysql_username'],$_SESSION['mysql_password']);
    mysqli_select_db($con,"bitnami_moodle");
    $result= mysqli_query($con,"select id from mdl_user where username='$UserName'");
      
    if( mysqli_num_rows($result)==1)
    {
            while($row = mysqli_fetch_array($result))
                {
                    $ID=$row['id']; 
                    $_SESSION['id'] = $ID;
                    echo "<script> window.location.href='CoursesSelection.php'; </script>";
                }
    }
   else
        {
                echo "<script>alert('Invalid User name and Password');</script>"; 
        }
   
}

    
?>