<?php 
		
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
<ul class="links-menu">

<li><a href="CoursesSelection.php">Home</a></li>
<li><a href="Logout.php">Logout</a></li>
</ul>
</div>
</div>
</div>
<hr style="height:5px;color:#8B0000; background-color:#8B0000;">

<div id="container" class="withleft clear-block">
<div id="main-wrapper">
<div id="main" class="clear-block">
<div id="CenterContent" class="content"><form action="CoursesSelection.php" method="POST"><input type="submit" name="Back" value="Back" class="glow"> <p class="narrative">to courses selection</p> </form>
<h1><span class="highlight">Step 2 (a): </span>Configure Thresholds for expected stay at learning objects</h1> 
<div id="CenterContent" class="content"><div id="loginform" style="clear: left;"><form id="form" action="stay.php" method="POST">
<table>
<tbody>
<tr></tr>
<tr><td width="200"><label>Content Objects</label></td> <td width="100"><label>Time (mins)</label></td> </tr>  
    
<tr><td width="600">Expected stay of each student on content objects (predefined expected time value):</td><td><input style="width:186px;" type="text" name="expected_time_co_obj" value=""></td></tr>
    
<tr><td width="200"><label>Outlines</label></td> <td width="100"><label>Time (mins)</label></td></tr>
    
<tr><td width="120">Expected stay of each student on outlines (predefined expected time value):</td><td><input style="width:186px;" type="text" name="expected_time_outline" value=""></td></tr>    
    
<tr><td width="200"><label>Course Overview</label></td> <td width="100"><label>Time (mins)</label></td> <td width="120"></td></tr>
    
<tr><td width="120">Expected stay of each student on course overview page (predefined expected time value):</td><td><input style="width:186px;" type="text" name="expected_time_courseovview" value=""></td></tr>  
      
<tr><td width="200"><label>Examples</label></td> <td width="100"><label>Time (mins)</label></td> <td width="120"></td></tr>
    
<tr><td width="120">Expected stay of each student on examples (predefined expected time value):</td><td><input style="width:186px;" type="text" name="expected_time_exa" value=""></td></tr>
    

<tr><td>&nbsp;</td><td>
    
<input type="submit" name="btnSubmit" value="Submit" method="post" class="glow" onclick="javascript:check_input();"></td></tr>
    
</tbody></table><input type="hidden" name="submit"></form>
    
</div>
</div>
</div>
</div>

<div id="sidebar-left" class="sidebar">
<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">This is the page where you enter expected stay of student on content objects, outlines, examples and course overview page. This time should be entered in minutes.<br><br>Note that expected stay on self assessment tests and exercises is taken directly from Moodle database.

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
   
$expected_time_co_obj=$_POST['expected_time_co_obj'];

$expected_time_outline=$_POST['expected_time_outline'];

$expected_time_courseovview=$_POST['expected_time_courseovview'];
    
$expected_time_exa=$_POST['expected_time_exa'];
    
if
(    
empty($expected_time_co_obj)==1 OR 
empty($expected_time_outline)==1 OR 
empty($expected_time_courseovview)==1 OR 
empty($expected_time_exa)==1 
)
   
{
    echo "<script>alert('Information missing! Please fill all the fields');</script>";
}
    
else
{
    
$_SESSION['expected_time_co_obj'] =$expected_time_co_obj;
$_SESSION['expected_time_outline']=$expected_time_outline;
$_SESSION['expected_time_courseovview'] =$expected_time_courseovview;
$_SESSION['expected_time_exa']=$expected_time_exa;

echo "<script> window.location.href='configure_thresholds'; </script>";
 
}
    
 
   
}
    
     
 
?>
