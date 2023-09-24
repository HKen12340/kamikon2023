<?php
if(!class_exists('DB_connect')){
  abstract class DB_connect{
    const DNS = 'mysql:host=localhost;dbname=ccr_db'; 
    const DB_USER = 'root';
    const PASS = '';
    protected $pdo;
    
    public function __construct()
    {
      try{
        $this->pdo = new PDO(self::DNS,self::DB_USER,self::PASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->pdo->query('SET NAMES utf8');  
      }catch(PDOException $e){
        print('エラーが発生しています:'.$e->getMessage());
        die();
      }
    }
  }
}
