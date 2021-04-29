<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_assignment_revision=[];

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
      
    $assignment_id_Array=$courses=$revisions_id_Array=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_revisions=0;
    
      
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
        $r1=mysqli_query($con,"select id from mdl_assign where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $assignment_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_assignments=count($assignment_id_Array);

        
        for($x1=0;$x1<$total_assignments;$x1++)
        {
            $r2=mysqli_query($con,"select COUNT(id) as attempts from mdl_assign_submission where  assignment=$assignment_id_Array[$x1] AND userid=$users[$i] AND status='submitted'");
            
            while($row=mysqli_fetch_array($r2))
            {
                $revisions=$row['attempts'];
                
                if($revisions==1)
                {
                    
                    $total_revisions=$total_revisions+0;
                }
                
                else if($revisions>1)
                {
                    $revisions=$revisions-1;
                    
                    $total_revisions=$total_revisions+$revisions;
                }
                
            }

        }
        
        $assignment_revisions=$total_revisions;
        
        echo "<br>";
        echo "assignment_revision: $assignment_revisions";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
       
        $user_id_array[$h]=$users[$i];
        
        $h3=2;
        
        $h2=1;

        if($assignment_revisions>$h3)
        {
            $hint_value_assignment_revision[$h]=3;
            $h=$h+1;
        }

        else if ($assignment_revisions>$h2 AND $assignment_revisions<=$h3)
        {
           $hint_value_assignment_revision[$h]=2; 
            $h=$h+1;
        }
        
        else if ($assignment_revisions>0 AND $assignment_revisions<=$h2)
        {
            $hint_value_assignment_revision[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($assignment_revisions==0)
        {
            $hint_value_assignment_revision[$h]=0;
            
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
            
            echo "$hint_value_assignment_revision[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>