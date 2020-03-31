<?php

require_once 'db.php';

// Hämta alla posts som är published
$stmt = $db->prepare("SELECT * FROM blog WHERE published ORDER BY created_at DESC");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id = htmlspecialchars($row['id']);
    $title = htmlspecialchars($row['title']);
    $text = htmlspecialchars($row['text']);
    $image = htmlspecialchars($row['image']);
    $created_at = htmlspecialchars($row['created_at']);
    $updated_at = htmlspecialchars($row['updated_at']);
    $published = htmlspecialchars($row['published']);
    $paragraphs = explode("\n", $text);
    $image = str_replace("../", "", $image);

// Card
    $output = "<div class='card mb-4'>
                    <img src='$image' class='card-img-top'>
                    <div class='card-body'>
                        <h2 class='card-title'>$title</h2>";

                    for($i = 0; $i < count($paragraphs); $i++) {
                        if(trim($paragraphs[$i]) !== "") {
                            $text = "<p class='card-text'>$paragraphs[$i]</p>";          
                        }
                    }

                    if (strlen($text) > 200) {
                        $cutText = substr($text, 0, 200);
                        $endPoint = strrpos($cutText, ' ');
                            
                        $text = $endPoint? substr($cutText, 0, $endPoint) : substr($cutText, 0);
                        $text .= '...';
                       
                    } 

    $output .=          "<p class='card-text'>$text</p>
                        <a class='readMore  btn btn-primary' role='button' href='singel-blog.php?id=$id'>Läs mer</a>
                    </div>
                    <div class='card-footer text-muted'>Posted: $created_at Updated: $updated_at</div>
                </div>";
                
echo $output;
endwhile; 

// $output .= "</div>";
// $output .=   "</div>";   
require_once 'footer.php';
?>
