<?php
if(isset($_POST['like']) && isset($_SESSION['username'])){
    $username = mysqli_real_escape_string($db, $_SESSION['username']);
    $id = mysqli_real_escape_string($db, $_SESSION['video_id']);
    $query = "SELECT * FROM review WHERE video_id='$id' AND username='$username'";
    $res = mysqli_query($db, $query);
    if (mysqli_num_rows($res) > 0) {
        $query = "DELETE FROM review WHERE video_id='$id' AND username='$username'";
        $res = mysqli_query($db, $query);
    }

    $query = "INSERT INTO review (username, video_id, review) 
  			  VALUES('$username', '$id', true)";
    $res = mysqli_query($db, $query);
    header('location: watch.php');
}
