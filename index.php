<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error){
    return !empty($error) ? "<p class = 'error-message'>$error</p>" : '';

}

function isActiveForm($formName, $activeForm){
    return $formName === $activeForm ? 'active' : '';
}



?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name = "viewport" content="width=device-width, initial-scale=1.0">
        <title> Page de Connexion & Inscription en Full-Stack pour les Utilisateurs et les Admins</title>
        <link rel ="stylesheet" href="style.css">
    </head>
    <body>

        <div class="container"> 
            <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
                <form action="login_register.php" method="post">
                    <h2>Connexion</h2>
                    <?= showError($errors['login']); ?>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="motdepasse" placeholder="Mot de passe" required>
                    <button type="submit" name="login">Se connecter</button>
                    <p>Tu n'as pas de compte? <a href="#" onclick="showForm('register-form')">Crée un compte</a></p>
                </form>
            </div>
           
            <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
                <form action="login_register.php" method="post">
                    <h2>Création de compte</h2>
                    <?= showError($errors['register']); ?>
                    <input type="name" name="name" placeholder="Nom d'utilisateur" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="motdepasse" placeholder="Mot de passe" required>
                    <select name="role" required>
                        <option value="choose">-- Choisir un role --</option>
                        <option value="user">Utilisateur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                    <button type="submit" name="register">Crée un compte</button>
                    <p>Déjà un compte? <a href="#" onclick="showForm('login-form')">Se connecter</a></p>
                </form>
            </div>
        </div>
        <script src="script.js"></script>
    </body>

</html>