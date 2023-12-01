<?php
require_once 'header.php';

if ($_SESSION['autenticado'] == false || $_SESSION['nivel'] !== 'admin' || $_SESSION['status'] !== 'ativo') {
    echo '<meta http-equiv="refresh" content="0;url=home.php">';
    exit();
}
$data = getAllUsers();
?>
    <link rel="stylesheet" href="css/style-dash-usuarios.css">
    <script src="js/script-dash-usuarios.js"></script>
    <div class="title">
        <h2>Meus Usuários</h2>
    </div>

    <div class="table-container">
        <table class="container table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">Nível</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) : ?>
                <?php
                $qtdAnotacoes = getAllListByIdUser($row['id']);
                if ($qtdAnotacoes !== null) {
                    $qtdAnotacoes = count($qtdAnotacoes);
                } else {
                    $qtdAnotacoes = 0;
                }
                $qtdCompromisso = getAllCompromissoByIdUser($row['id']);
                if ($qtdCompromisso !== null) {
                    $qtdCompromisso = count($qtdCompromisso);
                } else {
                    $qtdCompromisso = 0;
                }
                ?>
                <tr>
                    <th scope="row"><?= $row['id']; ?></th>
                    <td><?= $row['nome']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td><?= $row['nivel']; ?></td>
                    <td>
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-warning mr-3"
                                    data-form-id="button-edit-user-<?= $row['id']; ?>" data-toggle="modal"
                                    data-target="#edit-usuario-<?= $row['id']; ?>">
                                <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                            </button>
                            <form id="removerUsuario-<?= $row['id']; ?>" action="gerenciar-usuario.php" method="post">
                                <input type="hidden" name="opcao" value="removeUsuario">
                                <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                                <button type="submit" class="btn btn-danger button-delete-usuario"
                                        data-form-id="<?= $row['id']; ?>">
                                    <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="edit-usuario-<?= $row['id']; ?>" tabindex="-1" role="dialog"
                     aria-labelledby="editarUsuario"
                     aria-hidden="true">

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header-modal">
                                <h5 class="modal-title"><?= $row['nome']; ?></h5>
                                <button type="button" class="close button-close" data-dismiss="modal"
                                        aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="atualizar-usuario-<?= $row['id'];?>" action="gerenciar-usuario.php" method="post">
                                <div class="modal-body">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-signature"
                                                                          style="color: #000000;"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="nome"
                                               value="<?= $row['nome']; ?>"><br>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-regular fa-envelope" style="color: #000000;"></i></span>
                                        </div>
                                        <input type="email" class="form-control" name="email"
                                               value="<?= $row['email']; ?>"><br>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-user-check" style="color: #000000;"></i></i></span>
                                        </div>
                                        <select class="form-select" name="status">
                                            <option value="ativo" <?= ($row['status'] == 'ativo') ? 'selected' : ''; ?> >
                                                Ativo
                                            </option>
                                            <option value="inativo" <?= ($row['status'] == 'inativo') ? 'selected' : ''; ?> >
                                                Inativo
                                            </option>
                                            <option value="pendente" <?= ($row['status'] == 'pendente') ? 'selected' : ''; ?> >
                                                Pendente
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-id-card" style="color: #000000;"></i></i></span>
                                        </div>
                                        <select class="form-select" name="nivel">
                                            <option value="admin" <?= ($row['nivel'] == 'admin') ? 'selected' : ''; ?> >
                                                Admin
                                            </option>
                                            <option value="padrao" <?= ($row['nivel'] == 'padrao') ? 'selected' : ''; ?> >
                                                Padrão
                                            </option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-key" style="color: #000000;"></i>
                                    </span>
                                        </div>
                                        <input type="password" class="form-control" name="senha"
                                               placeholder="Atualize a senha se necessário."
                                        ><br>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                <span class="input-group-text">Total de Anotações:
                                        </div>
                                        <input type="text" class="form-control" value="<?= $qtdAnotacoes ?>"
                                               disabled><br>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                <span class="input-group-text">Total de Compromissos:
                                        </div>
                                        <input type="text" class="form-control" value="<?= $qtdCompromisso ?>" disabled><br>
                                    </div>
                                    <br>
                                    <input type="hidden" name="opcao" value="atualizarUsuario">
                                    <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn btn-success button-edit-items open-edit-modal button-save-user"
                                            data-form-id="<?= $row['id']; ?>">
                                        Salvar Alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


<?php
require_once 'footer.php';
?>