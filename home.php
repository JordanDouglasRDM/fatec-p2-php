<?php
require_once 'header.php';
require_once 'repository.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
    <link rel="stylesheet" href="css/style-home.css">
<div class="apresentacao">
    <h2>Bem vindo </h2>

    <p>
        Este projeto foi desenvolvido por Jordan Douglas, Matheus Couto, Julia Ferreti, Jessica Pelosi e Rafael Medeiros.
    </p>
    <p>
        Em um mundo onde 24 horas por dia parecem insuficientes para cumprirmos nossos afazeres, o gerenciamento eficiente do tempo é crucial para alcançar nossos objetivos, seja na esfera profissional, acadêmica ou pessoal.
        Com essa necessidade em mente, nossa equipe criou um pequeno sistema web dedicado ao gerenciamento de tarefas e compromissos,
        proporcionando uma abordagem prática e eficaz para otimizar o seu dia a dia.
    <p><br>
    <div class="botao-nav">
        <a href="dash-listas.php" role="button" class="button-name">Gerenciar Anotações</a>
        <a href="dash-compromissos.php" role="button" class="button-name">Gerenciar Compromissos</a>
    </div>
</div>

<?php require_once 'footer.php'; ?>