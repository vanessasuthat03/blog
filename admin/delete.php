  
<?php

require_once '../db.php';

 if($_SERVER["REQUEST_METHOD"]=== "GET"){
    if(isset($_GET['id'])){

        $id = $_GET['id']; 
      
        $sql = "SELECT * FROM blog WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $row['image'];
        unlink($image);
      
        $sql = "DELETE FROM blog WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
      
      }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>