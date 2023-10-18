<?php

namespace core\classes;

use PDO;
use PDOException;

class Database
{
    private $conn;
    
    private function conectar(){
        $this->conn = new PDO(
            'mysql:'.
            'host='.MYSQL_SERVER.';'.
            'dbname='.MYSQL_DATABASE.';'.
            'charset='.MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );
    }

    private function desconectar(){
        $this->conn = null;
    }

    public function select($sql, $parametros = null) {
        $this->conectar();

        $result = null;

        try {

            if(!empty($parametros)){
                $exec = $this->conn->prepare($sql);
                $exec->execute($parametros);
                $result =  $exec->fetchAll(PDO::FETCH_CLASS);
            }
            
        } catch (PDOException $e) {
            
            return false;
        }


        $this->desconectar();
    }


}
