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
<!--                                    <button type="button" class="btn btn-primary" data-toggle="modal"-->
<!--                                            data-target="#itensLista">-->
<!--                                        View-->
<!--                                    </button>-->
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
                    <input type="text" class="form-control" id="titulo" name="titulo"
                           placeholder="Título da lista"
                           required value="Um título">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastroForm" action="cadastro-itens.php" method="POST">
                        <div class="container">
                            <!-- Lista de tarefas -->
                            <ul class="list-group" id="taskList">
                                <li class="list-group-item">
                                    <div class="d-flex">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input">
                                        </div>
                                        <div class="flex-fill">
                                            <input type="text" class="form-control" placeholder="Descreva o item">
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-danger" onclick="removeTask(this)">X</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h6 id="addNewTask" style="cursor: pointer">+ Novo item</h6>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-info">Salvar</button>
                    </form>
                        <script>
                            document.getElementById("addNewTask").addEventListener("click", function () {
                                addNewTask(this);
                            });

                            function addNewTask(clickedElement) {
                                const taskItem = document.createElement("li");
                                taskItem.className = "list-group-item";
                                taskItem.innerHTML = `
                                                        <div class="d-flex">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input">
                                                            </div>
                                                            <div class="flex-fill">
                                                                <input type="text" class="form-control" placeholder="Descreva o item">
                                                            </div>
                                                            <div>
                                                                <button type="button" class="btn btn-danger" onclick="removeTask(this)">X</button>
                                                            </div>
                                                        </div>
                                                    `;
                                document.getElementById("taskList").appendChild(taskItem);
                            }

                            function removeTask(clickedElement) {
                                const taskItem = clickedElement.closest("li");
                                if (taskItem) {
                                    taskItem.remove();
                                }
                            }
                            $(document).ready(function () {
                                $('#cadastroForm').submit(function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        type: 'POST',
                                        url: 'cadastro-itens.php',
                                        data: JSON.stringify(collectData()),
                                        contentType: 'application/json; charset=utf-8',
                                        dataType: 'json',
                                        // console.log("Resposta do servidor:"); // Adicione esta linha
                                        success: function (data) {
                                            if (data.status === 'sucesso') {
                                                toastr.options = {
                                                    progressBar: true,
                                                        timeOut: 2000
                                                }
                                                toastr.success('Sucesso<br>' + data.status);
                                                // setTimeout(function () {
                                                //     $('#itensLista').modal('hide');
                                                // }, 1000);
                                                // setTimeout(function () {
                                                //     window.location.href = 'home.php';
                                                // }, 2000);
                                            } else {
                                                toastr.error('Erro<br>' + data.status);
                                            }
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            toastr.error('Erro<br>Erro interno do servidor, tente novamente mais tarde.');
                                            console.log("Erro na solicitação AJAX: " + textStatus + " - " + errorThrown);
                                        }

                                    });
                                });
                            });

                            function collectData() {
                                const formData = {
                                    title: $('#titulo').val(), // Coleta o título da lista
                                    tasks: [] // Inicializa um array para as tarefas
                                };
                                const taskItems = $('#taskList .list-group-item');

                                taskItems.each(function (index, item) {
                                    const description = $(item).find('.form-control').val();
                                    const isCompleted = $(item).find('.form-check-input').prop('checked');

                                    formData.tasks.push({
                                        description: description,
                                        isCompleted: isCompleted
                                    });
                                });

                                return formData;
                            }
                        </script>
                </div>
            </div>
        </div>
    </div>

<?php
require_once 'footer.php';