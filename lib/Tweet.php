<?php
require_once("DB.php");
class Tweet
{

  private $dbh;
  public function __construct()
  {
    $db = new DB;
    $this->dbh = $db->getDBHandler();
    date_default_timezone_set('Asia/Tokyo');
  }

  public function create(string $content, ?int $parent_id = null): bool
  {
    session_start();
    $request_method = $_SERVER["REQUEST_METHOD"];
    if ($request_method === "POST") {
      if (is_null($parent_id)) {
        $sql = 'INSERT INTO tweets(user_id, content, created_at) VALUES(:user_id, :content, :created_at)';
      } else {
        $sql = 'INSERT INTO tweets(user_id, content, parent_id, created_at) VALUES(:user_id, :content, :parent_id, :created_at)';
      }
      $prepare = $this->dbh->prepare($sql);
      // どの箱に何を入れるか
      $prepare->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
      $prepare->bindValue(':content', $content, PDO::PARAM_STR);
      if (!is_null($parent_id)) {
        $prepare->bindValue(':parent_id', $parent_id, PDO::PARAM_INT);
      }
      $prepare->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
      $prepare->execute();
      return true;
    }
    return false;
  }
  public function getRecords(): array
  {
    $sql = 'SELECT `tweets`.*, 1 AS is_parent, id AS sort_key
            FROM `tweets`
            WHERE parent_id IS NULL
    
            UNION 
    
            SELECT `tweets`.*, 0 AS is_parent, parent_id AS sort_key
            FROM `tweets`
            WHERE parent_id IS NOT NULL
    
            ORDER BY sort_key, is_parent DESC';

    $prepare = $this->dbh->prepare($sql);
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
// user_idからnameデータを選んで取り出す
  public function getUserName($id){
    $sql = 'SELECT * FROM users WHERE id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function getRecord($id)
  {
    $sql = 'SELECT * FROM tweets WHERE id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  public function delete($id)
  {
    $sql = 'DELETE FROM tweets WHERE id = :id OR parent_id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
  }
  
  public function favorite($id)
  {
    $sql = 'UPDATE tweets SET favorites_count = favorites_count + 1 WHERE id = :id';
    $prepare = $this->dbh->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_INT);
    $prepare->execute();
  }
}


