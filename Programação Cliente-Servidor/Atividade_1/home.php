<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="Home_PAG">

    <nav class="NavBar">
        <ul class="NavBar_List">
            <li><a class="Nav_Link" href="#Servicos">Automatização</a></li>
            <li><a class="Nav_Link" href="#Dominio">Domínio</a></li>
            <li><a class="Nav_Link" href="#DominioApp">Domínio+App</a></li>
            <li><a class="Nav_Link" href="index.php">Sair</a></li>
        </ul>
    </nav>



    <div class="Carrossel_Container">
        <div class="Carrossel">
            <img src="Assets/Slide_1.png" alt="Imagem_1" class="Carrossel_Item">
            <img src="Assets/Slide_2.png" alt="Imagem_2" class="Carrossel_Item">
            <img src="Assets/Slide_3.png" alt="Imagem_3" class="Carrossel_Item">
            <img src="Assets/Slide_4.png" alt="Imagem_4" class="Carrossel_Item">
        </div>

        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="next" onclick="moveSlide(1)">&#10095;</button>
    </div>

    <!-- Referência para o arquivo JS -->
    <script src="scripts.js"></script>

    <div class="Servicos">
        <div>
            <img src="Assets/Site_Servicos/Automacao.png" alt="Automatização">
            <h2>Automatização</h2>
            <section id="Servicos">
            </section>
        </div>

        <div>
            <img src="Assets/Site_Servicos/Dominio.png" alt="Domínio">
            <h2>Domínio</h2>
            <section id="Dominio">
            </section>

        </div>

        <div>
            <img src="Assets/Site_Servicos/Dominio_APP.png" alt="Domínio+App">
            <h2>Domínio+App</h2>
            <section id="DominioApp">
            </section>
        </div>
    </div>

</body>
</html>