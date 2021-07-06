<?php
require 'db.php';

$data = file_get_contents('php://input');
$param = $_POST['param'];

switch($param){
  case 'del':
    $id = $_POST['id'];
    $table = $_POST['table'];
    $query = "DELETE FROM `$table` WHERE id = $id";
    $result1 = mysqli_query($connect, $query);
    break;

  case 'change':
    $id = $_POST['id'];
    $table = $_POST['table'];
    $zn = $_POST['name'];
    $pole = $_POST['pole'];
    $query = "UPDATE `$table` SET `$pole`='$zn' WHERE id = $id";
    $result1 = mysqli_query($connect, $query);
    break;
}
 ?>
