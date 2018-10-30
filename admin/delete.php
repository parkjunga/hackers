<?php
$no = $_GET['lecture_no'];
$fileNo  =$_GET['file_no'];
echo  $no;
echo $fileNo;
$rSql = "DELETE 
        FROM tb_lecture 
        WHERE lecture_no = '$no'";
echo  $rSql;
$rRst = mysql_query($rSql);

$fileNo = $_GET['file_no'];
$fSql = " DELETE 
		    FROM tb_file 
           WHERE file_no = '$fileNo'";
$fRst = mysql_query($fSql);
echo '삭제완료';
echo("<script>location.href='/admin/index.php?mode=list';</script>");
?>