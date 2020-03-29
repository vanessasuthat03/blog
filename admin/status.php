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
        $published = $row['published'];
       
        // $unpublish = "$status";

        if ($row['published']== 1){
           
            $published = "0";
           

            $sql = "UPDATE blog
            SET published = :published
            WHERE id = :id";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':published', $published);


        }else if($row['published']== 0){
            $published = "1";
            $sql = "UPDATE blog
            SET published = :published
            WHERE id = :id";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':published', $published);
        }else {
            echo "Error från status";
        }
        $stmt->execute();
      }

 }
// header("Location:javascript://history.go(-1)");
header('Location: ' . $_SERVER['HTTP_REFERER']);

// header("Location: read-list.php");
// header("Location: read-blog.php");


?>