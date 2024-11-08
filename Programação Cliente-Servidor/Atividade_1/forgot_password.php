<?php
require_once 'User.php';

if (isset($_POST['reset'])) {
    $user = new User();
    $token = $user->createToken($_POST['email']);
    // Aqui você enviaria o link com o token por email, mas vamos simular
    echo "Link de recuperação: <a href='reset_password.php?token=$token'>Clique aqui para redefinir sua senha</a>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Recuperação de Senha</h2>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Digite seu email" required>
            <button type="submit" name="reset">Enviar link de recuperação</button>
        </form>
    </div>
</body>
</html>