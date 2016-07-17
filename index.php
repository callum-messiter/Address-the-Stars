<?php

// Initiate connection to the database...
$db = mysqli_connect('localhost', 'root', '', 'stellar');

// Query database of words
$words_sql = "SELECT * FROM words";
$words_res = mysqli_query($db, $words_sql)or die(mysqli_error());

// Create array of words
$array  = array();

// Loop through each word from the database and add each to the array
while($row = mysqli_fetch_array($words_res)){
    $array[] = $row['word'];
}
 
// Create array of all possible two-word combinations, from which we will randomly select our combinations 
$pairs = array();
foreach ($array as $word1) {
    foreach ($array as $word2) {
        if ($word1 !== $word2) {
            $pairs[] = "$word1.$word2";
        }
    }
}

// Pull all stars from database
$stars_sql = "SELECT * FROM stars";
$stars_res = mysqli_query($db, $stars_sql)or die(mysqli_error());

// Loop through every star in the array
while($row = mysqli_fetch_array($stars_res)){
    // Store the star name in a variable
    $star    = $row['star_name'];
    $star_id = $row['star_id'];

    // Set $pair as random combination from $pairs...
    $ran_num = array_rand($pairs);
    $pair    = $pairs[$ran_num];

    // ...and remove it, in order to prevent repating combinations
    array_splice($pairs, $ran_num, 1);

    // Set variables 
    $word        = 'star';
    $three_words = "$word.$pair";

    // Add unique three-word combination to star's row in the datbase
    $add_sql = "INSERT INTO stars (three_words) 
                VALUES '$three_words' 
                WHERE 'star_id' = '$star_id' "; 
    $add_res = mysqli_query($db, $add_sql);                    

    // Attach the random 3-word combination to the star 
    echo $star.'&nbsp;&nbsp;&nbsp;&nbsp;'.$three_words.'<br/><br/>';
}

?>