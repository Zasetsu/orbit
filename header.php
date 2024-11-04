<!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

<!-- preloader  -->
<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                <span data-text-preloader="O" class="letters-loading">
                    O
                </span>
                <span data-text-preloader="R" class="letters-loading">
                    R
                </span>
                <span data-text-preloader="B" class="letters-loading">
                    B
                </span>
                <span data-text-preloader="I" class="letters-loading">
                    I
                </span>
                <span data-text-preloader="T" class="letters-loading">
                    T
                </span>
            </div>
        </div>
        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- preloader end -->

<!-- header start -->
<header class="site-header">
    <div class="header-top header-top__2">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-xl-6 col-lg-12 align-self-center">
                    <div class="header-top__left d-flex align-items-center">
                        <div class="logo">
                            <a href="/">
                                <img src="assets/orbitlogosalt.png" alt="img">
                            </a>
                        </div>
                        <ul class="header-top__infos pl-75 list-unstyled d-flex align-items-center mb-0">
                            <li><a href="<?=$contact['directions']?>"
                                    target="_blank"><i class="fa fa-map-marker-alt"></i> Yol Tarifi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12  align-self-center">
                    <div
                        class="header-top__right header-top__right--2 d-flex justify-content-xl-end justify-content-center align-items-center">
                        <div
                            class="social-links social-links__2 d-flex align-items-center justify-content-md-start justify-content-center">
                            <a href="<?=$contact['instagram_url']?>" target="_blank"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                        <a href="/franchise" class="site-btn">Franchıse</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-area menu-area-2 custom-padding">
        <div class="container-fluid custom-width">
            <div class="row">
                <div class="col-xl-8 col-lg-9 col-6">
                    <div class="logo mm-only d-md-block d-lg-none">
                        <a href="/">
                            <img src="assets/orbitlogosalt.png" alt="img">
                        </a>
                    </div>
                    <div class="main-menu main-menu__2">
                        <nav id="mobile-menu">
                            <ul>
                                <li class="active">
                                    <a href="/">Anasayfa</a>
                                </li>
                                <li><a href="/hakkimizda">Hakkımızda</a></li>
                                <li><a href="/instagram">Instagram</a></li>
                                <li><a href="/franchise">Franchıse</a></li>
                                <li><a href="/urunler">Ürünler</a></li>
                                <li><a href="/iletisim">İletişim</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>

                <div class="col-xl-4 col-lg-3 col-6 align-self-center">
                    <div class="menu-area__right menu-area__right--2 d-flex justify-content-end align-items-center">
                        <div class="hamburger-trigger item">
                            <i class="far fa-bars"></i>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header end -->

<!-- side info for mobile view -->
<aside class="side-info-wrapper mm-only">
    <nav>
        <div class="nav" id="nav-tab" role="tablist">


        </div>
    </nav>
    <div class="side-info__wrapper d-flex align-items-center justify-content-between">
        <div class="side-info__logo">
            <a href="/">
                <img src="/assets/logosaltremove.png" alt="logo" style="max-width:200px;height:auto">
            </a>
        </div>
        <div class="side-info__close">
            <a href="javascript:void(0);"><i class="fal fa-times"></i></a>
        </div>
    </div>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="menu-tab-1" role="tabpanel" aria-labelledby="menu-tab-1-tab">
            <div class="mobile-menu"></div>
        </div>
    </div>
</aside>




<div class="overlay"></div>