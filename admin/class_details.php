
<?php 


require_once "./includes/conn.php";
require_once "./includes/logged.php";

if(isset($_GET['id'])){


  try{


$sql = "SELECT * FROM `classes` WHERE id=?";

$stmt = $conn->prepare($sql);

$id=$_GET['id'];

$stmt->execute([$id]);

$class = $stmt->fetch();



$sqltea = "SELECT * FROM `teachers`";
$stmttea = $conn->prepare($sqltea);
$stmttea->execute();

$teachers = $stmttea->fetchAll();







}  catch(PDOException $e){
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
          <div class="card bg-light border-0">
            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-6 col-10">
                <img src="../img/<?php echo $class['image'] ?>" alt="" class="card-img" />
              </div>
              <div class="col-lg-8 col-md-6 col-12 card-body">
                <div class="mb-4 text-center py-2">
                  <h2 class="fw-semibold bg-light card-header"><?php echo $class['classname'] ?></h2>
                </div>
                <div class="mb-4">
                  <p class="card-text">

                  
                    
                    <span value="<?php echo $teacher['id'] ?>"  class="fw-bold" >Teacher:<?php foreach($teachers as $teacher) {
                      
                      ?>   
                      <?php echo ($teacher["id"] == $class['teacher_id']) ?   $teacher['fullname']: ""; ?>
                      
                      
                      
                      </span>  <?php } ?>
                  </p>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Price:</span> <?php echo $class['price'] .' ' . '$' ?>
                  </p>
                </div>
                <div class="mb-4">
                  <p class="card-text">
                    <span class="fw-bold">Published:</span> <?php echo $class['published'] ?>
                  </p>
                </div>
                <div class="row">
                  <div class="col-md-4" style="border-top: 3px solid #198754">
                    <p class="text-success fs-5 fw-bold lh-1 pt-2">Age:</p>
                       

                    <p class="lh-1 fw-bold"><?php echo $class['age1'] ?> - <?php echo $class['age2'] ?> Years</p>
                  </div>
                  <div class="col-md-4" style="border-top: 3px solid #fe5d37">
                    <p class="text-primary fs-5 fw-bold lh-1 pt-2">Time:</p>

                    <?php  
                    
                    $time1 =  strtotime($class['time1']);
                    $time2 =  strtotime($class['time2']);
                   
                    
                    
                    ?>

                    <p class="lh-1 fw-bold"> <?php echo date('h:i', $time1)?> -  <?php echo date('h:i A', $time2)?> </p>
                  </div>
                  <div class="col-md-4" style="border-top: 3px solid #ffc107">
                    <p class="text-warning fs-5 fw-bold lh-1 pt-2">Capacity:</p>
                    <p class="lh-1 fw-bold"><?php echo  $class['capacity'] . ' ' . 'Kids' ?>  </p>
                  </div>
                </div>
                <div class="text-md-end">
                  <a href="classes.php"
                    class="btn mt-4 btn-primary text-white fs-5 fw-bold border-0 py-2 px-md-5"
                  >
                    Back to All classes
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script src="js/bootstrap.bundle.min.js"></script>
  </body>

  <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>
</html>
