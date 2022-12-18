<?php

class DB{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    /**
     * Constructor para asignar las varibales y sus valores
     * a lo que utilizara la coneccion a la base de datos
     */
    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'casa_quinta_db';
        $this->user = 'root';
        $this->password = '';
        $this->charset  = 'utf8mb4';
    }

    /**
     * Funcion para conectarse a la base de datos y poder
     * realizar las Querys al servidor.
     */
    function connect()
    {
        try{

            
            $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            //$pdo = new PDO($connection, $this->user, $this->password, $options);
            $pdo = new PDO($connection,$this->user,$this->password);
        
            return $pdo;


        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
        }   
    }
}
?>