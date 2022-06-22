<?php
$uploaddir = $_SERVER["DOCUMENT_ROOT"];

$mime = mime_content_type($_FILES['file']['tmp_name']);
if(strstr($mime, "image/") || strstr($mime, "video/")){
    if(strstr($mime, "video/")){
        $uploaddir .= '/video/';
    }else if(strstr($mime, "image/")){
        $uploaddir .= '/image/';
    }
}else{
    $ret = array();
    $ret["code"] = -1;
    echo json_encode($ret);
    die();
}


    //$filename = time() . basename($_FILES['file']['name']);

    $filename = md5_file($_FILES['file']['tmp_name']) . "." . pathinfo(basename($_FILES['file']['name']), PATHINFO_EXTENSION);
    $uploadfile = $uploaddir . $filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);

    $ret = array();
    $ret["name"] = $filename;
    $ret["path"] = $uploadfile;

    echo json_encode($ret);
?>