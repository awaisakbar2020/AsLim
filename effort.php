<?php

session_start();

$con= new mysqli($_SESSION['host'],$_SESSION['mysql_username'],$_SESSION['mysql_password']);

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses=$_SESSION['selected_courses'];

$len_teachers_courses=count($teachers_courses);

$effort=$normalized=$AS_level=$desc=$percentage_effort=[];

$hint_value_selfasses_visit=[];

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

      

for($j=0;$j<$len_teachers_courses;$j++)
{  
    
  for($i=0;$i<$len_users;$i++)
  { 
      
    $quiz_id_Array=$courses=$question_id_Array=$quiz_attempted_array=[];
      
    $quiz_attempted_in_same_course=$questions_in_attempted_quizes=$question_attempt_id_array=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=0;
    
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
        
        $r1=mysqli_query($con,"select id from mdl_quiz where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $quiz_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_quizes=count($quiz_id_Array);

        for($x=0;$x<$total_quizes;$x++)
        {
            $r2=mysqli_query($con,"select questionid from mdl_quiz_slots where quizid=$quiz_id_Array[$x]");
            
            while($row=mysqli_fetch_array($r2))
            {
                $question_id_Array[$q]=$row['questionid'];
                
                $q=$q+1;
            }

        }
        
        $total_questions=count($question_id_Array); //question_id_array gives all question created in the quizes. It has no concern with the attempt
        
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
            $r4=mysqli_query($con,"select questionid from mdl_quiz_slots where quizid=$quiz_attempted_in_same_course[$x1]");
            
            while($row=mysqli_fetch_array($r4))
            {
                $questions_in_attempted_quizes[$q2]=$row['questionid'];
                
                $q2=$q2+1;
            }
            //echo "$questions_in_attempted_quizes[$q]"

        }
        
        
        $len_questions_in_attempted_quizes=count($questions_in_attempted_quizes);
        
        
        // $questions_in_attempted_quizes gives all questions in attempted quizes
        
        // attempt adjustment can be done here i.e. todo or complete
        
        $r5=mysqli_query($con,"select DISTINCT(questionattemptid) from mdl_question_attempt_steps where state='complete' AND userid=$users[$i]");
        
        while($row=mysqli_fetch_array($r5))
        {
            $question_attempt_id_array[$q_a_i_a]=$row['questionattemptid'];
            
            $q_a_i_a = $q_a_i_a + 1;
        }
        
        $len_question_attempt_id_array=count($question_attempt_id_array);
        
        for($q3=0;$q3<$len_question_attempt_id_array;$q3++)
        {
          $r6=mysqli_query($con,"select DISTINCT(questionid) from mdl_question_attempts where id=$question_attempt_id_array[$q3]");
            
          while($row=mysqli_fetch_array($r6))
          {
              $attempted_questions_using_attempt_id[$q4]=$row['questionid'];
              
              $q4=$q4+1;
          }
        }
        
        $len_attempted_questions_using_attempt_id=count($attempted_questions_using_attempt_id);
        
        
        for($q5=0;$q5<$len_attempted_questions_using_attempt_id;$q5++)
        {
            if(in_array($attempted_questions_using_attempt_id[$q5],$questions_in_attempted_quizes))
            {
                $performed_selfasses_ques[$p_s_q]=$attempted_questions_using_attempt_id[$q5];
                
                $p_s_q=$p_s_q+1;
            }
        }
        
        //$performed_selfasses_ques gives all the attempted question. It is refined form
        
        $user_id_array[$h]=$users[$i];
        
        $total_performed_selfasses_ques=count($performed_selfasses_ques);
        
        if($total_questions==0)
        {
            $hint_value_selfasses_visit[$h]=0;
            $h=$h+1; 
        }
        else
        {
           $s_q=$total_performed_selfasses_ques/$total_questions;

            $percentage=$s_q*100;
        
        

            if($percentage>=$_SESSION['self_assess_visit_higher'])
            {
                $hint_value_selfasses_visit[$h]=3;
                $h=$h+1;
            }

            else if ($percentage>=$_SESSION['self_assess_visit_lower'] AND $percentage<$_SESSION['self_assess_visit_higher'])
            {
                $hint_value_selfasses_visit[$h]=2; 
                $h=$h+1;
            }
        
            else if ($percentage>0 AND $percentage<$_SESSION['self_assess_visit_lower'])
            {
                $hint_value_selfasses_visit[$h]=1;
                $h=$h+1;
            }
        
            
            else if ($percentage==0)
            {
                $hint_value_selfasses_visit[$h]=0;
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

//-------------------------------------------------------------------------------------------------

$hint_value_selfassess_stay=[];

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
      

for($j=0;$j<$len_teachers_courses;$j++)
{  
    
  for($i=0;$i<$len_users;$i++)
  { 
      
    $quiz_id_Array=$courses=$attempts_id_Array=$quiz_attempted_array=[];
      
    $quiz_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=$stay_on_quizes=0;
      
    $predefined_expected_time_quiz=0;
    
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
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
        
        for($y=0;$y<$total_quizes;$y++)
        {
            $y2=mysqli_query($con,"select timelimit from mdl_quiz where id=$quiz_id_Array[$y]");
            while($row=mysqli_fetch_array($y2))
            {
                $time=$row['timelimit'];
            }
            $predefined_expected_time_quiz=$predefined_expected_time_quiz+$time;
        }
//--------------------------------------------------------------------------------------------
        for($x1=0;$x1<$len_quiz_attempted_in_same_course;$x1++)
        {
            $start_time=$end_time=0;
            
            $r2=mysqli_query($con,"select time from mdl_log where module='quiz' AND action='attempt' AND info=$quiz_attempted_in_same_course[$x1] AND userid=$users[$i]");
            
            if(mysqli_num_rows($r2)!=0)
            {
              while($row=mysqli_fetch_array($r2))
                {       
            
                //$start_time=$row['time'];
                
                $start_time=$start_time+$row['time'];

                }  
            }
            
            $r4=mysqli_query($con,"select time from mdl_log where module='quiz' AND action='review' AND info=$quiz_attempted_in_same_course[$x1] AND userid=$users[$i]");
            
            
            if(mysqli_num_rows($r4)!=0)
            {
              while($row=mysqli_fetch_array($r4))
                {       
            
                //$end_time=$row['time'];
                
                $end_time=$end_time+$row['time'];

                }  
            }
            
            
            $time_spent=$end_time-$start_time;
            
            $stay_on_quizes=$stay_on_quizes+$time_spent;
                

        }
        
        $selfassess_stay=$stay_on_quizes;
        
      
        
        if($predefined_expected_time_quiz==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_selfassess_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$selfassess_stay/$predefined_expected_time_quiz;

        $percentage=$s_r*100;
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=$_SESSION['self_assess_stay_higher'])
        {
            $hint_value_selfassess_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=$_SESSION['self_assess_stay_lower'] AND $percentage<$_SESSION['self_assess_stay_higher'])
        {
           $hint_value_selfassess_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<$_SESSION['self_assess_stay_lower'])
        {
            $hint_value_selfassess_stay[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_selfassess_stay[$h]=0;
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

//-------------------------------------------------------------------------------------------------

$hint_value_exercise_visit=[];

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

      

for($j=0;$j<$len_teachers_courses;$j++)
{
  for($i=0;$i<$len_users;$i++)
  {
      $a=$c=0;
    $counter=0;
      $courses=$lesson_id_Array=[];
   
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
        
        $r1=mysqli_query($con,"select id from mdl_lesson where course=$teachers_courses[$j]");
 
        while($row=mysqli_fetch_array($r1))
        {
            $lesson_id_Array[$a]=$row['id'];
            $a=$a+1;
        }

        $total_content_objects=count($lesson_id_Array);

        for($x=0;$x<$total_content_objects;$x++)
        {
            $r2=mysqli_query($con,"select id from mdl_log where module='lesson' AND action='view' AND info=$lesson_id_Array[$x] AND userid=$users[$i]");
    
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
            $hint_value_exercise_visit[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            $c_o=$counter/$total_content_objects;

            $percentage=$c_o*100;
       
            if($percentage>=$_SESSION['exercise_visit_higher'])
            {
                $hint_value_exercise_visit[$h]=3;
                $h=$h+1;
            }

            else if ($percentage>=$_SESSION['exercise_visit_lower'] AND $percentage<$_SESSION['exercise_visit_higher'])
            {
                $hint_value_exercise_visit[$h]=2; 
                $h=$h+1;
            }
        
            else if ($percentage>0 AND $percentage<$_SESSION['exercise_visit_lower'])
            {
                $hint_value_exercise_visit[$h]=1;
                $h=$h+1;
            }
        
        
            else if ($percentage==0)
            {
                $hint_value_exercise_visit[$h]=0;
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
  //-----------------------------------------------------------------------------------------------


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

      

for($j=0;$j<$len_teachers_courses;$j++)
{  
    
  for($i=0;$i<$len_users;$i++)
  { 
      
    $lesson_id_Array=$courses=$attempts_id_Array=$lesson_attempted_array=[];
      
    $lesson_attempted_in_same_course=[];
      
    $attempted_questions_using_attempt_id=$performed_selfasses_ques=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$total_attempts=$k=$stay_on_lessons=0;
      
    $predefined_expected_time_exe=0;
    
      
    $result= mysqli_query($con,"select mdl_course.id from mdl_role, mdl_role_assignments,mdl_context,mdl_course where mdl_role_assignments.userid=$users[$i] AND mdl_role.id=mdl_role_assignments.roleid AND mdl_role.shortname='student'AND mdl_role_assignments.contextid=mdl_context.id AND mdl_role_assignments.userid=$users[$i] AND mdl_context.contextlevel='50' AND mdl_context.instanceid=mdl_course.id");

    while($row=mysqli_fetch_array($result))
    {
        $courses[$c]=$row['id'];
        $c=$c+1;
    }
      
    $len_courses=count($courses);
      
      
    if (in_array($teachers_courses[$j], $courses))
    {
        
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
            $predefined_expected_time_exe=$predefined_expected_time_exe+$time;
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
      
            
            $stay_on_lessons=$stay_on_lessons+$time_spent;
                

        }
        
        $exercise_stay=$stay_on_lessons;
        
        if($predefined_expected_time_exe==0) //if it is zero then dividing by zero will turn into infinity. Just resolving that case when a user has not attempted any lesson.
        {
            $hint_value_exercise_stay[$h]=0;
            $h=$h+1;
        }
        
        else
        {
            
        $s_r=$exercise_stay/$predefined_expected_time_exe;

        $percentage=$s_r*100;
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=$_SESSION['exercise_stay_higher'])
        {
            $hint_value_exercise_stay[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=$_SESSION['exercise_stay_lower'] AND $percentage<$_SESSION['exercise_stay_higher'])
        {
           $hint_value_exercise_stay[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<$_SESSION['exercise_stay_lower'])
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
 
//-------------------------------------------------------------------------------------------------
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
        
 $h3=$total_resources*$_SESSION['forum_content_visit_higher']*$len_weekly_divided_time; //number of visit in each forum during a week (handling here)
        
$h2=$total_resources*$_SESSION['forum_content_visit_lower']*$len_weekly_divided_time;
       
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
 
//-------------------------------------------------------------------------------------------------

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
      

        for($z2=0;$z2<$len_forum_discussion_idArray;$z2++)
        {  
            
            $f_p_id= mysqli_query($con,"SELECT COUNT(id) as posts_replies FROM mdl_forum_posts WHERE discussion=$forum_discussion_idArray[$z2] AND userid=$users[$i] AND parent!=0 ");
    
            while($row = mysqli_fetch_array($f_p_id))
            {
                $f_posts_reply=$row['posts_replies'];
                
          
                $forum_posts_reply=$forum_posts_reply+$f_posts_reply;
            }
        }
       
        $forum_resource_posts_reply=$forum_posts_reply;
        
        $h3=$total_resources*$_SESSION['forum_content_post_higher'];
        
        $h2=$total_resources*$_SESSION['forum_content_post_lower'];
       
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

//-------------------------------------------------------------------------------------------------

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
        
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
       
        $user_id_array[$h]=$users[$i];
       
        $h3=$_SESSION['assign_rev_higher'];
        
        $h2=$_SESSION['assign_rev_lower'];

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
//-------------------------------------------------------------------------------------------------


  
  
?>

<html style="" class="js flexbox flexboxlegacy canvas canvastext webgl touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface no-generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths gr__academicanalytics_ca"><head>
<title> AsLim Tool </title>
<link rel="shortcut icon" href="images/AsLim_Icon.ico">
<link rel="stylesheet" href="style_sheets/hover.css">
<link rel="stylesheet" href="style_sheets/jquery-ui-1.10.4.custom.css">
<link rel="stylesheet" href="style_sheets/jquery.dataTables.min.css">
<link rel="stylesheet" href="style_sheets/style.css">
<link rel="stylesheet" href="style_sheets/tooltipster.css">
<script src="js/aat.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.checkboxes-1.0.6.min.js"></script>
<script src="js/json2.js"></script>
<script src="js/jquery.json-2.4.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.blockUI.js"></script>
<script src="js/jquery.session.js"></script>
<script src="js/jquery.alphanum.js"></script>
<script src="js/jquery.tooltipster.min.js"></script>
<script src="js/modernizr-latest.js"></script>
</head>

<body id="second" onload="bodyOnLoad(); makeTableScroll();" data-gr-c-s-loaded="true" waid71fa0d88-5390-4b5b-a2f4-e45fa93d85e2="SA password protect entry checker">
<hr style="height:5px;color:#8B0000; background-color:#8B0000;">
<div id="page" class="one-sidebar">
<div id="header">
<div id="logo-title">
<h1 id="site-name"><a href="#" title="Home"><img src="./images/AsLim_Logo_New.png" alt="AsLim"></a>
</h1>
</div>
   
    
<div class="menu withprimary ">
<div id="primary" class="clear-block">
<ul class="links-menu">

<li><a href="CoursesSelection.php">Home</a></li>
<li><a href="Logout.php">Logout</a></li>
</ul>
</div>
</div>
</div>
<hr style="height:5px;color:#8B0000; background-color:#8B0000;">



<div id="container" class="withleft clear-block">
<div id="main-wrapper">
<div id="main" class="clear-block">
    
<div id="CenterContent" class="content"><form action="AffectiveStates.php" method="POST"><input type="submit" name="Back" value="Back" class="glow"> <p class="narrative">to the selection of affective states</p></form><p id="maintitle">Affective States Calculation Module for Effort</p><h1 style="text-align: center;"></h1>
<form id="Profile_Defined" method="post" action="CreateNewDatasetDetails.php"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="DataSetManager"> <input type="hidden" name="op2" value="listDataSet"> </form><form id="DefineDataSet" action="CreateNewDatasetDetails.php" method="POST"> <input type="hidden" name="submit" value="submit"> <input type="hidden" name="op1" value="DataSetManager"> <input type="hidden" name="op2" value="saveDataSet">   <p class="helptext">Students' Affective States details for the selected courses are as follows:<br></p>  <div id="checkboxes" data-toggle="checkboxes" data-range="true"><div id="ListTableContainer">
    

<table id="ListTable"><tbody><tr><th></th><th>Course Code</th><th></th><th>Shortname</th><th></th><th>Longname</th><th></th><th>Reg. No.</th><th></th><th>First Name</th><th></th><th>Last Name</th><th></th><th>Level of Effort</th><th></th><th>Description</th></tr>
    
<?php 
    
  $n=0;

    for($m=0;$m<$len_teachers_courses;$m++)
    {
        $tc=mysqli_query($con,"select idnumber,shortname,fullname from mdl_course where id=$teachers_courses[$m]");
            
        while($row=mysqli_fetch_array($tc))
        {
            
            $id_number=$row['idnumber'];
            $short_name=$row['shortname'];
            $full_name=$row['fullname'];
            
        }
        
        
        $inc=1;
        
        while($n<$spliter[$m])
        {
            $ui=mysqli_query($con,"select idnumber,firstname,lastname from mdl_user where id=$user_id_array[$n]");
            
            while($row2=mysqli_fetch_array($ui))
            {
                $reg_no=$row2['idnumber'];
                $first_name=$row2['firstname'];
                $last_name=$row2['lastname'];
            }
           
           $add=$hint_value_exercise_visit[$n]+$hint_value_exercise_stay[$n]+$hint_value_forum_resource_visit[$n]+$hint_value_forum_resource_posts_reply[$n]+$hint_value_selfasses_visit[$n]+$hint_value_selfassess_stay[$n]+$hint_value_assignment_revision[$n];
            
            $div=$add/7;
            
            $effort[$n]=$div;

            $norm=($effort[$n]-1)/2;
         
            if($norm<0)
            {
                $norm=0;
            }
            
            $normalized[$n]=$norm;
            
            $percentage_effort[$n]=round(($normalized[$n]/1)*100,1);
            
            if($normalized[$n]>0.5)
            {
                $AS_level[$n]="High";
                $desc[$n]="Student's behavior is indicating that he is putting $percentage_effort[$n] % effort";
            }
            else if ($normalized[$n]<0.5)
            {
                 $AS_level[$n]="Low";
                 $desc[$n]="Student's behavior is indicating that he is putting $percentage_effort[$n] % effort";
            }
            else if($normalized[$n]==0.5)
            {
                 $AS_level[$n]="Medium";
                 $desc[$n]="Student's behavior is indicating that he is putting $percentage_effort[$n] % effort";
            }
            
            
            echo '<tr><td>'.$inc.':   
            <td>'.$id_number.'</td><td></td><td>'. $short_name.'</td><td></td>
            <td>'.$full_name.'</td><td></td><td>'.$reg_no.'</td><td></td><td>'.$first_name.'</td><td></td><td>'.$last_name.'</td><td></td><td>'.$AS_level[$n].'</td><td></td>
            <td>'.$desc[$n].'</td></tr>';
            $inc=$inc+1;
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    echo "<table>";
    
    
   
?>
    
    
</tbody></table> </div></div></form></div>
</div>
</div>

<div id="sidebar-left" class="sidebar">
<div class="block block-book">
<div class="blockinner"><h2>Help</h2>
<div class="content"><p class="helptext">This page gives you details about the Affective States of all students registered in the courses which you have selected. <br><br>The results are generated by refining and analyzing the data stored in Moodle databases.
</p></div>
    
</div>
</div>
</div>
<div id="footer">© copyright COMSATS Institute of Information Technology, Attock
</div></div>
</div>

  
</body></html>
