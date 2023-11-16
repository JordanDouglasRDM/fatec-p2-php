<?php
require_once 'header.php';
?>
    <link rel="stylesheet" href="css/style-index.css">
    <script src="js/script-index.js"></script>
    <div class="container">
        <form id="loginForm" action="gerenciar-usuario.php" method="post" class="">
            <h3>Tasks and Appointments</h3>
            <label for="email" class="email">Email:</label><br>
            <input class="form-control" type="email" name="email" id="email" required autofocus><br>
            <label for="senha">Senha:</label><br>
            <input class="form-control" type="password" name="senha" id="senha" required><br>
            <input type="hidden" name="opcao" value="autenticarUsuario">
            <input type="submit" value="Entrar" class="btn button-login"><br><br>
        </form>
        <p>Ainda não possui uma conta ? <a href="" data-toggle="modal" data-target="#meuModal" class="register">Clique aqui.</a></p>
        <!--<button type="button" class="btn btn-secondary" >
            <a href=""></a>
        </button>-->
    </div>
    
    <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-container">
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
                        <button type="submit" class="btn btn-primary button-register">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
require_once 'footer.php';
?>