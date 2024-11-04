<?php 
include 'dashboard/config/db.php';

// About Intro verilerini çek
$stmt_intro = $db->prepare("SELECT * FROM about_intro WHERE id = 1");
$stmt_intro->execute();
$intro = $stmt_intro->fetch(PDO::FETCH_ASSOC);

// About Promo verilerini çek
$stmt_promo = $db->prepare("SELECT * FROM about_promo WHERE id = 1");
$stmt_promo->execute();
$promo = $stmt_promo->fetch(PDO::FETCH_ASSOC);

// About Why Us verilerini çek
$stmt_why = $db->prepare("SELECT * FROM about_why_us ORDER BY id ASC");
$stmt_why->execute();
$why_us = $stmt_why->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html class="no-js" lang="tr">
<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Hakkımızda | Orbit Coffee Co.</title>

    <!--====== Favicon ======-->
<?php include 'favicon.php';?>

    <!--====== CSS Here ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/main.css">

</head>

<body>
<?php include 'header.php';?>

    <main>
        <!-- breadcrumb area start -->
        <section class="breadcrumb-area pt-140 pb-140 bg_img" data-background="https://images.pexels.com/photos/324028/pexels-photo-324028.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" data-overlay="dark" data-opacity="5">
            <div class="shape shape__1"><img src="assets/images/shape/breadcrumb-shape-1.png" alt=""></div>
            <div class="shape shape__2"><img src="assets/images/shape/breadcrumb-shape-2.png" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h2 class="page-title">Hakkımızda</h2>
                        <div class="cafena-breadcrumb breadcrumbs">
                            <ul class="list-unstyled d-flex align-items-center justify-content-center">
                                <li class="cafenabcrumb-item duxinbcrumb-begin">
                                    <a href="/"><span>Anasayfa</span></a>
                                </li>
                                <li class="cafenabcrumb-item duxinbcrumb-end">
                                    <span>Hakkımızda</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->

          <!-- about area start -->
          <section class="about__area about__area--2 position-relative pt-120 pb-130">
    <span class="shape shape__1 position-absolute"><img src="assets/images/shape/about-shape-2-1.png" alt=""></span>
    <span class="shape shape__2 position-absolute"><img src="assets/images/shape/about-shape-2-2.png" alt=""></span>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-7">
                <div class="about__left about__left--2 position-relative">
                    <img class="big" src="dashboard/uploads/<?php echo $intro['image']; ?>" alt="img">
                    <img class="small position-absolute" src="assets/images/about/about-img-2-2.png" alt="img">
                </div>
            </div>
            <div class="col-xl-6 offset-xl-1">
                <div class="about__right about__right--2 pl-45 pt-45">
                    <div class="section-heading section-heading__black">
                        <span class="sub-title"><?php echo $intro['title1']; ?></span>
                        <h2 class="title mb-25"><?php echo $intro['title2']; ?></h2>
                        <p><?php echo $intro['content']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- about area end -->

        <!-- wcu section start -->
        <section class="wcu__area pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <div class="section-heading section-heading__black mb-60">
                    <span class="sub-title">neden biz?</span>
                    <h2 class="title">Orbit Coffee Co.</h2>
                </div>
            </div>
        </div>
        <div class="row mt-none-30">
            <?php foreach($why_us as $item): ?>
            <div class="col-xl-4 col-lg-6 col-md-6 mt-30 text-center">
                <div class="wcu__item">
                    <div class="icon">
                        <img src="dashboard/uploads/<?php echo $item['image']; ?>" alt="">
                    </div>
                    <div class="content">
                        <h2 class="title"><?php echo $item['title']; ?></h2>
                        <p><?php echo $item['content']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
        <!-- wcu section end -->

        <!-- best-coffe section start -->
        <div class="best-coffe__area position-relative">
    <div class="best-coffe__bg">
        <img src="dashboard/uploads/<?php echo $promo['image']; ?>" alt="">
    </div>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-8 pl-35">
                <div class="best-coffe__wrapper">
                    <div class="section-heading section-heading__black">
                        <h2 class="title mb-25"><?php echo $promo['title']; ?></h2>
                        <p><?php echo $promo['content']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- best-coffe section end -->

        <!-- team section end -->

    </main>

    <?php include 'footer.php';?>

    <!--========= JS Here =========-->
    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/lightcase.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/tilt.jquery.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrollwatch.js"></script>
    <script src="assets/js/sticky-header.js"></script>
    <script src="assets/js/waypoint.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfpGBFn5yRPvJrvAKoGIdj1O1aO9QisgQ"></script>
    <script src="assets/js/jquery-ui-slider-range.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>