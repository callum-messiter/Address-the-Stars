<?php

ini_set('max_execution_time', 100000);

require 'functions.php';

// Pull all words from the words table
$wordsSql = "SELECT * FROM words";
$wordsRes = mysqli_query($db, $wordsSql)or die(mysqli_error($db));

// Create an array of words from which we will create our three-word combinations
$words = array(); 

// Loop through the words table and add each word to the array
while($row = mysqli_fetch_array($wordsRes)){
    $words[] = $row['word'];
}

// Set max and min parameters for random_int ()
$max = count($words) - 1;
$min = $max - $max;

// Pull all stars from database
$starsSql = "SELECT * FROM stars";
$starsRes = mysqli_query($db, $starsSql)or die(mysqli_error());

// Create an array of assigned triplets to avoid repeating combinations
$used = [];

while($row = mysqli_fetch_array($starsRes)){
     
     // Store the star name and star_id in variables
     $id  = $row['StarID'];
     
     // *Generate unique three-word combination
     do{  
          // Generate first word
          $word1 = random_int($min ,$max);
          // Generate second word. If $word1 = $word2, generate second word again
          do {$word2 = random_int($min , $max);
          } while ($word2 == $word1);  
          // Generate third word. If $word3 = $word2 or $word1, generate third word again
          do {$word3 = random_int($min ,$max);
          } while ($word3 == $word2 || $word1 == $word3);  
          // If all three words are different, create the three-word combination
          $triplet = $words[$word1]. "." .$words[$word2]. "." .$words[$word3];
     // *If the combination has already been created, start the loop again
     } while(isset($used[$triplet])); 
    
     // If the new three-word combination hasn't already been created, add it to the array of assigned triplets
     $used[$triplet] = true;
     
     // Add the generated triplet to the star's row in the table
     # $w3w = "UPDATE stars SET w3w = '$triplet' WHERE StarID = '$id'";
     # $w3w_res = mysqli_query($db, $w3w)or die(mysqli_error($db));
     # echo $id.'&nbsp;added.<br/>'; 
}    

?>