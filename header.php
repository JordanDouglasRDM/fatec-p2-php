<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    .navbar-color {
        background-color: #427D9D;
    }

    .color {
        color: #DDF2FD;
        font-weight: bold;
    }

    .color:hover {
        color: #164863;
    }

    .button-logout {
        background-color: red;
        color: white;
        font-weight: bold;
        margin-right: 2vw;
        padding: 0.5vh 2vw;
    }

    .button-logout:hover {
        background-color: #164863;
        color: red;
    }

</style>
<body>
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) {
      echo '
        <nav class="navbar navbar-expand-lg navbar-color">
  <a class="navbar-brand color" href="#">Gerenciador de Listas</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" style="width: 100px" href=""></a>
      <a class="nav-item nav-link active color" href="home.php">Home <span class="sr-only">(current)</span></a>
      
    </div>
  </div>
    <form class="form-inline">
    <a href="logout.php" class="btn btn-outline-danger my-2 my-sm-0 button-logout" type="submit">Sair</a>
  </form>
</nav>
      
      ';
    }
    ?>
