<?php
require_once 'conn.php';
function getUserByEmail(string $email)
{
    global $conn;
    $query = 'SELECT id, nome, email FROM users WHERE email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $meuEmail);
        $stmt->fetch();
        $data = [
            'id' => $id,
            'nome' => $nome,
            'email' => $meuEmail
        ];
        $stmt->close();
        return $data;
    } else {
        $stmt->close();
        return null;
    }
}

function addUser(array $data)
{
    global $conn;
    $query = 'INSERT INTO users (nome, email, senha) VALUES (?,?,?);';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $data['nome'], $data['email'], $data['senha']);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function addLista(array $data)
{
    global $conn;
    $query = 'INSERT INTO listas (titulo, user_id) VALUES (?,?);';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $data['titulo'], $data['user_id']);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function getListByTitle(string $titulo)
{
    global $conn;
    $query = 'SELECT * FROM listas WHERE titulo = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $titulo);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $titulo, $user_id);
        $stmt->fetch();
        $data = [
            'id' => $id,
            'titulo' => $titulo,
        ];
        $stmt->close();
        return $data;
    } else {
        $stmt->close();
        return null;
    }
}

function getAllListByIdUser(int $id)
{
    global $conn;
    $query = 'SELECT * FROM listas WHERE user_id = ? ORDER BY created_at DESC';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    } else {
        $stmt->close();
        return null;
    }
    function addItem(array $data)
    {
        global $conn;
        $query = 'INSERT INTO itens (nome, finalizado, lista_id) VALUES (?,?,?);';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sbi', $data['nome'], $data['finalizado'], $data['lista_id']);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
}