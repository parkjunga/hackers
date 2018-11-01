<div id="container" class="container">
<style>
#alink img { max-width:100%; } 
</style>
<?php
	include '../include/lnb.php';
	$no = $_GET['review_no'];
	include 'Controller.php';
	$controller = new Controller();
	$view = $controller->view($no);
	$result = mysql_query($view[1]);
    $row = mysql_fetch_array($result);
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
					<th scope="col"><?= $result['row']['title'] ?></th>
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
						<span class="tit_rating">작성자 : <?= $row['user_id']?></span>
						</div>
						<div id="alink"><?= $row['contents'] ?></div>
						<?
						while($sRow=mysql_fetch_array($result)){
						?>
						첨부파일 : <a href="/lecture_board/download.php?filename=<?=$sRow['sys_name'] ?>"><?= $sRow['ori_name']?></a>
						<br/>
						<?
						}
						?>
					
						<? if($tRow != 0) echo '첨부파일 : '?><a href="/lecture_board/download.php?filename=<?=$row['sys_name'] ?>"><?= $row['ori_name']?></a>
					</td>
					
				</tr>
			</tbody>
		</table>
		
		
		<p class="mb15"><strong class="tc-brand fs16"><?= $row['user_id'] ?>님의 수강하신 강의 정보</strong></p>
		
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
			<? 
			if($_SESSION['id'] == $row['user_id']){
			?>
			<a href="/lecture_board/index.php?mode=modify&&review_no=<?= $no ?>" class="btn-m ml5">수정</a>
			<a href="/lecture_board/index.php?mode=delete&&review_no=<?= $no ?>" class="btn-m-dark">삭제</a>
			<?
			}
			?>
		</div>
	<!-- 리스트 출력 -->
	<?php


 // 검색쿼리
 $type = $_GET['type'];
 echo $type;
 echo '<br/>';
 $type2 = $_GET['type2'];
 echo $type2;
 echo '<br/>';
 $keyword = $_GET['keyword'];
 echo $keyword;
 $cNo = $_GET['category_no'];
		
 $query = "SELECT *
 FROM `tb_review` r
 JOIN `tb_lecture` l
  ON r.`lecture_no` = l.`lecture_no`
 JOIN `tb_user` u
  ON r.`user_id` = u.`id`
 JOIN `tb_category` c
  ON r.`category_no` = c.`category_no`";


 $where = "WHERE c.category_no = '$type'
			AND l.lecture_title LIKE '%$keyword%' order by r.board_no desc";
 
 $where2 ="WHERE c.category_no = '$type'
 AND u.name LIKE '%$keyword%' order by r.board_no desc";

 

 if($type != '' ){
	 if($type2 == 1){
		$sql =$query.$where;
	 }else{
		$sql = $query.$where2;
	 }
 }else{
	 // 총 데이터 수 
	 if($cNo != ''){
		$sql = $query."where c.category_no = '$cNo' order by r.board_no desc";
	 } else{
		 $sql = $query."order by r.board_no desc";
	 }
 }
 
 $result = mysql_query($sql); 
 while($sRow = mysql_fetch_array($result)){
	//echo $sRow['lecture_title'];
	//echo '<br/>';
};
 $total = mysql_num_rows($result); 
 $page = ($_GET['page'])?$_GET['page']:1;

 

 $pageSize = 10; // 페이지당 보여줄 게시글 수 
 $blockSize = 5; // 블록 당 페이지 수

 $pageN = ceil($total/$pageSize); // 총 페이지 
 $block = ceil($pageN/$blockSize); 
 $nowBlock = ceil($page/$blockSize); // 현재 위치한 블록 체크 
 $start_p = ($nowBlock*$blockSize)-($blockSize-1); 

 if($start_p <= 1){
	 $start_p = 1;
 }
 
 $end_p = $nowBlock * $blockSize;
 
 if($pageN <= $end_p){
	 $end_p = $pageN;
 }
 
