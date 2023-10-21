<?php
require_once 'header.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<div class="alert alert-success">
    Logado
</div>

<?php
require_once 'footer.php';