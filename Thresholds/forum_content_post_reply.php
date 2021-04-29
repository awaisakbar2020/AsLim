<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_forum_resource_posts_reply=[];

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
      
    $resource_name=$courses=$attempts_id_Array=$resource_related_forums=[];
      
    $attempted_questions_using_attempt_id=$forum_discussion_idArray=[];
      
    $a=$c=$s=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$forum_posts_reply=0;
    
      
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
        $r1=mysqli_query($con,"select name from mdl_resource where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $resource_name[$a]=$row['name'];
            $a=$a+1;
        }

        $total_resources=count($resource_name);
        
        for($y=0;$y<$total_resources;$y++)
        {
         $r3=mysqli_query($con,"select id from mdl_forum where name='$resource_name[$y]' AND course=$teachers_courses[$j]");
        
         while($row=mysqli_fetch_array($r3))
          {
            $resource_related_forums[$q_a]=$row['id'];
            
            $q_a=$q_a+1;
          }
        
        }
       
        $total_resource_related_forums=count($resource_related_forums);
        
        echo"<br>";
        echo "total_resource_related_forums: $total_resource_related_forums";
        echo"<br>";
            
        for($z=0;$z<$total_resource_related_forums;$z++)
        {   
        
        $f_d_id= mysqli_query($con,"SELECT id FROM mdl_forum_discussions WHERE forum=$resource_related_forums[$z]");
        
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
            
            $f_p_id= mysqli_query($con,"SELECT COUNT(id) as posts_replies FROM mdl_forum_posts WHERE discussion=$forum_discussion_idArray[$z2] AND userid=$users[$i] AND parent!=0 ");
    
            while($row = mysqli_fetch_array($f_p_id))
            {
                $f_posts_reply=$row['posts_replies'];
                echo"<br>";
                echo "count of replies is $f_posts_reply";
                echo"<br>";
          
                $forum_posts_reply=$forum_posts_reply+$f_posts_reply;
            }
        }
       
        $forum_resource_posts_reply=$forum_posts_reply;
        
        echo "<br>";
        echo "forum_resource_posts_reply: $forum_resource_posts_reply";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "total_resources: $total_resources";
        echo "<br>";
        
        $h3=$total_resources*2;
        
        $h2=$total_resources*1;
       
        $user_id_array[$h]=$users[$i];
        
        if($forum_resource_posts_reply>$h3)
        {
            $hint_value_forum_resource_posts_reply[$h]=3;
            $h=$h+1;
        }

        else if ($forum_resource_posts_reply>$h2 AND $forum_resource_posts_reply<=$h3)
        {
           $hint_value_forum_resource_posts_reply[$h]=2; 
            $h=$h+1;
        }
        
        else if ($forum_resource_posts_reply>0 AND $forum_resource_posts_reply<=$h2)
        {
            $hint_value_forum_resource_posts_reply[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($forum_resource_posts_reply==0)
        {
            $hint_value_forum_resource_posts_reply[$h]=0;
            
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
            
            echo "$hint_value_forum_resource_posts_reply[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>