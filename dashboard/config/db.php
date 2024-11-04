<?php
$host = '127.0.0.1';
$dbname = 'cms_db';
$username = 'cms_user';
$password = 'Orbit2024!';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
    die();
}

// Contact Settings verilerini çek
$stmt_contact = $db->prepare("SELECT address, directions, working_hours, instagram_url FROM contact_settings WHERE id = 1");
$stmt_contact->execute();
$contact = $stmt_contact->fetch(PDO::FETCH_ASSOC);