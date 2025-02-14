<?php

require_once __DIR__ . '\DBConnection.php';

//Cria conexão com Database
$database = new DatabaseConnection();
$database->ConnectToDatabase();

//Verifica se há alguma sessão ativa. Se existe, vá direto para tela de saudação. Se não existe, execute todo o html
session_start();
if (array_key_exists('logged',$_SESSION))
{
    header('location: /logincomplete.php?email=' .$_SESSION['username']);
    exit();
}
else
{

?><!DOCTYPE html>
<html lang="en" data-bs-theme="dark" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary h-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <main class="w-100 m-auto form-container">
        <form action="/ExecuteLogin.php" method="post">
            <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" class="mb-4" height="57" width="72"/>
            <h1 class="h3 mb-3 fw-normal">Formulário de Login</h1>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="your-email@gmail.com">
                <label for="floatingInput">Email</label>
            </div>
            
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="password">
                <label for="floatingInput">Password</label>
            </div>
            
            <button class="btn btn-primary w-100 py-2">Sign In</button>

            <p class="text-body-secondary mt-5 mb-3">© Desafio SS Digital - 2025</p>
       
        </form>
    </main>

</body>
</html>
<?php } ?>