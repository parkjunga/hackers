<?php
$no = $_GET['review_no'];
echo  $no;
$rSql = "DELETE 
        FROM tb_review 
        WHERE board_no = '$no'";
echo  $rSql;
$rRst = mysql_query($rSql);

$fSql = " DELETE 
		    FROM tb_review_file 
           WHERE board_no = '$no'";
$fRst = mysql_query($fSql);
$gSql = " DELETE 
		    FROM tb_review_file_group
           WHERE board_no = '$no'";
$gRst = mysql_query($gSql);
echo '삭제완료';
echo("<script>location.href='/lecture_board/index.php?mode=list';</script>");
?>