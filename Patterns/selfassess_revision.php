<?php

$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");

/*$k=0;
$quiz_id=[];
$forum_discussion_idArray=[];
$userid_quiz_array=[];
$useridArray = [];
$s=0;
$p=0;
$q=0;

//------------------------------------------------------------------------------------------
//Query with Course ID
//$f_id= mysqli_query($con,"SELECT id FROM mdl_forum WHERE course=$CourseID AND (name='Forum Content' OR name='Forum Assignment')");
//------------------------------------------------------------------------------------------

$f_id= mysqli_query($con,"SELECT id FROM mdl_quiz WHERE course='2'");
while($r1=mysqli_fetch_array($f_id))
{
  $quiz_id[$q]=$r1['id'];
  $q=$q+1;
}
$len_quiz_id=count($quiz_id);
for($q=0;$q<$len_quiz_id;$q++)
{
    $f_d_id= mysqli_query($con,"SELECT userid FROM mdl_quiz_attempts WHERE quiz=$quiz_id[$q]");
    while($r2 = mysqli_fetch_array($f_d_id))
    {
        $userid_quiz_array[$s]=$r2['userid'];
        $s=$s+1;
    }
}

//------------------------------------------------------------------------------------------
$arrlength=count($userid_quiz_array);
echo "length of array is $arrlength<br>";

for($i=0;$i<$arrlength;$i++)
  {
  echo $userid_quiz_array[$i];
  echo "<br>";
  }

for($i=0;$i<$arrlength;$i++)
{   
    $check_existing_userid=0;
    $useridArraylength=count($useridArray);
    if($useridArraylength!=0)
    {
       for($s=0;$s<$useridArraylength;$s++) 
       {
           if($userid_quiz_array[$i]==$useridArray[$s])
           {
               $check_existing_userid=$check_existing_userid+1;
           }
       }
    }
    if($check_existing_userid==0)
    {
    $counter=1;
    for($j=$i+1;$j<$arrlength;$j++)
    {
        if($userid_quiz_array[$i]==$userid_quiz_array[$j])
        {
            
            $counter=$counter+1;
        }
    }
    $useridArray[$k]=$userid_quiz_array[$i];
    $counterArray[$k]=$counter;
    $k=$k+1;
    }  
}

$finalArraylength=count($useridArray);
echo "User ID: Self assessment revision:";
for($d=0;$d<$finalArraylength;$d++)
{
    echo "<br>";  
echo "$useridArray[$d] $counterArray[$d]"; 
}
for($u=0;$u<$finalArraylength;$u++)
{
    $result2=mysqli_query($con,"SELECT firstname,lastname,idnumber FROM mdl_user WHERE id='$useridArray[$u]'");
    while($row = mysqli_fetch_array($result2))
    {
    $fetch_user_firstname[$u]=$row['firstname'];
    $fetch_user_lastname[$u]=$row['lastname'];
    $fetch_user_idnumber[$u]=$row['idnumber'];
    }
}
$len_ud_array=count($fetch_user_firstname);
echo "<br>"; 
echo "firstname lastname idnumber:";
echo "<br>"; 
for($ud=0;$ud<$len_ud_array;$ud++)
{
    echo $fetch_user_firstname[$ud];
    echo $fetch_user_lastname[$ud];
    echo $fetch_user_idnumber[$ud];
    echo "<br>"; 
} */
$q=0;

$quiz=[];

$r1=mysqli_query($con,"select MAX(attempt) as max_attempt from mdl_quiz_attempts");

while($row=mysqli_fetch_array($r1))
    
{
    $quiz[$q]=$row['max_attempt'];
    $q=$q+1;
}



?>
