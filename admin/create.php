<?php

/*
Filnamn: create.php

Filen innehåller ett formulär som skapar data och skickar till databasen.

*/

// Kollar vad som har skickat från formuläret via post.

require_once '../db.php';
require_once 'header-adm.php';





        if($_SERVER['REQUEST_METHOD']=== 'POST' && !empty($_FILES["fileToUpload"]["name"])):

        
            //print_r($_POST);
            require_once 'upload.php';
        
                 //Binda parametrar; rensar på specialtecken
                 $title = htmlspecialchars($_POST['title']);
                 //$img = htmlspecialchars($_POST['image']);
                 $text = htmlspecialchars($_POST['text']);
           
            // Skapa en SQL-sats. 
            if(!empty($title) && !empty($text)):
            $sql ="INSERT INTO blog (title, image, text, published) 
                    VALUES (:title, :image, :text, 1)";
                    //prepared statements
                    $stmt = $db->prepare($sql);
                    //Binda parametrar 
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':image', $target_file );
                    $stmt->bindParam(':text', $text);
                  
        
                    // Skicka SQL-satsen till databas-servern
                    
                    $stmt->execute();

                    header("Location: read-blog.php");

            endif;

        endif;

// header("Location: index.php");
?>
<h1 class="adm my-4">Skapa
      <small>inlägg</small>
    </h1>

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
    
    <div>
    <button type="submit" class="btn btn-success" name="submit">Lägg till</button>
    </div>

    <div>

    <a class="btn btn-danger" href="read-blog.php" role="button">Avbryt</a>
    </div>


</form>

<?php
require_once '../footer.php';
?>

