<?php
$_GET['lecture_no'];
//echo '테스트중';
$no = $_GET['lecture_no'];
//echo $no;
$sql = "SELECT * FROM tb_lecture l INNER JOIN tb_category c ON l.category_no = c.category_no join tb_file f on l.file_no = f.file_no where l.lecture_no ='$no' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
//echo $row['teacher'];
//echo $result;

?> 

<div id="container" class="container">
<?php
		include '../include/adminLnb.php';
	?>

	<div id="content" class="content">
		<div class="tit-box-h3">
			<h3 class="tit-h3">강의목록</h3>
			<div class="sub-depth">
				<span><i class="icon-home"><span>홈</span></i></span>
				<span>관리자</span>
				<strong>강의목록</strong>
			</div>
		</div>

		<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs-view">
			<caption class="hidden">수강후기</caption>
			<colgroup>
            <col style="width:166px"/>
				<col style="*"/>
				<col style="width:110px"/>
			</colgroup>
			<tbody>
				 <tr>
					<th colspan="3" scope="col">분류 | <?= $row['category_title'] ?></th>
				 </tr>
				<tr>
                    <td>
						<a href="#" class="sample-lecture">
							<img src="<?=$row['file_path'] ?>" alt="" width="144" height="101" />
							<span class="tc-brand">샘플강의 ▶</span>
						</a>
					</td>
					<td colspan="2" class="lecture-txt">
						<em class="tit mt10"><?= $row['lecture_title'] ?></em>
						<p class="tc-gray mt20">강사: <?= $row['teacher']?></p>
						<p class="tc_gray mt20">학습난이도 : <?= $row['lecture_level'] ?></p>
						<p class="tc_gray mt20">교육시간 : <?= $row['time'] ?>시간</p>
					</td>
					<!-- <td class="t-r"><a href="#" class="btn-square-line">강의<br />상세</a></td> -->
				</tr>
			</tbody>
		</table>
		

		<div class="box-btn t-r">
			<a href="/admin/index.php?mode=list" class="btn-m-gray">목록</a>
			<? 
			 $row['id']
			?>
			<a href="/admin/index.php?mode=modify&&lecture_no=<?= $no ?>" class="btn-m ml5">수정</a>
			<!-- <td><a href="/admin/index.php?mode=view&&lecture_no='.$row[0].'"> -->
			<a href="#" class="btn-m-dark">삭제</a>
		</div>
	</div>
</div>

