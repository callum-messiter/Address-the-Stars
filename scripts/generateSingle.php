<?php

require 'functions.php';

$db = new mysqli("localhost", "root", "", "stellar");

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

// Generate first word
$word1 = random_int($min ,$max);

// Generate second word. If $word1 = $word2, generate second word again
do {$word2 = random_int($min , $max);
} while ($word2 == $word1);  

// Generate third word. If $word3 = $word2 or $word1, generate third word again
do {$word3 = random_int($min ,$max);
} while ($word3 == $word2 || $word1 == $word3);  

// If all three words are different, create the three-word combination
$triplet = $words[$word1].".".$words[$word2].".".$words[$word3];

echo $triplet;

?>