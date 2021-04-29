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
<li><a id="admin_access" href="#">Admin</a></li>
<li><a href="http://www.academicanalytics.ca/aat/aat30/login.php?qs=$2a$07$iWLE21q8W4TnPMp8oAcvE.3TpEBsWfaE.L1Fkm/G1zFNrC1dViniO">Home</a></li>
<li><a href="http://www.academicanalytics.ca/aat/aat30/login.php?qs=$2a$07$RuZLszmpVZCJa3vwjVBxDuGxRFw2FkdVMryivKcQ/FucbylSAcIZC">Report Issue</a></li>
<li><a href="http://www.academicanalytics.ca/aat/aat30/login.php?qs=$2a$07$DdwAYIfHL1bXftNjfjzr6.hdf.ztZFH0ThKqpFquXQoZwbNyZk1sG">Usage Guide</a></li>
<li><a href="http://www.academicanalytics.ca/aat/aat30/login.php?qs=$2a$07$B8uFsVOEXO7werupA0Ehbu0d.FSgO1lriyPIraXfPoCdNXabpd4t.">Logout</a></li>
</ul>
</div>
</div>
</div>
<hr style="height:5px;color:#8B0000; background-color:#8B0000;">
    
<div id="container" class="withleft clear-block">
<div id="main-wrapper">
<div id="main" class="clear-block">
<div id="CenterContent" class="content"><form id="Profile_Defined" method="post" action="CreateProject.php"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="ProfileManager"> <input type="hidden" name="op2" value="createProfileForm"> <input type="submit" name="Back" value=" Back " class="glow"> <p class="narrative" style="display:inline-block"> to Project Wizard Home</p></form><br><h1><span class="highlight">Step 1:</span> Name your new Project</h1><form id="DefineProfile" action="NewProjectDetails.php" method="POST" onsubmit="return RequiredFieldsDefineProfile(this);"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="ProfileManager"> <input type="hidden" name="op2" value="saveProfile"> <table><tbody><tr> <td><label>Project Name <span style="color: red;">(*)</span>:</label></td> <td><input class="namebox" id="ProfileName" type="text" maxlength="50" name="prname" value="" onblur="javascript:ValidateProfileName(this);"> (50 chars max)<br><div class="inputerror">Project name is already assigned. Please choose a new one.</div></td></tr><tr> <td><label>Project Description:</label> </td> <td><textarea class="descriptionbox" rows="2" maxlength="100" id="ProfileDescription" name="prdesc" style=" resize: both;"></textarea> (100 chars max)</td></tr> <tr><td></td><td></td></tr> </tbody></table> <input id="SaveProfileButton" type="submit" name="Next" value=" Continue " class="glow"> <p class="narrative" style="display:inline-block"> to create Dataset</p></form></div>
</div>
</div>

<div id="sidebar-left" class="sidebar">
<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">This is where you give a name and description to your Project.  <br><br>For a new Project, you
        	will see two blank fields for the name and description.  <br><br>If you are editing or Cloning a Project, the
        	fields will be filled with the previous name and description, and you have the option to change them.
        	For a Cloned Project you must at least change the name as you cannot save two Projects with the same name.

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
                </div><div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"><div class="ui-dialog-buttonset"><button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Submit</span></button><button type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Cancel</span></button></div></div><div class="ui-resizable-handle ui-resizable-n" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-w" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-sw" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-ne" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-nw" style="z-index: 90;"></div></div></body></html>
<?php 
$ID=$_SESSION['id'];
if(isset($_POST['Next']))
{
    $ProjName=$_POST['prname'];
    $ProjDesc=$_POST['prdesc'];
    
    
    $con= new mysqli("localhost","root","","aslim");
    mysqli_select_db($con,"AsLim");
    $sql=mysqli_query($con,"create table if not exists project (projectname varchar(50),projectdescription varchar(100), userid int(100))");
    $result= mysqli_query($con,"select * from project where projectname='$ProjName'");  
    if( mysqli_num_rows($result)==0)
    {
        $result2= mysqli_query($con,"insert into project (projectname,projectdescription,userid) values ('$ProjName','$ProjDesc','$ID')");
        echo "<script>
        alert('Project Successfully created'); 
        window.location.href='CreateNewDataset.php';
        </script>"; 
    }
    else
    {
        echo "<script>
        alert('Project name is already assigned. Please choose a new one.'); 
        </script>"; 
    }

   

}
    
?>