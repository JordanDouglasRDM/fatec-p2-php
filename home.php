<?php
require_once 'header.php';
require_once 'repository.php';

if (!isset($_SESSION['user_id']) || $_SESSION['status'] !== 'ativo') {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit();
}
?>
    <link rel="stylesheet" href="css/style-home.css">

    <div class="apresentacao">
        <h2>Bem vindo </h2>

        <p>
            Este projeto foi desenvolvido por Jordan Douglas, Matheus Couto, Julia Ferreti, Jessica Pelosi e Rafael
            Medeiros.
        </p>
        <p>
            Em um mundo onde 24 horas por dia parecem insuficientes para cumprirmos nossos afazeres, o gerenciamento
            eficiente do tempo é crucial para alcançar nossos objetivos, seja na esfera profissional, acadêmica ou
            pessoal.
            Com essa necessidade em mente, nossa equipe criou um pequeno sistema web dedicado ao gerenciamento de
            tarefas e compromissos,
            proporcionando uma abordagem prática e eficaz para otimizar o seu dia a dia.
        <p><br>
        <h4>Contribuições: </h4>
        <div class="integrante-progress">
            <p>Jordan Douglas Rosa de Melo</p>
            <div class="custom-progress">
                <div class="progress">
                    <div class="progress-bar  bg-success progress-bar-animated" role="progressbar"
                         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </div>
            <p>Matheus Henrique Couto Marques</p>
            <div class="custom-progress">
                <div class="progress">
                    <div class="progress-bar  bg-success progress-bar-animated" role="progressbar"
                         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </div>
            <p>Jessica Simada Pelosi</p>
            <div class="custom-progress">
                <div class="progress">
                    <div class="progress-bar  bg-success progress-bar-animated" role="progressbar"
                         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </div>
            <p>Julia Ferreti</p>
            <div class="custom-progress">
                <div class="progress">
                    <div class="progress-bar  bg-success progress-bar-animated" role="progressbar"
                         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </div>
            <p>Rafael Medeiros Sobrinho Monteiro</p>
            <div class="custom-progress">
                <div class="progress">
                    <div class="progress-bar  bg-success progress-bar-animated" role="progressbar"
                         style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">100%</div>
                </div>
            </div>
        </div>
        <br>
        <div class="botao-nav">
            <a href="dash-listas.php" role="button" class="button-name">Gerenciar Anotações</a>
            <a href="dash-compromissos.php" role="button" class="button-name">Gerenciar Compromissos</a>
        </div>
    </div>
    <script src="js/script-home.js"></script>

<?php require_once 'footer.php'; ?>