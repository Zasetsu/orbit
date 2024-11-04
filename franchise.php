<!doctype html>
<html class="no-js" lang="tr">
<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Franchise | Orbit Coffee Co.</title>

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
                        <h2 class="page-title">Franchıse</h2>
                        <div class="cafena-breadcrumb breadcrumbs">
                            <ul class="list-unstyled d-flex align-items-center justify-content-center">
                                <li class="cafenabcrumb-item duxinbcrumb-begin">
                                    <a href="/"><span>Anasayfa</span></a>
                                </li>
                                <li class="cafenabcrumb-item duxinbcrumb-end">
                                    <span>Franchıse</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="reservation__area reservation__area--2 position-relative pt-120 pb-120">
            <span class="shape shape__1 position-absolute"><img src="assets/images/shape/hero-shape-2-1.png" alt=""></span>
            <span class="shape shape__2 position-absolute"><img src="assets/images/shape/hero-shape-2-2.png" alt=""></span>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="reservation__wrapper reservation__wrapper--2">
                            <div class="section-heading section-heading__black text-center mb-35">
                                <h2 class="title">Franchıse Bilgi Formu</h2>
                                <p class="mt-3">Orbit Coffee ailesine katılmak ister misiniz? Franchise fırsatlarımız hakkında bilgi almak için bizimle iletişime geçin ve başarılı bir iş ortaklığına adım atın.</p>
                            </div>
                            <div class="reservation__form reservation__form--2 mt-none-30 text-center">
                            <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require 'vendor/autoload.php';
        
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
            try {
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host       = 'mail.ursamedia.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'umut@ursamedia.io';
                $mail->Password   = 'Azathoth*9901';
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
        
                $mail->setFrom('umut@ursamedia.io', 'Orbit Coffee Co.');
                $mail->addAddress('turanumutyilmaz@gmail.com');
        
                $mail->isHTML(true);
                $mail->Subject = 'Franchise başvurusu';
                $mail->Body    = "Ad Soyad: {$_POST['name']}<br>Telefon: {$_POST['tel']}<br>Notlar: {$_POST['message']}";
        
                $mail->send();
                echo '<div class="alert alert-success alert-box" role="alert">Başvurunuz başarıyla gönderildi.</div>';
            } catch (Exception $e) {
                echo '<div class="alert alert-danger alert-box" role="alert">Mesaj gönderilemedi. Hata: ' . $mail->ErrorInfo . '</div>';
            }
        }
        ?>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="contact__form">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="from-group mt-30">
                                                <input type="text" name="name" placeholder="Ad & Soyad" required="true">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-12">
                                            <div class="from-group mt-30">
                                                <input type="tel" name="tel" id="tel" placeholder="Telefon Numarası" required="true">
                                            </div>
                                        </div>
                                        <div class="col-xl-12 col-lg-12">
                                        <div class="form-group mt-30">
                                                        <textarea name="message" id="message" placeholder="Mesajınız"></textarea>
                                                    </div>
                                        </div>
                                     
                                        <div class="col-xl-12 text-center">
                                            <button type="submit" class="site-btn mt-30">Gönder</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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