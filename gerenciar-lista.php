<?php
require_once 'repository.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $titulo = filter_input(INPUT_POST, 'titulo');
        $user_id = $_SESSION['user_id'];
        $data = [
            'user_id' => $user_id,
            'titulo' => $titulo
        ];
        $existeLista = getListByTitle($titulo, $user_id);
        if ($existeLista == null) {
            $result = addLista($data);
            if ($result) {
                echo json_encode(['status' => 'sucesso']);
                exit();
            } else {
                throw new Exception('Falha ao cadastrar nova lista.');
            }
        } else {
            throw new Exception('Já existe uma lista com esse nome.');
        }
    } catch (Exception $e) {
        echo json_encode(['status' =>$e->getMessage()]);
    }
}