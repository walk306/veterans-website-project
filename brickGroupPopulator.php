<?php
	//include "searchVar.php";

 	$servername = "localhost";
 	$dbname = "manchester_veterans_memorial_database";
 	$uname = "root";
 	$psword = "";
 	//$p = "";
  	$ageFromDB = $firstNameFromDB = $lastNameFromDB = "";

	$table = (isset($_REQUEST['table']) ? $_REQUEST['table'] : null);
	


	if($table !== null)
	{
		try {
			
			$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety

			$stmt = null;
			//$table .= '%';
			if($table === "a"){
			$stmt = $conn->prepare("SELECT brickNum, firstName, lastName FROM a_brick_group");
			}
			else if($table === "b"){
				$stmt = $conn->prepare("SELECT brickNum, firstName, lastName FROM b_brick_group");
			}
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();

			if($result)
			{
				echo json_encode($result);
			
			}
				

		}
		catch(PDOException $e) {
			
			echo "Error: " . $e->getMessage();
		}
	}

	$conn = null;
?> 