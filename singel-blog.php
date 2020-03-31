<?php

require_once 'db.php';
require_once 'header.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql ="SELECT * FROM blog WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

$output = "<div class='card mb-4'>";

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

    $image = str_replace("../", "", $image);

    $output .= "<img src='$image' class='card-img-top'>";
    $output .= "<div class='card-body'>
                    <h2 class='card-title'>$title</h2>";

    
    for($i = 0; $i < count($paragraphs); $i++) {
        if(trim($paragraphs[$i]) !== "") {
            $output .= "<p class='card-text'>$paragraphs[$i]</p>";
           
        }
    }

$output .= "<div class='iframeShow'> $iframe </div>";
$output .=  "<a class='backBtn  btn btn-primary' role='button' href='index.php'>Tillbaka</a>
            </div>
            <div class='card-footer text-muted'>Posted: $created_at Updated: $updated_at</div>";

endwhile;

$output .= "</div>";
echo $output; 
require_once 'footer.php';

?>
  