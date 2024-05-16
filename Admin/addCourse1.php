<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Course');
// include('./dbConnection.php');
if (file_exists('../dbConnection.php')) {
    include('../dbConnection.php');
} else {
    echo "File not found.";
}


if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}
if(isset($_REQUEST['courseSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_price'] == "") || ($_REQUEST['course_original_price'] == "")){
    // msg displayed if required field missing
    $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Assigning User Values to Variable
    $course_name = $_REQUEST['course_name'];
    $course_desc = $_REQUEST['course_desc'];
    $course_author = $_REQUEST['course_author'];
    $course_duration = $_REQUEST['course_duration'];
    $course_price = $_REQUEST['course_price'];
    $course_original_price = $_REQUEST['course_original_price'];
    $course_image = $_FILES['course_img']['name']; 
    $course_image_temp = $_FILES['course_img']['tmp_name'];
    $img_folder = '../image/courseimg/'. $course_image; 
    move_uploaded_file($course_image_temp, $img_folder);
    $sql = "INSERT INTO course (course_name, course_desc, course_author, course_img, course_duration, course_price, course_original_price) VALUES ('$course_name', '$course_desc','$course_author', '$img_folder', '$course_duration', '$course_price', '$course_original_price')";
    if($conn->query($sql) == TRUE){
      // below msg display on form submit success
      $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Course Added Successfully </div>';
    } else {
      // below msg display on form submit failed
      $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Course </div>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>
    <?php echo TITLE ?>
  </title>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="./css/all.min.css">

  <!-- Google Font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/adminstyle.css">
  <link rel="icon" href="../image/point_logo.jpeg" />
</head>

<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-dark fixed-top p-0 shadow" style="background-color: #225470;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminDashboard.php">Nexus <small class="text-white">Admin Area</small></a>
  </nav>
  <!--Form-->
  <div class="container-fluid mb-5" style="margin-top:40px;">
  <div class="row">
      <div class="col-sm-6 mt-5  mx-3 jumbotron">
        <h3 class="text-center">Add New Course</h3>
        <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name" value="">
    </div>
    <div class="form-group">
      <label for="course_desc">Course Description</label>
      <textarea class="form-control" id="course_desc" name="course_desc" row=2></textarea>
    </div>
    <div class="form-group">
      <label for="course_author">Author</label>
      <input type="text" class="form-control" id="course_author" name="course_author">
    </div>
    <div class="form-group">
      <label for="course_duration">Course Duration</label>
      <input type="text" class="form-control" id="course_duration" name="course_duration">
    </div>
    <div class="form-group">
      <label for="course_original_price">Course Original Price</label>
      <input type="text" class="form-control" id="course_original_price" name="course_original_price" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="course_price">Course Selling Price</label>
      <input type="text" class="form-control" id="course_price" name="course_price" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="course_img">Course Image</label>
      <input type="file" class="form-control-file" id="course_img" name="course_img">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
      <a href="courses.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
      </div>
      <!-- Only Number for input fields -->
      <script>
        function isInputNumber(evt) {
          var ch = String.fromCharCode(evt.which);
          if (!(/[0-9]/.test(ch))) {
            evt.preventDefault();
          }
        }
      </script>
    </div> <!-- div Row close from header -->
  </div> <!-- div Container-fluid close from header -->

  <!-- Jquery and Boostrap JavaScript -->
  <script type="text/javascript" src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>

  <!-- Font Awesome JS -->
  <script type="text/javascript" src="../js/all.min.js"></script>

  <!-- Admin Ajax Call JavaScript -->
  <script type="text/javascript" src="..js/adminajaxrequest.js"></script>

  <!-- Custom JavaScript -->
  <script type="text/javascript" src="../js/custom.js"></script>
</body>

</html>
