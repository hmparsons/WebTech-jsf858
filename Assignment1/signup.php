<?php
   include('functions.php');
	//start session
	session_start();

	//get username and password from $_POST
	$username = sanitizeString($_POST["username"]);
   //echo "Username: ".$username;
	$password = sanitizeString($_POST["password"]);
   $passhash = hash('sha256', $password);
   $name = sanitizeString($_POST["name"]);
   $email = sanitizeString($_POST["email"]);
   $dob = sanitizeString($_POST["dob"]);
   $gender = sanitizeString($_POST["gender"]);
   $question = sanitizeString($_POST["question"]);
   $answer = sanitizeString($_POST["answer"]);
   $locaiton = sanitizeString($_POST["location"]);
   $picture = sanitizeString($_POST["picture"]);


	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$sql = "INSERT INTO users (id, username, password, name, email, dob, gender,
      verification_question, verification_answer, location, profile_pic) VALUES
      (NULL,'$username','$passhash', '$name', '$email', '$dob', '$gender', '$question', '$answer',
         '$location', '$picture')";

   if (mysqli_query($conn, $sql)) {
      $_SESSION["username"] = $username;
      header("Location: feed.php");
   } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }

?>
