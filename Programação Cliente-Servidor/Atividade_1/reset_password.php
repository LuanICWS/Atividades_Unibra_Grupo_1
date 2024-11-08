<?php
require_once 'User.php';

$user = new User();
$token = $_GET['token'] ?? null;
$error = '';
$success = '';

// Verifica se o formulário de redefinição foi enviado
if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        if ($user->resetPassword($token, $new_password)) {
            $success = "Senha redefinida com sucesso! <a href='index.php'>Clique aqui para fazer login</a>";
        } else {
            $error = "Token inválido ou expirado.";
        }
    } else {
        $error = "As senhas não correspondem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Redefinir Senha</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green;"><?php echo $success; ?></p>
        <?php else: ?>
            <form method="post" action="">
                <input type="password" name="new_password" placeholder="Nova Senha" required>
                <input type="password" name="confirm_password" placeholder="Confirmar Nova Senha" required>
                <button type="submit" name="reset_password">Redefinir Senha</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
