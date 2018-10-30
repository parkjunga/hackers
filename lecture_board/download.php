<?php
$sysnmae = $_GET['filename'];
$filepath = '/upload/temp/'.$sysnmae;
$filesize = filesize($filepath);
echo $filesize;
$path_parts = pathinfo($filepath);
$filename = $path_parts['basename']; // 파일명
$extension = $path_parts['extension']; // 파일 확장자
 
header('Pragma: public');
header('Expires: 0');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . $filesize);
 
ob_clean();
flush();
readfile($filepath);
?>