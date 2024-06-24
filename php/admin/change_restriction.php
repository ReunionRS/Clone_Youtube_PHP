<?php
if (isset($_POST['change_restriction'])) {
    if ($_SESSION['username'] == 'admin') {
        $restriction = mysqli_real_escape_string($db, $_POST['restriction_option']);
        $id_restriction = mysqli_real_escape_string($db, $_POST['restriction_id']);
        $sql = "UPDATE videos SET restriction='$restriction' WHERE id='$id_restriction'";
        mysqli_query($db, $sql);
    }
    header('location: studio.php');
}
