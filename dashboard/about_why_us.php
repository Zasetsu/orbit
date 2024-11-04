<?php
session_start();
require_once 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Kayıt ekleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    try {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $order = $_POST['order'] ?? 0;
        
        // Görsel yükleme
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $image = uniqid() . '_' . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
        }
        
        $stmt = $db->prepare("INSERT INTO about_why_us (title, content, image, order_number) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $content, $image, $order]);
        
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Kayıt başarıyla eklendi!'];
    } catch (Exception $e) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Hata: ' . $e->getMessage()];
    }
    header('Location: about_why_us.php');
    exit;
}

// Kayıt güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    try {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $order = $_POST['order'] ?? 0;
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            
            // Eski görseli sil
            $stmt = $db->prepare("SELECT image FROM about_why_us WHERE id = ?");
            $stmt->execute([$id]);
            $old_image = $stmt->fetchColumn();
            if ($old_image && file_exists($target_dir . $old_image)) {
                unlink($target_dir . $old_image);
            }
            
            $image = uniqid() . '_' . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            
            $stmt = $db->prepare("UPDATE about_why_us SET title = ?, content = ?, image = ?, order_number = ? WHERE id = ?");
            $stmt->execute([$title, $content, $image, $order, $id]);
        } else {
            $stmt = $db->prepare("UPDATE about_why_us SET title = ?, content = ?, order_number = ? WHERE id = ?");
            $stmt->execute([$title, $content, $order, $id]);
        }
        
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Kayıt başarıyla güncellendi!'];
    } catch (Exception $e) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Hata: ' . $e->getMessage()];
    }
    header('Location: about_why_us.php');
    exit;
}

// Kayıt silme
if (isset($_GET['delete'])) {
    try {
        $id = $_GET['delete'];
        
        // Görsel silme
        $stmt = $db->prepare("SELECT image FROM about_why_us WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        
        if ($item['image'] && file_exists("uploads/" . $item['image'])) {
            unlink("uploads/" . $item['image']);
        }
        
        $stmt = $db->prepare("DELETE FROM about_why_us WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Kayıt başarıyla silindi!'];
    } catch (Exception $e) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Hata: ' . $e->getMessage()];
    }
    header('Location: about_why_us.php');
    exit;
}

// Kayıtları listele
$stmt = $db->query("SELECT * FROM about_why_us ORDER BY order_number ASC");
$items = $stmt->fetchAll();

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
    <title>Neden Biz?</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Neden Biz?</h5>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal">
                        <i class="fas fa-plus"></i> Yeni Ekle
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="80">Sıra</th>
                                    <th width="150">Görsel</th>
                                    <th>Başlık</th>
                                    <th>İçerik</th>
                                    <th width="120">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['order_number']); ?></td>
                                    <td>
                                        <?php if ($item['image']): ?>
                                            <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" 
                                                 class="img-thumbnail" style="max-height: 50px;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($item['title']); ?></td>
                                    <td><?php echo mb_substr(strip_tags($item['content']), 0, 100) . '...'; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info edit-btn" 
                                                data-id="<?php echo $item['id']; ?>"
                                                data-title="<?php echo htmlspecialchars($item['title']); ?>"
                                                data-content="<?php echo htmlspecialchars($item['content']); ?>"
                                                data-order="<?php echo $item['order_number']; ?>"
                                                data-toggle="modal" data-target="#editModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete=<?php echo $item['id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Bu kaydı silmek istediğinize emin misiniz?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ekleme Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        
                        <div class="form-group">
                            <label>Sıra</label>
                            <input type="number" name="order" class="form-control" value="0">
                        </div>
                        
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>İçerik</label>
                            <textarea name="content" class="form-control" rows="4" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Görsel</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Düzenleme Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit-id">
                        
                        <div class="form-group">
                            <label>Sıra</label>
                            <input type="number" name="order" id="edit-order" class="form-control" value="0">
                        </div>
                        
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>İçerik</label>
                            <textarea name="content" id="edit-content" class="form-control" rows="4" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Görsel</label>
                            <input type="file" name="image" class="form-control-file">
                            <small class="form-text text-muted">Yeni görsel yüklemezseniz mevcut görsel korunacaktır.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    $('.edit-btn').click(function() {
        $('#edit-id').val($(this).data('id'));
        $('#edit-title').val($(this).data('title'));
        $('#edit-content').val($(this).data('content'));
        $('#edit-order').val($(this).data('order'));
    });
    </script>
</body>
</html>