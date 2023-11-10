<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require_once 'repository.php';
    $dataUser = getUserById($_SESSION['user_id']);
    echo '
<style>
    .meuNome {
        margin-right: 10%;
        color: white;
        margin-bottom: 3px;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Gerenciador de Listas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" style="width: 100px" href=""></a>
            <a class="nav-item nav-link active" href="home.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="dash-listas.php">Anotações</a>
            <a class="nav-item nav-link" href="dash-compromissos.php">Compromissos</a>
        </div>
    </div>
    <p class="meuNome">Olá, ' . $dataUser['nome'] . '</p>
    <form class="form-inline">
        <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Logout</a>
    </form>
</nav>

';
}
