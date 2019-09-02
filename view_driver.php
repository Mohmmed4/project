<?php
session_start();
if (isset($_SESSION['admin_name'])== false){
    header("Location: login.php");
}
?>
<?php include ("db.php");
include_once "functions.php";
$class = new helper($conn);
if (isset($_GET['delete'])) {
    $class->delete_relation_driver($_GET);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>the drivers</title>
    <link rel="stylesheet" href="css/table.css">
</head>
<header>
    <div class="ml-auto w-25">
        <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="logout.php" class="nav-link">logout</a></li>
            </ul>
        </nav>
        <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
    </div>
</header>

<body>
<div class="container">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th colspan="10">information driver</th>
        <tr>
            <th>id</th>
            <th>driver name</th>
            <th>address</th>
            <th>phone</th>
            <th>time to leave</th>
            <th>student name</th>
            <th>address</th>
        </tr>
        </thead>
        <tbody>
        <?php include ("db.php");
        include_once "functions.php";
        $class = new helper($conn);
        if (isset($_GET['view_passengers'])) {
            $class->view_passengers($_GET);
        }
        ?>
        </tbody>
    </table>
</div>
<div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
    <form action="insert_driver.php" method="post" class="form-box">
        <div class="form-group">
        </div>
    </form>
</div>
</body>
</html>