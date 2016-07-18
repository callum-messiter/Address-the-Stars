<?php

// Initiate connection to the database...
$db = mysqli_connect('localhost', 'root', '', 'stellar');

// Query database of words
$words_sql = "SELECT * FROM words";
$words_res = mysqli_query($db, $words_sql)or die(mysqli_error());

// Create array of words
$words  = array();

// Loop through each word from the database and add each to an array
while($row = mysqli_fetch_array($words_res)){
    $words[] = $row['word'];
}
 
// Create array of all possible three-word combinations, from which we will randomly select our combinations 
$triplets = array();
foreach ($words as $word1) {
    foreach ($words as $word2) {
        foreach($words as $word3) {
            if ($word1 !== $word2 && $word2 !== $word3 && $word1 !== $word3) {
                $triplets[] = "$word1.$word2.$word3";
            }
        }    
    }
}

// Pull all stars from database
$stars_sql = "SELECT * FROM stars";
$stars_res = mysqli_query($db, $stars_sql)or die(mysqli_error());

// Loop through every star in the array
while($row = mysqli_fetch_array($stars_res)){
    // Store the star name and star_id in variables
    $star    = $row['star_name'];
    $star_id = $row['star_id'];

    // Set $three_words as a random combination from the array of possible combinations...
    $ran_num     = array_rand($triplets);
    $three_words = $triplets[$ran_num];

    // ...and remove this particular combination, in order to prevent repating combinations
    array_splice($triplets, $ran_num, 1);
   
    // Attach the random 3-word combination to the star 
    echo $star.'&nbsp;&nbsp;&nbsp;&nbsp;'.$three_words.'<br/><br/>';
}

?>