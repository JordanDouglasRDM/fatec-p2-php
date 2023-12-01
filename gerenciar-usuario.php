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

        try {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha');

            $usuarioData = getUserByEmail($email);
            if ($usuarioData !== null) {
                if (password_verify($senha, $usuarioData['senha'])) {
                    if ($usuarioData['status'] == 'ativo') {
                        session_start();
                        $_SESSION['user_id'] = $usuarioData['id'];
                        $_SESSION['nivel'] = $usuarioData['nivel'];
                        $_SESSION['status'] = $usuarioData['status'];
                        $_SESSION['autenticado'] = true;
                        echo json_encode(array('status' => 'sucesso'));
                        exit();
                    } else {
                        echo json_encode(['status' => 'inativo']);
                        exit();
                    }
                } else {
                    throw new Exception('Usuário ou senha inválidos.');
                }
            } else {
                throw new Exception('Usuário ou senha inválidos.');
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'editarPerfil') {
        try {
            session_start();
            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'senha');
            $user_id = $_SESSION['user_id'];
            $userData = getUserById($user_id);
            $atualizado = 0;
            if (!empty($nome) && $userData['nome'] !== $nome) {
                updateUserByField($user_id, 'nome', $nome);
                $atualizado++;
            }
            if (!empty($email && $userData['email'] !== $email)) {
                updateUserByField($user_id, 'email', $email);
                $atualizado++;
            }
            $senhaDiff = password_verify($senha, $userData['senha']);

            if (!empty($senha) && $senhaDiff == false) {
                $hash_senha = password_hash($senha, PASSWORD_DEFAULT);
                updateUserByField($user_id, 'senha', $hash_senha);
                $atualizado++;
            }

            if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] == UPLOAD_ERR_OK) {
                $foto_perfil = file_get_contents($_FILES["foto_perfil"]["tmp_name"]);
                updateUserByField($user_id, 'foto_perfil', $foto_perfil);
                $atualizado++;
            }
            if ($atualizado > 0) {
                echo json_encode(array('status' => 'sucesso'));
                exit();
            } else {
                echo json_encode(array('status' => 'aviso'));
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'excluirFotoPerfil') {
        try {
            session_start();
            $user_id = $_SESSION['user_id'];
            $dataUser = getUserById($user_id);
            if ($dataUser['foto_perfil'] == null) {
                throw new Exception('Não é possível remover a foto padão.');
            }
            if (removeFotoPerfil($user_id)) {
                echo json_encode(array('status' => 'sucesso'));
                exit();
            } else {
                throw new Exception('Falha ao remover a foto do perfil, tente novamente mais tarde.');
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'removeUsuario') {
        try {
            session_start();
            $my_id = $_SESSION['user_id'];
            $qtyAdmin = 0;

            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            $dataUser = getAllUsers();
            foreach ($dataUser as $user) {
                if ($user['nivel'] == 'admin' && $user['id'] != $my_id)
                    $qtyAdmin++;
            }
            if ($qtyAdmin == 0 && $user_id == $my_id) {
                throw new Exception('Você não pode excluir o único admin, conceda acesso admin a outro usuário e tente novamente.');
            }

            if (removeUser($user_id)) {
                echo json_encode(array('status' => 'sucesso'));
                exit();
            }
        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    } elseif ($opcao == 'atualizarUsuario') {
        try {
            session_start();
            $my_id = $_SESSION['user_id'];
            $qtyAdmin = 0;
            $dataUsers = getAllUsers();

            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            $nome = filter_input(INPUT_POST, 'nome');
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $status = filter_input(INPUT_POST, 'status');
            $nivel = filter_input(INPUT_POST, 'nivel');
            $senha = filter_input(INPUT_POST, 'senha');

            $atualizado = 0;
            $userData = getUserById($user_id);

            //atualiza somente se tiver algum dado novo
            if (!empty($nome) && $userData['nome'] !== $nome) {
                updateUserByField($user_id, 'nome', $nome);
                $atualizado++;
            }
            if (!empty($email) && $userData['email'] !== $email) {
                updateUserByField($user_id, 'email', $email);
                $atualizado++;
            }
            if (!empty($status) && $userData['status'] !== $status) {
                if ($user_id == $my_id) {
                    throw new Exception('Você não pode alterar o seu próprio status.');
                }
                updateUserByField($user_id, 'status', $status);
                $atualizado++;
            }
            foreach ($dataUsers as $user) {
                if ($user['nivel'] == 'admin')
                    $qtyAdmin++;
            }
            if (!empty($nivel && $userData['nivel'] !== $nivel)) {
                if ($qtyAdmin == 1 && $user_id == $my_id) {
                    throw new Exception('Conceda acesso admin a outro usuário e tente novamente.');
                }
                updateUserByField($user_id, 'nivel', $nivel);
                $atualizado++;
            }
            if (!empty($senha)) {
                $senhaDiff = password_verify($senha, $userData['senha']);
            }

            if (!empty($senha) && $senhaDiff == false) {
                $hash_senha = password_hash($senha, PASSWORD_DEFAULT);
                updateUserByField($user_id, 'senha', $hash_senha);
                $atualizado++;
            }

            echo json_encode(array('status' => 'sucesso'));
            exit();

        } catch (Exception $e) {
            echo json_encode(['status' => $e->getMessage()]);
            exit();
        }
    }
}