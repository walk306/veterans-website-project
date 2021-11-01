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
			$stmt = $conn->prepare("SELECT 'a' as source, brickNum, firstName, lastName FROM a_brick_group");
			}
			else if($table === "b"){
				$stmt = $conn->prepare("SELECT 'b' as source, brickNum, firstName, lastName FROM b_brick_group");
			}
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();

			if($result)
			{
				
				//foreach($result as $assocArray)
				for ($i = 0; $i < count($result); $i++) 
			   {
				   $tempString = $result[$i]["brickNum"]; //strlen($result[$i]["brickNum"]
				   for($j = strlen($result[$i]["brickNum"]); $j < 3; $j++){
					   $tempString = "0" . $tempString; 
				   }
				   $result[$i]["brickNum"] = $result[$i]["source"] . $tempString;
				}
				echo json_encode($result);
			}
		}
		catch(PDOException $e) {
			
			echo "Error: " . $e->getMessage();
		}
	}

	$conn = null;
?> 