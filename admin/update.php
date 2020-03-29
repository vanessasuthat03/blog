

<?php

require_once '../db.php';
require_once 'header-adm.php';

// Raderar bild url från databas och mappen

// if(isset($_GET['id'])){

//     $id = $_GET['id']; 

//     $id = htmlspecialchars($_GET['id']);
//     $sql = "SELECT * FROM blog WHERE id = :id";
//         $stmt = $db->prepare($sql);
//         $stmt->bindParam(":id", $id);
//         $stmt->execute();

//         $row = $stmt->fetch(PDO::FETCH_ASSOC);
//         $image = $row['image'];
//         $link ="$image";

//         unlink($link);

//         $sql = "DELETE FROM blog WHERE id = :id";
//         $stmt = $db->prepare($sql);
//         $stmt->bindParam(':id', $id);
//         $stmt->execute();

// }

        // Test

if(isset($_GET['id'])){
    $id = htmlspecialchars($_GET['id']);
    $sql ="SELECT * FROM blog WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
      
    if($stmt->rowCount()>0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = $row['title'];
        $text = $row['text'];
        $image = $row['image'];
      }else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
      }
}else{
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once 'upload.php';

    $title = htmlentities($_POST['title']);
    $text  = htmlentities($_POST['text']);
    $id   = htmlentities($_POST['id']);
    $updated_at = htmlspecialchars($row['updated_at']);
    $link = ($_POST['image']);
    //$image = htmlspecialchars($_POST['image']);
  
    $sql = "UPDATE blog
            SET title = :title, text = :text, image = :image, updated_at = :updated_at
            WHERE id = :id";
  
    $stmt = $db->prepare($sql);
  
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':text' , $text);
    $stmt->bindParam(':id'  , $id);
    $stmt->bindParam(':image', $target_file );
    $stmt->bindParam(':updated_at', $updated_at);
  
    $stmt->execute();
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    header('Location: read-blog.php');
    exit;
  }

  // jimmy
//   if(isset($_GET['update'])){
// echo "vi är här";
//   }
  
 
?>



<h1 class="adm my-4">Uppdatera 
      <small>inlägg</small>
    </h1>



<form action="#"  method="POST" enctype="multipart/form-data">

    <div class="form-group">
    <label for="fileToUpload"><?php echo "<img src='$image' class='imgUpdate card-img-top'>" ?></label>
    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
    </div>

    <div class="form-group">
    <input type="text" value="<?php echo $title ?>"class="form-control" name="title" required>
    </div>

    <div class="form-group">
    <textarea 
    name="text" 
    id="" 
    type="text" 
    class="form-control"  
    cols="30" 
    rows="10"  
    ><?php echo $text ?></textarea>
    </div>

    <div>
        <input
        type="submit"
        value="Uppdatera"
        class="upDateBtn btn btn-danger">
  
    </div>


    <div>
        <a href="read-list.php"
        class="noUpdateBtn btn btn-success" >
        Avbryt
        </a>

    </div>
   
        <input
        type="hidden"
        name="id"
        value="<?php echo $id; ?>">

        <input
        type="hidden"
        name="updated_at"
        value="<?php echo $updated_at; ?>">
  


      
</form>

<?php
require_once '../footer.php';


?>




