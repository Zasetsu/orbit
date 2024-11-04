<?php
session_start();
require_once 'config/db.php';

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Yönetim Paneli</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .welcome-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            margin-top: 50px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        
        .welcome-icon {
            font-size: 48px;
            color: #007bff;
            margin-bottom: 20px;
        }
        
        .welcome-text {
            font-size: 24px;
            color: #495057;
            margin-bottom: 15px;
        }
        
        .welcome-subtext {
            font-size: 16px;
            color: #6c757d;
            line-height: 1.6;
        }

        .navbar {
            background-color: #343a40;
            padding: 1rem;
        }

        .navbar-brand {
            color: white !important;
        }

        .logout-btn {
            color: rgba(255,255,255,.75);
            text-decoration: none;
        }

        .logout-btn:hover {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <span class="navbar-brand">Yönetim Paneli</span>
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Çıkış Yap
        </a>
    </nav>

    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="welcome-box">
                        <div class="welcome-icon">
                            <i class="fas fa-desktop"></i>
                        </div>
                        <h2 class="welcome-text">Yönetim Paneline Hoş Geldiniz</h2>
                        <p class="welcome-subtext">
                            Yan menüler aracılığıyla içerik düzenlemelerini yapabilirsiniz.
                            <br>
                            Ürünler, kategoriler ve diğer içerikleri kolayca yönetebilirsiniz.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>