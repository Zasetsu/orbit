<!doctype html>
<html class="no-js" lang="tr">
<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Instragram | Orbit Coffee Co.</title>

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
                        <h2 class="page-title">Instragram</h2>
                        <div class="cafena-breadcrumb breadcrumbs">
                            <ul class="list-unstyled d-flex align-items-center justify-content-center">
                                <li class="cafenabcrumb-item duxinbcrumb-begin">
                                    <a href="/"><span>Anasayfa</span></a>
                                </li>
                                <li class="cafenabcrumb-item duxinbcrumb-end">
                                    <span>Instragram</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="pp__area  position-relative pt-95 popular-menu__area  position-relative pb-120">
            <span class="shape shape__1 position-absolute"><img src="assets/images/shape/menu-shape-1.png" alt=""></span>
            <span class="shape shape__2 position-absolute"><img src="assets/images/shape/menu-shape-2.png" alt=""></span>
            <span class="shape shape__3 position-absolute"><img src="assets/images/shape/menu-shape-3.png" alt=""></span>
            <span class="shape shape__4 position-absolute"><img src="assets/images/shape/menu-shape-4.png" alt=""></span>
            <span class="shape position-absolute"><img src="assets/images/shape/pp-shape-1.png" alt=""></span>
            <div class="container">
                <div class="row align-items-end mb-60">
                    <div class="col-lg-8">
                        <div class="section-heading">
                            <span class="sub-title">Bizi Takip Edin!</span>
                            <h2 class="title">Orbit Coffee Co.</h2>
                            <p>Kahve tutkunlarıyla buluşmanın en güzel yolu sosyal medya! Orbit Coffee'nin Instagram hesabını takip edin, kahve dünyasındaki yeniliklerden haberdar olun.</p>
                        </div>
                    </div>
                    
                </div>
                <div class="row mt-none-30">
                <?php
// JSON dosyasını oku ve PHP dizisine dönüştür
$instagramPosts = json_decode(file_get_contents('instagram.json'), true);

?>

<div class="row mt-none-30">
    <?php foreach ($instagramPosts as $post): ?>
        <div class="col-xl-4 col-lg-6 mt-30">
            <div class="pp__item text-center  pb-25">
                <div class="pp__thumb mt-30">
                    <img  src="<?php echo htmlspecialchars($post['image']); ?>" alt="Instagram post">
                </div>
                <div class="pp__content mt-40">
                    <div class="pp__c-top d-flex align-items-center justify-content-center">
                        <div class="pp__cat">
                            <a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Instagram'da Gör</a>
                        </div>
                    </div>
                    <p class="pp__caption mt-2 p-3">
                        <?php echo htmlspecialchars(substr($post['caption'], 0, 100)) . '...'; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="col-lg-12 d-flex justify-content-center pt-60">
    <a href="https://www.instagram.com/orbitcoffeecom/" target="_blank" class="site-btn">Instagram Hesabımıza Gidin</a>
    </div>
</div>
                   
                </div>
            </div>
        </section>

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