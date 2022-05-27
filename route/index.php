<?php
session_start();
ob_start();

require(__DIR__ . '/../app/Url.php');
$route = URL::getURL(0);
$exception = ['login', 'sigin'];

if (!empty($_SESSION['UserLogin']) || in_array($route, $exception)) {
    header("Content-Type: application/json; charset=UTF-8");

    require_once(__DIR__ . '/../app/conexao/conexao.php');
    require(__DIR__ . '/../app/User.php');
    require(__DIR__ . '/../app/Post.php');
    require(__DIR__ . '/../app/Comments.php');

    $dados = (!empty(filter_input_array(INPUT_POST)) ? filter_input_array(INPUT_POST) : filter_input_array(INPUT_GET));

    if (!empty($route)) {
        switch ($route) {
            case 'sigin':
                (new User())->insert($dados);
                break;
            case 'login':
                (new User())->login($dados);
                break;
            case 'post':
                echo json_encode((new Post())->get(URL::getURL(1)));
                break;
            case 'post-create':
                (new Post())->insert($dados);
                break;
            case 'post-update':
                (new Post())->update($dados);
                break;
            case 'post-destroy':
                (new Post())->destroy(URL::getURL(1));
                break;
            case 'comment-create':
                (new Comments())->insert($dados);
                break;
        }
    }
}else{
    http_response_code(403);
}