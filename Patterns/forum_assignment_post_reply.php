<?php

$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");

$k=0;
$forum_idArray=[];
$forum_discussion_idArray=[];
$forum_post_idArray=[];
$useridArray = [];
$s=0;
$p=0;

//------------------------------------------------------------------------------------------
//Query with Course ID
//$f_id= mysqli_query($con,"SELECT id FROM mdl_forum WHERE course=$CourseID AND (name='Forum Content' OR name='Forum Assignment')");
//------------------------------------------------------------------------------------------

$f_id= mysqli_query($con,"SELECT id FROM mdl_forum WHERE name='Forum Assignment'");
while($r1=mysqli_fetch_array($f_id))
{
  $forum_id=$r1['id']; 
}

$f_d_id= mysqli_query($con,"SELECT id FROM mdl_forum_discussions WHERE forum=$forum_id");
   
while($r2 = mysqli_fetch_array($f_d_id))
{
  $forum_discussion_idArray[$s]=$r2['id'];
  $s=$s+1;
}
$len_forum_discussion_idArray=count($forum_discussion_idArray);

for($i=0;$i<$len_forum_discussion_idArray;$i++)
{  
    $f_p_id= mysqli_query($con,"SELECT userid FROM mdl_forum_posts WHERE discussion=$forum_discussion_idArray[$i] AND parent=!0 ");
    
    while($r3 = mysqli_fetch_array($f_p_id))
    {
    $forum_post_idArray[$p]=$r3['userid'];
    $p=$p+1;
    }
}

//------------------------------------------------------------------------------------------

$arrlength=count($forum_post_idArray);
echo "length of array is $arrlength<br>";

for($i=0;$i<$arrlength;$i++)
  {
  echo $forum_post_idArray[$i];
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
           if($forum_post_idArray[$i]==$useridArray[$s])
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
        if($forum_post_idArray[$i]==$forum_post_idArray[$j])
        {
            
            $counter=$counter+1;
        }
    }
    $useridArray[$k]=$forum_post_idArray[$i];
    $counterArray[$k]=$counter;
    $k=$k+1;
    }  
}

$finalArraylength=count($useridArray);
echo "User ID: Forum Content Posts:";
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
}





?>
