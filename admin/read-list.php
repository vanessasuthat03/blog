<?php

require_once '../db.php';
require_once 'header-adm.php';


$sql = "SELECT * FROM blog";
$stmt = $db->prepare($sql);
$stmt->execute();

$output = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link" href="read-blog.php">Home
        </a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="read-list.php">Blog list
        <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Skapa ett inlägg</a>
      </li>
    </ul>
  </div>
</div>
</nav>

 
<div class="list container">
  <div class="listRow">
    <div class="post col-md-12">
      <h1 class="admRubrik my-4">Välkommen
        <small>till adminpanelen</small>
      </h1>';
echo $output;

$table = '<table class="table">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Rubrik</th>
              <th scope="col">Inlägg</th>
              <th scope="col">Status</th>
              <th scope="col">Redigering</th>
              <th scope="col">Radera</th>
            </tr>';

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

  $id = htmlspecialchars($row['id']);
  $title =htmlspecialchars($row['title']);
  $text = htmlspecialchars($row['text']);
  $published = htmlspecialchars($row['published']);
  $knapp = "info";

  $text = strip_tags($text);
    if (strlen($text) > 50) {
      $cutString = substr($text, 0, 50);
      $endString = strrpos($cutString, ' ');

      $text = $endString? substr($cutString, 0, $endString) : substr($cutString, 0);
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
              </td>

              <td>
                <a href='update.php?id=$id'
                  class='listUpdateBtn btn btn-warning'>
                  Uppdatera
                </a>
              </td>

              <td>
                <a href='delete.php?id=$id'
                  class='listDeleteBtn btn btn-danger'>
                  Ta bort
                </a>
              </td>
            </tr>";
}

$table .= '</table>';
echo $table;

require_once '../footer.php';

?>