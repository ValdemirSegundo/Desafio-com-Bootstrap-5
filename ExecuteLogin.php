<?php

require __DIR__ . '\DBConnection.php';
require __DIR__ . '\LoginHandler.php';

//Cria Conexão com database
$database = new DatabaseConnection();
$database->ConnectToDatabase();

//cria um novo login
$login = new LoginHandler();

//Recupera o email e senha digitado na tela de login e filtra
$email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST,'password');

//verifica se o login e senha foram digitados conforme a sintaxe correta
if($email == false && $password == false)
{
    header('location: /index.php?email-senhainvalido=0');
    exit();
}

//Executa a verificação de login para validação, no LoginHandler.php
$login->VerifyLogin($database, $email, $password);




