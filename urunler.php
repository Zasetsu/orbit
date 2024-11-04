<?php
include 'dashboard/config/db.php';
// Veritabanı bağlantısı ve sorguları
$stmt_categories = $db->prepare("
    SELECT c.* 
    FROM categories c 
    INNER JOIN products p ON c.id = p.category_id 
    GROUP BY c.id 
    HAVING COUNT(p.id) > 0 
    ORDER BY c.order_number ASC
");
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

$stmt_products = $db->prepare("
    SELECT p.*, c.title as category_title 
    FROM products p 
    LEFT JOIN categories c ON p.category_id = c.id 
    ORDER BY p.id DESC
");
$stmt_products->execute();
$products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Ürünler | Orbit Coffee Co.</title>

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
    <style>
        .category-badge {
            display: inline-block;
            font-size: 12px;
            padding: 4px 8px;
            background-color: #186650;
            color: white;
            border-radius: 4px;
            margin-left: 8px;
            font-weight: normal;
            vertical-align: middle;
        }

        .card-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
    </style>

</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <!-- breadcrumb area start -->
        <section class="breadcrumb-area pt-140 pb-140 bg_img"
            data-background="https://images.pexels.com/photos/324028/pexels-photo-324028.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
            data-overlay="dark" data-opacity="5">
            <div class="shape shape__1"><img src="assets/images/shape/breadcrumb-shape-1.png" alt=""></div>
            <div class="shape shape__2"><img src="assets/images/shape/breadcrumb-shape-2.png" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h2 class="page-title">Ürünler</h2>
                        <div class="cafena-breadcrumb breadcrumbs">
                            <ul class="list-unstyled d-flex align-items-center justify-content-center">
                                <li class="cafenabcrumb-item duxinbcrumb-begin">
                                    <a href="/"><span>Anasayfa</span></a>
                                </li>
                                <li class="cafenabcrumb-item duxinbcrumb-end">
                                    <span>Ürünler</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="products__area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Sol Menü -->
                    <div class="col-lg-3">
                        <div class="category-list">
                            <h4 class="mb-4">Kategoriler</h4>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action active" data-category="all">
                                    Tümü
                                </a>
                                <?php foreach ($categories as $category): ?>
                                    <a href="#" class="list-group-item list-group-item-action"
                                        data-category="<?php echo $category['id']; ?>">
                                        <?php echo $category['title']; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sağ Taraf - Ürünler -->
                    <div class="col-lg-9">
                        <div class="row" id="products-container">
                            <?php foreach ($products as $product): ?>
                                <div class="col-lg-4 col-md-6 mb-4 product-item"
                                    data-category="<?php echo $product['category_id']; ?>">
                                    <div class="card h-100" style="cursor: pointer;"
                                        onclick="openProductModal(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                                        <img src="dashboard/uploads/<?php echo $product['image']; ?>" class="card-img-top"
                                            alt="<?php echo $product['title']; ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $product['title']; ?>
                                                <span
                                                    class="category-badge"><?php echo $product['category_title']; ?></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- team section end -->

    </main>

    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modalImage" src="" alt="" class="img-fluid rounded">
                    </div>
                    <div class="col-md-6">
                        <h3 id="modalTitle" class="mb-2"></h3>
                        <span id="modalCategory" class="category-badge mb-3 d-inline-block"></span>
                        <p id="modalDescription" class="mt-3"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    <script>

function openProductModal(product) {
    // Modal içeriğini güncelle
    document.getElementById('modalImage').src = 'dashboard/uploads/' + product.image;
    document.getElementById('modalTitle').textContent = product.title;
    document.getElementById('modalCategory').textContent = product.category_title;
    document.getElementById('modalDescription').textContent = product.description;
    
    // Modal'ı aç
    var modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();
}

        document.addEventListener('DOMContentLoaded', function () {
            const categoryLinks = document.querySelectorAll('.list-group-item');
            const productItems = document.querySelectorAll('.product-item');

            categoryLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Aktif kategori sınıfını güncelle
                    categoryLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');

                    const selectedCategory = this.dataset.category;

                    // Ürünleri filtrele
                    productItems.forEach(item => {
                        if (selectedCategory === 'all' || item.dataset.category === selectedCategory) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

    <style>
        .product-item .card {
            transition: all 0.3s ease;
        }

        .product-item .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .list-group-item.active {
            background-color: #186650;
            border-color: #186650;
        }

        .card-img-top {
            height: 200px;
            object-fit: contain;
        }
    </style>
</body>

</html>