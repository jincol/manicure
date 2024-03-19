<?php

$server = $_ENV['DB_HOST'];
$nombre = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

$db = mysqli_connect($_ENV['DB_HOST'],$_ENV['DB_USER'], $_ENV['DB_PASS'],$_ENV['DB_NAME']);

$db->set_charset('utf8');

if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}

