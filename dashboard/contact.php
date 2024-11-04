<?php
session_start();
require_once 'config/db.php';

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $address = $_POST['address'];
        $directions = $_POST['directions'];  // Yeni eklenen
        $working_hours = $_POST['working_hours'];
        $instagram_url = $_POST['instagram_url'];

        // Veritabanını güncelle
        $stmt = $db->prepare("UPDATE contact_settings SET 
            address = ?, 
            directions = ?,  
            working_hours = ?, 
            instagram_url = ? 
            WHERE id = 1");
        $stmt->execute([
            $address, 
            $directions,  // Yeni eklenen
            $working_hours, 
            $instagram_url
        ]);

        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'İletişim bilgileri başarıyla güncellendi!'
        ];

        header('Location: contact.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: contact.php');
        exit;
    }
}

// Mevcut ayarları çek
$stmt = $db->query("SELECT * FROM contact_settings WHERE id = 1");
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

// Alert mesajını al
$alert = null;
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Ayarları</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php if (isset($alert) && isset($alert['type']) && isset($alert['message'])): ?>
                <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $alert['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">İletişim Bilgileri</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-map-marker-alt"></i> Adres
                                    </label>
                                    <textarea name="address" class="form-control" rows="3" required><?php echo htmlspecialchars($contact['address']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-route"></i> Yol Tarifi
                                    </label>
                                    <textarea name="directions" class="form-control" rows="4"><?php echo htmlspecialchars($contact['directions'] ?? ''); ?></textarea>
                                    <small class="form-text text-muted">Detaylı yol tarifi yazabilirsiniz. Örn: Metro durağından çıkınca sağa dönün...</small>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-clock"></i> Çalışma Saatleri
                                    </label>
                                    <textarea name="working_hours" class="form-control" rows="3" required><?php echo htmlspecialchars($contact['working_hours']); ?></textarea>
                                    <small class="form-text text-muted">Her satıra bir gün yazabilirsiniz. Örn: Pazartesi: 09:00 - 18:00</small>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fab fa-instagram"></i> Instagram URL
                                    </label>
                                    <input type="url" name="instagram_url" class="form-control" value="<?php echo htmlspecialchars($contact['instagram_url']); ?>" required>
                                    <small class="form-text text-muted">Instagram profil linkinizi girin</small>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Kaydet
                                </button>
                            </form>
                        </div>
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