<?php
session_start();
if (isset($_SESSION['user_id'])) {
    require_once 'repository.php';
    $dataUser = getUserById($_SESSION['user_id']);
?>
<style>
    .my-name {
        margin-right: 10%;
        margin-bottom: 3px;
        color: #DDF2FD;
    }
    .nav {
        background-color: #164863;
        color: #DDF2FD;
    }
    .nav-title {
        color: #DDF2FD;
    }
    .nav-title:hover {
        color: orange;
    }
    .item-link {
        color: #DDF2FD;
        margin-right: 5vw;
    }
    .item-link:hover {
        color: orange;
    }

    .home {
        margin-left: -5vw;
    }
    .button-exit {
        margin-right: 3vw;
        padding: 0.5vh 2vw;
        background-color: red;
        color: white;
    }
    
</style>
    <nav class="navbar navbar-expand-lg <!--navbar-dark bg-dark--> nav">
        <a class="navbar-brand nav-title" href="home.php">Gerenciador de Listas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link item-link" style="width: 100px" href=""></a>
            <a class="nav-item nav-link active item-link home" href="home.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link item-link" href="dash-listas.php">Anotações</a>
            <a class="nav-item nav-link item-link" href="dash-compromissos.php">Compromissos</a>
        </div>
    </div>
    <p class="my-name">Olá, <?= $dataUser['nome']; ?></p>
    <form class="form-inline">
        <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0 button-exit" type="submit">Sair</a>
    </form>
</nav>
<?php } ?>