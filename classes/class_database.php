<?php
/**
 * Created by PhpStorm.
 * User: slicer
 * Date: 07.10.16
 * Time: 15:56
 */

class Database {
    private $pdo;
    
    public function __construct($connection) {

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $this->pdo = new PDO($connection, "root", "root", $options);

    }
    
    public function query($string) {

        return $this->pdo->query($string);

    }

    public function getColumn($string) {
        
        $res = $this->query($string);
        return $res->fetchColumn();

    }
}