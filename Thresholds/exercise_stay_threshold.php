<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_exercise_stay=[];

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
      
    $lesson_id_Array=$courses=$attempts_id_Array=$lesson_attempted_array=[];
      
    $lesson_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=$stay_on_lessons=0;
      
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
        $r1=mysqli_query($con,"select id from mdl_lesson where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $lesson_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_lessons=count($lesson_id_Array);

        
        $r3=mysqli_query($con,"select DISTINCT(lessonid) from mdl_lesson_attempts where userid=$users[$i]");
        
        while($row=mysqli_fetch_array($r3))
        {
            $lesson_attempted_array[$q_a]=$row['lessonid'];
            
            $q_a=$q_a+1;
        }
        
        $total_attempted_lessons=count($lesson_attempted_array);
        
         // in order to check whether the attempted lesson belongs to the same course? because mdl_lesson_attempts doesnt have the course column
        
        for ($q1=0;$q1<$total_attempted_lessons;$q1++)
        {
             if (in_array($lesson_attempted_array[$q1], $lesson_id_Array)) 
            {
             $lesson_attempted_in_same_course[$q_a_i_s_c]=$lesson_attempted_array[$q1];
                 
             $q_a_i_s_c = $q_a_i_s_c + 1;
            }
            
        }
        
        $len_lesson_attempted_in_same_course=count($lesson_attempted_in_same_course);
        
        for($y=0;$y<$len_lesson_attempted_in_same_course;$y++)
        {
            $y2=mysqli_query($con,"select timelimit from mdl_lesson where id=$lesson_attempted_in_same_course[$y]");
            while($row=mysqli_fetch_array($y2))
            {
                $time=$row['timelimit'];
            }
            $predefined_expected_time=$predefined_expected_time+$time;
        }
//--------------------------------------------------------------------------------------------
        for($x1=0;$x1<$len_lesson_attempted_in_same_course;$x1++)
        {
            $start_time=$end_time=0;
            
            $r2=mysqli_query($con,"select time from mdl_log where module='lesson' AND action='start' AND info=$lesson_attempted_in_same_course[$x1] AND userid=$users[$i]");
            
            if(mysqli_num_rows($r2)!=0)
            {
              while($row=mysqli_fetch_array($r2))
                {       
            
                //$start_time=$row['time'];
                
                $start_time=$start_time+$row['time'];

                }  
            }
            
            $r4=mysqli_query($con,"select time from mdl_log where module='lesson' AND action='end' AND info=$lesson_attempted_in_same_course[$x1] AND userid=$users[$i]");
            
            
            if(mysqli_num_rows($r4)!=0)
            {
              while($row=mysqli_fetch_array($r4))
                {       
            
                //$end_time=$row['time'];
                
                $end_time=$end_time+$row['time'];

                }  
            }
            
            
            $time_spent=$end_time-$start_time;
            
            echo "<br>";
            echo "time spent: $time_spent";
            echo "<br>";
            
            $stay_on_lessons=$stay_on_lessons+$time_spent;
                

        }
        
        $exercise_stay=$stay_on_lessons;
        
        echo "<br>";
        echo "exercise_stay: $exercise_stay";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "predefined_expected_time $predefined_expected_time";
        echo "<br>";
        if($predefined_expected_time==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_exercise_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$exercise_stay/$predefined_expected_time;

        $percentage=$s_r*100;
        
        echo "percentage is $percentage";
        echo "<br>";
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=75)
        {
            $hint_value_exercise_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=50 AND $percentage<75)
        {
           $hint_value_exercise_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<50)
        {
            $hint_value_exercise_stay[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_exercise_stay[$h]=0;
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
            
            echo "$hint_value_exercise_stay[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>

