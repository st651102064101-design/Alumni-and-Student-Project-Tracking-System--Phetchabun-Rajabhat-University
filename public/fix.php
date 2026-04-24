<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$storage = __DIR__ . '/../storage';
$cache = __DIR__ . '/../bootstrap/cache';

echo "Attempting to fix permissions...<br>";

try {
    chmod($storage, 0777);
    chmod($cache, 0777);
    
    // พยายามเปลี่ยนแบบจำกัดแค่ directory หลักๆ หาก shell_exec โดนปิด
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($storage), 
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach($iterator as $item) {
        chmod($item, 0777);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cache), 
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach($iterator as $item) {
        chmod($item, 0777);
    }
    
    echo "Done! <br>Storage: $storage <br>Cache: $cache";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
