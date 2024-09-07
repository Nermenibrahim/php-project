<?php 

require_once "./includes/conn.php";
require_once "./includes/logged.php";

try{

$sql = "SELECT * FROM `testimonials`  ";

$stmt = $conn->prepare($sql);

$stmt->execute();


$testimonials = $stmt->fetchAll();

}catch(PDOException $e){
  $error = "Connection failed: " . $e->getMessage();
}



?>








<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/main.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <main>
    
    <?php 

require_once "../includes/nav.php";




?>
      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">All Testimonials</h2>
          <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Registration Date</th>
                <th scope="col">FullName</th>
                <th scope="col">Job Title</th>
                <th scope="col">Comment</th>
                <th scope="col">Published</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>

            <?php foreach($testimonials as $testimonial){

                $date = date_create($testimonial['RegDate']);
            
            ?>
              <tr>
                <th scope="row"><?php echo  date_format($date,"d M Y ")?></th>
                <td><?php echo $testimonial['fullname'] ?></td>
                <td><?php echo $testimonial['jobtitle'] ?></td>
                <td><?php echo $testimonial['comment'] ?></td>
                <td><?php echo $testimonial['published'] ?></td>
                <td><a href="edit_testimonial.php?id=<?php echo $testimonial['id'] ?>" class="text-decoration-none"><i>✒️</i></a></td>
                <td><a href="delete_testimonial.php?id=<?php echo $testimonial['id'] ?>" onclick ="return confirm('Are you sure you want to delete?')"  class="text-decoration-none"><img src="../img/trash-bin.png" alt="" style="max-width: 35px"></a></td>
              </tr>

              <?php } ?>
            
              
              
            </tbody>
            <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>

          </table>
        </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>