<?php
require_once 'repository.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = filter_input(INPUT_POST, 'titulo');
    $id = $_SESSION['user_id'];
    $data = [
      'id' => $id,
      'titulo' => $titulo
    ];
    $result = addLista($data);

    if ($result) {
        header('Location: home.php');
        exit();
    } else {
        exit();
    }
}