<?php
include 'dashboard/config/db.php';

$stmt_promo = $db->prepare("SELECT * FROM home_promo WHERE id = 1");
$stmt_promo->execute();
$promo = $stmt_promo->fetch(PDO::FETCH_ASSOC);

// Home About verilerini çek
$stmt_about = $db->prepare("SELECT * FROM home_about WHERE id = 1");
$stmt_about->execute();
$about = $stmt_about->fetch(PDO::FETCH_ASSOC);

// Why Us verilerini çek
$stmt_why = $db->prepare("SELECT * FROM why_us ORDER BY id ASC");
$stmt_why->execute();
$why_us = $stmt_why->fetchAll(PDO::FETCH_ASSOC);

$stmt_contact = $db->prepare("SELECT * FROM contact_settings WHERE id = 1");
$stmt_contact->execute();
$contact = $stmt_contact->fetch(PDO::FETCH_ASSOC);

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
    <title>Kahve Dünyasına Adım Atın ! | Orbit Coffee Co.</title>

    <!--====== Favicon ======-->
    <?php include 'favicon.php'; ?>

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
    <?php include 'header.php'; ?>

    <main>
        <!-- hero area start -->
        <section class="hero__area hero__area--2 position-relative custom-padding">
            <span class="shape shape__1 position-absolute"><img src="assets/images/shape/hero-shape-2-1.png"
                    alt=""></span>
            <span class="shape shape__2 position-absolute"><img src="assets/images/shape/hero-shape-2-2.png"
                    alt=""></span>
            <div class="container-fluid custom-width">
                <div class="row mm-reverse">
                    <div class="col-xl-6 col-lg-7 align-self-center">
                        <div class="hero__content hero__content--2 position-relative">
                            <h1 class="title mb-10"><?php echo $promo['title']; ?></h1>
                            <p><?php echo $promo['content']; ?></p>
                            <div class="btns mt-45 d-flex align-items-center justify-content-start">
                                <a target="_blank" href="<?php echo $contact['directions']; ?>"
                                    class="site-btn site-btn__2">
                                    <i class="fa fa-map-marker-alt"></i> Konum
                                </a>
                                <a href="<?php echo $promo['button_link']; ?>"
                                    class="site-btn"><?php echo $promo['button_text']; ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="hero__thumb hero__thumb--2 position-relative">
                            <img src="dashboard/uploads/<?php echo $promo['image']; ?>" alt="img">
                            <!-- <a href="http://www.youtube.com/embed/4xe72U7mXNg?rel=0&amp;controls=0&amp;showinfo=0" data-rel="lightcase:myCollection" data-animation="fadeInLeft" class="video-btn video-btn__2 d-flex align-items-center"><i class="fas fa-play"></i><span class="border-effect">play video</span></a> -->
                        </div>
                    </div>
                </div>
            </div>


        </section>
        <!-- hero area end -->
        <div class="feature__area feature__area--3 dark-bg hero__area--2 pt-120 pb-120 " data-overlay="dark"
            data-opacity="9" style="padding: 120px 0px">
            <span class="shape shape__1 position-absolute" style="opacity: .1;"><img
                    src="assets/images/shape/hero-shape-2-1.png" alt=""></span>
            <div class="container-fluid custom-width custom-width__2">
                <div class="row mt-none-30">
                    <?php foreach ($why_us as $item): ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 mt-30">
                            <div class="feature__item feature__item--3 bg_img"
                                data-background="dashboard/uploads/<?php echo $item['image']; ?>"
                                style="background-image: url('dashboard/uploads/<?php echo $item['image']; ?>');">
                                <div class="shape"><img src="assets/images/shape/f-shape-1.png" alt=""></div>
                                <div class="content">
                                    <span
                                        class="count"><?php echo str_pad($item['order_number'], 2, '0', STR_PAD_LEFT); ?></span>
                                    <h2 class="title mb-10"><?php echo $item['title']; ?></h2>
                                    <p><?php echo $item['content']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- about area start -->
        <section class="about__area about__area--2 grey-bg position-relative pt-120 pb-130">
            <span class="shape shape__1 position-absolute"><img src="assets/images/shape/about-shape-2-1.png"
                    alt=""></span>
            <span class="shape shape__2 position-absolute"><img src="assets/images/shape/about-shape-2-2.png"
                    alt=""></span>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7">
                        <div class="about__left about__left--2 position-relative">
                            <img class="big" src="dashboard/uploads/<?php echo $about['image']; ?>" alt="img">
                            <img class="small position-absolute" src="assets/images/about/about-img-2-2.png" alt="img">
                        </div>
                    </div>
                    <div class="col-xl-6 offset-xl-1">
                        <div class="about__right about__right--2 pl-45 pt-45">
                            <div class="section-heading section-heading__black">
                                <span class="sub-title">hakkımızda</span>
                                <h2 class="title mb-25"><?php echo $about['title1']; ?> <br> <span
                                        style="color: #186650;"><?php echo $about['title2']; ?></span></h2>
                                <p><?php echo $about['content']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end -->

        <section class="pp__area dark-bg position-relative pt-95 popular-menu__area grey-bg position-relative pb-120">
            <span class="shape shape__1 position-absolute"><img src="assets/images/shape/menu-shape-1.png"
                    alt=""></span>
            <span class="shape shape__2 position-absolute"><img src="assets/images/shape/menu-shape-2.png"
                    alt=""></span>
            <span class="shape shape__3 position-absolute"><img src="assets/images/shape/menu-shape-3.png"
                    alt=""></span>
            <span class="shape shape__4 position-absolute"><img src="assets/images/shape/menu-shape-4.png"
                    alt=""></span>
            <span class="shape position-absolute"><img src="assets/images/shape/pp-shape-1.png" alt=""></span>
            <div class="container">
                <div class="row align-items-end mb-60">
                    <div class="col-lg-8">
                        <div class="section-heading">
                            <span class="sub-title">Bizi Takip Edin!</span>
                            <h2 class="title">Orbit Coffee Co.</h2>
                            <p>Kahve tutkunlarıyla buluşmanın en güzel yolu sosyal medya! Orbit Coffee'nin Instagram
                                hesabını takip edin, kahve dünyasındaki yeniliklerden haberdar olun.</p>
                        </div>
                    </div>

                </div>
                <div class="row mt-none-30">
                    <?php
                    // JSON dosyasını oku ve PHP dizisine dönüştür
                    $instagramPosts = json_decode(file_get_contents('instagram.json'), true);
                    $instagramPosts = array_slice($instagramPosts, 0, 6);

                    ?>

                    <div class="row mt-none-30">
                        <?php foreach ($instagramPosts as $post): ?>
                            <div class="col-xl-4 col-lg-6 mt-30">
                                <div class="pp__item text-center  pb-25">
                                    <div class="pp__thumb mt-30">
                                        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Instagram post">
                                    </div>
                                    <div class="pp__content mt-40">
                                        <div class="pp__c-top d-flex align-items-center justify-content-center">
                                            <div class="pp__cat">
                                                <a href="<?php echo htmlspecialchars($post['link']); ?>"
                                                    target="_blank">Instagram'da Gör</a>
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
                            <a href="/instagram" class="site-btn">Tümünü Gör</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>



    </main>

    <?php include 'footer.php'; ?>

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