?>
	<div id="content" class="content">
		
	
		<div class="search-info">
			<div class="search-form f-r">
				<form id="sForm">
				<select name="type" class="input-sel" style="width:158px" onChange="showSub(this.options[this.selectedIndex].value);"> 
				<option value="">분류</option>
    			<option value="0">일반직무</option>
   				<option value="1">산업직무</option>
    			<option value="2">공통역량</option>
    			<option value="3">어학 및 자격증</option> 
				</select>
				<select name="type2" class="input-sel" style="width:158px">
					<option value="1">강의명</option>
					<option value="2">작성자</option>
				</select>
				<input type="text" name="keyword" class="input-text" placeholder="강의명을 입력하세요." style="width:158px"/>
				<button id="searchBtn" type="submit" class="btn-s-dark">검색</button>
			</form>
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
				<col style="width:8%"/>
			</colgroup>

			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">제목</th>
					<th scope="col">강좌만족도</th>
					<th scope="col">작성자</th>
					<th scope="col">조회수</th>
				</tr>
			</thead>
			<tbody>
			<!-- 베스트 글 -->
			<?
			 $cntSql = $query."order by r.cnt desc Limit 0,3";
             $cntRst = mysql_query($cntSql);
			 while($cntRow = mysql_fetch_array($cntRst)){
				$star = $cntRow['satisfy'];
				if($cntRow['satisfy'] == '0'){
					$star = '0';
				}
				else if($cntRow['satisfy'] == '1') {
					$star = '20';
				}
				else if($cntRow['satisfy'] == '2') {
					$star = '40';
				}
				else if($cntRow['satisfy'] == '3') {
					$star = '60';
				}
				else if($cntRow['satisfy'] == '4') {
					$star = '80';
				}else if($cntRow['satisfy'] == '5') {
					$star = '100';
				} 
			 ?>
				<!-- set -->
				<tr class="bbs-sbj">
					<td><span class="txt-icon-line"><em>BEST</em></span></td>
					<td><?= $cntRow['category_title']?></td>
					<td>
                    <a href="/lecture_board/index.php?mode=view&&review_no=<?= $cntRow['board_no']?>"  >
							<span class="tc-gray ellipsis_line">수강 강의명 : <?= $cntRow['lecture_title']?></span>
							<strong class="ellipsis_line"><?= $cntRow['title']?></strong>
						</a>
					</td>
					<td class="last"><span class="star-rating">
							<span class="star-inner" style="width:<?= $star ?>%"></span>
						</span></td>
					<td class="last"><?= $cntRow['name']?></td>
					<td class="last"><?= $cntRow['cnt']?></td>
				</tr>
				<?
			 }
			 ?>
				<!-- 일반 게시글 -->
				<?php
				// $totalSize는 한페이지당 뿌려줄 데이터 수 
				$s_point = ($page-1)*$pageSize; 
				if($type != '' ){
					if($type2 == 1){
					   $data = $query.$where.' Limit '.$s_point.','.$pageSize;
					}else{
						$data = $query.$where2.' Limit '.$s_point.','.$pageSize;
					}
				}else{
					// 총 데이터 수 
					if($cNo != ''){
						$data = $query."where c.category_no = '$cNo' order by r.board_no desc Limit ".$s_point.','.$pageSize;
					}else{
						$data = $query."order by r.board_no desc Limit ".$s_point.','.$pageSize;
					}
					
				}
				
				$rst = mysql_query($data);
				while($sRow = mysql_fetch_array($result)){
				   echo $sRow['lecture_title'];
			   };
				// total은 총 데이터수 
				for($i=1; $i<=$total; $i++){
				$row = mysql_fetch_array($rst);
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
				<tr class="bbs-sbj">
				 	<td><?= $row['board_no']?></td>
					<td><?= $row['category_title']?></td>
					<td><a href="/lecture_board/index.php?mode=view&&review_no=<?= $row['board_no']?>"  >
					<span class="tc-gray ellipsis_line">수강 강의명 : <?= $row['lecture_title']?></span>
					<span class="tc-gray ellipsis_line"><?= $row['title']?></span></a></td>
					<td class="last"><span class="star-rating">
							<span class="star-inner" style="width:<?= $star ?>%"></span>
						</span></td>
					<td class="last"><?= $row['name']?></td>
					<td class="last"><?= $row['cnt']?></td>
				</tr>	
				<?
 					if($row == false){
						 break;
						 echo'없다';
				?>
				<?
 					}
				}
				?>
				<!-- //set -->

			</tbody>
		</table>

		<div class="box-paging">
			<a href="<?= $PHP_SELF?>?page=<?= $start_p?>"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
			<a href="<?= $PHP_SELF?>?page=<?=$start_p-1?>"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
			<?
			for($p=$start_p; $p<=$end_p; $p++){
			?>
			<a id="paging" href="<?= $PHP_SELF?>?page=<?=$p?>" <? 	if($page == $p){ echo 'class="active"';}?> ><?=$p?></a>
			<?
			}
			?>
			<a href="<?$PHP_SELF?>?page=<?= $end_p+1?>"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>
			<a href="<?$PHP_SELF?>?page=<?= $end_p?>"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>
		</div>

	</div>





	</div>
</div>
