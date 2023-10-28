<?php
require_once 'repository.php';
session_start();
$lista_id = filter_input(INPUT_POST, 'lista_id', FILTER_VALIDATE_INT);

require_once 'header.php';
require_once 'repository.php';
$data = getAllItemByListId($lista_id);
$dataItemPendente = getAllItemWithValidation($lista_id, 'finalizado', '0', 'created_at', 'desc');
$dataItemConcluido = getAllItemWithValidation($lista_id, 'finalizado', '1', 'updated_at', 'desc');
?>
    <!-- Formulário para adicionar item -->
<div class="container col-3" style="margin-bottom: 50px; margin-top: 100px">
    <form class="wrapper" id="cadastroItem" action="gerenciar-itens.php" method="post">
        <label for="nome" style="font-size: 30px;">Novo item:</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Adicionar novo item"
               required><br>
        <input type="hidden" name="lista_id" value="<?= $lista_id ?>"><br>
        <input type="hidden" name="opcao" value="adicionar">
        <a class="btn btn-secondary" href="home.php">Home</a>
        <button type="submit" class="btn btn-primary">Novo Item</button>
    </form>
</div>
<?php if ($data !== null): ?>
    <style>
        .meuContainer {
            display: flex;
        }
        .max-height {
            max-height: 450px;
            overflow-y: auto;
        }
    </style>
    <div class="meuContainer container w-100">
        <div class="row w-100">
            <div class="" style="width: 50%">
                <h3>Itens pendentes:</h3>
                <div class="max-height">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="">Ação</th>
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
                                            <input type="submit" class="btn btn-outline-success" value="Concluir">
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
                <h3>Itens concluídos:</h3>
                <div class="max-height">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="">Ação</th>
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
                                            <input type="submit" class="btn btn-outline-warning"
                                                   value="Marcar como pendente">
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
                                <button class="btn btn-warning" disabled>Marcar como pendente</button>
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
    <script>
        $(document).ready(function () {
            $('#cadastroItem').submit(function (event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'gerenciar-itens.php',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'sucesso') {
                            toastr.options = {
                                progressBar: true,
                                timeOut: 1500
                            };
                            toastr.success('Sucesso<br>Adicionado com sucesso');
                            setTimeout(function () {
                                location.reload();
                            }, 1500);
                        } else {
                            toastr.options = {
                                progressBar: true,
                                timeOut: 2000
                            };
                            toastr.error('Erro<br>' + data.status);
                        }
                    },
                    error: function () {
                        toastr.error('Erro<br>Erro interno do servidor, tente novamente mais tarde.');
                    }
                });
            });
        });

        $(document).ready(function () {
            $('form[id^="alterarItemForm_"]').submit(function (event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    type: 'POST',
                    url: 'gerenciar-itens.php',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'sucesso') {
                            location.reload();
                        } else {
                            toastr.options = {
                                progressBar: true,
                                timeOut: 2000
                            };
                            toastr.error('Erro<br>' + data.status);
                        }
                    },
                    error: function () {
                        toastr.error('Erro<br>Erro interno do servidor, tente novamente mais tarde.');
                    }
                });
            });
        });
    </script>
<?php require_once 'footer.php'; exit(); ?>