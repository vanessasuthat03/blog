<?php

/*
Filnamn: create.php
Författare: Vanessa Suthat
Date: 2020-03-04

Filen innehåller ett formulär som skickar data till databasen.


*/



// Kollar vad som har skickat från formuläret via post.

if($_SERVER['REQUEST_METHOD']=== 'POST'):
    print_r($_POST);

    // skicka data till sql
    // INSERT INTO "namn på tabellen i myadmin" (name, tel)

    // Skapa en SQL-sats. Första raden: name och tel i myadmin tabellen. Andra raden: det som ska skickas från formen.
    $sql ="INSERT INTO blog (title, text) 
            VALUES (:title, :text)";
            //prepared statements
            $stmt = $db->prepare($sql);

            //Binda parametrar; rensar på specialtecken
            $title = htmlspecialchars($_POST['title']);
            $text = htmlspecialchars($_POST['text']);

            //Binda parametrar 
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':text', $text);

            // Skicka SQL-satsen till databas-servern
            $stmt->execute();

    

endif;

?>

<form action="#" method="POST">

<div class="row">

    <div class="col-md-5">
    <input type="text" placeholder="Ange namn" class="form-control mb-3" name="title">
    </div>

    <div class="col-md-5">
    <input type="text" placeholder="Ange telenummer" class="form-control mb-3" name="text">
    </div>
    
    <div class="col-md-2">
    <input type="submit" value="Lägg till" class=" mb-3 btn btn-outline-primary btn-block" name="submit">
    </div>

</div>


</form>