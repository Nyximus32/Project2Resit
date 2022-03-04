<?php
    class Db{
        private $host = 'localhost';
        private $username = 'root';
        private $password = '';
        private $database = 'webshop';

        public function __construct(){
            try{
                //if it is success
                $dsn = "mysql:host={$this->host}; dbname={$this->database}";
                $option = array(PDO::ATTR_PERSISTENT);

                $this->db = new PDO($dsn,$this->username,$this->password, $option,);

            } catch(PDOException $e){
                //if it is getting any error
                echo "Connection Error: " . $e->getMessage();
            }
    }
    }
?>