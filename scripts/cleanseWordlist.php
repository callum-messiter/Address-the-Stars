<?php

ini_set('max_execution_time', 1000);

// Initiate connection to the database...
$db = mysqli_connect('localhost', 'root', '', 'stellar');

// Pull all words from the datbase and order them alphabetically
$sql   = "SELECT * FROM words ORDER BY word";
$res   = mysqli_query($db, $sql)or die(mysqli_error($db));

// Create the array in which to store the words
$words = array();

// Pull all homophones from the database
$sql2 = "SELECT * FROM homophones";
$res2 = mysqli_query($db, $sql2);

// Loop through the homophones table and add each word to an array
while($row = mysqli_fetch_array($res2)){
    $homophones[] = $row['word'];
}

// Pull all offensive words from the database
$sql3 = "SELECT * FROM offensive";
$res3 = mysqli_query($db, $sql3);

// Loop through the offensive-words table and add each word to an array
while($row = mysqli_fetch_array($res3)){
    $offensive[] = $row['word'];
}

// Loop through the main words table 
while($row = mysqli_fetch_array($res)){
	 // Store the word and word_id in variables
	 $word    = $row['word'];
	 $word_id = $row['id'];

     // If the word has fewer than 4 or more than 7 characters, delete its row from database
     if(strlen($word) < 4 || strlen($word) > 7){
          echo $word.' is not the desired length.<br/>';
          $del     = "DELETE FROM words_big WHERE (id) = $word_id";
          $del_res = mysqli_query($db, $del)or die(mysqli_error($db));
          # echo 'Word&nbsp;'.$word_id.'&nbsp; deleted.<br/><br/>';
          continue;
     }
     
     // If the word is offensive or a homophone, delete its row from the database
     if(in_array($word, $homophones) || in_array($word, $offensive)){
          echo $word.' is a homophone/offensive word.<br/>';
          $del     = "DELETE FROM words_big WHERE (id) = $word_id";
          $del_res = mysqli_query($db, $del)or die(mysqli_error());
          # echo 'Word&nbsp;'.$word_id.'&nbsp;deleted.<br/><br/>';
          continue;
     }

     // If the word is a duplicate, delete its row from the database 
     if(in_array($word, $words)){
          echo $word.' already added to the array.<br/>';
          $del     = "DELETE FROM words_big WHERE (id) = $word_id";
          $del_res = mysqli_query($db, $del)or die(mysqli_error());
          # echo 'Word&nbsp;'.$word_id.'&nbsp;deleted.<br/><br/>';
          continue;  
     }

     // If the word is not comprised soley of lower-case alphabetical characters, delete its row from the database 
     if(!ctype_lower($word)){
          echo $word.' contains inappropriate character(s).<br/>';
          $del     = "DELETE FROM words_big WHERE (id) = $word_id";
          $del_res = mysqli_query($db, $del)or die(mysqli_error());
          # echo 'Word&nbsp;'.$word_id.'&nbsp;deleted.<br/><br/>';
          continue;
     }

     // If none of these conditions apply, add the new word to the array
     $words[] = $word;
     # echo '<p style="color: red">Word&nbsp;'.$word_id.'&nbsp;'.$word.'&nbsp;saved.<br/><br/></p>';
}  

?>