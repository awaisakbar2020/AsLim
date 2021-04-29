<?php

$con= new mysqli("localhost:3308","root","root123");

mysqli_select_db($con,"bitnami_moodle");

$teachers_courses=[];

$teachers_courses[0]=2;

$len_teachers_courses=count($teachers_courses);

$hint_value_ques_text=[];

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
      
    $quiz_id_Array=$courses=$question_id_Array=$quiz_attempted_array=[];
      
    $quiz_attempted_in_same_course=$questions_in_attempted_quizes=$question_attempt_id_array=[];
      
    $attempted_questions_using_attempt_id=$correctly_answered_textual_ques=[];
      
    $intermediate_refined_ques_text=[];
      
    $a=$c=$q=$q_a=$q_a_i_s_c=$q2=$q_a_i_a=$p_s_q=$q4=$q_g=$q6=0;
    
      
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

        for($x=0;$x<$total_quizes;$x++)
        {
            $r2=mysqli_query($con,"select questionid from mdl_quiz_slots where quizid=$quiz_id_Array[$x]");
            
            while($row=mysqli_fetch_array($r2))
            {
                $question_id_Array[$q]=$row['questionid'];
                
                $q=$q+1;
            }

        }
        
        $len_question_id_Array=count($question_id_Array);
        
        for($z=0;$z<$len_question_id_Array;$z++)
        {
            $g_q= mysqli_query($con,"SELECT id FROM mdl_question WHERE id=$question_id_Array[$z] AND qtype!='ddimageortext'");
            while($row = mysqli_fetch_array($g_q))
            {   
                $ques_text_id_Array[$q_g]=$row['id'];
            
                $q_g=$q_g+1;
            }
        }
        
        $total_textual_ques_in_course=count($ques_text_id_Array);
        
        //question_id_array gives all question created in the quizes. It has no concern with the attempt
        
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
          $r6=mysqli_query($con,"select DISTINCT(questionid) from mdl_question_attempts where id=$question_attempt_id_array[$q3] AND responsesummary=rightanswer");
            
          while($row=mysqli_fetch_array($r6))
          {
              $attempted_questions_using_attempt_id[$q4]=$row['questionid'];
              
              $q4=$q4+1;
          }
        }
        
        $len_attempted_questions_using_attempt_id=count($attempted_questions_using_attempt_id);
        
        for($q5=0;$q5<$len_attempted_questions_using_attempt_id;$q5++)
        {
            $r7=mysqli_query($con,"select id from mdl_question where id=$attempted_questions_using_attempt_id[$q5] AND qtype!='ddimageortext'");
            
            while($row=mysqli_fetch_array($r7))
          {
              $intermediate_refined_ques_text[$q6]=$row['id'];
              
              $q6=$q6+1;
          }
            
        }
        $len_intermediate_refined_ques_text=count($intermediate_refined_ques_text);
        
        for($q7=0;$q7<$len_intermediate_refined_ques_text;$q7++)
        {
            if(in_array($intermediate_refined_ques_text[$q7],$questions_in_attempted_quizes))
            {
             $correctly_answered_textual_ques[$p_s_q]=$intermediate_refined_ques_text[$q7];
             $p_s_q=$p_s_q+1;
            }
        }
        
        //$correctly_answered_textual_ques gives all the attempted question. It is refined form
        
        $total_correctly_answered_textual_ques=count($correctly_answered_textual_ques);
        
        echo "<br>";
        echo "total_correctly_answered_textual_ques: $total_correctly_answered_textual_ques";
        echo "<br>";
    //---------------------------------
    //q4 etc should be inside the loop
    //---------------------------------
        echo "total_textual_ques_in_course: $total_textual_ques_in_course";
        echo "<br>";
        
        $s_q=$total_correctly_answered_textual_ques/$total_textual_ques_in_course;

        $percentage=$s_q*100;
        
        echo "percentage is $percentage";
        echo "<br>";
        
        $user_id_array[$h]=$users[$i];

        if($percentage>=75)
        {
            $hint_value_ques_text[$h]=3;
            $h=$h+1;
        }

        else if ($percentage>=50 AND $percentage<75)
        {
            $hint_value_ques_text[$h]=2; 
            $h=$h+1;
        }
        
        else if ($percentage>0 AND $percentage<50)
        {
            $hint_value_ques_text[$h]=1;
            $h=$h+1;
        }
        
        
        else if ($percentage==0)
        {
            $hint_value_ques_text[$h]=0;
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
            
            echo "$hint_value_ques_text[$n]";
            
            echo "<br>";
            
            $n=$n+1;
        }
        
        $n=$spliter[$m];
    }
    
  



?>