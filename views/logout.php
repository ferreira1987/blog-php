<?php

if(isset($_SESSION['UserLogin'])){
    session_destroy();
    header("Location: /");
    exit();
}