<?php
require_once 'repository.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcao = filter_input(INPUT_POST, 'opcao');
    if ($opcao == 'marcarConcluido') {
        try {
            $item_id = $_POST['item'];
            tornarConcluidoItem($item_id);
            $result = array('status' => 'sucesso');
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['status' => 'Erro: ' . $e->getMessage()]);
            exit();
        }
    } else if ($opcao == 'marcarPendente') {
        try {
            $item_id = $_POST['item'];
            tornarPendenteItem($item_id);
            $result = array('status' => 'sucesso');
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['status' => 'Erro: ' . $e->getMessage()]);
            exit();
        }
    } else if ($opcao == 'excluir') {
        try {
            $item_id = $_POST['item'];
            exluirItem($item_id);
            $result = array('status' => 'sucesso');
            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['status' => 'Erro: ' . $e->getMessage()]);
            exit();
        }
    } else if ($opcao == 'adicionar') {
        try {
            $nome = filter_input(INPUT_POST, 'nome');
            $lista_id = filter_input(INPUT_POST, 'lista_id', FILTER_VALIDATE_INT);

            if ($nome !== null && $lista_id !== null && !empty($nome)) {
                $itemData = [
                    'nome' => $nome,
                    'lista_id' => $lista_id
                ];
                addItem($itemData);
                echo json_encode(['status' => 'sucesso']);
                exit();
            } else {
                throw new Exception("Não adicionado Nome: $nome, id lista:  $lista_id");
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'Erro: ' . $e->getMessage()]);
            exit();
        }
    }
}