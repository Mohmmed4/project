<?php
session_start();
if (isset($_SESSION['admin_name'])== false){
    header("Location: login.php");
}
?>
<?php include ("db.php");
require "functions.php";
$class = new helper($conn);
if (isset($_POST['add'])){
    $class->insert_course($_POST);
}
?>

<!DOCTYPE html>
<html>
<body>

<html lang="en">
<head>
    <title>the courses</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!--    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">-->
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

        <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
                <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                    <li><a href="logout.php" class="nav-link">logout</a></li>
                </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
        </div>
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <div class="mx-auto text-center">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                    </nav>
                </div>

                <div class="ml-auto w-25">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                        </ul>
                    </nav>
                    <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
                </div>
            </div>
        </div>

    </header>

    <div class="intro-section" id="home-section">

        <div class="slide-1" style="background-image: url('images/hero_1.jpg');" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                                <form action="" method="post" class="form-box">
                                    <h3 class="h4 text-black mb-4">Sign Up</h3>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="name" name="name" >
                                    </div>
                                    <div class="form-group">
                                        time start<input type="time" class="form-control" placeholder="Time_start_lecture" name="Time_start_lecture">
                                    </div>
                                    <div class="form-group">
                                        time end <input type="time" class="form-control" placeholder="Time_end_lecture" name="Time_end_lecture">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary btn-pill" value="insert" name="add">
                                    </div>
                                </form>



                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div> <!-- .site-wrap -->

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script src="js/jquery.sticky.js"></script>


<script src="js/main.js"></script>

</body>
</html>