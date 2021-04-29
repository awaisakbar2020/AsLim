<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_assignment_stay=[];

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
      
    $assign_id_Array=$courses=$attempts_id_Array=$assign_attempted_well_before=[];
      
    $assign_attempted_in_same_course=$duedate_array=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=$stay_on_assignes=0;
      
    $predefined_expected_time=0;
    
      
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
        $r1=mysqli_query($con,"select id,duedate from mdl_assign where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $assign_id_Array[$a]=$row['id'];
            $duedate_array[$a]=$row['duedate'];
            $a=$a+1;
        }

        $total_assignes=count($assign_id_Array);

        for($t1=0;$t1<$total_assignes;$t1++)
        {
          $well_before_deadline_time=$duedate_array[$t1]-3600;
          $r3=mysqli_query($con,"select assignment from mdl_assign_submission where userid=$users[$i] AND status='submitted' AND timemodified<$well_before_deadline_time AND assignment=$assign_id_Array[$t1]");
        
            while($row=mysqli_fetch_array($r3))
            {
                $assign_attempted_well_before[$q_a]=$row['assignment'];
            
                $q_a=$q_a+1;
            }  
        }
        
        
        $total_attempted_assignes_well_before_deadline=count($assign_attempted_well_before);
        
        echo "<br>";
        echo "total_attempted_assignes_well_before_deadline: $total_attempted_assignes_well_before_deadline";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "total_assignes: $total_assignes";
        echo "<br>";
        
        if($total_assignes==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_assignment_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$total_attempted_assignes_well_before_deadline/$total_assignes;

        $percentage=$s_r*100;
        
        echo "percentage is $percentage";
        echo "<br>";
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=75)
        {
            $hint_value_assignment_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=50 AND $percentage<75)
        {
           $hint_value_assignment_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<50)
        {
            $hint_value_assignment_stay[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_assignment_stay[$h]=0;
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
            
            echo "$hint_value_assignment_stay[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>

