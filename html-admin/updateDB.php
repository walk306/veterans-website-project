<?php
	//include "searchVar.php";
	//TODO information coming over; update database now

 	$servername = "localhost";
 	$dbname = "manchester_veterans_memorial_database";
 	$uname = "phpmyadmin";
 	$psword = "Y4VnqfDCz2vvMkv";
 	//$p = "";
  	//$firstNameFromDB = $lastNameFromDB = "";

	$groupName = (isset($_REQUEST['groupName']) ? $_REQUEST['groupName'] : null);
	$brickID = (isset($_REQUEST['brickID']) ? $_REQUEST['brickID'] : null);
	$firstName = (isset($_REQUEST['firstName']) ? $_REQUEST['firstName'] : null);
	$lastName = (isset($_REQUEST['lastName']) ? $_REQUEST['lastName'] : null);
	$brickDescription = (isset($_REQUEST['brickDescription']) ? $_REQUEST['brickDescription'] : null);

	//$brickNumber = intval($brickNumber);


	if($groupName !== null)
	{
		try {
			$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
		 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety

			$stmt = null;
		  //$input .= '%'; //+=
			// switch($groupName)
			// {
			// 	case "a":
			$test = $conn->prepare("SELECT brickID FROM allNames where brickID = ?");
			$test->bindParam(1, $brickID, PDO::PARAM_STR, 4);
			$test->execute();
			$testResult = $test->setFetchMode(PDO::FETCH_ASSOC);
			$testResult = $test->fetchAll();

			if($testResult){
				$stmt = $conn->prepare("UPDATE allNames SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				$stmt->bindParam(4, $brickID, PDO::PARAM_INT, 3);
				$stmt->execute();
			}
			else{
				$stmt = $conn->prepare("INSERT INTO allNames (brickID, firstName, lastName, brickDescription) VALUES (?, ?, ?, ?)");
				$stmt->bindParam(1, $brickID, PDO::PARAM_INT, 3);
				$stmt->bindParam(2, $firstName, PDO::PARAM_INT, 50);
				$stmt->bindParam(3, $lastName, PDO::PARAM_INT, 50);
				$stmt->bindParam(4, $brickDescription, PDO::PARAM_INT, 255);
				$stmt->execute();
			}
				// break;
				// case "b":
				// 	$stmt = $conn->prepare("UPDATE b_brick_group SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				// 	$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				// 	$stmt->bindParam(4, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
				// case "c":
				// 	$stmt = $conn->prepare("UPDATE c_brick_group SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				// 	$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				// 	$stmt->bindParam(4, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
				// case "d":
				// 	$stmt = $conn->prepare("UPDATE d_brick_group SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				// 	$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				// 	$stmt->bindParam(4, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
				// case "e":
				// 	$stmt = $conn->prepare("UPDATE e_brick_group SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				// 	$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				// 	$stmt->bindParam(4, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
				// case "f":
				// 	$stmt = $conn->prepare("UPDATE f_brick_group SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				// 	$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				// 	$stmt->bindParam(4, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
				// case "g":
				// 	$stmt = $conn->prepare("UPDATE g_brick_group SET firstName = ?, lastName = ?, brickDescription = ? WHERE brickID = ?");
				// 	$stmt->bindParam(1, $firstName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(2, $lastName, PDO::PARAM_INT, 50);
				// 	$stmt->bindParam(3, $brickDescription, PDO::PARAM_INT, 255);
				// 	$stmt->bindParam(4, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
		
				// case "a":
				// 	$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription FROM a_brick_group WHERE brickNum = ?");
				//   $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				//   $stmt->execute();
				//   break;

		    	// case "b":
				// 	$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription FROM b_brick_group WHERE brickNum = ?");
				//   $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				//   $stmt->execute();
				//   break;

				// case "c":
				// 		$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription	FROM c_brick_group WHERE brickNum = ?");
				// 	$stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				// 	$stmt->execute();
				// 	break;
				// case "d":
				// 	$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription	FROM d_brick_group WHERE brickNum = ?");
				// $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				// $stmt->execute();
				// break;
				// case "e":
				// 	$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription	FROM e_brick_group WHERE brickNum = ?");
				// $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				// $stmt->execute();
				// break;
				// case "f":
				// 	$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription	FROM f_brick_group WHERE brickNum = ?");
				// $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				// $stmt->execute();
				// break;
				// case "g":
				// 	$stmt = $conn->prepare("SELECT firstName, lastName, brickDescription	FROM g_brick_group WHERE brickNum = ?");
				// $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				// $stmt->execute();
				// break;
			// }

			// $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			// $result = $stmt->fetchAll();

			// if($result)
			// {
			// 	foreach($result as $assocArray)
			// 	{
			// 		echo $assocArray["firstName"] . "^" . $assocArray["lastName"] . "^" . $assocArray["brickDescription"];
			// 	}
			// }

			echo $groupName;
		}
		catch(PDOException $e) {
		  echo "Error: " . $e->getMessage();
		}
	}
	$conn = null;
?> 