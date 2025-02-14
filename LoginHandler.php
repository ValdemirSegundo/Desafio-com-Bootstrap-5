<?php


class LoginHandler
{
    //Método responsável por verificar o login e executar
    public function VerifyLogin(DatabaseConnection $database ,string $email, string $password)
    {
        $realPassword = $password;

        //transforma o password do usuário em criptografia hash
        $hash = password_hash($password, PASSWORD_ARGON2I);

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
                    //Se não existir sessão ativa
                    if (!array_key_exists('logged',$_SESSION))
                    {
                        $_SESSION['logged'] = true;
                        $_SESSION['username'] = $user['username'];
                        header('location: /logincomplete.php?email=' .$_SESSION['username']);
                    }
                    else
                    {
                        $_SESSION['username'] = $user['username'];
                        header('location: /logincomplete.php?email=' .$_SESSION['username']);
                    }
                    
                    
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
    public function Logout()
    {
        session_start();
        session_destroy();
        header('location: /index.php?LogoutConcluido');
    }

}