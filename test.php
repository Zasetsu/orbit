<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Instagram\Api;
use Instagram\Exception\InstagramException;

function saveImage($imageUrl, $savePath) {
    if (!file_exists($savePath)) {
        $imageData = file_get_contents($imageUrl);
        if ($imageData !== false) {
            file_put_contents($savePath, $imageData);
            return true;
        }
    }
    return false;
}

function loadInstagramPosts($username, $password, $targetProfile) {
    try {
        $cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . '/cache');
        $api = new Api($cachePool);
        $api->login($username, $password);

        $profile = $api->getProfile($targetProfile);
        $medias = $api->getMoreMedias($profile);

        // Son 12 medyayı içeren bir dizi oluştur
        $lastTwelveMedia = array_slice($medias->getMedias(), 0, 12);

        // JSON'a yazılacak veriyi hazırla
        $jsonData = [];
        foreach ($lastTwelveMedia as $media) {
            $imageUrl = $media->getDisplaySrc();
            $filename = 'instagram_' . md5($imageUrl) . '.jpg';
            $savePath = __DIR__ . '/instagramImages/' . $filename;
            
            if (saveImage($imageUrl, $savePath)) {
                $localImage = 'instagramImages/' . $filename;
            } else {
                $localImage = $imageUrl; // İndirme başarısız olursa orijinal URL'yi kullan
            }

            $jsonData[] = [
                'link' => $media->getLink(),
                'caption' => $media->getCaption(),
                'image' => $localImage
            ];
        }

        // Veriyi JSON formatına dönüştür
        $jsonContent = json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        // JSON dosyasına yaz
        file_put_contents('instagram.json', $jsonContent);

        echo "Instagram verileri başarıyla 'instagram.json' dosyasına kaydedildi.";
    } catch (InstagramException $e) {
        echo 'Bir hata oluştu: ' . $e->getMessage();
    }
}

// Fonksiyonu çağır
loadInstagramPosts('Zasetsu', 'Azathoth92', 'orbitcoffeecom');