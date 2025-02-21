<?php

require_once __DIR__ . '\SessionManager.php';

class LoginHandler
{

    //Método responsável por verificar o login e executar
    public function VerifyLogin(DatabaseConnection $database ,string $email, string $password)
    {
        $realPassword = $password;

        //transforma o password do usuário em criptografia hash
        #$hash = password_hash($password, PASSWORD_ARGON2I);

        //bloco usado para evitar SQL Injection
        $sql = 'SELECT * FROM users WHERE username = ?;';
        $statement = $database->GetPDO()->prepare($sql);
        $statement->bindValue(1, $email);
        
        //Se não houver SQL Injection
        if ($statement->execute())
        {
            //Recupera o array da busca do banco de dados
            $userList = $statement->fetchAll(PDO::FETCH_ASSOC);

            //Para cada item, se houver email, e a senha for igual
            foreach ($userList as $user) {
                if($user['username'] == $email && password_verify($realPassword,$user['password']))
                {                   
                    session_start();

                    if (empty($user['session_token'])) 
                    {
                        $session = new SessionManager();
                        $token = $session->CreateCookieInDatabase($database, $user['username']);
                    }
                    else 
                    {
                        $token = $user['session_token'];
                    }

                    setcookie('session_token', $token, time() + (86400 * 30), '/', '', false, true);

                    $_SESSION['username'] = $user['username'];
                    header('location: /logincomplete.php?email=' .$_SESSION['username']);
                     
                    exit();
                }
            }
        
            header('location: /index.php?sucesso=0');
            exit();
        }
        else
        {
            header('location: /index.php?sucesso=2');
            exit();
        }
    }

    //Função responsável pelo Logout do usuário
    public function Logout(DatabaseConnection $database)
    {
        $session = new SessionManager();
        session_start();

        if (isset($_SESSION['username']))
        {
            $statement = $database->GetPDO()->prepare("UPDATE users SET session_token = NULL WHERE username = ?");
            #$statement->bindValue(1, $_SESSION['username']);
            $statement->execute([$_SESSION['username']]);

        }
        
        $session->EndSession();
        
        header('location: /index.php?LogoutConcluido');
    }

}