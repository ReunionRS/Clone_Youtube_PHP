<?php
session_start();

$username = "";
$email = "";
$errors = array();
$comment = "";

include 'review/add_comment.php';

include 'auth/logout.php';

include 'auth/login.php';

include 'auth/register.php';

include 'video/upload_video.php';

include 'video/watch_video.php';

include 'review/like.php';

include 'review/dislike.php';

include 'admin/change_restriction.php';

$_SESSION['errors'] = $errors;
