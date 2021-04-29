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
<div id="CenterContent" class="content"><form action="stay.php" method="POST"><input type="submit" name="Back" value="Back" class="glow"> <p class="narrative">to expected stay page</p> </form>
<br><h1><span class="highlight">Step 2 (b): </span>Configure Visit and Stay Thresholds for Patterns of Behavior</h1> <p class="decisiontext">Please Change the necessary field information if required:</p>  
<div id="CenterContent" class="content"><div id="loginform" style="clear: left;"><form id="form" action="configure_thresholds.php" method="POST">
<table>
<tbody>
<h1></h1><tr></tr>
<tr><td width="200"><label>Content Objects</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>  
    
<tr><td width="120">Visits of Content Objects (based on total available content objects): (%)</td><td><input style="width:186px;" type="text" name="co_obj_vis_lower" value="75"></td><td><input style="width:186px;" type="text" name="co_obj_vis_higher" value="100"></td></tr>
    
<tr><td width="120">Stay at Content Objects (based on predefined expected time value): (%)</td><td><input style="width:186px;" type="text" name="co_obj_stay_lower" value="10"></td><td><input style="width:186px;" type="text" name="co_obj_stay_higher" value="20"></td></tr>
    
<tr><td width="200"><label>Outlines</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Visits of Outlines (based on total available outlines): (%)</td><td><input style="width:186px;" type="text" name="outline_visit_lower" value="75"></td><td><input style="width:186px;" type="text" name="outline_visit_higher" value="100"></td></tr>
    

<tr><td width="120">Stay at Outlines (based on predefined expected time value): (%)</td><td><input style="width:186px;" type="text" name="outline_stay_lower" value="50"></td><td><input style="width:186px;" type="text" name="outline_stay_higher" value="75"></td></tr>    
    
<tr><td width="200"><label>Exercises</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Visits of Exercises (based on total available Exercises): (%)</td><td><input style="width:186px;" type="text" name="exercise_visit_lower" value="25"></td><td><input style="width:186px;" type="text" name="exercise_visit_higher" value="75"></td></tr> 
    
<tr><td width="120">Stay at Exercises (based on predefined expected time value): (%)</td><td><input style="width:186px;" type="text" name="exercise_stay_lower" value="50"></td><td><input style="width:186px;" type="text" name="exercise_stay_higher" value="75"></td></tr> 
    
<tr><td width="200"><label>Course Overview</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Visits of Course Overview Page/ Course Outline (based on the number of visited learning objects): (%)</td><td><input style="width:186px;" type="text" name="course_ovview_visit_lower" value="10"></td><td><input style="width:186px;" type="text" name="course_ovview_visit_higher" value="20"></td></tr>  
    
<tr><td width="120">Stay at Course Overview Page/ Course Outline (based on predefined expected time value): (%)</td><td><input style="width:186px;" type="text" name="course_ovview_stay_lower" value="50"></td><td><input style="width:186px;" type="text" name="course_ovview_stay_higher" value="75"></td></tr>     
    
    
<tr><td width="200"><label>Self Assessment Tests</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Performed self assessment questions (based on the total number of available questions): (%)</td><td><input style="width:186px;" type="text" name="self_assess_visit_lower" value="50"></td><td><input style="width:186px;" type="text" name="self_assess_visit_higher" value="75"></td></tr>
    
<tr><td width="120">Stay at self assessment tests (based on predefined expected time value): (%)</td><td><input style="width:186px;" type="text" name="self_assess_stay_lower" value="50"></td><td><input style="width:186px;" type="text" name="self_assess_stay_higher" value="75"></td></tr> 
    
<tr><td>Number of times a learner revised self assessment test(based on the total number of self assessment tests): (%)</td><td><input style="width:186px;" type="text" name="self_assess_rev_lower" value="25"></td><td><input style="width:186px;" type="text" name="self_assess_rev_higher" value="50"></td></tr> 
    
<tr><td>Correctly answered questions about graphics (based on the total number of available questions about graphics) (%)</td><td><input style="width:186px;" type="text" name="ques_graphics_lower" value="50"></td><td><input style="width:186px;" type="text" name="ques_graphics_higher" value="75"></td></tr>
    
<tr><td>Correctly answered questions about text (based on the total number of available questions presented in textual form) (%)</td><td><input style="width:186px;" type="text" name="ques_text_lower" value="50"></td><td><input style="width:186px;" type="text" name="ques_text_higher" value="75"></td></tr>
    
