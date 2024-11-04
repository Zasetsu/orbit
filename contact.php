<?php 
include 'dashboard/config/db.php';

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
    <title>İletişim | Orbit Coffee Co.</title>

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
                        <h2 class="page-title">İletişim</h2>
                        <div class="cafena-breadcrumb breadcrumbs">
                            <ul class="list-unstyled d-flex align-items-center justify-content-center">
                                <li class="cafenabcrumb-item duxinbcrumb-begin">
                                    <a href="/"><span>Anasayfa</span></a>
                                </li>
                                <li class="cafenabcrumb-item duxinbcrumb-end">
                                    <span>İletişim</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="contact__area position-relative pt-120 pb-120">
            <span class="shape shape__1 position-absolute"><img src="assets/images/shape/hero-shape-2-1.png" alt=""></span>
            <span class="shape shape__2 position-absolute"><img src="assets/images/shape/hero-shape-2-2.png" alt=""></span>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="contact__wrapper">
                        <div class="row mt-none-30">
    <div class="col-lg-6 col-md-6 mt-30">
        <div class="contact-info d-flex align-items-center justify-content-center">
            <div class="icon d-flex align-items-center justify-content-center">
                <img src="assets/images/icons/ci-2.png" alt="">
            </div>
            <div class="content">
                <h3 class="title">Adres</h3>
                <p><?php echo $contact['address']; ?></p>
                
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 mt-30">
        <div class="contact-info d-flex align-items-center justify-content-center">
            <div class="icon d-flex align-items-center justify-content-center">
                <img src="assets/images/icons/ci-3.png" alt="">
            </div>
            <div class="content">
                <h3 class="title">Çalışma Saatleri</h3>
                <p><?php echo $contact['working_hours']; ?></p>
                
            </div>
        </div>
    </div>
</div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="contact__form mt-20">
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

                                                $mail->setFrom('umut@ursamedia.io', '=?UTF-8?B?'.base64_encode('Orbit Coffee Co.').'?=');
                                                $mail->addAddress('turanumutyilmaz@gmail.com');

                                                $mail->isHTML(true);
                                                $mail->Subject = '=?UTF-8?B?'.base64_encode('İletişim Formu Mesajı').'?=';
                                                $mail->Body    = "Ad: {$_POST['name']}<br>E-posta: {$_POST['email']}<br>Konu: {$_POST['subject']}<br>Mesaj: {$_POST['message']}";

                                                $mail->send();
                                                echo '<div class="alert alert-success alert-box" role="alert">Mesajınız başarıyla gönderildi.</div>';
                                            } catch (Exception $e) {
                                                echo '<div class="alert alert-danger alert-box" role="alert">Mesaj gönderilemedi. Hata: ' . $mail->ErrorInfo . '</div>';
                                            }
                                        }
                                        ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <div class="row">
                                                <div class="col-xl-6 mt-30">
                                                    <div class="form-group">
                                                        <input type="text" name="name" id="name" placeholder="Adınız :">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 mt-30">
                                                    <div class="form-group">
                                                        <input type="email" name="email" id="email" placeholder="E-Posta Adresi :">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 mt-30">
                                                    <div class="form-group">
                                                        <input type="text" name="subject" id="subject" placeholder="Konu :">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 mt-30">
                                                    <div class="form-group">
                                                        <textarea name="message" id="message" placeholder="Mesaj :"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 mt-20 text-center">
                                                    <button type="submit" class="site-btn">Gönder</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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