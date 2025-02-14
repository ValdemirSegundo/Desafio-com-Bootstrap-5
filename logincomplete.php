<?php

//Tela de saudação


session_start();

//Verifica se há alguma sessão ativa. Se existe, execute o html. Se não existe, volte para o index
if (array_key_exists('logged',$_SESSION) ) 
{

?><!DOCTYPE html>
<html lang="en" data-bs-theme="dark" class="w-25">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleLoginComplete.css">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary h-100">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <main class="w-100 m-auto form-container">
        <form action="/ExecuteLogout.php" method="post">>
            <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" class="mb-4" height="57" width="72"/>
            <h1 class="h3 mb-3 fw-normal">Bem vindo!!</h1>
            
            <h3>você está conectado <?php 
                                        if (isset($_SESSION['username']))
                                        {
                                            echo ", " . $_SESSION['username'];
                                        }  ?></h3>
            <button class="btn btn-primary w-100 py-2">Logout</button>

       
        </form>
    </main>

</body>
</html>

<?php 
    }
    else
    {
        header('location: /index.php?SemSessao');
    } ?>