
<?php  

require_once "./includes/conn.php";
require_once "./includes/logged.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  try{

$sql = "UPDATE `classes` SET `classname`=?,`price`=?,`capacity`=?,`age1`=?,`age2`=?,`time1`=?,`time2`=?,`published`=?,`image`=?,`teacher_id`=? WHERE `id`=?";

$stmt = $conn->prepare($sql);

$classname = $_POST['classname'];
$price = $_POST['price'];
$capacity = $_POST['capacity'];
$age1 = $_POST['age1'];
$age2 = $_POST['age2'];
$time1 = $_POST['time1'];
$time2 = $_POST['time2'];

if (isset($_POST['published'])) {
  $published = 'Yes';
} else {
  $published = 'No';
}

$oldImage = $_POST['oldImage'];
require_once "./includes/updateImage.php";

$teacher_id = $_POST['teacher_id'];


$id = $_POST['id'];

$stmt->execute([$classname , $price , $capacity , $age1 , $age2 , $time1 , $time2 , $published  ,$image_name, $teacher_id  ,$id]);

}catch(PDOException $e){
  $error =  "Connection failed: " . $e->getMessage();
}


}


if (isset($_GET['id'])) {

  $sql = "SELECT * FROM `classes` WHERE id = ?";
  $stmt = $conn->prepare($sql);

  $id = $_GET['id'];

  $stmt->execute([$id]);
  $class = $stmt->fetch();

  

  if ($class === false) {
      header('Location: classes.php');
      die();
  }
} else {
  header('Location: classes.php');
  die();
}


try{


$sqlteac = "SELECT * FROM `teachers`";
$stmtteac = $conn->prepare($sqlteac);
$stmtteac->execute();

$teachers = $stmtteac->fetchAll();

}catch(PDOException $e){
  $error =  "Connection failed: " . $e->getMessage();
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
     

      <div class="container my-5">
        <div class="bg-light p-5 rounded">
          <h2 class="fw-bold fs-2 mb-5 pb-2">Edit Class</h2>
          <form action="" method="POST" class="px-md-5" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <input type="hidden" name="oldImage" value="<?php echo $class['image'] ?>">
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Class Name:</label
              >
              <div class="col-md-10">
                <input
                  type="text"
                  placeholder="e.g. Art & Design"
                  class="form-control py-2"
                  name="classname"
                  value="<?php echo $class['classname'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Teacher:</label
              >
              <div class="col-md-10">
                <select name="teacher_id" id="" class="form-control py-1">
                  <?php foreach($teachers as $teacher){
                    ?>
                  <option value="<?php echo $teacher['id'] ?>"  <?php echo ($teacher["id"] == $class['teacher_id']) ? "selected" : ""; ?>  ><?php echo $teacher['fullname'] ?></option>
                  <?php } ?>
                  
                </select>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Price:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="0.1"
                  placeholder="Enter price"
                  class="form-control py-2"
                  name="price"
                  value="<?php echo $class['price'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Capacity:</label
              >
              <div class="col-md-10">
                <input
                  type="number"
                  step="1"
                  placeholder="Enter catpacity"
                  class="form-control py-2"
                  name="capacity"
                  value="<?php echo $class['capacity'] ?>"
                />
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Age:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input name="age1" type="number" class="form-control" value="<?php echo $class['age1'] ?>"></label>
                <label for="" class="form-label">To <input name="age2" type="number" class="form-control" value="<?php echo $class['age2'] ?>"></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Time:</label
              >
              <div class="col-md-10">
                <label for="" class="form-label">From <input name="time1" type="time" class="form-control"value="<?php echo $class['time1'] ?>" ></label>
                <label for="" class="form-label">To <input name="time2" type="time" class="form-control"value="<?php echo $class['time2'] ?>" ></label>
              </div>
            </div>
            <div class="form-group mb-3 row">
              <label for="" class="form-label col-md-2 fw-bold text-md-end"
                >Published:</label
              >
              <div class="col-md-10">
                <input
                  name="published"
                  type="checkbox"
                  class="form-check-input"
                  style="padding: 0.7rem;"
                  <?php echo($class['published'] === 'Yes' ? 'checked':'')?>

                
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
                  id="image"
                  name="image"
                  type="file"
                  class="form-control"
                  style="padding: 0.7rem;"
                  accept="image/*"
                />
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-10">
                <img
                  src="../img/<?php echo $class['image'] ?>"
                  alt="class-image"
                  style="max-width: 150px"
                />
              </div>
            </div>
            <div class="text-md-end">
            <button
              class="btn mt-4 btn-secondary text-white fs-5 fw-bold border-0 py-2 px-md-5"
            >
              Edit Class
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
