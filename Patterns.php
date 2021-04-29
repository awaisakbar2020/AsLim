<?php


$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");


//selfass_visit(Number of performed self-assessment questions for each learner)

$result= mysqli_query($con,"SELECT userid count(userid)");

echo "result is $result";


$result= mysqli_query($con,"SELECT a.userid as userid FROM mdl_ls_quiz_questions q, mdl_ls_quiz_responses r, mdl_ls_quiz_question_grades qg, mdl_ls_quiz_attempts a WHERE r.question = q.id and a.id = r.attempt and qg.grade = 1 and q.qtype &lt; 11 ORDER BY a.userid, q.id");



?>