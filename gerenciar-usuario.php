<?php
require_once 'repository.php'; // camade de serviço que trata banco de dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcao = filter_input(INPUT_POST, 'opcao');
    if ($opcao == 'adicionarUsuario') {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');
        $nome = filter_input(INPUT_POST, 'nome');

        $hash_senha = password_hash($senha, PASSWORD_DEFAULT);

        $data = [
            'email' => $email,
            'nome' => $nome,
            'senha' => $hash_senha
        ];
        $existeEmail = getUserByEmail($email);
        if ($existeEmail == null) {
            $result = addUser($data);
            if ($result) {
                echo json_encode(['status' => 'sucesso']);
                exit();
            } else {
                echo json_encode(['status' => 'falha']);
                exit();
            }
        } else {
            echo json_encode(['status' => 'E-mail já cadastrado.']);
            exit();
        }
    } elseif ($opcao == 'autenticarUsuario') {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha');

        $usuarioData = getUserByEmail($email);
        if ($usuarioData !== null) {
            if (password_verify($senha, $usuarioData['senha'])) {
                session_start();
                $_SESSION['user_id'] = $usuarioData['id'];
                echo json_encode(array('status' => 'sucesso'));
                exit();
            } else {
                echo json_encode(array('status' => 'Usuário ou senha inválidos.'));
                exit();
            }
        } else {
            echo json_encode(array('status' => 'Usuário ou senha inválidos.'));
            exit();
        }
    }
}