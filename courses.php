<?php
session_start();
if (isset($_SESSION['admin_name'])== false){
    header("Location: login.php");
}
?>
<?php include ("db.php");
include_once 'functions.php';
$class = new helper($conn);
if (isset($_GET['delete'])){
    $class->delete_course($_GET);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>the courses</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<header></header>
<body>
<div class="ml-auto w-25">
    <nav class="site-navigation position-relative text-right" role="navigation">
        <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
            <li><a href="logout.php" class="nav-link">logout</a></li>
        </ul>
    </nav>
    <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
</div>
<div class="container">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th colspan="999">courses</th>
        <tr>
            <th>id</th>
            <th>full_name</th>
            <th>Time start lecture</th>
            <th>Time end lecture</th>
        </tr>

        </thead>
        <tbody>
        <?php
        include_once 'functions.php';
        $class = new helper($conn);
        $class->show_courses();
        ?>
        </tbody>
    </table>
</div>
<div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
    <form action="insert_course.php" method="post" class="form-box">
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-pill" value="add" name="submit">
        </div>
    </form>
</div>
<div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
    <form action="student_course.php" method="post" class="form-box">
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-pill" value="add_student" name="submit">
        </div>
    </form>
</div>
</body>
</html>
