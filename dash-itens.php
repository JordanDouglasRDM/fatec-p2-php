<?php
require_once 'repository.php';
require_once 'header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$lista_id = filter_input(INPUT_POST, 'lista_id', FILTER_VALIDATE_INT);

$data = getAllItemByListId($lista_id);
$dataItemPendente = getAllItemWithValidation($lista_id, 'status', '0', 'created_at', 'desc');
$dataItemConcluido = getAllItemWithValidation($lista_id, 'status', '1', 'updated_at', 'desc');
?>
    <script src="js/script-dash-itens.js"></script>

    <link rel="stylesheet" href="css/style-dash-itens.css">
    <div class="tituloLista">
        <div class="title-list">
            <?php
            echo $_POST['titulo'];
            ?>
        </div>
<button type="button" class="btn btn-outline-success buttonNovaLista col-1 button-new-item" data-toggle="modal" data-target="#novoItem">
    Novo Item
</button>
<div class="modal fade" id="novoItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-new-item">
                <h5 class="modal-title" id="exampleModalLabel">Novo Item</h5>
                <button type="button" class="close button-close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form class="wrapper" id="cadastroItem" action="gerenciar-itens.php" method="post">
                        <label for="nome" style="font-size: 15px;">Nome do Item:</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Descrição do item"
                            required><br>
                        <input type="hidden" name="lista_id" value="<?= $lista_id ?>"><br>
                        <input type="hidden" name="opcao" value="adicionar">
                        <button type="submit" class="btn btn-success">Adicionar Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
        <?php if ($data !== null): ?>
<div class="scrollbar">
            <div class="meuContainer container w-100">
                <div class="row w-100">
            <div class="" style="width: 50%;">
                <h3 class="">Itens pendentes:</h3>
                <div class="">
                    <table class="table table-hover table-left">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                            <th style="text-align: center;" >Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($dataItemPendente !== null): ?>
                                    <?php foreach ($dataItemPendente as $item): ?>
                                        <tr>
                                            <td class="col-8"><?= $item['nome']; ?></td>
                                            <td class="meuContainer container">
                                                <form id="alterarItemForm_<?= $item['id'] ?>" action="" method="post">
                                                    <input type="hidden" name="item" value="<?= $item['id'] ?>">
                                                    <input type="hidden" name="opcao" value="marcarConcluido">
                                            <input type="submit" class="btn btn-success button-conclude" value="Concluir">
                                                </form>
                                                <form id="alterarItemForm_<?= $item['id'] ?>" action="" method="post">
                                                    <input type="hidden" name="item" value="<?= $item['id'] ?>">
                                                    <input type="hidden" name="opcao" value="excluir">
                                                    <input type="submit" class="btn btn-danger" value="X">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if ($dataItemPendente == null): ?>
                                    <td>Nenhum item pendente</td>
                                    <td>
                                        <button class="btn btn-success" disabled>Concluir</button>
                                        <button class="btn btn-danger" disabled>X</button>
                                    </td>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="" style="width: 50%">
                <h3 class="">Itens concluídos:</h3>
                <div class="">
                    <table class="table table-hover table-form">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                            <th style="text-align: center;">Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if ($dataItemConcluido !== null): ?>
                                    <?php foreach ($dataItemConcluido as $item): ?>
                                        <tr>
                                            <td class="col-8"><?= $item['nome']; ?></td>
                                            <td class="meuContainer container">
                                                <form id="alterarItemForm_<?= $item['id'] ?>" action="" method="post">
                                                    <input type="hidden" name="item" value="<?= $item['id'] ?>">
                                                    <input type="hidden" name="opcao" value="marcarPendente">
                                            <input type="submit" class="btn button-pending"
                                                    value="Pendente">
                                                </form>
                                                <form id="alterarItemForm_<?= $item['id'] ?>" action="" method="post">
                                                    <input type="hidden" name="item" value="<?= $item['id'] ?>">
                                                    <input type="hidden" name="opcao" value="excluir">
                                                    <input type="submit" class="btn btn-danger" value="X">
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <?php if ($dataItemConcluido == null): ?>
                                    <td>Nenhum item concluido</td>
                                    <td>
                                <button class="btn btn-warning button-pending" disabled>Pendente</button>
                                        <button class="btn btn-danger" disabled>X</button>
                                    </td>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($data == null): ?>
            <div class="alert alert-danger">
                Não possui itens cadastrados
            </div>
        <?php endif; ?>
<?php require_once 'footer.php';
exit(); ?>