<?php

require_once 'db.php';


// Hämta alla posts
$stmt = $db->prepare("SELECT * FROM blog WHERE published ORDER BY create_at DESC");

//test
// $sql = "SELECT * FROM blog WHERE published=true ORDER BY create_at DESC";
//
$stmt->execute();


    


$output = "<div class='card mb-4'>";


while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $text = htmlspecialchars($row['text']);
    $image = htmlspecialchars($row['image']);
    // $image = $row['image'];
    $create = htmlspecialchars($row['create_at']);
    $published = htmlspecialchars($row['published']);
    $paragraphs = explode("\n", $text);

    $image = str_replace("../", "", $image);
    // echo $image;

    $output .= 
"<img src='$image' class='card-img-top'>";

    $output .= "<div class='card-body'>
    <h2 class='card-title'>$title</h2>";
    
    for($i = 0; $i < count($paragraphs); $i++) {
        if(trim($paragraphs[$i]) !== "") {
            $output .= "<p class='card-text'>$paragraphs[$i]</p>";
           
        }
    }
$output .= "</div>";
echo $image;
endwhile;

$output .= "</div>";

?>
  
<?php echo $output; 
require_once 'footer.php';
?>
</body>
</html>