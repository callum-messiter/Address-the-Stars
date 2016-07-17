<?php

include "db_connect.php";
// Pull all stars from database
$stars_sql = "SELECT * FROM stars";
$stars_res = mysqli_query($db, $stars_sql)or die(mysqli_error());
// Loop through every star in the array
while($row = mysqli_fetch_array($stars_res)){
    // Store the star name in a variable
    $star = $row['star_name'];
    // Create a random 3-word combination
	include "combo_generator.php"; 
    // Attach the random 3-word combination to the star 
    echo $star.'&nbsp;&nbsp;&nbsp;&nbsp;'.$three_words.'<br/><br/>';
}

?>