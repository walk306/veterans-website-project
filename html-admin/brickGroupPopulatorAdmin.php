<?php
	//include "searchVar.php";

 	$servername = "localhost";
 	$dbname = "manchester_veterans_memorial_database";
 	$uname = "phpmyadmin";
 	$psword = "Y4VnqfDCz2vvMkv";
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
				$stmt = $conn->prepare("SELECT * FROM a_brick_group INNER JOIN allNames ON allNames.brickID = a_brick_group.brickID");
				// $stmt = $conn->prepare("SELECT 'a' as source, nameTableID, brickID, firstName, lastName FROM allNames");
			}
			else if($table === "b"){
				$stmt = $conn->prepare("SELECT * FROM b_brick_group INNER JOIN allNames ON allNames.brickID = b_brick_group.brickID");
			}
			else if($table === "c"){
				$stmt = $conn->prepare("SELECT * FROM c_brick_group INNER JOIN allNames ON allNames.brickID = c_brick_group.brickID");
			}
			else if($table === "d"){
				$stmt = $conn->prepare("SELECT * FROM d_brick_group INNER JOIN allNames ON allNames.brickID = d_brick_group.brickID");
			}
			else if($table === "e"){
				$stmt = $conn->prepare("SELECT * FROM e_brick_group INNER JOIN allNames ON allNames.brickID = e_brick_group.brickID");
			}
			else if($table === "f"){
				$stmt = $conn->prepare("SELECT * FROM f_brick_group INNER JOIN allNames ON allNames.brickID = f_brick_group.brickID");
			}
			else if($table === "g"){
				$stmt = $conn->prepare("SELECT * FROM g_brick_group INNER JOIN allNames ON allNames.brickID = g_brick_group.brickID");
			}
			$stmt->execute();

			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();

			if($result)
			{
				
				//foreach($result as $assocArray)
			// 	for ($i = 0; $i < count($result); $i++) 
			//    {
			// 	   $tempString = $result[$i]["allNames.brickID"]; //strlen($result[$i]["id"]
			// 	   for($j = strlen($result[$i]["allNames.brickID"]); $j < 3; $j++){
			// 		   $tempString = "0" . $tempString; 
			// 	   }
			// 	   $result[$i]["allNames.brickID"] = $result[$i]["source"] . $tempString;
			// 	}
				echo json_encode($result);
			}
		}
		catch(PDOException $e) {
			
			echo "Error: " . $e->getMessage();
		}
	}

	$conn = null;
?> 