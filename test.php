<?Php

if(isset($_POST['submit']))
{
 if(!empty($_POST['check_list']) )
{
	// Loop to store and display values of individual checked checkbox.
	$s_c=0;
     
	foreach($_POST['check_list'] as $selected )
	{
		$selected_courses[$s_c]=$selected;
        $s_c=$s_c+1;
    }
}   
}
$total_selected_courses=count($selected_courses);
for($c=0;$c<$total_selected_courses;$c++)
{
    echo $selected_courses[$c];
}

 


?>