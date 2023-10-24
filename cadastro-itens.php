<?php
require_once 'repository.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    try {
        $title = $data['title'];
        $tasks = $data['tasks'];
        if ($title !== null && $tasks !== null) {
            $listData = [
                'titulo' => $title,
                'user_id' => $_SESSION['user_id']
            ];
            $existeLista = getListByTitle($title);
            if ($existeLista == null) {
            addLista($listData);
            $recuperaLista = getListByTitle($title);
//                    throw new Exception('dados: ' . $recuperaLista['id']);
                foreach ($tasks as $task) {
//                    $dadosItem = [
//                        'nome' => $task->description,
//                        'finalizado' => $task->isCompleted,
//                        'lista_id' => $listData['id']
//                    ];
//                    addItem($dadosItem);
                }
                echo json_encode(['status' => 'sucesso']);
                exit();
        } else {
                throw new Exception('Já existe uma lista com esse nome.');
        }
        } else {
            throw new Exception('Dados inválidos');
        }
    } catch (Exception $e) {
        error_log('Erro: ' . $e->getMessage());
        echo json_encode(['status' => 'Erro: ' . $e->getMessage()]);
    }

}
