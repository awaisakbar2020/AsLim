<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_forum_assignment_posts=[];

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
      
    $assignment_name=$courses=$attempts_id_Array=$assignment_related_forums=[];
      
    $quiz_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$forum_discussion_idArray=[];
      
    $a=$c=$s=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$forum_posts=0;
    
      
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
        $r1=mysqli_query($con,"select name from mdl_assign where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $assignment_name[$a]=$row['name'];
            $a=$a+1;
        }

        $total_assignments=count($assignment_name);
        
        for($y=0;$y<$total_assignments;$y++)
        {
         $r3=mysqli_query($con,"select id from mdl_forum where name='$assignment_name[$y]' AND course=$teachers_courses[$j]");
        
         while($row=mysqli_fetch_array($r3))
          {
            $assignment_related_forums[$q_a]=$row['id'];
            
            $q_a=$q_a+1;
          }
        
        }
       
        $total_assignment_related_forums=count($assignment_related_forums);
        
        echo"<br>";
        echo "total_assignment_related_forums: $total_assignment_related_forums";
        echo"<br>";
            
        for($z=0;$z<$total_assignment_related_forums;$z++)
        {   
        
        $f_d_id= mysqli_query($con,"SELECT id FROM mdl_forum_discussions WHERE forum=$assignment_related_forums[$z]");
        
        while($row = mysqli_fetch_array($f_d_id))
        {
        $forum_discussion_idArray[$s]=$row['id'];
        
        $s=$s+1;
        }
        
        }
    
        $len_forum_discussion_idArray=count($forum_discussion_idArray);
        
        echo"<br>";
        echo "total_forum_discussion: $len_forum_discussion_idArray";
        echo"<br>";

        for($z2=0;$z2<$len_forum_discussion_idArray;$z2++)
        {  
            $f_p_id= mysqli_query($con,"SELECT COUNT(id) as posts FROM mdl_forum_posts WHERE discussion=$forum_discussion_idArray[$z2] AND userid=$users[$i] AND parent=0 ");
    
            while($row = mysqli_fetch_array($f_p_id))
            {
                $f_posts=$row['posts'];
          
                $forum_posts=$forum_posts+$f_posts;
            }
        }
       
        $forum_assignment_posts=$forum_posts;
        
        echo "<br>";
        echo "forum_assignment_posts: $forum_assignment_posts";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "total_assignments: $total_assignments";
        echo "<br>";
        
        $h3=$total_assignments*2;
        
        $h2=$total_assignments*1;
       
        $user_id_array[$h]=$users[$i];
        
        if($forum_assignment_posts>$h3)
        {
            $hint_value_forum_assignment_posts[$h]=3;
            $h=$h+1;
        }

        else if ($forum_assignment_posts>$h2 AND $forum_assignment_posts<=$h3)
        {
           $hint_value_forum_assignment_posts[$h]=2; 
            $h=$h+1;
        }
        
        else if ($forum_assignment_posts>0 AND $forum_assignment_posts<=$h2)
        {
            $hint_value_forum_assignment_posts[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($forum_assignment_posts==0)
        {
            $hint_value_forum_assignment_posts[$h]=0;
            
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

    echo"<br>";

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
            
            echo "$hint_value_forum_assignment_posts[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>