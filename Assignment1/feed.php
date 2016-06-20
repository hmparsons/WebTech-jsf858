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
            echo "<input type='hidden' name='PID' value='$row[0]'>";
            echo "<input type='submit' value='Like'></form>";
            echo "Comments: <br>";
         
            $result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE PID='$row[0]'");
            $num_of_rows2 = mysqli_num_rows($result_comments);
         
            if($num_of_rows2){
               for($j =0; $j < $num_of_rows2; $j++){
                  $row2 = mysqli_fetch_row($result_comments);
                  echo "$row2[3] commented \"$row2[1]\".";
                  echo "<br>";
               }
            }else{
               echo "No comments yet";
               echo "<br>";
            }
            echo "<form action='comments.php' method='POST'>";
            echo "<textarea name='comment'>Comment here</textarea>";
            echo "<input type='hidden' name='PID' value='$row[0]'>";
            echo "<input type='hidden' name='username' value='$username'>";
            echo "<input type='submit' value='Comment'></form>";
            echo "<br>";
         }
      }else{
         echo "Nothing to see here!";
      }

   ?>

</body>
</html>