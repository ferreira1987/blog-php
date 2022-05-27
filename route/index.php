<?php
header("Content-Type: application/json; charset=UTF-8");  

session_start();
ob_start();

require(__DIR__ . '/../app/Url.php');
require(__DIR__ . '/../app/User.php');

$route = URL::getURL(0);
$dados = (!empty(filter_input_array(INPUT_POST)) ? filter_input_array(INPUT_POST) : filter_input_array(INPUT_GET));

if(!empty($route)){
    switch($route){
        case 'sigin':
            (new User())->insert($dados);
        break;
        case 'login':
            (new User())->login($dados);
        break;
    }
}


