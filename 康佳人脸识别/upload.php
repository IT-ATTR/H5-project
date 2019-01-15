<?php 
    $base64_str = $_POST['localimg'];
    $data = base64_decode($base64_str);

    if (!is_dir("./upload/")) {
        mkdir("./upload/",0777,true);
    }

    $tagName = "./upload/".date('YmdHis').rand(1000,9999).'.jpg';

    if (file_put_contents($tagName, $data)) {
        echo json_encode($tagName);
    }


 ?>