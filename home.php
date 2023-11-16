<?php
require_once 'header.php';
require_once 'repository.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<style>.flip-card {
        background-color: transparent;
        width: 190px;
        height: 254px;
        perspective: 1000px;
        font-family: sans-serif;
    }

    .title {
        font-size: 1em;
        font-weight: 900;
        text-align: center;
        margin: 0;
    }

    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        text-align: center;
        transition: transform 0.8s;
        transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner {
        transform: rotateY(180deg);
    }

    .flip-card-front, .flip-card-back {
        box-shadow: 0 8px 14px 0 rgba(0, 0, 0, 0.2);
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        border: 1px solid #ccc; /* cinza claro */
        border-radius: 1rem;
    }

    .flip-card-front {
        background: linear-gradient(120deg, #fff 60%, #eee 88%, #ddd 40%, rgba(255, 127, 80, 0.603) 48%);
        color: #ccc; /* cinza claro */
    }

    .flip-card-back {
        background: linear-gradient(120deg, #aaa 30%, #ccc 88%, #fff 40%, #f7b9a0 78%);
        color: #fff; /* branco */
        transform: rotateY(180deg);
    }
    .meuContainer {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .meus-cards {
        margin-right: 100px;
    }
</style>
<div class="meuContainer row">
    <div class="meus-cards card">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <p class="title">Minhas Anotações</p>
                    <p>Hover Me</p>
                </div>
                <div class="flip-card-back">
                    <p class="title">Acessar</p>
                    <a style="text-decoration: none" href="dash-listas.php">Clique aqui</a>
                </div>
            </div>
        </div>
    </div>
    <div class="meus-cards card">
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <p class="title">Meus Compromissos</p>
                    <p>Hover Me</p>
                </div>
                <div class="flip-card-back">
                    <p class="title">Acessar</p>
                    <a style="text-decoration: none" href="dash-compromissos.php">Clique aqui</a>
                </div>
            </div>
        </div>
    </div>
</div>