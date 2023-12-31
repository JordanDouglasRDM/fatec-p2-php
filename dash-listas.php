<?php
require_once 'header.php';
require_once 'repository.php';

if (!isset($_SESSION['user_id']) || $_SESSION['status'] !== 'ativo') {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
}
$data = getAllListByIdUser($_SESSION['user_id']);

?>
    <script src="js/script-dash-listas.js"></script>
    <link rel="stylesheet" href="css/style-dash-listas.css">
    <div class="title-page">
        <i class="fa-regular fa-calendar-check" style="color: #000000;"></i>
        Minhas Anotações
    </div>
    <br><br><br>
<?php if ($data !== null): ?>
    <?php foreach ($data as $row): ?>
        <div class="modal fade" id="itensLista<?= $row['id']; ?>" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?= $row['titulo']; ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

    <button type="button" class="btn btn-success sm-col-2 button-new-list" data-toggle="modal"
            data-target="#itensLista">
        <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
        Adicionar lista
    </button>
    <br><br>
<div class="scrollbar">
    <div class="containerCards max-height">
        <?php if (!$data == null): ?>
            <div class="row div-base">
                <?php foreach ($data as $row): ?>
                    <?php
                        $timestamp = strtotime($row['created_at']);
                        $row['created_at'] = date("d/m/Y - H:i", $timestamp);
                        $dataCount = countItensByIdList($row['id']);
                    ?>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="title-card"><?= $row['titulo']; ?></h5>
                                <p class="card-text con-pen">Pendente/Concluído (<?= $dataCount[0]['pendente']; ?>
                                    /<?= $dataCount[0]['concluido']; ?>)</p>
                                <div class="container d-flex">
                                    <form class="mr-2" action="dash-itens.php" method="post">
                                        <input type="hidden" name="lista_id" value="<?= $row['id']; ?>">
                                        <input type="hidden" name="titulo" value="<?= $row['titulo']; ?>">
                                        <input type="submit" class="btn button-view-items" value="Ver itens">
                                    </form>
                                    <button type="button" class="btn btn-outline-warning button-edit-items"
                                            data-toggle="modal" data-target="#edit-list-<?= $row['id']; ?>"
                                            data-form-id="<?= $row['id']; ?>">
                                        Editar
                                    </button>
                                    <form id="removeLista-<?= $row['id']; ?>" action="gerenciar-lista.php" method="POST">
                                        <input type="hidden" name="opcao" value="removerLista">
                                        <input type="hidden" name="lista_id" value="<?= $row['id']; ?>">
                                        <button type="submit" class="btn btn-danger button-delete-items button-delete"
                                                data-form-id="<?= $row['id']; ?>">X
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <p class="card-footer text-muted">Criado em: <?= $row['created_at']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="modal fade" id="itensLista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header moda-new-list">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Nova Lista</h5>
                    <button type="button" class="close button-close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastroLista" action="gerenciar-lista.php" method="POST">
                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título da lista"
                               required>
                        <input type="hidden" name="opcao" value="novaLista">
                        <br><br>
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php if (!$data == null): ?>
    <?php foreach ($data as $row): ?>
        <div class="modal fade form-edicao" id="edit-list-<?= $row['id']; ?>" tabindex="-1" role="dialog"
             aria-labelledby="editListModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header moda-new-list">
                        <h5 class="modal-title" id="editListModalLabel">Editar título da lista</h5>
                        <button type="button" class="close button-close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editaLista-<?= $row['id']; ?>" action="gerenciar-lista.php" method="POST">
                            <input type="text" class="form-control" id="titulo" name="titulo"
                                   value="<?= $row['titulo']; ?>">
                            <br><br>
                            <input type="hidden" name="opcao" value="editaTitulo">
                            <input type="hidden" name="lista_id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<?php require_once 'footer.php'; ?>