<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

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
    $a=$c=$counter=0;
      
    $courses=$resource_id_Array=[];
      
   // $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id AND mdl_course.id=$teachers_courses[$j]");   
      
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
        $r1=mysqli_query($con,"select id from mdl_resource where course=$teachers_courses[$j] AND (name LIKE 'Course Overview%' OR name LIKE '%Course Overview' OR name LIKE '%Course Overview%')");
 
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
        
            if($percentage>=100)
            {
                $hint_value_course_ovview_visit[$h]=3;
                $h=$h+1;
            }

            else if ($percentage>=75 AND $percentage<100)
            {
                $hint_value_course_ovview_visit[$h]=2; 
                $h=$h+1;
            }
        
            else if ($percentage>0 AND $percentage<75)
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
            
            echo "$hint_value_course_ovview_visit[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>