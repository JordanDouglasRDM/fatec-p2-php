<?php
require_once 'header.php';
require_once 'repository.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$data = getAllListByIdUser($_SESSION['user_id']);
?>

<style>
    .containerCards {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
    }
</style>

<div class="alert alert-success">
    Logado
</div>

<!-- Exibe todas as listas do meu usuário. -->
<?php if (!$data == null): ?>
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

<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#itensLista">
    Nova lista
</button>
<a href="logout.php" class="btn btn-danger">Logout</a>
<br><br>
<div class="containerCards">
    <?php if (!$data == null): ?>
        <div class="row">
            <?php foreach ($data as $row): ?>
                <div class="col-sm-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['titulo']; ?></h5>
                            <p class="card-text">Criado em: <?= $row['created_at']; ?></p>
                            <form action="dash-itens.php" method="post">
                                <input type="hidden" name="lista_id" value="<?= $row['id']; ?>">
                                <input type="submit" class="btn btn-primary" value="View">
                            </form>
                        </div>
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
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Nova Lista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="cadastroLista" action="gerenciar-lista.php" method="POST">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título da lista"
                           required>
                    <br><br>
                    <button type="submit" class="btn btn-info">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#cadastroLista').submit(function (event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'gerenciar-lista.php',
                data: $('#cadastroLista').serialize(),
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'sucesso') {
                        location.reload(); // Recarrega a página
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
<?php require_once 'footer.php'; ?>