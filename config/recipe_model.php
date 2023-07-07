<?
require('db_connect.php');

class Recipe_model extends DB_connect{
  
  public function __construct()
  {
    parent::__construct();
  }

  //ここから
  public function view_recipe(){
    // try{
    //   $sql = 'select * from user where id = :id';
    //   $stmt = $this->pdo->prepare($sql);
    //   $stmt->bindValue(':id',$id);
    //   $stmt->execute();
    //   $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //   return $result;
    // }catch(PDOException $e){
    //   echo "エラーが発生しました".$e->getMessage();
    // }
  }

  public function create_recipe(){

  }

  public function delete_recipe(){

  }

}
