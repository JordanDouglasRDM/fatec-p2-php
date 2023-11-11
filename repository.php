<?php
require_once 'conn.php';
function getUserByEmail(string $email)
{
    global $conn;
    $query = 'SELECT id, nome, email, senha FROM users WHERE email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $meuEmail, $senha);
        $stmt->fetch();
        $data = [
            'id' => $id,
            'nome' => $nome,
            'email' => $meuEmail,
            'senha' => $senha
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

function getListByTitle(string $titulo, int $user_id)
{
    global $conn;
    $query = 'SELECT id, titulo, user_id FROM listas WHERE titulo = ? AND user_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $titulo, $user_id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $tituloColumn, $user_id);
        $stmt->fetch();
        $data = [
            'id' => $id,
            'titulo' => $tituloColumn,
            'user_id' => $user_id
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
}
function addItem(array $data)
{
    global $conn;
    $valorPadrao = 0;
    $query = 'INSERT INTO itens (nome, status, lista_id) VALUES (?,?,?);';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sii', $data['nome'], $valorPadrao, $data['lista_id']);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
function getAllItemByListId(int $lista_id)
{
    global $conn;
    $query = 'SELECT * FROM itens WHERE lista_id = ? ORDER BY status DESC';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $lista_id);
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
}
function getAllItemWithValidation(int $lista_id, string $field, string $valor, string $orderBy, string $orderDirection)
{
    global $conn;
    $query = "SELECT * FROM itens WHERE lista_id = ? AND $field=$valor ORDER BY $orderBy $orderDirection;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $lista_id);
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
}
function tornarConcluidoItem(int $item_id)
{
    global $conn;
    $query = 'UPDATE itens SET status = 1 WHERE id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i',$item_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
function tornarPendenteItem(int $item_id)
{
    global $conn;
    $query = 'UPDATE itens SET status = 0 WHERE id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i',$item_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
function exluirItem(int $item_id)
{
    global $conn;
    $query = 'DELETE FROM itens WHERE id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i',$item_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function editListById(int $lista_id, string $novoTitulo)
{
    global $conn;
    $query = 'UPDATE listas SET titulo = ? WHERE id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $novoTitulo, $lista_id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deleteListById(int $lista_id)
{
    $allItens = getAllItemByListId($lista_id);
    if ($allItens !== null) {
        foreach ($allItens as $item) {
            exluirItem($item['id']);
        }
    }
    $allItens = getAllItemByListId($lista_id);
    if ($allItens == null) {
        global $conn;
        $query = 'DELETE FROM listas WHERE id = ?';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $lista_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    return null;
}
function countItensByIdList(int $lista_id)
{
    global $conn;
    $query = "
                SELECT
                COUNT(CASE WHEN status = 0 THEN 1 END) AS 'pendente',
                COUNT(CASE WHEN status = 1 THEN 1 END) AS 'concluido'
                FROM itens where lista_id = ?;
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $lista_id);
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
}
function getUserById(int $id)
{
    global $conn;
    $query = 'SELECT id, nome, email FROM users WHERE id = ?;';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nome, $email);
        $stmt->fetch();
        $data = [
            'id' => $id,
            'nome' => $nome,
            'email' => $email
        ];
        $stmt->close();
        return $data;
    } else {
        $stmt->close();
        return null;
    }
}
function addCompromisso(array $data)
{
    global $conn;
    $query = 'INSERT INTO compromissos (nome, local, data, hora, user_id) VALUES (?,?,?,?,?);';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssi', $data['nome'], $data['local'], $data['data'], $data['hora'], $data['user_ìd']);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}