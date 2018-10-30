<?php

// 관리자 리스트 페이지

$cNo = $_GET['category_no'];
//echo $cNo;
$sql = "SELECT * FROM tb_lecture l INNER JOIN tb_category c ON l.category_no = c.category_no";
if($cNo != ''){
	$data = $sql." where c.category_no = '$cNo' order by l.lecture_no desc";
	//echo $data;
}else{
	$data = $sql." order by l.lecture_no desc";
	//echo $data;
}


$result = mysql_query($data);
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

		<ul class="tab-list tab5">
			<li class="<? if($cNo == '') echo 'on' ?>"><a href="/admin/index.php?mode=list" >전체</a></li>
			<li class="<? if($cNo == '0') echo 'on' ?>" ><a href="/admin/index.php?mode=list&&category_no=0" >일반직무</a></li>
			<li class="<? if($cNo == '1') echo 'on' ?>"><a href="/admin/index.php?mode=list&&category_no=1" >산업직무</a></li>
			<li class="<? if($cNo == '2') echo 'on' ?>"><a href="/admin/index.php?mode=list&&category_no=2" >공통역량</a></li>
			<li class="<? if($cNo == '3') echo 'on' ?>"><a href="/admin/index.php?mode=list&&category_no=3" >어학 및 자격증</a></li>
		</ul>
		<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs">
			<caption class="hidden">수강후기</caption>
			<colgroup>
				<col style="width:8%"/>
				<col style="width:8%"/>
				<col style="*"/>
				<col style="width:15%"/>
				<col style="width:12%"/>
			</colgroup>

			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">강의명</th>
					<th scope="col">강사</th>
					<th scope="col">교육시간</th>
				</tr>
			</thead>
	 
			<tbody>

				<?php
				while($row=mysql_fetch_array($result)){
					echo '<tr class="bbs-sbj">';
					echo '<td>'.$row['lecture_no'].'</td>';
					echo '<td>'.$row['category_title'].'</td>';
					echo '<td><a href="/admin/index.php?mode=view&&lecture_no='.$row['lecture_no'].'">
					<span class="tc-gray ellipsis_line">'.$row['lecture_title'].'</span>
				    </a></td>';
					echo '<td class="last">'.$row['teacher'].'</td>';
					echo '<td class="last">'.$row['time'].'시간</td>';
					echo '<tr/>';
				}
				?>
				<!-- //set -->
			</tbody>
		</table>

		<!-- <div class="box-paging">
			<a href="#"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
			<a href="#"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
			<a href="#" class="active">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a href="#">5</a>
			<a href="#">6</a>
			<a href="#"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>
			<a href="#"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>
		</div> -->

		<div class="box-btn t-r">
			<a href="/admin/index.php?mode=write" class="btn-m">강의 등록</a>
		</div>
	</div>
</div>

