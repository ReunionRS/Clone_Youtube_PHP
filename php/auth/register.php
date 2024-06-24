<?php
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "*Имя пользователя обязательно");
    }
    if (empty($email)) {
        array_push($errors, "*Email обязателен");
    }
    if (empty($password_1)) {
        array_push($errors, "*Пароль обязателен");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "*Пароли не совпадают");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "*Такое имя пользователя уже существует");
        }

        if ($user['email'] === $email) {
            array_push($errors, "*Такой Email уже существует");
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        header('location: index.php');
    }
}
