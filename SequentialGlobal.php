<?php

session_start();

$con= new mysqli($_SESSION['host'],$_SESSION['mysql_username'],$_SESSION['mysql_password']);

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses=$_SESSION['selected_courses'];

$len_teachers_courses=count($teachers_courses);

$a=0;

$resource_id_Array=[];

$users=[];

$u=0;

$c=0;

$h=0;

$hint_value_outline_visit=[];

$user_id_array=[];

$spliter=[];

$u1=mysqli_query($con,"select userid from mdl_role_assignments where roleid='5'");

while($row=mysqli_fetch_array($u1))
{
  $users[$u]=$row['userid'];
  $u=$u+1;
}

$len_users=count($users);


 
for($j=0;$j<$len_teachers_courses;$j++)
{
  for($i=0;$i<$len_users;$i++)
  {
    $counter=$a=$c=0;
      $courses=$resource_id_Array=[];
 
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
       
        $r1=mysqli_query($con,"select id from mdl_resource where course=$teachers_courses[$j] AND (name LIKE 'Outline%' OR name LIKE '%Outline' OR name LIKE '%Outline%') OR  (name LIKE 'Chapter%' OR name LIKE '%Chapter' OR name LIKE '%Chapter%')");
 
        while($row=mysqli_fetch_array($r1))
        {
            $resource_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_content_objects=count($resource_id_Array);

        for($x=0;$x<$total_content_objects;$x++)
        {
            $r2=mysqli_query($con,"select id from mdl_log where module='resource' AND action='view' AND info=$resource_id_Array[$x] AND userid=$users[$i]");
    
            if(mysqli_num_rows($r2)!=0)
            {
            $counter=$counter+1;
            }
            else
            {
                $counter=$counter+0;
            }
            
        }
        
        $c_o=$counter/$total_content_objects;

        $percentage=$c_o*100;
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=$_SESSION['outline_visit_higher'])
        {
            $hint_value_outline_visit[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=$_SESSION['outline_visit_lower'] AND $percentage<$_SESSION['outline_visit_higher'])
        {
            $hint_value_outline_visit[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<$_SESSION['outline_visit_lower'])
        {
            $hint_value_outline_visit[$h]=1;
            $h=$h+1;
        }
        
        
        
        else if ($percentage==0)
        {
            $hint_value_outline_visit[$h]=0;
            $h=$h+1;
        }

        
    }
      else
      {
          
      }
    
  } 
    $len_t_students=count($user_id_array);   //gives the total number of students for each course
    
    $spliter[$j]=$len_t_students;
    
}


$hint_value_outline_stay=[];

$users=[];

$u=0;

$h=0;

$user_id_array=[];

$spliter=[];

$u1=mysqli_query($con,"select userid from mdl_role_assignments where roleid='5'");

while($row=mysqli_fetch_array($u1))
{
  $users[$u]=$row['userid'];
  $u=$u+1;
}

$len_users=count($users);



for($j=0;$j<$len_teachers_courses;$j++)
{  
    
  for($i=0;$i<$len_users;$i++)
  { 
      
    $resource_id_Array=$courses=$attempts_id_Array=$resource_attempted_array=[];
      
    $resource_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=$stay_on_resources=0;
      
    $Duration=0;
    
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
        
        $r1=mysqli_query($con,"select id from mdl_resource where course=$teachers_courses[$j] AND (name LIKE 'Outline%' OR name LIKE '%Outline' OR name LIKE '%Outline%')");
 
        while($row=mysqli_fetch_array($r1))
        {
            $resource_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_resources=count($resource_id_Array);
        
        for($y=0;$y<$total_resources;$y++)
        {
            
            $r2=mysqli_query($con,"select id,time from mdl_log where module='resource' AND action='view' AND info=$resource_id_Array[$y] AND userid=$users[$i]");
            
            if(mysqli_num_rows($r2)!=0)
            {
              while($row=mysqli_fetch_array($r2))
                {       
            
                //$start_time=$row['time'];
                    $id_resource=$row['id'];
                    $time1=$row['time'];
                
                   // $start_time=$start_time+$row['time'];
                  
    //---------------------------------------------------------------------------------------------
                    $module='resource';
                    $id=$id_resource+1;
                  
                    while($module=='resource')
                    {
                        userids_not_equal_case:
                        $result2=mysqli_query($con,"select module,userid,time,action from mdl_log where id='$id'");
                        while($row = mysqli_fetch_array($result2))
                            {
                            $module=$row['module'];
                            $time2=$row['time'];
                            $user_id=$row['userid'];
                            $action=$row['action'];
                            }
                            if($user_id==$users[$i])
                            {
                                if($module!='resource')
                                {
                                    $time_sub=$time2-$time1;
                                    $Duration=$Duration+$time_sub;
                                    goto outside_while_loop;
                                }
                                  
                                else
                                {
                                    $id=$id+1; 
                                }
                            }
                            else
                            {
                                $id=$id+1;
                                goto userids_not_equal_case;
                            }
                    }
                    outside_while_loop:

                }  
            }
            
        }
//--------------------------------------------------------------------------------------------
        
        $content_stay=$Duration;
        
       
        
        if($_SESSION['expected_time_outline']==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_outline_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$content_stay/$_SESSION['expected_time_outline'];

        $percentage=$s_r*100;
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=$_SESSION['outline_stay_higher'])
        {
            $hint_value_outline_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=$_SESSION['outline_stay_lower'] AND $percentage<$_SESSION['outline_stay_higher'])
        {
           $hint_value_outline_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<$_SESSION['outline_stay_lower'])
        {
            $hint_value_outline_stay[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_outline_stay[$h]=0;
            $h=$h+1;
        }

        
        } 

        
    }
      else
      {
          
      }
    
  } 
    $len_t_students=count($user_id_array);   //gives the total number of students for each course
    
    $spliter[$j]=$len_t_students;
    
}

$a=0;

$users=[];

$u=0;

$c=0;

$h=0;

$hint_value_course_ovview_visit=[];

$user_id_array=[];

$spliter=[];

$u1=mysqli_query($con,"select userid from mdl_role_assignments where roleid='5'");

while($row=mysqli_fetch_array($u1))
{
  $users[$u]=$row['userid'];
  $u=$u+1;
}

$len_users=count($users);


for($j=0;$j<$len_teachers_courses;$j++)
{
  for($i=0;$i<$len_users;$i++)
  {
    $a=$c=$counter=0;
      
    $courses=$resource_id_Array=[];
      
   
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
        
        $r1=mysqli_query($con,"select id from mdl_resource where course=$teachers_courses[$j] AND (name LIKE 'Course Outline%' OR name LIKE '%Course Outline' OR name LIKE '%Course Outline%') OR (name LIKE 'Course Overview%' OR name LIKE '%Course Overview' OR name LIKE '%Course Overview%')");
 
        while($row=mysqli_fetch_array($r1))
        {
            $resource_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_content_objects=count($resource_id_Array);
        

        for($x=0;$x<$total_content_objects;$x++)
        {
            $r2=mysqli_query($con,"select id from mdl_log where module='resource' AND action='view' AND info=$resource_id_Array[$x] AND userid=$users[$i]");
    
            if(mysqli_num_rows($r2)!=0)
            {
            $counter=$counter+1;
            }
            else
            {
                $counter=$counter+0;
            }
            
        }
        
        $user_id_array[$h]=$users[$i];
        
        if($total_content_objects==0)
        {
            $hint_value_course_ovview_visit[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            $c_o=$counter/$total_content_objects;

            $percentage=$c_o*100;
        
            if($percentage>=$_SESSION['course_ovview_visit_higher'])
            {
                $hint_value_course_ovview_visit[$h]=3;
                $h=$h+1;
            }

            else if ($percentage>=$_SESSION['course_ovview_visit_lower'] AND $percentage<$_SESSION['course_ovview_visit_higher'])
            {
                $hint_value_course_ovview_visit[$h]=2; 
                $h=$h+1;
            }
        
            else if ($percentage>0 AND $percentage<$_SESSION['course_ovview_visit_lower'])
            {
                $hint_value_course_ovview_visit[$h]=1;
                $h=$h+1;
            }
        
            else if ($percentage==0)
            {
                $hint_value_course_ovview_visit[$h]=0;
                $h=$h+1;
            }
  
        }
        
        
    }
      else
      {
          
      }
    
  } 
    $len_t_students=count($user_id_array);   //gives the total number of students for each course
    
    $spliter[$j]=$len_t_students;
    
}

$hint_value_course_ovview_stay=[];

$users=[];

$u=0;

$h=0;

$user_id_array=[];

$spliter=[];

$u1=mysqli_query($con,"select userid from mdl_role_assignments where roleid='5'");

while($row=mysqli_fetch_array($u1))
{
  $users[$u]=$row['userid'];
  $u=$u+1;
}

$len_users=count($users);



for($j=0;$j<$len_teachers_courses;$j++)
{  
    
  for($i=0;$i<$len_users;$i++)
  { 
      
    $resource_id_Array=$courses=$attempts_id_Array=$resource_attempted_array=[];
      
    $resource_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=$stay_on_resources=0;
      
    $Duration=0;
    
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
       
        $r1=mysqli_query($con,"select id from mdl_resource where course=$teachers_courses[$j] AND (name LIKE 'Course Outline%' OR name LIKE '%Course Outline' OR name LIKE '%Course Outline%') OR (name LIKE 'Course Overview%' OR name LIKE '%Course Overview' OR name LIKE '%Course Overview%')");
 
        while($row=mysqli_fetch_array($r1))
        {
            $resource_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_resources=count($resource_id_Array);
        
        for($y=0;$y<$total_resources;$y++)
        {
            
            $r2=mysqli_query($con,"select id,time from mdl_log where module='resource' AND action='view' AND info=$resource_id_Array[$y] AND userid=$users[$i]");
            
            if(mysqli_num_rows($r2)!=0)
            {
              while($row=mysqli_fetch_array($r2))
                {       
            
                //$start_time=$row['time'];
                    $id_resource=$row['id'];
                    $time1=$row['time'];
                
                   // $start_time=$start_time+$row['time'];
                  
    //---------------------------------------------------------------------------------------------
                    $module='resource';
                    $id=$id_resource+1;
                  
                    while($module=='resource')
                    {
                        userids_not_equal_case2:
                        $result2=mysqli_query($con,"select module,userid,time,action from mdl_log where id='$id'");
                        while($row = mysqli_fetch_array($result2))
                            {
                            $module=$row['module'];
                            $time2=$row['time'];
                            $user_id=$row['userid'];
                            $action=$row['action'];
                            }
                            if($user_id==$users[$i])
                            {
                                if($module!='resource')
                                {
                                    $time_sub=$time2-$time1;
                                    $Duration=$Duration+$time_sub;
                                    goto outside_while_loop3;
                                }
                                  
                                else
                                {
                                    $id=$id+1; 
                                }
                            }
                            else
                            {
                                $id=$id+1;
                                goto userids_not_equal_case2;
                            }
                    }
                    outside_while_loop3:

                }  
            }
            
        }
//--------------------------------------------------------------------------------------------
        
        $content_stay=$Duration;
        
      
        if($_SESSION['expected_time_courseovview']==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_course_ovview_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
         
        $s_r=$content_stay/$_SESSION['expected_time_courseovview'];

        $percentage=$s_r*100;
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=$_SESSION['course_ovview_stay_higher'])
        {
            $hint_value_course_ovview_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=$_SESSION['course_ovview_stay_lower'] AND $percentage<$_SESSION['course_ovview_stay_higher'])
        {
           $hint_value_course_ovview_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<$_SESSION['course_ovview_stay_lower'])
        {
            $hint_value_course_ovview_stay[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_course_ovview_stay[$h]=0;
            $h=$h+1;
        }

        
        } 

        
    }
      else
      {
          
      }
    
  } 
    $len_t_students=count($user_id_array);   //gives the total number of students for each course
    
    $spliter[$j]=$len_t_students;
    
}



/*----------------------------------------------------------------------------------------------------------------------------------Nav Skip-------------------------------------------------------------------------------------------------------------------------------------------------

$hint_value_navigation_skip=[];

$teacher_id=3;

$users=[];

$u=0;

$h=0;

$user_id_array=[];

$spliter=[];

$u1=mysqli_query($con,"select userid from mdl_role_assignments where roleid='5'");

while($row=mysqli_fetch_array($u1))
{
  $users[$u]=$row['userid'];
  $u=$u+1;
}

$len_users=count($users);

echo "users are:";
      echo "<br>";
      
    for($i=0;$i<$len_users;$i++)
    {
        echo "$users[$i]";
        echo "<br>";
    }
      

for($j=0;$j<$len_teachers_courses;$j++)
{   
    $id=$module=$info=[];
    $b=0;
    
    $q1=mysqli_query($con,"select * from mdl_log where course=$teachers_courses[$j] AND userid=$teacher_id AND (module='resource' OR module='book' OR module='lesson' OR module='quiz') AND action='add'");
    
    while($row=mysqli_fetch_array($q1))
    {
        $id[$b]=$row['id'];
        $module[$b]=$row['module'];
        $info[$b]=$row['info'];
        
        $b=$b+1;
        
        
    }
    
    $len_added_modules=count($id);

    
for($i=0;$i<$len_users;$i++)
  { 
      
    $courses=$users_id_sequence=$users_info_sequence=$users_modules_sequence=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=0;
      
    $skip=0;
    
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
        
        for($x=0;$x<$len_added_modules;$x++)
        {
          $r1=mysqli_query($con,"select * from mdl_log where course=$teachers_courses[$j] AND userid=$users[$i] AND module='$module[$x]' AND action='view' AND info=$info[$x]"); 
            
          while($row=mysqli_fetch_array($r1))
          {
              
            $users_id_sequence[$a]=['id'];
            $users_info_sequence[$a]=['info'];
            $users_modules_sequence[$a]=$row['module'];
            $a=$a+1;
            goto out;
          }
            
          out:
            
        }
        
            //to get the only first id among the ids returned

        $total_visited_learning_objects=count($users_modules_sequence);
        
        for($y=0;$y<$total_visited_learning_objects;$y++)
        {
            if($users_modules_sequence[$y]==$module[$y] AND $users_info_sequence[$y]==$info[$y])
            {
                $skip=$skip+0;
            }
            else
            {
              $ch=$y+1;
              while($ch<$total_visited_learning_objects)
              {
                  if($users_id_sequence[$y]<$users_id_sequence[$ch])
                  {
                      $ch=$ch+1;
                  }
                  else
                  {
                      $skip=$skip+1;
                  }
              }
            }
        }

        
        
        
         // in order to check whether the attempted quiz belongs to the same course? because mdl_quiz_attempts doesnt have the course column
        
       
//--------------------------------------------------------------------------------------------

        
        $navigation_skips=$skip;
        
        if($total_visited_learning_objects==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_navigation_skip[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$navigation_skips/$total_visited_learning_objects;

        $percentage=$s_r*100;
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=75)
        {
            $hint_value_navigation_skip[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=50 AND $percentage<75)
        {
           $hint_value_navigation_skip[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<50)
        {
            $hint_value_navigation_skip[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_navigation_skip[$h]=0;
            $h=$h+1;
        }

        
        } 

        
    }
      else
      {
          
      }
    
  } 
    $len_t_students=count($user_id_array);   //gives the total number of students for each course
    
    $spliter[$j]=$len_t_students;
    
}
    $n=0;

    for($m=0;$m<$len_teachers_courses;$m++)
    {
       
        
        while($n<$spliter[$m])
        {
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  
*/


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
    
<div id="CenterContent" class="content"><form action="Learning Styles.php" method="POST"><input type="submit" name="Back" value="Back" class="glow"> <p class="narrative">to the selection of learning style dimensions </p></form><p id="maintitle">Learning Style Calculation Module for Sequential/Global Dimension</p><h1 style="text-align: center;"></h1>
<form id="Profile_Defined" method="post" action="CreateNewDatasetDetails.php"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="DataSetManager"> <input type="hidden" name="op2" value="listDataSet"> </form><form id="DefineDataSet" action="CreateNewDatasetDetails.php" method="POST"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="DataSetManager"> <input type="hidden" name="op2" value="saveDataSet">   <p class="helptext">Students' Learning Styles details for the selected courses are as follows:<br></p>  <div id="checkboxes" data-toggle="checkboxes" data-range="true"><div id="ListTableContainer">
    
 
<table id="ListTable"><tbody><tr><th></th><th>Course Code</th><th></th><th>Shortname</th><th></th><th>Longname</th><th></th><th>Reg. No.</th><th></th><th>First Name</th><th></th><th>Last Name</th><th></th><th>Learning Style dimension</th><th></th><th>Description</th></tr>
    
<?php 
    $total=1;
    
  $n=0;

    for($m=0;$m<$len_teachers_courses;$m++)
    {
        $tc=mysqli_query($con,"select idnumber,shortname,fullname from mdl_course where id=$teachers_courses[$m]");
            
        while($row=mysqli_fetch_array($tc))
        {
            
            $id_number=$row['idnumber'];
            $short_name=$row['shortname'];
            $full_name=$row['fullname'];
            
        }
        
        
        $inc=1;
        
        while($n<$spliter[$m])
        {
            $ui=mysqli_query($con,"select idnumber,firstname,lastname from mdl_user where id=$user_id_array[$n]");
            
            while($row2=mysqli_fetch_array($ui))
            {
                $reg_no=$row2['idnumber'];
                $first_name=$row2['firstname'];
                $last_name=$row2['lastname'];
            }
            $add=$hint_value_course_ovview_stay[$n]+$hint_value_course_ovview_visit[$n]+$hint_value_outline_stay[$n]+$hint_value_outline_visit[$n];
            
    
            $div=$add/4;
            
            $act_ref_ls_dim[$n]=$div;
       
            $norm=($act_ref_ls_dim[$n]-1)/2;
            
            if($norm<0)
            {
                $norm=0;
            }
            
            $normalized[$n]=$norm;
            
            if($normalized[$n]>0.5)
            {
                $LS[$n]="Sequential";
                $desc[$n]="Student's behavior is giving strong indication towards Sequential Learning Style";
            }
            else if ($normalized[$n]<0.5)
            {
                $LS[$n]="Global";
                $desc[$n]="Student's behavior is giving strong indication towards Global Learning Style";
            }
            else if($normalized[$n]==0.5)
            {
                $LS[$n]="Average/Balanced";
                $desc[$n]="Student’s behavior is average and therefore it is not giving a specific hint. Learning Style is neither Sequential nor Global but Balanced";
            }
         
            
            echo '<tr><td>'.$inc.':   
            <td>'.$id_number.'</td><td></td><td>'. $short_name.'</td><td></td>
            <td>'.$full_name.'</td><td></td><td>'.$reg_no.'</td><td></td><td>'.$first_name.'</td><td></td><td>'.$last_name.'</td><td></td>
            <td>'.$LS[$n].'</td><td></td> <td>'.$desc[$n].'</td></tr>';
            $inc=$inc+1;
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    echo "<table>";
    
    
   
?>
    
    
</tbody></table> </div></div></form></div>
</div>
</div>

<div id="sidebar-left" class="sidebar">
<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">This page gives you details about the learning style preferences of all students registered in the courses which you have selected. <br><br>The results are generated by refining and analyzing the data stored in Moodle databases.
</p></div>

</div>
</div>
</div>
<div id="footer">© copyright COMSATS Institute of Information Technology, Attock
</div></div>
</div>


  
</body></html>


