<?php

require_once '../db.php';
require_once 'header-adm.php';



        if($_SERVER['REQUEST_METHOD']=== 'POST' && !empty($_FILES["fileToUpload"]["name"])):
            require_once 'upload.php';
                
                 $title = htmlspecialchars($_POST['title']);
                 $text = htmlspecialchars($_POST['text']);
                 $iframe = strip_tags($_POST['iframe'], '<iframe>');
                 $iframe = htmlspecialchars($iframe);
           
            if(!empty($title) && !empty($text)):
              $sql ="INSERT INTO blog (title, image, text, published, iframe) 
                      VALUES (:title, :image, :text, 1, :iframe)";
                    
                    $stmt = $db->prepare($sql);
                    
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':image', $target_file );
                    $stmt->bindParam(':text', $text);
                    $stmt->bindParam(':iframe', $iframe);
                    
                    $stmt->execute();
                    header("Location: read-blog.php");

            endif;

        endif;
        $output = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="read-blog.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="read-list.php">Blog list</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="create.php">Skapa ett inlägg
                <span class="sr-only">(current)</span></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

<div class="container">
<div class="row">
  <div class="post col-md-8">
    <h1 class="admRubrik my-4">Välkommen
      <small>till adminpanelen</small></h1>';

echo $output;
?>

<h2 class="adm my-4">Skapa<small>inlägg</small></h2>

<form action="#"  method="POST" enctype="multipart/form-data">

  <div class="form-group">
      <label for="fileToUpload"> Select image to upload:</label>
      <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
  </div>

  <div class="form-group">
    <input type="text" placeholder="Ange rubrik till inlägget" class="form-control" name="title" required>
  </div>

  <div class="form-group">
    <textarea name="text" id="" class="form-control"  cols="30" rows="10" placeholder="Skriv ditt inlägg här..." required ></textarea>
  </div>

  <div class="form-group">
      <label for="iframe">iFrame (optional)</label><br>
  <textarea class="iframeCreate" name="iframe" placeholder="Put your iframe-code here"></textarea>
  </div>
    
  <div>
    <button type="submit" class="btn btn-success" name="submit">Lägg till</button>
  </div>

    <div>
      <a class="avbrytBtn btn btn-danger" href="read-blog.php" role="button">Avbryt</a>
    </div>

</form>

<?php
require_once '../footer.php';
?>

