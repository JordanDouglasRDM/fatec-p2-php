<?php
session_start();
if (isset($_SESSION['user_id']) || $_SESSION['status'] == 'ativo') {
    require_once 'repository.php';
    $dataUser = getUserById($_SESSION['user_id']);
    if ($dataUser['foto_perfil'] !== null) {
        $foto_perfil_base64 = base64_encode($dataUser['foto_perfil']);
        $avatar = 'data:image/jpeg;base64,' . $foto_perfil_base64;
    } else {
        $avatar = 'img/avatar.jpg';
    }
    ?>
    <link rel="stylesheet" href="css/style-navbar.css">
    <script src="js/script-navbar.js"></script>
    <nav class="navbar navbar-expand-lg <!--navbar-dark bg-dark--> nav">
        <a class="navbar-brand nav-title" href="home.php">Gerenciador de Listas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link item-link" style="width: 100px" href=""></a>
                <a class="nav-item nav-link item-link home" href="home.php">Home <span
                            class="sr-only">(current)</span></a>
                <a class="nav-item nav-link item-link" href="dash-listas.php">Anotações</a>
                <a class="nav-item nav-link item-link" href="dash-compromissos.php">Compromissos</a>
                <?php if ($dataUser['nivel'] == 'admin'): ?>
                    <a class="nav-item nav-link item-link" href="dash-usuarios.php">Usuarios</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="container">
            <p class="my-name">Olá, <?= $dataUser['nome']; ?></p>
            <div class="avatar-container">
                <img src="<?= $avatar; ?>" alt="Avatar" class="rounded-circle" data-toggle="modal"
                     data-target="#visualizarPerfil">
            </div>
        </div>
        <form class="form-inline">
            <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0 button-exit" type="submit">Sair</a>
        </form>
    </nav>
    <div class="modal fade" id="visualizarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Meu Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="avatar-container-view">
                            <img src="<?= $avatar; ?>" alt="Avatar" class="rounded-circle">
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-signature"
                                                                                        style="color: #000000;"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nome" disabled
                               value="<?= $dataUser['nome']; ?>"
                        ><br>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-envelope" style="color: #000000;"></i>
                                    </span>
                        </div>
                        <input type="text" class="form-control" name="local" disabled
                               value="<?= $dataUser['email']; ?>"
                        ><br>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-key" style="color: #000000;"></i>
                                    </span>
                        </div>
                        <input type="password" class="form-control" name="data" disabled
                               value="**********"
                        ><br>
                    </div>
                    <br>
                    <button type="button" class="btn btn-warning open-edit-perfil">Editar Perfil</button>
                </div>
            </div>
        </div>
    </div>
    <!--    MODAL PARA EDITAR O PERFIL-->
    <div class="modal fade" id="editarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar meu perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="avatar-container-view">
                            <img src="<?= $avatar; ?>" alt="Avatar" class="rounded-circle">
                            <form id="excluirFotoPerfil" action="gerenciar-usuario.php" method="post">
                                <input type="hidden" name="opcao" value="excluirFotoPerfil">
                                <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can"
                                                                                style="color: #ffffff;"></i></button>
                            </form>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" id="editarUsuario" action="gerenciar-usuario.php" method="POST">
                        <br><br>
                        <div class="mb-3">
                            <label for="foto_perfil" class="form-label">Selecionar nova foto de perfil</label>
                            <input class="form-control" type="file" accept="image/*" id="foto_perfil"
                                   name="foto_perfil">
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-signature"
                                                                                        style="color: #000000;"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nome"
                                   value="<?= $dataUser['nome']; ?>"
                            ><br>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-envelope" style="color: #000000;"></i>
                                    </span>
                            </div>
                            <input type="email" class="form-control" name="email"
                                   value="<?= $dataUser['email']; ?>"
                            ><br>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-key" style="color: #000000;"></i>
                                    </span>
                            </div>
                            <input type="password" class="form-control" name="senha"
                                   placeholder="Repita sua senha ou digite uma nova"
                                   value="admin"
                            ><br>
                        </div>
                        <br>
                        <input type="hidden" name="opcao" value="editarPerfil">
                        <button type="submit" class="btn btn-success">Salvar alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    header('Location: index.php');
    exit();
}


?>