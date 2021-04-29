<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_outline_stay=[];

$predefined_expected_time=450;

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
        echo "Match found";
        echo "<br>";
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
        
        echo "<br>";
        echo "content_stay: $content_stay";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "predefined_expected_time $predefined_expected_time";
        echo "<br>";
        
        if($predefined_expected_time==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_outline_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$content_stay/$predefined_expected_time;

        $percentage=$s_r*100;
        
        echo "percentage is $percentage";
        echo "<br>";
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=75)
        {
            $hint_value_outline_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=50 AND $percentage<75)
        {
           $hint_value_outline_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<50)
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
    $n=0;

    for($m=0;$m<$len_teachers_courses;$m++)
    {
        echo "Hint value for course id $teachers_courses[$m] is:";
        
        echo "<br>";
        
        echo "user id: ";
        
        echo "Hint value";
        
        echo "<br>";
        
        while($n<$spliter[$m])
        {
            echo "$user_id_array[$n]: ";
            
            echo "$hint_value_outline_stay[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>

