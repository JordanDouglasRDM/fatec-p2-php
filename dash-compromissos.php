<?php
require_once 'header.php';
require_once 'repository.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$data = getAllCompromissoByIdUser($_SESSION['user_id']);
function reduzCaracter(string $var, int $maxCarac)
{
    if (strlen($var) > $maxCarac) {
        return substr($var, 0, $maxCarac) . "...";
    } else {
        return $var;
    }
}

?>
    <link rel="stylesheet" href="css/style-dash-compromissos.css">
    <script src="js/script-dash-compromissos.js"></script>
    <div class="title-page">
        <i class="fa-regular fa-calendar-check" style="color: #000000;"></i>
        Meus compromissos
    </div>
    <button type="button" class="btn btn-success buttonNovaLista" data-toggle="modal"
            data-target="#novoCompromisso">
        <i class="fa-solid fa-plus" style="color: #ffffff;"></i> Adicionar compromisso
    </button>
    <br><br>
    <!--Aqui eu tenho o LISTAR dos cards dos meus compromissos-->
    <div class="containerCards max-height">
        <?php if (!$data == null): ?>
            <div class="row div-base">
                <?php foreach ($data as $row): ?>
                    <?php
                    $datas = strtotime($row['data']);
                    $row['data'] = date("d/m/Y", $datas);
                    $nome = reduzCaracter($row['nome'], 14);
                    $local = reduzCaracter($row['local'], 14);
                    ?>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5 class="card-title"><?= $nome; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="card-text con-pen">
                                    <p><i class="fa-solid fa-location-dot" style="color: #000000;"></i> <?= $local; ?>
                                    </p>
                                    <p><i class="fa-solid fa-calendar-days"
                                          style="color: #000000;"></i> <?= $row['data']; ?></p>
                                    <p><i class="fa-regular fa-clock" style="color: #000000;"></i> <?= $row['hora']; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="card-footer text btn-group" role="group">
                                <span class="botao-rodape-view">
                                    <button type="button" class="btn btn-primary button-view-items"
                                            data-toggle="modal" data-target="#view-compromisso-<?= $row['id']; ?>"
                                            data-form-id="<?= $row['id']; ?>"><i class="fa-solid fa-eye"
                                                                                 style="color: #ffffff;"></i>
                                    </button>

                                </span>
                                <span>
                                    <form id="removeCompromisso-<?= $row['id']; ?>" action="gerenciar-compromissos.php" method="POST">
                                        <input type="hidden" name="opcao" value="removerCompromisso">
                                        <input type="hidden" name="compromisso_id" value="<?= $row['id']; ?>">
                                        <button type="button" class="btn btn-danger button-delete-compromisso"
                                                data-form-id="<?= $row['id']; ?>">
                                                <i class="fa-regular fa-trash-can" style="color: #ffffff;"></i>
                                        </button>
                                    </form>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <!--Aqui eu tenho o modal de ADIÇÃO um novo compromisso-->
    <div class="modal fade" id="novoCompromisso" tabindex="-1" role="dialog" aria-labelledby="addCompromisso"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCompromisso">Adicionar Novo Compromisso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastroCompromisso" action="gerenciar-compromissos.php" method="POST">
                        <label>Nome:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-signature"
                                                                                        style="color: #000000;"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nome" required><br>
                        </div>
                        <br>
                        <label>Local:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-location-dot"
                                                                                        style="color: #000000;"></i></span>
                            </div>
                            <input type="text" class="form-control" name="local"><br>
                        </div>
                        <br>
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                                class="fa-solid fa-calendar-days" style="color: #000000;"></i></span>
                            </div>
                            <input type="date" class="form-control" name="data" required><br>
                        </div>
                        <br>
                        <label>Hora:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-clock"
                                                                                        style="color: #000000;"></i></span>
                            </div>
                            <input type="time" class="form-control" name="hora"><br>
                        </div>
                        <input type="hidden" name="opcao" value="novoComromisso"><br><br>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Aqui eu tenho os modais para cada EDIÇÃO de cada card disponível-->
<?php if (!$data == null): ?>
    <?php foreach ($data as $row): ?>
        <div class="modal fade form-edicao" id="edit-compromisso-<?= $row['id']; ?>" tabindex="1" role="dialog"
             aria-labelledby="editListModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editListModalLabel">Editar Compromisso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editarCompromisso-<?= $row['id']; ?>" action="" method="POST">
                            <label>Nome:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-signature"
                                                                                        style="color: #000000;"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nome" value="<?= $row['nome']; ?>"
                                ><br>
                            </div>
                            <br>
                            <label>Local:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-location-dot"
                                                                                        style="color: #000000;"></i></span>
                                </div>
                                <input type="text" class="form-control" name="local" value="<?= $row['local']; ?>"><br>
                            </div>
                            <br>
                            <label>Data:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i
                                                class="fa-solid fa-calendar-days" style="color: #000000;"></i></span>
                                </div>
                                <input type="date" class="form-control" name="data" value="<?= $row['data']; ?>"><br>
                            </div>
                            <br>
                            <label>Hora:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-clock"
                                                                                        style="color: #000000;"></i></span>
                                </div>
                                <input type="time" class="form-control" name="hora" value="<?= $row['hora']; ?>"><br>
                            </div>
                            <br>
                            <input type="hidden" name="opcao" value="editaCompromisso">
                            <input type="hidden" name="compromisso_id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn btn-success button-edit-compromissos open-edit-modal"
                                    data-form-id="<?= $row['id']; ?>">
                                Salvar Edições
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

    <!--Aqui eu tenho os modais para cada VISUALIZAÇÃO de cada card disponível-->
<?php if (!$data == null): ?>
    <?php foreach ($data as $row): ?>
        <div class="modal fade" id="view-compromisso-<?= $row['id']; ?>" tabindex="-1" role="dialog"
             aria-labelledby="viewCompromisso"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewCompromisso">Visualizar Compromisso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Nome:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-signature" style="color: #000000;"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nome" value="<?= $row['nome']; ?>"
                                   disabled><br>
                        </div>
                        <br>
                        <label>Local:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-location-dot"
                                                                                    style="color: #000000;"></i></span>
                            </div>
                            <input type="text" class="form-control" name="local" value="<?= $row['local']; ?>" disabled><br>
                        </div>
                        <br>
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"
                                                                                    style="color: #000000;"></i></span>
                            </div>
                            <input type="date" class="form-control" name="data" value="<?= $row['data']; ?>"
                                   disabled><br>
                        </div>
                        <br>
                        <label>Hora:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-clock"
                                                                                    style="color: #000000;"></i></span>
                            </div>
                            <input type="time" class="form-control" name="hora" value="<?= $row['hora']; ?>"
                                   disabled><br>
                        </div>
                        <br>
                        <button type="button" class="btn btn-warning button-edit-items open-edit-modal"
                                data-form-id="<?= $row['id']; ?>">
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php require_once 'footer.php'; ?>