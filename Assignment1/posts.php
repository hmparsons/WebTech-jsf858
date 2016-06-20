<?php

   session_start();

   include('database.php');
   include('functions.php');

   $content = sanitizeString($_POST['content']);
   $UID = sanitizeString($_POST['UID']);

   // Connect DB
   $conn = connect_db();
   $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$UID'");
   $row = mysqli_fetch_assoc($result);

   // Fetch User Information
   $name = sanitizeString($row["name"]);
   $profile_pic = sanitizeString($row["profile_pic"]);

   $result_insert = mysqli_query($conn, "INSERT INTO posts(content, UID, name, profile_pic, likes) VALUES ('$content', $UID, '$name', '$profile_pic', 0)");

   if($result_insert){
      header('Location:feed.php');
   }else{
      echo "Oops! Something went wrong! Please try again!";
   }
?>