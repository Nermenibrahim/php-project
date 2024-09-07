 <?php 
 
 require_once "./admin/includes/conn.php";


 try{

 $sql = " SELECT * FROM `teachers` WHERE `published` ='Yes' ";

 $stmt = $conn->prepare($sql);

$stmt->execute();

$teachers = $stmt->fetchAll();

 
 } catch(PDOException $e){
    $error =  "Connection failed: " . $e->getMessage();
  }
 
 
 
 
 ?>
 
 
 
 
 
 
 
 
 <!-- Team Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Popular Teachers</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit
                        eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p>
                </div>
                <div class="row g-4">
                    <?php foreach($teachers as $teacher){ ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative">
                            <img class="img-fluid rounded-circle w-75" src="img/<?php echo $teacher['image'] ?>" alt="">
                            <div class="team-text">
                                <h3><?php echo $teacher['fullname'] ?></h3>
                                <p><?php echo $teacher['jobtitle'] ?></p>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary  mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                   
                </div>
            </div>
        </div>

        <?php
			if (isset($error)) {
    ?>
    <div style="color: #ee0002; padding: 5px;">
    <?php echo $error ?>
    </div>
    <?php
			}
			?>
        <!-- Team End -->