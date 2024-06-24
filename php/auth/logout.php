<?php
if (isset($_POST['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['errors']);
    header('location: index.php');
}
