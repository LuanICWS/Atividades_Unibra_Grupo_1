<?php
session_start();
require_once 'User.php';

if (isset($_POST['login'])) {
    $user = new User();
    if ($user->login($_POST['email'], $_POST['password'])) {
        header("Location: home.php");
    } else {
        $error = "Credenciais inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" name="login">Entrar</button>
            <a href="forgot_password.php">Esqueceu a senha?</a>
            <a href="register.php">Criar uma conta</a> 
        </form>

        <?php if(isset($error)) echo "<p>$error</p>"; ?>
    </div>
</body>
</html>
