<?php
     $db_user   = 'root';
     $db_pass   = '';
     $host_name = 'localhost';
     $db_name   = 'words';

     // Connection to the database
     $db = mysqli_connect($host_name, $db_user, $db_pass, $db_name);

     // Check that the connection is established.
     if(!$db){
          echo "Not connected.";
     }
     // }else{
     //     echo "Connected to $db_name;<br><br>";
     // }

     // Check that a database has been selected.
     if(!mysqli_select_db($db, $db_name)){
          echo "Database not selected.<br><br>";
     }
     // }else{
     //     echo "Database $db_name selected.<br><br>";
     // }

?>

