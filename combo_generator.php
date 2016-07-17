<?php

include "db_connect.php";
// Query database of words
$words_sql    = "SELECT * FROM words";
$words_res    = mysqli_query($db, $words_sql)or die(mysqli_error());
// Create array of words
$array  = array();
// Loop through each word and add each to the array
while($row = mysqli_fetch_array($words_res)){
     $array[] = $row['word'];
}
// Set $word1 as random word from $array
$ran_num = array_rand($array);
$word1   = $array[$ran_num];

// Remove the chosen word from the array
array_splice($array, $ran_num, 1);

// Reset the array
$array2 = $array;

// Set $word2 as random word from $array
$ran_num2 = array_rand($array2);
$word2    = $array2[$ran_num2];

// Set variables 
$word        = 'star';
$three_words = "$word.$word1.$word2";

?>