<?php
session_start();
ob_start();

require_once(__DIR__ . '/app/conexao/conexao.php');
require(__DIR__ . '/app/Url.php');

$pagina = (empty(URL::getURL(0)) ? 'home' : URL::getURL(0));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog PHP</title>
    <link href="/assets/css/app.css" type="text/css" rel="stylesheet" />
    <link href="/assets/css/custom.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Blog PHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php
                if(!empty($_SESSION['UserLogin'])){
            ?>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white font-weight-bold" href="#" id="navbarDropdown" data-toggle="dropdown">
                                Olá, <?= $_SESSION['UserLogin']->name;?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Meu Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">Sair</a>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php
                }
            ?>
        </div>
    </nav>

    <div id="app">
        <?php
            $path = __DIR__ . "/views/{$pagina}.php";

            if (empty($_SESSION['UserLogin'])){
                include (__DIR__ . '/views/login.php');
            }else{
                if (file_exists($path) && !is_dir($path)){
                    include ($path);
                }else{
                    header("Location: " . URL::getBase());
                }
            }           
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="/assets/js/app.js?v=<?= time(); ?>"></script>
</body>

</html>