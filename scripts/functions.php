<?php
	
	// Connect to the database
	function connection() {
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$dbname   = "stellar";
		try {
			$db = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage() . PHP_EOL;
			die();
		}
		return $db;
	}

	function deleteWord($db, $word_id) {
		$stmt = $db->prepare("DELETE FROM 5000words WHERE id = :word_id");
		$stmt->bindParam(':word_id', $word_id);
		$stmt->execute();
	}

?>