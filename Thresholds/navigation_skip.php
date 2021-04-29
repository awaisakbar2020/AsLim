<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

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
        
      /* echo "<br>";
        echo "id is $id[$b]";
        echo "<br>"; 
        echo "module is $module[$b]";
        echo "<br>";
        echo "info is $info[$b]";  */
        
        $b=$b+1;
        
        
    }
    
    $len_added_modules=count($id);
    
    echo "teachers sequence length: $len_added_modules";
    echo "<br>";

    
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
        echo "Match found";
        echo "<br>";
        
        for($x=0;$x<$len_added_modules;$x++)
        {
          $r1=mysqli_query($con,"select * from mdl_log where course=$teachers_courses[$j] AND userid=$users[$i] AND module='$module[$x]' AND action='view' AND info=$info[$x]"); 
            
          while($row=mysqli_fetch_array($r1))
          {
              echo "storing users navigation:";
              echo "<br>";
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
        echo "total_visited_learning_objects/ users sequence: $total_visited_learning_objects";
        echo "<br>";
        
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
        
        echo "<br>";
        echo "navigation_skips: $navigation_skips";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "total_visited_learning_objects $total_visited_learning_objects";
        echo "<br>";
        
        if($total_visited_learning_objects==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_navigation_skip[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$navigation_skips/$total_visited_learning_objects;

        $percentage=$s_r*100;
        
        echo "percentage is $percentage";
        echo "<br>";
        
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
        echo "Hint value for course id $teachers_courses[$m] is:";
        
        echo "<br>";
        
        echo "user id: ";
        
        echo "Hint value";
        
        echo "<br>";
        
        while($n<$spliter[$m])
        {
            echo "$user_id_array[$n]: ";
            
            echo "$hint_value_navigation_skip[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  


?>

