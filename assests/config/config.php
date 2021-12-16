<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of config
 *
 * @author Admin
 */
class Database {

    //put your code here
    private $con;

    public function db_connect() {
        include 'db.php';
        $this->con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->con) {
            return $this->con;
        }
        return "DATABASE_CONNECTION_FAIL";
    }

}

?>