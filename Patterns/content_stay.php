<?php
$con= new mysqli("localhost:3308","root","root123");
mysqli_select_db($con,"bitnami_moodle");

$result= mysqli_query($con,"SELECT id,userid,time FROM mdl_log WHERE module='resource' AND action='view'");

$myArray = [];
$idArray = [];
$timeArray = [];
$useridArray = [];
$Duration=[];
$user_id_for_duration=[];
$counterArray = [];
$fetch_user_firstname=[];
$fetch_user_lastname=[];
$fetch_user_idnumber=[];
$x=0;
$k=0;
$d=0;
while($row = mysqli_fetch_array($result))
{
  $useridArray[$k]=$row['userid'];
  $idArray[$k]=$row['id'];
  $timeArray[$k]=$row['time'];
  $k=$k+1;
}
$arrlength=count($useridArray);

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
echo "useridArray:";
echo "<br>";
for($i=0;$i<$arrlength;$i++)
  {
  echo $useridArray[$i];
  echo "<br>";
  }
echo "idArray:";
echo "<br>";
for($i=0;$i<$arrlength;$i++)
  {
  echo $idArray[$i];
  echo "<br>";
  }
echo "Time Array";
echo "<br>";
for($i=0;$i<$arrlength;$i++)
  {
  echo $timeArray[$i];
  echo "<br>";
  }

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

$d=0;
$u=0;

for($x=0;$x<$arrlength;$x++)
{
    
  $module='resource';
  $id=$idArray[$x]+1;
  $uid=$useridArray[$x];
  $time1=$timeArray[$x];
  while($module=='resource')
  {
      userids_not_equal_case:
      $result2=mysqli_query($con,"select module,userid,time,action from mdl_log where id='$id'");
      while($row = mysqli_fetch_array($result2))
      {
          $module=$row['module'];
          $time2=$row['time'];
          $user_id=$row['userid'];
          $action=$row['action'];
      }
          if($user_id==$uid)
          {
              if($module!='resource')
              {
                   $time_sub=$time2-$time1;
                   $Duration[$d]=$time_sub;
                   $user_id_for_duration[$d]=$uid;
                   $d=$d+1;
                   goto outside_while_loop;
              }
                                  
              else
              {
                 $id=$id+1; 
              }
          }
          else
          {
              $id=$id+1;
              goto userids_not_equal_case;
          }
  }
    outside_while_loop:
}

$len_duration=count($Duration);
echo "Duration array is:";
echo "<br>";
for($i=0;$i<$len_duration;$i++)
  {
  echo $Duration[$i];
  echo "<br>";
  }
echo "<br>";
echo "user id array is:";
echo "<br>";
for($i=0;$i<$len_duration;$i++)
  {
  echo $user_id_for_duration[$i];
  echo "<br>";
  }



//-----------------------------------------------------------------------------------------
//                                    Adding Duration w.r.t user id
//----------------------------------------------------------------------------------------

$totalDurationArray=[];
$final_useridArray=[];
$f=0;
for($i=0;$i<$len_duration;$i++)
{
    $u=$user_id_for_duration[$i];
    $total_duration=$Duration[$i];
    $check_existing_userid=0;
    $len_final_useridArray=count($final_useridArray);
    if($len_final_useridArray!=0)
    {
        
       for($s=0;$s<$len_final_useridArray;$s++) 
       {
           
           if($user_id_for_duration[$i]==$final_useridArray[$s])
           {
               $check_existing_userid=$check_existing_userid+1;
           }
       }
    }
    if($check_existing_userid==0)
    {
    
    for($j=$i+1;$j<$len_duration;$j++)
    {
        if($user_id_for_duration[$i]==$user_id_for_duration[$j])
        {
            $total_duration=$total_duration+$Duration[$j];
        }
           
    }  
     
    $final_useridArray[$f]=$user_id_for_duration[$i];
    $totalDurationArray[$f]=$total_duration;
    $f=$f+1;
        
    }  
}
$forum_stay=[];
$length=count($totalDurationArray);
for($f_s=0;$f_s<$length;$f_s++)
{ 
    $timestamp = $totalDurationArray[$f_s];
    $format = 'H:i:s';
    $res = date($format, $timestamp);
    $forum_stay[$f_s]=$res;
}
for($f_s=0;$f_s<$length;$f_s++)
{
    echo"<br>";
    echo "Content stay of user id $final_useridArray[$f_s] is: ";
        echo $forum_stay[$f_s];
    echo"<br>";
}

/*

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

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
echo "User ID: Forum Visits:";
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
*/
?>