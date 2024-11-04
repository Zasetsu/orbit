<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Form gönderildiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $button_text = $_POST['button_text'];
        $button_link = $_POST['button_link'];
        
        // Görsel yükleme
        $image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $image = uniqid() . '_' . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            
            $stmt = $db->prepare("UPDATE home_promo SET title = ?, content = ?, button_text = ?, button_link = ?, image = ? WHERE id = 1");
            $stmt->execute([$title, $content, $button_text, $button_link, $image]);
        } else {
            $stmt = $db->prepare("UPDATE home_promo SET title = ?, content = ?, button_text = ?, button_link = ? WHERE id = 1");
            $stmt->execute([$title, $content, $button_text, $button_link]);
        }

        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Promo bilgileri başarıyla güncellendi!'
        ];
        
        header('Location: home_promo.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: home_promo.php');
        exit;
    }
}

// Mevcut bilgileri çek
$stmt = $db->query("SELECT * FROM home_promo WHERE id = 1");
$promo = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Promo Düzenle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/iwg5fqfmhbh5s5mpgcurst7rbgjy9aaovrxc3506c4l19db4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#content',
            height: 300,
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            language: 'tr'
        });
    </script>
</head>
<body>
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="container-fluid py-4">
            <?php if (isset($alert)): ?>
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
                            <h5 class="mb-0">Promo Düzenle</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Başlık</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($promo['title']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>İçerik</label>
                                    <textarea id="content" name="content" class="form-control"><?php echo htmlspecialchars($promo['content']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Buton Metni</label>
                                    <input type="text" name="button_text" class="form-control" value="<?php echo htmlspecialchars($promo['button_text']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Buton Linki</label>
                                    <input type="text" name="button_link" class="form-control" value="<?php echo htmlspecialchars($promo['button_link']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Görsel</label>
                                    <?php if ($promo['image']): ?>
                                        <div class="mb-2">
                                            <img src="uploads/<?php echo htmlspecialchars($promo['image']); ?>" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="image" class="form-control-file">
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