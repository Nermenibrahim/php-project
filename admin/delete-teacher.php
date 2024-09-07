<?php 


require_once "./includes/conn.php";


if (isset($_GET['id'])){


try{

$sql = "DELETE FROM `teachers` WHERE id=?";
$stmt = $conn->prepare($sql);

$id=$_GET['id'];

$stmt->execute([$id]);

header('Location: teachers.php');
die();

}catch(PDOException $e){
    $error = "Connection failed: " . $e->getMessage();
  }



}









?>