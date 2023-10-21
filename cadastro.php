<?php
require_once 'conn.php';
/** @var mysqli $conn */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');
    $nome = filter_input(INPUT_POST, 'nome');
    $hash_senha = password_hash($senha, PASSWORD_DEFAULT);

    $query = 'SELECT id FROM users WHERE email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(array('status' => 'E-mail já cadastrado.'));
        exit();
    } else {
        $query = 'INSERT INTO users (nome, email, senha) VALUES (?,?,?);';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $nome, $email, $hash_senha);
        $result = $stmt->execute();
        if ($result) {
            echo json_encode(array('status' => 'sucesso'));
            exit();
        } else {
            echo json_encode(array('status' => 'falha'));
            exit();
        }
    }
}