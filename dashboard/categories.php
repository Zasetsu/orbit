<?php
session_start();
require_once 'config/db.php';

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$alert = []; // Alert mesajları için dizi

// Kategori ekleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    try {
        $title = $_POST['title'];
        $order_number = $_POST['order_number'];
        
        $stmt = $db->prepare("INSERT INTO categories (title, order_number) VALUES (?, ?)");
        $stmt->execute([$title, $order_number]);
        
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Kategori başarıyla eklendi!'
        ];
        
        header('Location: categories.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: categories.php');
        exit;
    }
}

// Kategori güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    try {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $order_number = $_POST['order_number'];
        
        $stmt = $db->prepare("UPDATE categories SET title = ?, order_number = ? WHERE id = ?");
        $stmt->execute([$title, $order_number, $id]);
        
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Kategori başarıyla güncellendi!'
        ];
        
        header('Location: categories.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: categories.php');
        exit;
    }
}

// Kategori silme
if (isset($_GET['delete'])) {
    try {
        $id = $_GET['delete'];
        
        // Önce kategoriye bağlı ürün var mı kontrol et
        $check_products = $db->prepare("SELECT COUNT(*) FROM products WHERE category_id = ?");
        $check_products->execute([$id]);
        $has_products = $check_products->fetchColumn();
        
        if ($has_products > 0) {
            $_SESSION['alert'] = [
                'type' => 'danger',
                'message' => 'Bu kategoriye ait ürünler bulunduğu için silinemez!'
            ];
        } else {
            $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Kategori başarıyla silindi!'
            ];
        }
        
        header('Location: categories.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: categories.php');
        exit;
    }
}

// Alert mesajını al ve temizle
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

// Kategorileri listele
$stmt = $db->query("SELECT * FROM categories ORDER BY order_number ASC");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategoriler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="container-fluid py-4">
            <h2>Kategoriler</h2>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus"></i> Yeni Kategori Ekle
            </button>

            <!-- HTML içinde alert gösterimi -->
<?php if (isset($alert) && isset($alert['type']) && isset($alert['message'])): ?>
    <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $alert['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Sıra</th>
                        <th>Başlık</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo $category['order_number']; ?></td>
                        <td><?php echo $category['title']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" 
                                    data-id="<?php echo $category['id']; ?>"
                                    data-title="<?php echo $category['title']; ?>"
                                    data-order="<?php echo $category['order_number']; ?>"
                                    data-toggle="modal" data-target="#editModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="?delete=<?php echo $category['id']; ?>" class="btn btn-sm btn-danger" 
                               onclick="return confirm('Silmek istediğinize emin misiniz?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ekleme Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yeni Kategori Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Sıra</label>
                            <input type="number" name="order_number" class="form-control" required value="999">
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
<h5 class="modal-title">Kategori Düzenle</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<form method="POST">
<div class="modal-body">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="id" id="edit-id">
<div class="form-group">
<label>Başlık</label>
<input type="text" name="title" id="edit-title" class="form-control" required>
</div>
<div class="form-group">
<label>Sıra</label>
<input type="number" name="order" id="edit-order" class="form-control" required>
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
$('#edit-order').val($(this).data('order'));
});
</script>
</body>
</html>