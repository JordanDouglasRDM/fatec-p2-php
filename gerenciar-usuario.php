<?php
require_once 'repository.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
}