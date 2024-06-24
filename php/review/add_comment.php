<?php
if (isset($_POST['add_comment'])) {
    $username = mysqli_real_escape_string($db, $_SESSION['username']);
    $comment = mysqli_real_escape_string($db, $_POST['comment']);
    $id =  mysqli_real_escape_string($db, $_SESSION['video_id']);
    $query = "INSERT INTO comments (comm, video_id, user) 
  			  VALUES('$comment', '$id', '$username')";
    mysqli_query($db, $query);
    header('location: watch.php');
}
