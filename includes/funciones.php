<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

//LOGEADO
function isAdmin(){
    session_start();

    if(!$_SESSION['admin']){
        header('Location: /login');
    }
}

function isAuth(){

    if(!isset($_SESSION['login'])){
        header('Location: /login');
    }
}