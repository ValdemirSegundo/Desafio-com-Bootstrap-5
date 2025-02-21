<?php

require __DIR__ . '\DBConnection.php';
require __DIR__ . '\LoginHandler.php';

//Cria conexão com banco de dados
$database = new DatabaseConnection();
$database->ConnectToDatabase();

//Cria instância do LoginHandler
$login = new LoginHandler();

//Executa Logout
$login->Logout($database);