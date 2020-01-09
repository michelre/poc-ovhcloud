<?php

require 'vendor/autoload.php';
require_once 'StorageService.php';

$storageService = new StorageService();

if(!isset($_GET['action'])){
    $files = $storageService->getFileNames();
    require_once 'view.php';
}

if($_GET['action'] == 'send-file'){
    $file = $_FILES['document'];
    $storageService->sendFile($file);
    header('Location: /');
}

if($_GET['action'] == 'delete-file'){
    $storageService->deleteFile($_GET['name']);
    header('Location: /');
}

if($_GET['action'] == 'download-file'){
    $url = $storageService->getFileUrl($_GET['name']);
    require_once 'download.php';
}
