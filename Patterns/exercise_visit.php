<?php
$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");

$result= mysqli_query($con,"SELECT userid FROM mdl_log WHERE module='lesson' AND action='view'");

$myArray = [];
$useridArray = [];
$counterArray = [];
$fetch_user_firstname=[];
$fetch_user_lastname=[];
$fetch_user_idnumber=[];
$x=0;
$k=0;

while($row = mysqli_fetch_array($result))
{
  $myArray[$x]=$row['userid'];
  $x=$x+1;
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
echo "User ID: Exercise Visits:";
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