<tr><td width="200"><label>Examples</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Visits of Examples (based on total available Examples): (%)</td><td><input style="width:186px;" type="text" name="example_visit_lower" value="50"></td><td><input style="width:186px;" type="text" name="example_visit_higher" value="100"></td></tr> 
    
<tr><td width="120">Stay at Examples (based on predefined expected time value): (%)</td><td><input style="width:186px;" type="text" name="example_stay_lower" value="50"></td><td><input style="width:186px;" type="text" name="example_stay_higher" value="75"></td></tr>
    
<tr><td width="200"><label>Forum for assignment related queries</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Number of visits in a forum (based on total number of assignments offered during the course)</td><td><input style="width:186px;" type="text" name="forum_assign_visit_lower" value="2"></td><td><input style="width:186px;" type="text" name="forum_assign_visit_higher" value="4"></td></tr> 
    
<tr><td>Number of postings in the forum (based on total number of assignments offered during the whole course)</td><td><input style="width:186px;" type="text" name="forum_assign_post_lower" value="1"></td><td><input style="width:186px;" type="text" name="forum_assign_post_higher" value="2"></td></tr> 
    
<tr><td>Number of post replies in the forum (based on total number of queries, posted related to each assignment during the course)</td><td><input style="width:186px;" type="text" name="forum_assign_post_repl_lower" value="1"></td><td><input style="width:186px;" type="text" name="forum_assign_post_repl_higher" value="2"></td></tr> 
    
<tr><td width="200"><label>Forum related to Content Objects</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>
    
<tr><td>Number of visits in a forum during each week</td><td><input style="width:186px;" type="text" name="forum_content_visit_lower" value="2"></td><td><input style="width:186px;" type="text" name="forum_content_visit_higher" value="4"></td></tr> 
    
<tr><td>Number of posts in the forum during each week</td><td><input style="width:186px;" type="text" name="forum_content_post_lower" value="1"></td><td><input style="width:186px;" type="text" name="forum_content_post_higher" value="2"></td></tr> 
    
<tr><td>Number of post replies in the forum (based on the number of posts related to content objects during the course)</td><td><input style="width:186px;" type="text" name="forum_content_post_repl_lower" value="1"></td><td><input style="width:186px;" type="text" name="forum_content_post_repl_higher" value="2"></td></tr> 
    

<tr><td width="200"><label>Assignments</label></td> <td width="100"><label>Lower Threshold</label></td> <td width="120"><label>Higher Threshold</label></td></tr>

<tr><td>Number of times a student revised his/her assignment after initial submission</td><td><input style="width:186px;" type="text" name="assign_rev_lower" value="1"></td><td><input style="width:186px;" type="text" name="assign_rev_higher" value="2"></td></tr> 
    
<tr><td>Stay at assignments (% of assignments submitted well before deadline)</td><td><input style="width:186px;" type="text" name="assign_stay_lower" value="50"></td><td><input style="width:186px;" type="text" name="assign_stay_higher" value="75"></td></tr>
    
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
<div class="content"><p class="helptext">This is the page where you input both higher and lower threshold values for each learning object.<br><br>Teachers have to decide the thresholds. For example, if you you want your students to post at least 2 queries in assignment related forum throughout the course, you will set lower threshold value to 2.

</p></div>

