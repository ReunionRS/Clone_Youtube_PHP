<?php
if (isset($_POST['watch_video'])) {
    $id = $_POST['video_id'];
    $_SESSION['video_id'] = $id;
    header('location: watch.php');
}
