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
<div id="CenterContent" class="content"><form action="ActionSelection.php" method="POST"><input type="submit" name="Back" value="Back" class="glow"> <p class="narrative">to action selection</p> </form><h1><span class="highlight">Step 4: </span>Select a Learning Style dimension</h1>
<form id="DefineDataSet" action="AffectiveStates.php" method="POST"><br>
<input class="SaveDSButton glow" style="width: 
400px" type="submit" name="confidence" value="Calculate students' confidence (Affective State)">      <br>  <br>  <input class="SaveDSButton glow" style="width: 
400px" type="submit" name="confusion" value="Calculate students' confusion (Affective State)"><br><br>
<input class="SaveDSButton glow" style="width: 
400px" type="submit" name="effort" value="Calculate students' effort (Affective State)">   <br><br> 
<input class="SaveDSButton glow" style="width: 
400px"  type="submit" name="independence" value="Calculate students' independence (Affective State)">
     
    
</form>
    
    
    </div>
</div>
</div>

<div id="sidebar-left" class="sidebar">
<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">This page allows you to select a learning style dimension in order to check whether a student has the respective learning style or not. <br><br>Learning styles will be calculated for each course.
</p></div>

</div>
</div>
</div>
<div id="footer">© copyright COMSATS Institute of Information Technology, Attock
</div></div>
</div>

<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-dialog-buttons ui-draggable ui-resizable" tabindex="-1" role="dialog" aria-describedby="dialog-form" aria-labelledby="ui-id-1" style="display: none; position: absolute;"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">Admin Access</span><button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div><div style="" id="dialog-form" class="ui-dialog-content ui-widget-content">
                  <p class="validateTips"><b>Required Field</b></p>
                  <p class="intro">If you are the administrator of the tool,
                  please enter the admin password in the input field below:</p>

                  <form>
                  <fieldset>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all">
                  </fieldset>
                  </form>
                </div><div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"><div class="ui-dialog-buttonset"><button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Submit</span></button><button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Cancel</span></button></div></div><div class="ui-resizable-handle ui-resizable-n" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-w" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-sw" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-ne" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-nw" style="z-index: 90;"></div></div>
  
    </body></html>

<?php


if(isset($_POST['confidence']))
{
   echo "<script> window.location.href='confidence.php'; </script>" ;
}
else if(isset($_POST['confusion']))
{
    echo "<script> window.location.href='confusion.php'; </script>";
}
else if (isset($_POST['effort']))
{
    echo "<script> window.location.href='effort.php'; </script>";
}
else if(isset($_POST['independence']))
{
    echo "<script> window.location.href='independence.php'; </script>";
}

?>