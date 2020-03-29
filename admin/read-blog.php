<?php

require_once '../db.php';
require_once 'header-adm.php';


// Hämta alla posts
$stmt = $db->prepare("SELECT * FROM blog ORDER BY create_at DESC");
$stmt->execute();

//Published
// public function publish($id) {
   
// }


$output =  '<h1 class="adm my-4">Välkommen <small>till adminpanelen</small></h1>';


$output .= "<div class='card mb-4'>";


while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $text = htmlspecialchars($row['text']);
    $image = htmlspecialchars($row['image']);
    $create = htmlspecialchars($row['create_at']);
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


    $output .= 
"<img src='$image' class=' card-img-top'><br>

<a class='readDelete  btn btn-danger'role='button' href='delete.php?id=$id'>Radera</a>
<a class='readUpdate  btn btn-warning' role='button' href='update.php?id=$id'>Uppdatera</a>
<a href='status.php?id=$id'class='listStatusBtn 
 btn btn-$knapp'>$published</a>";
// <button class='listStatusBtn btn btn-$knapp'>$published</button>";


    $output .= "<div class='card-body'>
    <h2 class='card-title'>$title</h2>";
    
    for($i = 0; $i < count($paragraphs); $i++) {
        if(trim($paragraphs[$i]) !== "") {
            $output .= "<p class='card-text'>$paragraphs[$i]</p>";
           
        }
    }
$output .= "</div>";
    $output .= "<div class='card-footer text-muted'>Posted: $create Updated: $updated_at</div>";

endwhile;

$output .= "</div>";



?>
  
<?php echo $output; 
echo $updated_at;

require_once '../footer.php';
?>
</body>
</html>