<?php
 	$servername = "localhost";
 	$dbname = "veterans_admin_logins";
 	$uname = "phpmyadmin";
 	$psword = "Y4VnqfDCz2vvMkv";
    $token = "supersecuresessiontoken";

    $adminUsername = (isset($_REQUEST['adminUsername']) ? $_REQUEST['adminUsername'] : null);
    $adminPassword = (isset($_REQUEST['adminPassword']) ? $_REQUEST['adminPassword'] : null);

	if(($adminUsername !== null) && ($adminPassword !== null))
	{
		try {
		    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $uname, $psword);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // For max SQL injection safety
            $stmt = null;

			$stmt = $conn->prepare("SELECT COUNT(*) FROM loginInfo WHERE usernames LIKE ? AND passwords LIKE ?");
			$stmt->bindParam(1, $adminUsername, PDO::PARAM_STR, 100);
			$stmt->bindParam(2, $adminPassword, PDO::PARAM_STR, 100);
			$stmt->execute();
			
			//TODO: Setup logic using result from COUNT(*) to determine if the given username 
			//and password has exactly one corresponding value in the database
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$result = $stmt->fetchAll();
			foreach($result as $assocArray){
				$tempString = $assocArray[0];
				echo $tempString;
				if($tempString == 1){
					// if($adminPassword == $adminCorrectPassword){
					//     echo $token;
					// 	$conn = null;
					// 	exit;
					// }
					// else{
					// 	echo "Incorrect username or password";
					// }
					echo $token;
					exit;
				}
				else{
					echo "Incorrect username or password.";
				}
			}
			
		}
		catch(PDOException $e) {
		  echo "Error: " . $e->getMessage();
		}
	}
	$conn = null;
?>