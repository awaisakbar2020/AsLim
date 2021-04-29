<?php


$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");

//******************************************************************************************
//                              Discussion Forum
//******************************************************************************************

//forum_visit (Number of visits in the forum for each learner)
 
$result= mysqli_query($con,"SELECT userid FROM mdl_log WHERE module='forum' AND action='view forum' ORDER BY userid");

//forum_stay (Time each learner spent in the forum)

$result= mysqli_query($con,"SELECT userid, duration FROM mdl_log WHERE module='forum' ORDER BY userid");

//forum_post(Number of postings in a forum for each learner)

$f_id= mysqli_query($con,"SELECT mdl_forum.id FROM mdl_forum WHERE mdl_forum.course=$CourseID AND (mdl_forum.name='Forum Content' OR mdl_forum.name='Forum Assignment') ORDER BY id");

$f_d_id= mysqli_query($con,"SELECT mdl_forum_discussions.id FROM mdl_forum_discussions WHERE mdl_forum_discussions.forum=$f_id");

$f_p_id= mysqli_query($con,"SELECT mdl_forum_posts.userid, COUNT(mdl_forum_posts.userid) FROM mdl_forum_posts WHERE mdl_forum_posts.discussion=$f_d_id AND parent=0 ORDER BY userid");

//forum_post_reply(Number of replies to posts in a forum for each learner)

$f_p_r_id= mysqli_query($con,"SELECT mdl_forum_posts.userid, COUNT(mdl_forum_posts.userid) FROM mdl_forum_posts WHERE mdl_forum_posts.discussion=$f_d_id AND parent!=0 ORDER BY userid");

//selfass_visit(Number of performed self-assessment questions for each learner)
//(should it include the new quiz visit and old quiz attempts as well)

$result= mysqli_query($con,"SELECT userid, COUNT(id) FROM mdl_log WHERE module='quiz' AND action='view' GROUP BY userid");

//selfass_duration (Time learners spent on self-assessment tests)

$result= mysqli_query($con,"SELECT mdl_quiz_attempts.userid as userid, mdl_quiz_attempts.quiz, mdl_log.time FROM  mdl_quiz_attempts, mdl_quiz, mdl_log WHERE mdl_quiz_attempts.quiz = mdl_quiz.id and mdl_quiz.sumgrades=5 and mdl_quiz.grade=0 and (mdl_log.userid=mdl_quiz_attempts.userid and mdl_log.module='quiz' and mdl_log.action='attempt' and mdl_log.info=mdl_quiz_attempts.quiz and INSTR(mdl_log.url, CONCAT('attempt=',mdl_quiz_attempts.id))&gt;0) ORDER BY mdl_quiz_attempts.userid, mdl_quiz_attempts.quiz");

//exercise_visit (Number of performed exercises for each learner)
$result= mysqli_query($con,"SELECT mdl_log.userid as userid FROM mdl_log, mdl_quiz WHERE mdl_log.module='quiz' and (mdl_log.action='attempt' or mdl_log.action='submit') and mdl_log.info=q.id and mdl_quiz.grade=0 and mdl_quiz.checkanswers=1 ORDER BY mdl_log.userid");
    
//exercise_stay (Time learners spent on exercises)
$result= mysqli_query($con,"SELECT mdl_log.userid as userid, mdl_log.duration as duration FROM mdl_log, mdl_ls_quiz WHERE mdl_log.module='quiz' and (mdl_log.action='attempt' or mdl_log.action='submit') and mdl_log.info=mdl_quiz.id and mdl_quiz.grade=0 and mdl_quiz.checkanswers=1 ORDER BY mdl_log.userid");

//example_visit (Number of visited examples for each learner)
$result= mysqli_query($con,"SELECT mdl_log.id AS userid FROM mdl_log LEFT JOIN mdl_resource ON mdl_log.info = mdl_resource.id WHERE mdl_resource.type = 'example'");

//example_stay(Time learners spent on examples)
$result= mysqli_query($con,"SELECT mdl_log.userid, mdl_log.time FROM mdl_resource, mdl_log WHERE mdl_resource.id = mdl_log.info and mdl_resource.type='example' ORDER BY mdl_log.userid");







?>