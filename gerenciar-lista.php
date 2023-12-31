<?php
require_once 'repository.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcao = filter_input(INPUT_POST, 'opcao');
    if ($opcao == 'novaLista') {
        try {
            /**
             * Para cadastrar listas em massa, descomente:
             **/
//            $user_id = $_SESSION['user_id'];
//            for ($i = 1; $i < 21; $i++) {
//                $data = [
//                    'user_id' => $user_id,
//                    'titulo' => "Lista $i"
//                ];
//                addLista($data);
//            }
//            echo json_encode(['status' => 'sucesso']);
//            exit();
            $user_id = $_SESSION['user_id'];
            $titulo = filter_input(INPUT_POST, 'titulo');
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
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'editaTitulo') {
        try {
            $titulo = filter_input(INPUT_POST, 'titulo');
            $lista_id = filter_input(INPUT_POST, 'lista_id', FILTER_VALIDATE_INT);
            $existeLista = getListByTitle($titulo, $_SESSION['user_id']);
            if ($existeLista == null) {
                $result = editListById($lista_id, $titulo);
                if ($result) {
                    echo json_encode(['status' => 'sucesso']);
                    exit();
                } else {
                    throw new Exception('Falha ao editar lista.');
                }
            } else {
                throw new Exception('Já existe uma lista com esse nome.');
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'removerLista') {
        try {
            $lista_id = filter_input(INPUT_POST, 'lista_id', FILTER_VALIDATE_INT);
            $result = deleteListById($lista_id);
            if ($result) {
                header('Location: dash-listas.php');
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    }
}