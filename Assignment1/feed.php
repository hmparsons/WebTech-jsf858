<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>

   <?php
	  include('database.php');

	   session_start();
	   $conn = connect_db();
	   $username = $_SESSION["username"];
	   $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

      // User Information
	   $row = mysqli_fetch_assoc($result);
	   echo "<h1>Welcome back ".$row[name]."!</h1>";
	   echo "<img src='".$row['profile_pic']."'>";

      echo "<form action='posts.php' method='POST'>";
      echo "<p><textarea name='content'>What's on your mind?</textarea></p>";
      // $row needs to php inside of html
      echo "<input type='hidden' name='UID' value='$row[id]'>";
      echo "<p><input type='submit'></p>";
      echo "</form>";

      echo "<br>";

      $result_posts = mysqli_query($conn, "SELECT * FROM posts");
      $num_of_rows = mysqli_num_rows($result_posts);

      echo "<h2>My Feed</h2>";
      if($num_of_rows){
         for($i =0; $i < $num_of_rows; $i++){
            $row = mysqli_fetch_row($result_posts);
            echo "$row[2] said $row[4] ($row[5])";
            echo "<form action='likes.php' method='POST'>";
            echo "<input type='hidden' name='PID' value'$row[0]'>";
            echo " <input type='submit' value='Like'></form>";
            echo "<br>";
         }
      }else{
         echo "Nothing to see here!";
      }

   ?>

</body>
</html>