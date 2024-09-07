<?php 


require_once "./includes/conn.php";
require_once "./includes/logged.php";


if($_SERVER['REQUEST_METHOD'] === "POST"){

  try{

  $sql = "INSERT INTO `testimonials`( `fullname`, `jobtitle`, `comment`, `published`, `image`) VALUES (?,?,?,?,?)";

  $stmt = $conn->prepare($sql);

  $fullname = $_POST['fullname'];
  $jobtitle = $_POST['jobtitle'];
  $comment = $_POST['comment'];


  if(isset($_POST['published'])){
    $published = 'Yes';
  }else{
    $published = 'No';
  }

  require_once "./includes/addimage.php";

  $stmt->execute([$fullname, $jobtitle , $comment  ,$published , $image_name ]);

header('Location: testimonials.php');
die();

}catch(PDOException $e){
  $error = "Connection failed: " . $e->getMessage();
}






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
          <h2 class="fw-bold fs-2 mb-5 pb-2">Add Testimonial</h2>
          <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Fullname:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. John Doe"
                  class="form-control py-2"
                  name="fullname"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Job Title:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. Content Creator"
                  class="form-control py-2"
                  name="jobtitle"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Comment:</label
              >
              <div class="col-md-10">
                <textarea id="" cols="30" rows="5" class="form-control py-2" name="comment"></textarea>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  type="checkbox"
                  class="form-check-input"
                  style="padding: 0.7rem;"
                  name="published"
                />
              </div>
            </div>
            <hr>
            <div class="form-group mb-3 row">
              <label for="image" class="form-label col-md-2 fw-bold text-md-end"
                >Image:</label
              >
              <div class="col-md-10">
                <input
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem;"
                  name="image"
                  id="image"
                  accept="image/*"
                />
              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Add Testimonial
            </button>
          </div>
          </form>
          <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>

        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>
</html>
