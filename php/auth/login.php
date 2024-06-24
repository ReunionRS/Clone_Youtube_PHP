<?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "*Имя пользователя обязательно");
    }
    if (empty($password)) {
        array_push($errors, "*Пароль обязателен");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header('location: index.php');
        } else {
            array_push($errors, "*Неправильное имя пользователя/пароль");
        }
    }
}
