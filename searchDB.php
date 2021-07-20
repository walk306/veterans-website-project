<?php
	//include "searchVar.php";

 	$servername = "localhost";
 	$dbname = "manchester_veterans_memorial_database";
 	$uname = "root";
 	$psword = "";
 	//$p = "";
  	$ageFromDB = $firstNameFromDB = $lastNameFromDB = "";

	$groupName = (isset($_REQUEST['groupName']) ? $_REQUEST['groupName'] : null);
	$brickNumber = (isset($_REQUEST['brickNumber']) ? $_REQUEST['brickNumber'] : null);

	$brickNumber = intval($brickNumber);


	if($groupName !== null)
	{
		try {
		  $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety

			$stmt = null;
		  //$input .= '%'; //+=
			switch($groupName)
			{
				case "a":
					$stmt = $conn->prepare("SELECT firstname, lastname, age FROM atable WHERE brickNum = ?");
				  $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				  $stmt->execute();
				  break;

		    case "b":
					$stmt = $conn->prepare("SELECT firstname, lastname, age FROM btable WHERE brickNum = ?");
				  $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				  $stmt->execute();
				  break;

		    case "c":
					$stmt = $conn->prepare("SELECT firstname, lastname, age	FROM ctable WHERE brickNum = ?");
				  $stmt->bindParam(1, $brickNumber, PDO::PARAM_INT, 3);
				  $stmt->execute();
			    break;
			}

			 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			 $result = $stmt->fetchAll();
			 $maxShow = 0;

			 if($result)
			 {
			   echo "<br/>";

			   foreach($result as $assocArray)
			   {
				   //$assocArray = $result[0];
				   //echo "<br/>";
				   echo $assocArray["firstname"] . " " . $assocArray["lastname"] . " " . $assocArray["age"] . " Years Old";
				   echo "<br/>";
				   //echo $assocArray["lastname"];
				   //echo "<br/";
				   //echo $assocArray["age"];
				   //echo "<br/";

				   $maxShow++;

				   if($maxShow > 2)
				   {
				     break;
				   }
			   }
			   echo "<br/>";
			 }


		}
		catch(PDOException $e) {
		  echo "Error: " . $e->getMessage();
		}
	}
	$conn = null;
?> 