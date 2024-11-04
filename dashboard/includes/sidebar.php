<style>
    .bg-dark {
        background-color: #186650 !important;
    }

    .navbar {
background-color: #186650;
}
</style>

<div class="sidebar bg-dark text-white" style="min-height: 100vh; width: 250px;">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="dashboard.php">
                <i class="fas fa-tachometer-alt"></i> Dashboard

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white dropdown-toggle" data-toggle="collapse" href="#homeSubmenu">
                    <i class="fas fa-home"></i> Anasayfa
                </a>
                <div class="collapse" id="homeSubmenu">
                    <ul class="nav flex-column pl-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="home_promo.php">Promo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="why_us.php">Neden Biz?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="home_about.php">Hakkımızda</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white dropdown-toggle" data-toggle="collapse" href="#aboutSubmenu">
                    <i class="fas fa-info-circle"></i> Hakkımızda
                </a>
                <div class="collapse" id="aboutSubmenu">
                    <ul class="nav flex-column pl-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="about_intro.php">Giriş</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="about_why_us.php">Neden Biz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="about_promo.php">Ek Promo</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white dropdown-toggle" data-toggle="collapse" href="#productSubmenu">
                    <i class="fas fa-box"></i> Ürünler
                </a>
                <div class="collapse" id="productSubmenu">
                    <ul class="nav flex-column pl-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="products.php">Ürünler</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="categories.php">Kategoriler</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="contact.php">
                    <i class="fas fa-envelope"></i> İletişim
                </a>
            </li>
        </ul>
    </div>
</div>