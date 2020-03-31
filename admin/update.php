
<?php

require_once '../db.php';
require_once 'header-adm.php';

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
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        echo "från update andra ifen";
        exit;
      }
}else{
    // header('Location: ' . $_SERVER['HTTP_REFERER']);
    echo "från update första ifen";
    exit;
 }


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    require_once 'upload.php';

 


    $title = htmlspecialchars($_POST['title']);
    $text  = htmlspecialchars($_POST['text']);
    $id   = htmlspecialchars($_POST['id']);
    $image = htmlspecialchars($row['image']);
    $iframe = strip_tags($_POST['iframe'], '<iframe>');

  
    $sql = "UPDATE blog
            SET title = :title, text = :text, image = :image, iframe = :iframe
            WHERE id = :id";


  
    $stmt = $db->prepare($sql);
  
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':text' , $text);
    $stmt->bindParam(':id'  , $id);
    $stmt->bindParam(':image', $target_file );
    $stmt->bindParam(':iframe', $iframe);
  
    $stmt->execute();
  
    header('Location: read-blog.php');
    exit;
  }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="read-blog.php">Home</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="read-list.php">Blog list
                        <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create.php">Skapa ett inlägg</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="list container">
    <div class="row">
        <div class="post col-md-8">
            <h1 class="admRubrik my-4">Välkommen<small>till adminpanelen</small></h1>
            <h2 class="adm my-4">Uppdatera <small>inlägg</small></h2>

<form action="#"  method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="fileToUpload"><?php echo "<img src='$image' class='imgUpdate card-img-top'>" ?></label>
        <input 
            type="file" 
            class="form-control" 
            name="fileToUpload" i
            d="fileToUpload">
    </div>

    <div class="form-group">
        <input 
            type="text" 
            value="<?php echo $title ?>"
            class="form-control" 
            name="title" 
            required>
    </div>

    <div class="form-group">
        <textarea 
            name="text" 
            id="" 
            type="text" 
            class="form-control"  
            cols="30" 
            rows="10">
            <?php echo $text ?>
        </textarea>
    </div>

    <div class="form-group">
        <label for="iframe">iFrame (optional)</label><br>
        <textarea 
            class="iframeCreate" 
            name="iframe" 
            placeholder="Put your iframe-code here">
        </textarea>
    </div>

    <div>
        <input
            type="submit"
            value="Uppdatera"
            class="upDateBtn btn btn-danger">
    </div>

    <div>
        <a href="javascript:history.go(-1)"
        class="noUpdateBtn btn btn-success" >
        Avbryt
        </a>
    </div>
   
    <input
        type="hidden"
        name="id"
        value="<?php echo $id; ?>">

</form>

<?php
require_once '../footer.php';
?>




