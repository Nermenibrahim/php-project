<?php 

require_once "./includes/conn.php";


if (isset($_GET['id'])){


try{

$sql = "DELETE FROM `testimonials` WHERE id=?";
$stmt = $conn->prepare($sql);

$id=$_GET['id'];

$stmt->execute([$id]);

header('Location: testimonials.php');
die();

}catch(PDOException $e){
    $error = "Connection failed: " . $e->getMessage();
  }



}











?>