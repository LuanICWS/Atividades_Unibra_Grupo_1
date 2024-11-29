<?php
require_once 'User.php';

if (isset($_POST['register'])) {
    $user = new User();

    // Verifica se as senhas são iguais 
    if ($_POST['password'] !== $_POST['comfirm_password']) {
        $error = "As senhas não correspondem.";
    } else {
        // Chama o método register, passando as variáveis do formulário
        $response = $user->register(
            $_POST['nome'],
            $_POST['email'],
            $_POST['password'],
            $_POST['telefone'],
            $_POST['cpf'],
            $_POST['data_nascimento'],
            $_POST['sexo']
        );

        if ($response === true) {
            header("Location: index.php?registered=success");
            exit;
        } else {
            $error = $response; 
        }
    }
}
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="login-container">
        <h2>Cadastro</h2>
        <form method="post" action="">

            <!--Nome-->
            <div class="input-container">
                <i class="fa-regular fa-user"></i>
                <input type="text" id="nome" name="nome" placeholder="Nome" required="required">
            </div>

            <!--email-->
            <div class="input-container">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" required="required">
            </div>

            <!--senha-->
            <div class="input-container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Senha" required="required">
            </div>

            <!--Comfirmação de senha-->
            <div class="input-container">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="comfirm_password" name="comfirm_password" placeholder="Confirme Senha" required="required">
            </div>

            <!--telefone-->
            <div class="input-container">
                <i class="fa-solid fa-phone"></i>
                <input type="text" id="telefone" name="telefone" placeholder="Telefone" required="required">
            </div>

            <!--cpf-->
            <div class="input-container">
                <i class="fa-solid fa-id-card"></i>
                <input type="text" id="cpf" name="cpf" placeholder="CPF" required="required">
            </div>

            <!--data-->
            <div class="input-container">
                <i class="fa-solid fa-calendar"></i>
                <input type="date" id="data_nascimento" name="data_nascimento" required="required">
            </div>

            <!--radios-->
            <div class="radio-group">

                <i class="fa-solid fa-user"></i>
                <span>Sexo:</span>

                <input type="radio" id="masc" name="sexo" value="M" required="required">
                <label for="masc">Masculino</label>

                <input type="radio" id="fem" name="sexo" value="F" required="required">
                <label for="fem">Feminino</label>

                <input type="radio" id="Outro" name="sexo" value="Outro">
                <label for="Outro">Outros</label>

            </div>

            <!--checkboxes-->
            <div class="checkbox-group">
                <input type="checkbox" id="autoriza" required="required">
                <label for="autoriza">Autoriza o uso de dados pela ferramenta de acordo com a LGPD</label>
                <br>
                <input type="checkbox" id="confirma">
                <label for="confirma">Confirma o envio de promoções por email</label>
            </div>

            <!--botão-->
            <button type="submit" name="register">Cadastrar</button>    
            <a href="index.php">Já tem uma conta? Faça login</a>
        </form>

        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    </div>
</body>
</html>