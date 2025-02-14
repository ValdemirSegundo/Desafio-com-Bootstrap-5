<?php


//Arquivo PHP utilizado apenas para criar usuário custom.
//Funciona de forma independente
//Instruções de uso no Terminal: php CreateUser.php "Email-escolhido@email.com" "senha-de-sua-escolha"


require __DIR__ .'/DBConnection.php';

//Cria a conexão com o database
$database = new DatabaseConnection();
$database->ConnectToDatabase();

//recupera o input digitado no terminal do email e senha seguindo o padrão
$email = $argv[1];
$password = $argv[2];

//cria o hash para a senha
$hash = password_hash($password , PASSWORD_ARGON2I);

//Insere no database o email e a senha
$sql = 'INSERT INTO users (username, password) VALUES (?,?);';

//Bloco que previne SQL Injection
$statement = $database->GetPDO()->prepare($sql);
$statement->bindValue(1,$email);
$statement->bindValue(2,$hash);

$statement->execute();
