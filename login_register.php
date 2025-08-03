<?php

session_start();
require_once 'config.php';

if (isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $motdepasse = password_hash($_POST['motdepasse'], motdepasse_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0){
        $_SESSION['register_error'] = 'Cet email est déjà enregistré!';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users (name, email, motdepasse, role) VALUES ('$name', '$email', '$motdepasse', '$role')");
    }

    header("Location: index.php");
    exit();

}

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    $result = $conn -> query("SELECT * FROM users WHERE email = '$email'");
    if ($result -> num_rows > 0){
        $user = $result -> fetch_assoc();
        if (password_verify($motdepasse, $user['motdepasse'])){
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] === 'admin'){
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php ");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Mauvais email ou mot de passe.';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}

?>