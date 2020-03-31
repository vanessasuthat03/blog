<?php

require_once '../db.php';
require_once 'header-adm.php';

$output = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="read-blog.php">Home
                                    <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="read-list.php">Blog list</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="create.php">Skapa ett inlägg</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

<div class="container">
    <div class="row">
        <div class="post col-md-8">
            <h1 class="admRubrik my-4">Välkommen <small>till adminpanelen</small></h1>';

$stmt = $db->prepare("SELECT * FROM blog ORDER BY created_at DESC");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $text = htmlspecialchars($row['text']);
    $iframe = htmlspecialchars_decode($row['iframe']);
    $image = htmlspecialchars($row['image']);
    $created_at = htmlspecialchars($row['created_at']);
    $updated_at = htmlspecialchars($row['updated_at']);
    $published = htmlspecialchars($row['published']);
    $paragraphs = explode("\n", $text);
    $knapp = "info";

    if($published == 1){
        $published = "Avpublicera";
    }else {
        $published = "Publicera";
        $knapp = "success";
    }

// card
$output .= "<div class='card mb-4'>
                <img src='$image' class=' card-img-top'>
                <div class='d-inline'>
                    <a class='readDelete  btn btn-danger'role='button' href='delete.php?id=$id'>Radera</a>
                    <a class='readUpdate  btn btn-warning' role='button' href='update.php?id=$id'>Uppdatera</a>
                    <a href='status.php?id=$id'class='readStatusBtn btn btn-$knapp'>$published</a>
                </div>
                <div class='card-body'>
                    <h2 class='card-title'>$title</h2>";


    for($i = 0; $i < count($paragraphs); $i++) {
        if(trim($paragraphs[$i]) !== "") {
            $output .= "<p class='card-text'>$paragraphs[$i]</p>";
           
        }
    }

$output .= "<div class='iframeShow'> $iframe </div>";

$output .= "</div>";

$output .= "<div class='card-footer text-muted'>Posted: $created_at Updated: $updated_at</div>
            </div>";

endwhile;
echo $output;
$output .= "</div></div>";
require_once '../footer.php';

?>

