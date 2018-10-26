<div id="container" class="container">
<?php
	include '../include/lnb.php';
	$no = $_GET['review_no'];
	// 글번호
	$sql = "SELECT * 
	        FROM tb_review r 
			INNER JOIN tb_lecture l 
			ON r.lecture_no = l.lecture_no 
			INNER JOIN tb_file f 
			ON l.file_no = f.file_no 
			WHERE r.board_no = '$no'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	//echo $row;
	$cnt = "update tb_review r
	           set r.cnt = r.cnt+1
			where r.board_no = '$no'";
	$rst = mysql_query($cnt);
	//echo $rst;
	?>
	<div id="content" class="content">
		<div class="tit-box-h3">
			<h3 class="tit-h3">수강후기</h3>
			<div class="sub-depth">
				<span><i class="icon-home"><span>홈</span></i></span>
				<span>직무교육 안내</span>
				<strong>수강후기</strong>
			</div>
		</div>

		<table border="0" cellpadding="0" cellspacing="0" class="tbl-bbs-view">
			<caption class="hidden">수강후기</caption>
			<colgroup>
				<col style="*"/>
				<col style="width:50%"/>
			</colgroup>
			<tbody>
				 <tr>
					<th scope="col"><?= $row['title'] ?></th>
					<th scope="col" class="user-id">등록일 | <?= $row['reg_date'] ?> 조회수 <?= $row['cnt'] ?></th>
				 </tr>
				<tr>
					<td colspan="2">
						<div class="box-rating">
							<span class="tit_rating">강의만족도</span>
							<?php
							
				$star = $row['satisfy'];
				if($row['satisfy'] == '0'){
					$star = '0';
				}
				else if($row['satisfy'] == '1') {
					$star = '20';
				}
				else if($row['satisfy'] == '2') {
					$star = '40';
				}
				else if($row['satisfy'] == '3') {
					$star = '60';
				}
				else if($row['satisfy'] == '4') {
					$star = '80';
				}else if($row['satisfy'] == '5') {
					$star = '100';
				} 
							?>
					<span class="star-rating">
								<span class="star-inner" style="width:<?=$star ?>%"></span>
							</span>
						</div>
						<div class="box-rating">
						<span class="tit_rating">작성자 : <?= $row['id']?></span>
						</div>
						<?= $row['contents'] ?>
					</td>
				</tr>
			</tbody>
		</table>
		
		
		<p class="mb15"><strong class="tc-brand fs16"><?= $row['id'] ?>님의 수강하신 강의 정보</strong></p>
		
		<table border="0" cellpadding="0" cellspacing="0" class="tbl-lecture-list">
			<caption class="hidden">강의정보</caption>
			<colgroup>
				<col style="width:166px"/>
				<col style="*"/>
				<col style="width:110px"/>
			</colgroup>
			<tbody>
				<tr>
					<td>
						<a href="#" class="sample-lecture">
							<img src="<?= $row['file_path'] ?>" alt="" width="144" height="101" />
							<span class="tc-brand">샘플강의 ▶</span>
						</a>
					</td>
					<td class="lecture-txt">
						<em class="tit mt10"><?= $row['lecture_title'] ?></em>
						<p class="tc-gray mt20">강사: <?= $row['teacher'] ?> | 학습난이도 : <?= $row['lecture_level'] ?> | 교육시간: <?= $row['time'] ?>시간 <!--(18강)--></p>
					</td>
					<td class="t-r"><a href="#" class="btn-square-line">강의<br />상세</a></td>
				</tr>
			</tbody>
		</table>

		<div class="box-btn t-r">
			<a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
			<a href="/lecture_board/index.php?mode=modify&&review_no=<?= $no ?>" class="btn-m ml5">수정</a>
			<a href="#" class="btn-m-dark">삭제</a>
		</div>

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
					<th scope="col">제목</th>
					<th scope="col">강의만족도</th>
					<th scope="col">작성자</th>
				</tr>
			</thead>
	 
			<tbody>
				<!-- set -->
				<tr class="bbs-sbj">
					<td>1</td>
					<td>CS</td>
					<td>
						<a href="#">
							<span class="tc-gray ellipsis_line">수강 강의명 : Beyond Trouble, 조직을 감동시키는 관계의 기술</span>
							<strong class="ellipsis_line">절대 후회 없는 강의 예요!</strong>
						</a>
					</td>
					<td>
						<span class="star-rating">
							<span class="star-inner" style="width:80%"></span>
						</span>
					</td>
					<td class="last">이름</td>
				</tr>
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
	</div>
</div>
