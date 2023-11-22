<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ProTasker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/9f50e2463f.js" crossorigin="anonymous"></script>

</head>
<style>
    head, body {
        background-color: #F2F2F2;
    }
</style>
<body>
    <link rel="stylesheet" href="css/style-index.css">
    <script src="js/script-index.js"></script>
    <div class="container">
        <form id="loginForm" action="gerenciar-usuario.php" method="post" class="">
            <h3>ProTasker</h3>
            <label for="email" class="email">Email:</label><br>
            <input class="form-control" type="email" name="email" id="email" value="paulo@gmail.com" required autofocus><br>
            <label for="senha">Senha:</label><br>
            <input class="form-control" type="password" name="senha" id="senha" placeholder="Professor, sua senha é  'admin'" required><br>
            <input type="hidden" name="opcao" value="autenticarUsuario">
            <input type="submit" value="Entrar" class="btn btn-primary button-login"><br><br>
        </form>
        <p>Ainda não possui uma conta ? <a href="" data-toggle="modal" data-target="#meuModal" class="register">Clique aqui</a></p>
    </div>
    
    <div class="modal fade" id="meuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-container">
                <div class="modal-header modal-new-user">
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
                        <button type="submit" class="btn btn-success button-register">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>