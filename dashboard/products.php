<?php
session_start();
require_once 'config/db.php';

// Oturum kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$alert = []; // Alert mesajları için dizi

// Ürün ekleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    try {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        
        // Görsel yükleme
        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $image = uniqid() . '_' . basename($_FILES["image"]["name"]);
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image)) {
                $stmt = $db->prepare("INSERT INTO products (title, description, image, category_id) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $description, $image, $category_id]);
                
                $_SESSION['alert'] = [
                    'type' => 'success',
                    'message' => 'Ürün başarıyla eklendi!'
                ];
            } else {
                throw new Exception("Görsel yüklenirken bir hata oluştu.");
            }
        } else {
            $stmt = $db->prepare("INSERT INTO products (title, description, image, category_id) VALUES (?, ?, ?, ?)");
            $stmt->execute([$title, $description, $image, $category_id]);
            
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Ürün başarıyla eklendi!'
            ];
        }
        
        header('Location: products.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: products.php');
        exit;
    }
}

// Ürün güncelleme
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    try {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target_dir = "uploads/";
            $image = uniqid() . '_' . basename($_FILES["image"]["name"]);
            
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image)) {
                $stmt = $db->prepare("UPDATE products SET title = ?, description = ?, image = ?, category_id = ? WHERE id = ?");
                $stmt->execute([$title, $description, $image, $category_id, $id]);
            } else {
                throw new Exception("Görsel güncellenirken bir hata oluştu.");
            }
        } else {
            $stmt = $db->prepare("UPDATE products SET title = ?, description = ?, category_id = ? WHERE id = ?");
            $stmt->execute([$title, $description, $category_id, $id]);
        }
        
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Ürün başarıyla güncellendi!'
        ];
        
        header('Location: products.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: products.php');
        exit;
    }
}

// Ürün silme
if (isset($_GET['delete'])) {
    try {
        $id = $_GET['delete'];
        
        // Önce eski görseli sil
        $stmt = $db->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch();
        
        if ($product['image'] && file_exists("uploads/" . $product['image'])) {
            unlink("uploads/" . $product['image']);
        }
        
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Ürün başarıyla silindi!'
        ];
        
        header('Location: products.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Hata: ' . $e->getMessage()
        ];
        header('Location: products.php');
        exit;
    }
}

// Alert mesajını al ve temizle
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
}

// Ürünleri listele
$stmt = $db->query("SELECT p.*, c.title as category_name 
                    FROM products p 
                    LEFT JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC");
$products = $stmt->fetchAll();

// Kategorileri listele
$stmt = $db->query("SELECT * FROM categories ORDER BY order_number ASC");
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünler</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        <div class="container-fluid py-4">
            <h2>Ürünler</h2>
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus"></i> Yeni Ürün Ekle
            </button>

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
                        <th>Görsel</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <?php if ($product['image']): ?>
                                    <img src="uploads/<?php echo $product['image']; ?>" height="50">
                                <?php endif; ?>
                            </td>
                            <td><?php echo $product['title']; ?></td>
                            <td><?php echo $product['category_name']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning edit-btn" data-id="<?php echo $product['id']; ?>"
                                    data-title="<?php echo $product['title']; ?>"
                                    data-description="<?php echo $product['description']; ?>"
                                    data-category="<?php echo $product['category_id']; ?>" data-toggle="modal"
                                    data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?delete=<?php echo $product['id']; ?>" class="btn btn-sm btn-danger"
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
                    <h5 class="modal-title">Yeni Ürün Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['title']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
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
                    <h5 class="modal-title">Ürün Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category_id" id="edit-category" class="form-control" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['title']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Başlık</label>
                            <input type="text" name="title" id="edit-title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Açıklama</label>
                            <textarea name="description" id="edit-description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Görsel</label>
                            <input type="file" name="image" class="form-control-file">
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
        $('.edit-btn').click(function () {
            $('#edit-id').val($(this).data('id'));
            $('#edit-title').val($(this).data('title'));
            $('#edit-description').val($(this).data('description'));
            $('#edit-category').val($(this).data('category'));
        });
    </script>
</body>

</html>