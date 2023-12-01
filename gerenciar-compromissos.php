<?php
require_once 'repository.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $opcao = filter_input(INPUT_POST, 'opcao');
    if ($opcao == 'novoComromisso') {
        try {
            $user_id = $_SESSION['user_id'];
            $nome = filter_input(INPUT_POST, 'nome');
            $local = filter_input(INPUT_POST, 'local');
            $datas = filter_input(INPUT_POST, 'data');
            $hora = filter_input(INPUT_POST, 'hora');

            $data = [
                'user_id' => $user_id,
                'nome' => $nome,
                'local' => $local,
                'data' => $datas,
                'hora' => $hora
            ];
            $existeCompromisso = getCompromissoByName($nome, $user_id);
            if ($existeCompromisso == null) {
                $result = addCompromisso($data);
                if ($result) {
                    echo json_encode(['status' => 'sucesso']);
                    exit();
                } else {
                    throw new Exception('Falha ao cadastrar novo compromisso.');
                }
            } else {
                throw new Exception('Já existe um compromisso com esse nome.');
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'editaCompromisso') {
        try {
            $user_id = $_SESSION['user_id'];
            $compromisso_id = filter_input(INPUT_POST, 'compromisso_id');
            $nome = filter_input(INPUT_POST, 'nome');
            $local = filter_input(INPUT_POST, 'local');
            $datas = filter_input(INPUT_POST, 'data');
            $hora = filter_input(INPUT_POST, 'hora');

            $data = [
                'nome' => $nome,
                'local' => $local,
                'data' => $datas,
                'hora' => $hora
            ];
            $dataCompromisso = getCompromissoByName($nome, $user_id);
            if (!is_null($dataCompromisso) && array_diff_assoc($data, $dataCompromisso) === []) {
                echo json_encode(['status' => 'aviso']);
                exit();
            } else {
                if ($dataCompromisso == null || $compromisso_id == $dataCompromisso['id']) {
                    $result = updateCompromisso($compromisso_id, $data);
                    if ($result) {
                        echo json_encode(['status' => 'sucesso']);
                        exit();
                    } else {
                        throw new Exception('Falha ao atualizar este compromisso.');
                    }
                } else {
                    throw new Exception('Já existe um compromisso com esse nome.');
                }
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'removerCompromisso') {
        try {
            $compromisso_id = filter_input(INPUT_POST, 'compromisso_id', FILTER_VALIDATE_INT);
            $result = removeCompromisso($compromisso_id);
            if ($result) {
                header('Location: dash-compromissos.php');
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    }
}