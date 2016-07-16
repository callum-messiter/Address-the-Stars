<?php

include "db_connect.php";
// Query database of words
$sql    = "SELECT * FROM words";
$res    = mysqli_query($db, $sql)or die(mysqli_error());
// Create array of words
$array  = array();
// Loop through each word and add each to the array
while($row = mysqli_fetch_array($res)){
     $array[] = $row['word'];
     // $arr_length = count($array);
}

// Set $word1 as random word from $array
$ran_num = array_rand($array);
$word1   = $array[$ran_num];

// Remove the chosen word from the array
array_splice($array, $ran_num, 1);

// Recount number of words in $array
// $arr_length = count($array);

// Reset the array
$array2 = $array;

// Set $word2 as random word from $array
$ran_num2 = array_rand($array2);
$word2    = $array2[$ran_num2];

// Set variables 
$word        = 'star';
$three_words = "$word.$word1.$word2";

// Echo the three-word combination in the form 'milky.$word1.$word2'
echo $three_words;