</div>
</div>
</div>
<div id="footer">© copyright COMSATS Institute of Information Technology, Attock.
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
if (isset($_POST['btnSubmit']))
{
//-----------------------------------------------------------------------------------------------    
$co_obj_vis_lower =$_POST['co_obj_vis_lower'];
$co_obj_vis_higher=$_POST['co_obj_vis_higher'];
$co_obj_stay_lower=$_POST['co_obj_stay_lower'];
$co_obj_stay_higher =$_POST['co_obj_stay_higher'];
$outline_visit_lower=$_POST['outline_visit_lower'];
$outline_visit_higher =$_POST['outline_visit_higher'];
$outline_stay_lower=$_POST['outline_stay_lower'];
$outline_stay_higher=$_POST['outline_stay_higher'];
$exercise_visit_lower=$_POST['exercise_visit_lower'];
$exercise_visit_higher =$_POST['exercise_visit_higher'];
$exercise_stay_lower=$_POST['exercise_stay_lower'];
$exercise_stay_higher=$_POST['exercise_stay_higher'];
$course_ovview_visit_lower=$_POST['course_ovview_visit_lower'];
$course_ovview_visit_higher=$_POST['course_ovview_visit_higher'];
$course_ovview_stay_lower=$_POST['course_ovview_stay_lower'];
$course_ovview_stay_higher=$_POST['course_ovview_stay_higher'];
$self_assess_visit_lower=$_POST['self_assess_visit_lower'];
$self_assess_visit_higher=$_POST['self_assess_visit_higher'];
$self_assess_stay_lower=$_POST['self_assess_stay_lower'];
$self_assess_stay_higher=$_POST['self_assess_stay_higher'];
$self_assess_rev_lower=$_POST['self_assess_rev_lower'];
$self_assess_rev_higher=$_POST['self_assess_rev_higher'];
$ques_graphics_lower=$_POST['ques_graphics_lower'];
$ques_graphics_higher=$_POST['ques_graphics_higher'];
$ques_text_lower=$_POST['ques_text_lower'];
$ques_text_higher=$_POST['ques_text_higher'];
$example_visit_lower=$_POST['example_visit_lower'];
$example_visit_higher=$_POST['example_visit_higher'];
$example_stay_lower=$_POST['example_stay_lower'];
$example_stay_higher=$_POST['example_stay_higher'];
$forum_assign_visit_lower=$_POST['forum_assign_visit_lower'];
$forum_assign_visit_higher=$_POST['forum_assign_visit_higher'];
$forum_assign_post_lower=$_POST['forum_assign_post_lower'];
$forum_assign_post_higher=$_POST['forum_assign_post_higher'];
$forum_assign_post_repl_lower=$_POST['forum_assign_post_repl_lower'];
$forum_assign_post_repl_higher=$_POST['forum_assign_post_repl_higher'];
$forum_content_visit_lower=$_POST['forum_content_visit_lower'];
$forum_content_visit_higher=$_POST['forum_content_visit_higher'];
$forum_content_post_lower=$_POST['forum_content_post_lower'];
$forum_content_post_higher=$_POST['forum_content_post_higher'];
$forum_content_post_repl_lower=$_POST['forum_content_post_repl_lower'];
$forum_content_post_repl_higher=$_POST['forum_content_post_repl_higher'];
$assign_rev_lower=$_POST['assign_rev_lower'];
$assign_rev_higher=$_POST['assign_rev_higher'];
$assign_stay_lower =$_POST['assign_stay_lower'];
$assign_stay_higher=$_POST['assign_stay_higher'];
    
//-----------------------------------------------------------------------------------------------

if
(    
empty($co_obj_vis_lower)==1 OR 
empty($co_obj_vis_higher)==1 OR 
empty($co_obj_stay_lower)==1 OR 
empty($co_obj_stay_higher)==1 OR 
empty($outline_visit_lower)==1 OR 
empty($outline_visit_higher)==1 OR 
empty($outline_stay_lower)==1 OR 
empty($outline_stay_higher)==1 OR 
empty($exercise_visit_lower)==1 OR 
empty($exercise_visit_higher)==1 OR 
empty($exercise_stay_lower)==1 OR 
empty($exercise_stay_higher)==1 OR 
empty($course_ovview_visit_lower)==1 OR 
empty($course_ovview_visit_higher)==1 OR 
empty($course_ovview_stay_lower)==1 OR 
empty($course_ovview_stay_higher)==1 OR 
empty($self_assess_visit_lower)==1 OR 
empty($self_assess_visit_higher)==1 OR 
empty($self_assess_stay_lower)==1 OR 
empty($self_assess_stay_higher)==1 OR 
empty($self_assess_rev_lower)==1 OR 
empty($self_assess_rev_higher)==1 OR 
empty($ques_graphics_lower)==1 OR 
empty($ques_graphics_higher)==1 OR 
empty($ques_text_lower)==1 OR 
empty($ques_text_higher)==1 OR 
empty($example_visit_lower)==1 OR 
empty($example_visit_higher)==1 OR 
empty($example_stay_lower)==1 OR 
empty($example_stay_higher)==1 OR 
empty($forum_assign_visit_lower)==1 OR 
empty($forum_assign_visit_higher)==1 OR 
empty($forum_assign_post_lower)==1 OR 
empty($forum_assign_post_higher)==1 OR 
empty($forum_assign_post_repl_lower)==1 OR 
empty($forum_assign_post_repl_higher)==1 OR 
empty($forum_content_visit_lower)==1 OR 
empty($forum_content_visit_higher)==1 OR 
empty($forum_content_post_lower)==1 OR 
empty($forum_content_post_higher)==1 OR 
empty($forum_content_post_repl_lower)==1 OR 
empty($forum_content_post_repl_higher)==1 OR 
empty($assign_rev_lower)==1 OR
empty($assign_rev_higher)==1 OR 
empty($assign_stay_lower)==1 OR empty($assign_stay_higher)==1)
   
{
    echo "<script>alert('Information missing! Please fill all the fields');</script>";
}
    
else
{
    
$_SESSION['co_obj_vis_lower'] =$co_obj_vis_lower;
$_SESSION['co_obj_vis_higher']=$co_obj_vis_higher;
$_SESSION['co_obj_stay_lower']=$co_obj_stay_lower;
$_SESSION['co_obj_stay_higher'] =$co_obj_stay_higher;
$_SESSION['outline_visit_lower']=$outline_visit_lower;
$_SESSION['outline_visit_higher'] =$outline_visit_higher;
$_SESSION['outline_stay_lower']=$outline_stay_lower;
$_SESSION['outline_stay_higher']=$outline_stay_higher;
$_SESSION['exercise_visit_lower']=$exercise_visit_lower;
$_SESSION['exercise_visit_higher'] =$exercise_visit_higher;
$_SESSION['exercise_stay_lower']=$exercise_stay_lower;
$_SESSION['exercise_stay_higher']=$exercise_stay_higher;
$_SESSION['course_ovview_visit_lower']=$course_ovview_visit_lower;
$_SESSION['course_ovview_visit_higher']=$course_ovview_visit_higher;
$_SESSION['course_ovview_stay_lower']=$course_ovview_stay_lower;
$_SESSION['course_ovview_stay_higher']=$course_ovview_stay_higher;
$_SESSION['self_assess_visit_lower']=$self_assess_visit_lower;
$_SESSION['self_assess_visit_higher']=$self_assess_visit_higher;
$_SESSION['self_assess_stay_lower']=$self_assess_stay_lower;
$_SESSION['self_assess_stay_higher']=$self_assess_stay_higher;
$_SESSION['self_assess_rev_lower']=$self_assess_rev_lower;
$_SESSION['self_assess_rev_higher']=$self_assess_rev_higher;
$_SESSION['ques_graphics_lower']=$ques_graphics_lower;
$_SESSION['ques_graphics_higher']=$ques_graphics_higher;
$_SESSION['ques_text_lower']=$ques_text_lower;
$_SESSION['ques_text_higher']=$ques_text_higher;
$_SESSION['example_visit_lower']=$example_visit_lower;
$_SESSION['example_visit_higher']=$example_visit_higher;
$_SESSION['example_stay_lower']=$example_stay_lower;
$_SESSION['example_stay_higher']=$example_stay_higher;
$_SESSION['forum_assign_visit_lower']=$forum_assign_visit_lower;
$_SESSION['forum_assign_visit_higher']=$forum_assign_visit_higher;
$_SESSION['forum_assign_post_lower']=$forum_assign_post_lower;
$_SESSION['forum_assign_post_higher']=$forum_assign_post_higher;
$_SESSION['forum_assign_post_repl_lower']=$forum_assign_post_repl_lower;
$_SESSION['forum_assign_post_repl_higher']=$forum_assign_post_repl_higher;
$_SESSION['forum_content_visit_lower']=$forum_content_visit_lower;
$_SESSION['forum_content_visit_higher']=$forum_content_visit_higher;
$_SESSION['forum_content_post_lower']=$forum_content_post_lower;
$_SESSION['forum_content_post_higher']=$forum_content_post_higher;
$_SESSION['forum_content_post_repl_lower']=$forum_content_post_repl_lower;
$_SESSION['forum_content_post_repl_higher']=$forum_content_post_repl_higher;
$_SESSION['assign_rev_lower']=$assign_rev_lower;
$_SESSION['assign_rev_higher']=$assign_rev_higher;
$_SESSION['assign_stay_lower'] =$assign_stay_lower;
$_SESSION['assign_stay_higher']=$assign_stay_higher; 
    
echo "<script> window.location.href='ActionSelection'; </script>";
 
}
    
 
   
}
    
     
 
?>
