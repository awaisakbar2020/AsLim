<?php

$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");


$s=0;
$p=0;
$myArray = [];
$useridArray = [];
$counterArray = [];
$fetch_user_firstname=[];
$fetch_user_lastname=[];
$fetch_user_idnumber=[];
$x=0;
$k=0;


//------------------------------------------------------------------------------------------
    //Filteration w.r.t to each course is needed i.e stay on each course outline
//------------------------------------------------------------------------------------------

$f_id= mysqli_query($con,"SELECT id FROM mdl_resource WHERE name='Outline'");
while($r1=mysqli_fetch_array($f_id))
{
  $resource_id=$r1['id']; 
}

$f_d_id= mysqli_query($con,"SELECT userid FROM mdl_log WHERE module='resource' AND action='view' AND info=$resource_id");
   
while($r2 = mysqli_fetch_array($f_d_id))
{
  $myArray[$s]=$r2['userid'];
  $s=$s+1;
}

$arrlength=count($myArray);
echo "length of array is $arrlength<br>";

for($i=0;$i<$arrlength;$i++)
  {
  echo $myArray[$i];
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
           if($myArray[$i]==$useridArray[$s])
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
        if($myArray[$i]==$myArray[$j])
        {
            
            $counter=$counter+1;
        }
    }
    $useridArray[$k]=$myArray[$i];
    $counterArray[$k]=$counter;
    $k=$k+1;
    }  
}

$finalArraylength=count($useridArray);
echo "User ID: Outline Visits:";
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