<?php

class Connection
{
   public $servername = 'localhost';
   public $username = 'root';
   public $dbname = 'rendez-vous';
   public $password = '';
   protected $sql;

   function __construct()
   {

      try {

         $this->sql = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
      } catch (PDOException $e) {

         echo "connection failde: " . $e->getMessage();
      }
   }
}
