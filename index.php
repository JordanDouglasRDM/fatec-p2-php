<?php
require_once 'header.php';
?>
    <style>
        .meu_form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
        }
    </style>
    <div class="meu_form">
        <form id="loginForm" action="gerenciar-usuario.php" method="post" class="wrapper">
            <label for="email">Email:</label><br>
            <input class="form-control" type="email" name="email" id="email" required autofocus><br>
            <label for="senha">Senha:</label><br>
            <input class="form-control" type="password" name="senha" id="senha" required><br>
            <input type="hidden" name="opcao" value="autenticarUsuario">
            <input type="submit" value="Login" class="btn btn-primary"><br><br>
        </form>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#meuModal">
            Primeiro Acesso
        </button>
    </div>
    <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastroUserForm" action="gerenciar-usuario.php" method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Seu e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha"
                                   required>
                        </div>
                        <input type="hidden" name="opcao" value="adicionarUsuario">
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        toastr.options = {
            progressBar: true,
            timeOut: 2000
        }
        $(document).ready(function () {
            $('#loginForm').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'gerenciar-usuario.php',
                    data: $('#loginForm').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'sucesso') {
                            toastr.success('Sucesso<br>Sucesso ao realizar o login.');
                            setTimeout(function () {
                                window.location.href = 'home.php';
                            }, 2000);
                        } else {
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
            $('#cadastroUserForm').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: 'gerenciar-usuario.php',
                    data: $('#cadastroUserForm').serialize(),
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'sucesso') {
                            toastr.success('Sucesso<br>Usuário adicionado com sucesso.');
                            setTimeout(function () {
                                window.location.href = 'index.php';
                            }, 2000);
                        } else {
                            toastr.error('Erro<br>' + data.status);
                        }
                    },
                    error: function () {
                        toastr.error('Erro<br>' + this.data);
                    }
                });
            });
        });
    </script>
<?php
require_once 'footer.php';
?>