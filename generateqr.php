<?php
    include './vendor/phpqrcode/qrlib.php';
    $id = $_GET['id'];
    $url = $_GET['url'];
    $path = $_GET['path'];
    $data = $url.$id;
    QRcode::png($data, "$path/$id.png");
    ?>