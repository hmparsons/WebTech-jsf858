<?php

   session_start();

   include('database.php');
   include('functions.php');

   $comment = sanitizeString($_POST['comment']);
   $PID = sanitizeString($_POST['PID']);
   $username = sanitizeString($_POST['username']);


   // Connect DB
   $conn = connect_db();
   $comresult = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
   $row2 = mysqli_fetch_assoc($comresult);

   // Fetch User Information
   $UID = sanitizeString($row2["id"]);
   $name = sanitizeString($row2["name"]);
   $profile_pic = sanitizeString($row2["profile_pic"]);

   $result_insert = mysqli_query($conn, "INSERT INTO comments(comment, UID, 
      name, profile_pic, PID) VALUES ('$comment', '$UID', '$name', '$profile_pic', 
         '$PID')");

   if($result_insert){
      header('Location:feed.php');
   }else{
      echo "Oops! Something went wrong! Please try again!";
   }

?>