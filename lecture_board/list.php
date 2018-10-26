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
 
 $query = "SELECT *
 FROM `tb_review` r
 JOIN `tb_lecture` l
  ON r.`lecture_no` = l.`lecture_no`
 JOIN `tb_user` u
  ON r.`id` = u.`id`
 JOIN `tb_category` c
  ON r.`category_no` = c.`category_no`";


 $where = "WHERE c.category_no = '$type'
			AND l.lecture_title LIKE '%$keyword%' order by r.board_no desc";
 
 $where2 ="WHERE c.category_no = '$type'
 AND u.name LIKE '%$keyword%' order by r.board_no desc";

 // 

 if($type != '' ){
	 if($type2 == 1){
		$sql =$query.$where;
	 }else{
		$sql = $query.$where2;
	 }
 }else{
	 // 총 데이터 수 
 $sql = $query."order by r.board_no desc";
 }
 
 $result = mysql_query($sql); 
 while($sRow = mysql_fetch_array($result)){
	echo $sRow['lecture_title'];
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
<div id="container" class="container">
	<?php
	include '../include/lnb.php';
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
		<ul class="tab-list tab5">
			<li class="on"><a href="#">전체</a></li>
			<li><a href="#">일반직무</a></li>
			<li><a href="#">산업직무</a></li>
			<li><a href="#">공통역량</a></li>
			<li><a href="#">어학 및 자격증</a></li>
		</ul>

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
			</colgroup>

			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">분류</th>
					<th scope="col">제목</th>
					<th scope="col">강좌만족도</th>
					<th scope="col">작성자</th>
				</tr>
			</thead>
	 
			<tbody>
				<!-- set -->
				<tr class="bbs-sbj">
					<td><span class="txt-icon-line"><em>BEST</em></span></td>
					<td>CS</td>
					<td>
                    <a href="/lecture_board/index.php?mode=view">
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
				<!-- set -->
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
					$data = $query.'order by r.board_no desc Limit '.$s_point.','.$pageSize;
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
			<a href="#"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
			<a href="<?= $PHP_SELF?>?page=<?=$start_p-1?>"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
			<?
			for($p=$start_p; $p<=$end_p; $p++){
			?>
			<a id="paging" href="<?= $PHP_SELF?>?page=<?=$p?>" <? 	if($page == $p){ echo 'class="active"';}?> ><?=$p?></a>
			<?
			}
			?>
			<!-- <a href="#" class="active">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a href="#">5</a>
			<a href="#">6</a> -->
			<a href="<?$PHP_SELF?>?page=<?= $end_p+1?>"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>
			<a href="#"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>
		</div>

		<div class="box-btn t-r">
		<a id="btn" href="/lecture_board/index.php?mode=write" class="btn-m">후기 작성</a>
			<?php
			if(!$_SESSION['id']){
				echo '<script> $("#btn").click(function(){ alert("로그인 후 작성 가능합니다."); return false;})</script>';
			
			}
			?>
		</div>
	</div>
</div>
<script>
/*  $("#searchBtn").click(function(){
	 var type = $("select[name='type']").val();
	 if(type == ""){
		 alert("분류를 선택해주세요");
		 return false;
	 }
	 $("#sForm").submit();
 }) */
</script>
