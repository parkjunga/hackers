<?php

$sql = "SELECT * FROM tb_lecture l INNER JOIN tb_category c ON l.category_no = c.category_no order by l.lecture_no desc";
$result = mysql_query($sql);
//echo $result;

?> 
 <div id="container" class="container">
	<?php
	include 'adminLnb.php'
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
			<li class="on"><a href="#">전체</a></li>
			<li><a href="#">일반직무</a></li>
			<li><a href="#">산업직무</a></li>
			<li><a href="#">공통역량</a></li>
			<li><a href="#">어학 및 자격증</a></li>
		</ul>

		<div class="search-info">
			<div class="search-form f-r">
				<select class="input-sel" style="width:158px">
					<option value="">분류</option>
				</select>
				<select class="input-sel" style="width:158px">
					<option value="">강의명</option>
					<option value="">작성자</option>
				</select>
				<input type="text" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
				<button type="button" class="btn-s-dark">검색</button>
			</div>
		</div>

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
				<!-- set -->
				<tr class="bbs-sbj">
					<td><span class="txt-icon-line"><em>BEST</em></span></td>
					<td>CS</td>
					<td>
                    <a href="/lecture_board/index.php?mode=view">
							<span class="tc-gray ellipsis_line">Beyond Trouble, 조직을 감동시키는 관계의 기술</span>
						</a>
					</td>
					<td class="last">이름</td>
					<td class="last">15시간</td>
				</tr>
				<!-- //set -->
				<!-- set -->

				<?php
				while($row=mysql_fetch_row($result)){
					echo '<tr class="bbs-sbj">';
					echo '<td>'.$row[0].'</td>';
					echo '<td>'.$row[8].'</td>';
					echo '<td><a href="/admin/index.php?mode=view&&lecture_no='.$row[0].'">
					<span class="tc-gray ellipsis_line">'.$row[2].'</span>
				    </a></td>';
					echo '<td class="last">'.$row[6].'</td>';
					echo '<td class="last">'.$row[3].'시간</td>';
					echo '<tr/>';
				}
				?>
				<!-- //set -->
			</tbody>
		</table>

		<div class="box-paging">
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
		</div>

		<div class="box-btn t-r">
			<a href="/admin/index.php?mode=write" class="btn-m">후기 작성</a>
		</div>
	</div>
</div>

