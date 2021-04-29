<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_forum_resource_visit=[];

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
    $w=0;
    
    $weekly_divided_time=[];
     
    $r0=mysqli_query($con,"select startdate,enddate from mdl_course where id=$teachers_courses[$j]");
    
    while($row=mysqli_fetch_array($r0))
    {
        $start_date=$row['startdate'];
        $end_date=$row['enddate'];
    }
    
    for($f=$start_date;$f<$end_date;$f=$f+604800)
    {
        $weekly_divided_time[$w]=$f;
        $w=$w+1;
    }
     
    $len_weekly_divided_time=count($weekly_divided_time);
    
  for($i=0;$i<$len_users;$i++)
  { 
      
    $resource_name=$courses=$attempts_id_Array=$resource_related_forums=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$forum_visits=0;
    
      
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
         $r3=mysqli_query($con,"select id from mdl_forum where name='Forum for $resource_name[$y]' AND course=$teachers_courses[$j]");
        
         while($row=mysqli_fetch_array($r3))
          {
            $resource_related_forums[$q_a]=$row['id'];
            
            $q_a=$q_a+1;
          }
        
        }
       
        $total_resource_related_forums=count($resource_related_forums);
        
          echo "total weeks are: $len_weekly_divided_time";
        
        for($t=0;$t<$len_weekly_divided_time-1;$t++)
        {
            $tt=$t+1;
          for($q1=0;$q1<$total_resource_related_forums;$q1++)
            {
            $r4=mysqli_query($con,"select COUNT(id) as visits from mdl_log where module='forum' AND action='view forum' AND info=$resource_related_forums[$q1] AND userid=$users[$i] AND time BETWEEN $weekly_divided_time[$t] AND $weekly_divided_time[$tt]"); 
                                                                
            while($row=mysqli_fetch_array($r4))
            {
                $f_visits=$row['visits'];
              
                if($f_visits>4)
                {
                      $f_visits=4;      //max visits of a forum can be 4
                }
            }
                $forum_visits=$forum_visits+$f_visits;
            
            }  
        }
        
        
    
        
        $forum_resource_visit=$forum_visits;
        
        echo "<br>";
        echo "forum_resource_visit: $forum_resource_visit";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "total_resources: $total_resources";
        echo "<br>";
        
        $h3=$total_resources*4*$len_weekly_divided_time; //number of visit in each forum during a week (handling here)
        
        $h2=$total_resources*2*$len_weekly_divided_time;
       
        $user_id_array[$h]=$users[$i];

        if($forum_resource_visit>=$h3)
        {
            $hint_value_forum_resource_visit[$h]=3;
            $h=$h+1;
        }

        else if ($forum_resource_visit>=$h2 AND $percentage<$h3)
        {
           $hint_value_forum_resource_visit[$h]=2; 
            $h=$h+1;
        }
        
        else if ($forum_resource_visit>0 AND $forum_resource_visit<$h2)
        {
            $hint_value_forum_resource_visit[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($forum_resource_visit==0)
        {
            $hint_value_forum_resource_visit[$h]=0;
            
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
            
            echo "$hint_value_forum_resource_visit[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>