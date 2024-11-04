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
        $title1 = $_POST['title1'];
        $title2 = $_POST['title2'];
        $content = $_POST['content'];
        
        // Görsel yükleme
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            // Eski görseli sil
            $stmt = $db->prepare("SELECT image FROM about_intro WHERE id = 1");
            $stmt->execute();
            $old_image = $stmt->fetchColumn();
            if ($old_image && file_exists($target_dir . $old_image)) {
                unlink($target_dir . $old_image);
            }
            
            $image = uniqid() . '_' . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            
            $stmt = $db->prepare("UPDATE about_intro SET title1 = ?, title2 = ?, content = ?, image = ? WHERE id = 1");
            $stmt->execute([$title1, $title2, $content, $image]);
        } else {
            $stmt = $db->prepare("UPDATE about_intro SET title1 = ?, title2 = ?, content = ? WHERE id = 1");
            $stmt->execute([$title1, $title2, $content]);
        }

        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Giriş bilgileri başarıyla güncellendi!'
        ];
        
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
    }
    
    header('Location: about_intro.php');
    exit;
}

// Mevcut bilgileri çek
$stmt = $db->query("SELECT * FROM about_intro WHERE id = 1");
$intro = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Hakkımızda Giriş</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/iwg5fqfmhbh5s5mpgcurst7rbgjy9aaovrxc3506c4l19db4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content',
            height: 400,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | bold italic backcolor | \
                     alignleft aligncenter alignright alignjustify | \
                     bullist numlist outdent indent | removeformat | help',
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
                            <h5 class="mb-0">Hakkımızda Giriş</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Başlık 1</label>
                                    <input type="text" name="title1" class="form-control" 
                                           value="<?php echo htmlspecialchars($intro['title1']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Başlık 2</label>
                                    <input type="text" name="title2" class="form-control" 
                                           value="<?php echo htmlspecialchars($intro['title2']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>İçerik</label>
                                    <textarea id="content" name="content" class="form-control">
                                        <?php echo htmlspecialchars($intro['content']); ?>
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label>Görsel</label>
                                    <?php if ($intro['image']): ?>
                                        <div class="mb-2">
                                            <img src="uploads/<?php echo htmlspecialchars($intro['image']); ?>" 
                                                 class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    <?php endif; ?>
                                    <input type="file" name="image" class="form-control-file">
                                    <small class="form-text text-muted">Yeni görsel yüklemezseniz mevcut görsel korunacaktır.</small>
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