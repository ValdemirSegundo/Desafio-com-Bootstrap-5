<?php

class SessionManager
{
    public function SessionExists(DatabaseConnection $database) : bool
    {
        //Conecte-se ao banco. Se a conexão com o banco de dados estiver estabelecida, prossiga
        if($database->ConnectToDatabase())
        {
            if (!isset($_SESSION['username']) && isset($_COOKIE['session_token'])) {
                $stmt = $database->GetPDO()->prepare("SELECT username FROM users WHERE session_token = ?");
                $stmt->execute([$_COOKIE['session_token']]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
                if ($user) 
                {
                    $_SESSION['username'] = $user['username'];
                    return true;
                } 
                else 
                {
                    setcookie('session_token', '', time() - 3600, '/'); // Cookie inválido
                    return false;
                }
            }
            elseif (isset($_SESSION['username'])) 
            {
                return true;
            } 
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    public function CreateCookieInDatabase(DatabaseConnection $database, string $username) : string
    {
    
        $token = bin2hex(random_bytes(32)); // Token seguro
        $stmt = $database->GetPDO()->prepare("UPDATE users SET session_token = ? WHERE username = ?");
        $stmt->execute([$token, $username]);
        /*
        else 
        {
            $token = $user['session_token'];
        }*/

        return $token;
    }

    public function EndSession() : void
    {
        setcookie('session_token', '', time() - 3600, '/');

        session_unset();
        session_destroy();
    }
}



