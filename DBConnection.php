<?php

class DatabaseConnection
{

    //Dados do Banco de Dados postgreSQL utilizados neste projeto

    //Endereço do BD
    private $address = "localhost";
    //Nome do BD
    private $databaseName = "Valdemir";
    //Usuário do BD
    private $username = "postgres";
    //Senha do BD
    private $password = "MyDatabase747";

    private $pdo;
    
    //Método responsável por fazer a conexão com o Banco de Dados
    public function ConnectToDatabase() : bool
    {
        try {
            $this->pdo = new PDO("pgsql:host=$this->address; port=5432; dbname=$this->databaseName",$this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
            return false;
        }      
    }

    //Método responsável por recuperar o objeto PDO
    public function GetPDO() : PDO
    {
        return $this->pdo;
    }
    
}
