<?php
require_once 'User.php';

if (isset($_POST['register'])) {
    $user = new User();
    $response = $user->register($_POST['email'], $_POST['password']);

    if ($response === true) {
        header("Location: index.php?registered=success");
        exit;
    } else {
        $error = $response;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Cadastro</h2>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit" name="register">Cadastrar</button>
            <a href="index.php">Já tem uma conta? Faça login</a>
        </form>
        <?php if(isset($error)) echo "<p>$error</p>"; ?>
    </div>
</body>
</html>
