<?php
try {
  $db = new PDO("mysql:host=localhost;dbname=ToDoList;", "root", "root");
  $db->query("SET CHARACTER SET uf8");
} catch ( PDOException $e ){
  print $e->getMessage();
}
 ?>
