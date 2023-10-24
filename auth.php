<?php
require_once 'conn.php';
/** @var mysqli $conn */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha');

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($senha, $row['senha'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
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
    } else {
        echo json_encode(array('status' => 'Erro interno no servidor.'));
        exit();
    }
}
