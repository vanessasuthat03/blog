<?php
/*****
 * Filen hämtar en tabell från databasen
*/
require_once '../db.php';
require_once 'header-adm.php';


$sql = "SELECT * FROM blog";
$stmt = $db->prepare($sql);
$stmt->execute();

$head = '<h1 class="adm my-4">Lista <small>på alla inlägg</small></h1>';

$table = '<table class="table">';
$table .= '<tr>
            <th>Id</th>
            <th>Rubrik</th>
            <th>Inlägg</th>
            <th>Status</th>
           
          </tr>';
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  // test
  // print_r($row);

  $id = htmlspecialchars($row['id']);
  $title =htmlspecialchars($row['title']);
  $text = htmlspecialchars($row['text']);
  $published = htmlspecialchars($row['published']);
  $knapp = "info";
  // $status = $row['published'];
  // $status = "<button class='status' value='1"

  $text = strip_tags($text);
  if (strlen($text) > 100) {
    $cutString = substr($text, 0, 100);
    $endString = strrpos($cutString, ' ');

    $text = $endString? substr($cutString, 0, $endString) : substr($cutString, 0);
    // $text .= '...   <a class="btn btn-primary" href="view.php" role="button">Läs mer</a>';
    $text .= '...';
  }

 
  if($published == 1){
    $published = "Avpublicera";
  
}else {
    $published = "Publicera";
    $knapp = "success";
}
 
  $table .= "<tr>
              <td> $id </td>
              <td> $title </td>
              <td> $text </td>
          
              <td>

              <a href='status.php?id=$id'
              class='listStatusBtn btn btn-$knapp'>
              $published
              </a>

              <a href='update.php?id=$id'
              class='listUpdateBtn btn btn-warning'>
              Uppdatera
              </a>
              <a href='delete.php?id=$id'
              class='listDeleteBtn btn btn-danger'>
              Ta bort
              </a>
              </td>
            </tr>";
}



$table .= '</table>';
echo $head;
echo $table;

require_once '../footer.php';

?>