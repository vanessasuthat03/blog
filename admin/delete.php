  
<?php

/**************************************
 * 
 * delete.php
 
 * 1. Filen tar bort en rad från databasen
 *    med hjälp av ett id
 *************************************/

require_once '../db.php';

// if($_SERVER["REQUEST_METHOD"]=== "GET"){
    if(isset($_GET['id'])){

        $id = $_GET['id']; 
      
        $sql = "SELECT * FROM blog WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $image = $row['image'];
        $link ="$image";
        // if (!unlink($link)) {
        //     echo "nope";
        // }else {
        //     echo "$link";
        // }

        unlink($link);
      
      
      
        $sql = "DELETE FROM blog WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
      
      }

// }


header("Location: read-blog.php");


?>