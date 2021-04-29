<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_selfassess_revision=[];

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
      
    $quiz_id_Array=$courses=$attempts_id_Array=$quiz_attempted_array=[];
      
    $quiz_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=0;
    
      
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
        $r1=mysqli_query($con,"select id from mdl_quiz where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $quiz_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_quizes=count($quiz_id_Array);

        
        $r3=mysqli_query($con,"select DISTINCT(quiz) from mdl_quiz_attempts where userid=$users[$i]");
        
        while($row=mysqli_fetch_array($r3))
        {
            $quiz_attempted_array[$q_a]=$row['quiz'];
            
            $q_a=$q_a+1;
        }
        
        $total_attempted_quizes=count($quiz_attempted_array);
        
         // in order to check whether the attempted quiz belongs to the same course? because mdl_quiz_attempts doesnt have the course column
        
        for ($q1=0;$q1<$total_attempted_quizes;$q1++)
        {
             if (in_array($quiz_attempted_array[$q1], $quiz_id_Array)) 
            {
             $quiz_attempted_in_same_course[$q_a_i_s_c]=$quiz_attempted_array[$q1];
                 
             $q_a_i_s_c = $q_a_i_s_c + 1;
            }
            
        }
        
        $len_quiz_attempted_in_same_course=count($quiz_attempted_in_same_course);
        
        for($x1=0;$x1<$len_quiz_attempted_in_same_course;$x1++)
        {
            $r2=mysqli_query($con,"select MAX(attempt) as max_attempts from mdl_quiz_attempts where quiz=$quiz_attempted_in_same_course[$x1] AND userid=$users[$i]");
            
            while($row=mysqli_fetch_array($r2))
            {
                $attempts=$row['max_attempts'];
                
                if($attempts==1)
                {
                    
                    $total_attempts=$total_attempts+0;
                }
                
                else if($attempts>1)
                {
                    $attempts=$attempts-1;
                    
                    $total_attempts=$total_attempts+$attempts;
                }
                
            }

        }
        
        $selfassess_revision=$total_attempts;
         
        $user_id_array[$h]=$users[$i];
        
        if($total_quizes==0)
        {
            $hint_value_selfassess_revision[$h]=0;
            
            $h=$h+1;
        }
        
        else
        {
            $s_r=$selfassess_revision/$total_quizes;

            $percentage=$s_r*100;
       
            if($percentage>=50)
            {
                $hint_value_selfassess_revision[$h]=3;
                $h=$h+1;
            }

            else if ($percentage>=25 AND $percentage<50)
            {
                $hint_value_selfassess_revision[$h]=2; 
                $h=$h+1;
            }
        
            else if ($percentage>0 AND $percentage<25)
            {
                $hint_value_selfassess_revision[$h]=1;
                $h=$h+1;
            }
        
        
            else if ($percentage==0)
            {
                $hint_value_selfassess_revision[$h]=0;
            
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
            
            echo "$hint_value_selfassess_revision[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>