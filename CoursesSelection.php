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
    
<div id="CenterContent" class="content"><p id="maintitle">Welcome to AsLim</p><p class="helptext" style="font-size: 105%; margin-bottom: 20px;">This tool allows users to analyze data from Learning Management Systems (LMSs).
				If this is your first time using this tool, please read the documentation by clicking the "Usage Guide" link in the
				top menu.</p><h1 style="text-align: center;"></h1>
<form id="Profile_Defined" method="post" action="CoursesSelection.php"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="DataSetManager"> <input type="hidden" name="op2" value="listDataSet"> </form><br><h1><span class="highlight">Step 1: </span>Select Courses</h1><form id="DefineDataSet" action="CoursesSelection.php" method="POST"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="DataSetManager"> <input type="hidden" name="op2" value="saveDataSet">  <p class="decisiontext">Available courses for this LMS:</p> <p class="helptext"></p> <a class="tooltip" href="#"><span></span></a>  <div id="checkboxes" data-toggle="checkboxes" data-range="true"><div id="ListTableContainer">
    
    
<?php

  $ID=$_SESSION['id']; 
  $con= new mysqli($_SESSION['host'],$_SESSION['mysql_username'],$_SESSION['mysql_password']);
  mysqli_select_db($con,"bitnami_moodle");
  $result= mysqli_query($con,"select mdl_course.id, mdl_course.idnumber,mdl_course.shortname,mdl_course.fullname from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$ID AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='teacher' OR mdl_role.shortname='editingteacher' AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$ID AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");
      
?> 
    
<table id="ListTable"><tbody><tr><th></th><th>Course Code</th><th>Shortname</th><th>Longname</th></tr>
<?php
    $array=[];
    $x=0;
    if( mysqli_num_rows($result)==0)
        {
            echo "<script>alert('No courses to view');</script>";  
        }

    else
        {       
            $inc=1;
            while ($row = mysqli_fetch_assoc($result)) 
                { 
			         echo '<tr><td>'.$inc.':   
			         <input type="checkbox" style="height:15px; width:15px;" value="'.$row['id'].'" name="check_list[]" ></td>
                     <td>'.$row['idnumber'].'</td><td>'.$row['shortname'].'</td>
			         <td>'.$row['fullname'].'</td>
			         <td>';
                     echo '</td></tr>';
			         $inc=$inc+1;
  
		        }
            echo "<table>";
       }
?>
    
    
</tbody></table> </div></div><table style="width: 400px;"> <tbody><tr> <td> <p class="narrative" style="text-align: center;">
                		
                		<input class="SaveDSButton glow" type="submit" name="submit" value=" Save and Continue ">
                        <br>with selected courses</p> </td> </tr></tbody></table></form></div>
</div>
</div>

<div id="sidebar-left" class="sidebar">
<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">This page allows you to select the courses in which you want to detect the learning styles and affective states of your students. <br><br>The courses listed come from the LMS you chose for this Project.  The
                    two top buttons provide a shortcut for selecting or deselecting all
                    of the available courses.

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

$selected_courses=[];

if(isset($_POST['submit']))
{
    if(!empty($_POST['check_list']) )
        {
	       // Loop to store and display values of individual checked checkbox.
	        $s_c=0;
     
	        foreach($_POST['check_list'] as $selected )
	           {
		          $selected_courses[$s_c]=$selected;
        
                  $s_c=$s_c+1;
                }
        
            $total_selected_courses=count($selected_courses);

            $_SESSION['selected_courses'] = $selected_courses;
            
            echo "<script> window.location.href='stay.php'; </script>";
        }
     else if (empty($_POST['check_list']))
      {
        echo "<script>alert('No courses selected! Please select at least one course to continue.');</script>";
      }
    

}

   
?>
