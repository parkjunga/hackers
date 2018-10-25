<?php

// 총 데이터 수 
 $sql = "SELECT * FROM tb_review r INNER JOIN tb_category c ON r.category_no = c.category_no JOIN tb_user u ON r.id = u.id  order by r.board_no desc";
 $result = mysql_query($sql); 
 $total = mysql_num_rows($result); 
 $page = ($_GET['page'])?$_GET['page']:1;

 // 검색쿼리
 $type = $_GET['type'];
 $keyword = $_GET['keyword'];
 $search = "SELECT * FROM tb_review r INNER JOIN tb_category c ON r.category_no = c.category_no JOIN tb_user u ON r.id = u.id  WHERE c.category_no = '$type' AND (l.lecture_title LIKE '%$keyword%' OR l.name LIKE '%$keyword%') order by r.board_no desc";
 $sResult = mysql_query($search);
 while($sRow = mysql_fetch_array($sResult)){
	 echo $sRow['lecture_title'];
 };


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
	include 'lnb.php'
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
				<!-- //set -->
<!-- 			
				while($row=mysql_fetch_array($result)){
					echo '<tr class="bbs-sbj">';
					echo '<td>'.$row['board_no'].'</td>';
					echo '<td>'.$row['category_title'].'</td>';
					echo '<td><a href="/lecture_board/index.php?mode=view&&review_no='.$row['board_no'].'">
					<span class="tc-gray ellipsis_line">'.$row['title'].'</span>
				    </a></td>';
					echo '<td class="last">'.$row['satisfy'].'</td>';
					echo '<td class="last">'.$row['name'].'</td>';
					echo '<tr/>';
				}
				?>
				
 -->
				<!-- set -->
				<?php
				// $totalSize는 한페이지당 뿌려줄 데이터 수 
				$s_point = ($page-1)*$pageSize; 
				$data = "SELECT * 
				          FROM tb_review r 
						  INNER JOIN tb_category c
						   ON r.category_no = c.category_no 
						   INNER JOIN tb_user u 
						   ON r.id = u.id 
						   INNER JOIN tb_lecture l 
						   ON r.`lecture_no` = l.`lecture_no` 
						   order by r.board_no desc
						    Limit $s_point,$pageSize";
				$rst = mysql_query($data);
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
					<td><a href="/lecture_board/index.php?mode=view&&review_no=<?= $row['board_no']?>" >
					<span class="tc-gray ellipsis_line">수강 강의명 : <?= $row['lecture_title']?></span>
					<span class="tc-gray ellipsis_line"><?= $row['title']?></span></a></td>
					<td class="last"><span class="star-rating">
							<span class="star-inner" style="width:<?= $star ?>%"></span>
						</span></td>
					<td class="last"><?= $row['name']?></td>
					
				<?
 					if($row == false){
	 					break;
 					}
				}
				?>
				<!-- //set -->

				<tr/>
			</tbody>
		</table>

		<div class="box-paging">
			<a href="#"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
			<a href="<?= $PHP_SELF?>?page=<?=$start_p-1?>"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
			<?
			for($p=$start_p; $p<=$end_p; $p++){
			?>
			<a href="<?= $PHP_SELF?>?page=<?=$p?>" ><?=$p?></a>
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
 $("#searchBtn").click(function(){
	 var type = $("select[name='type']").val();
	 if(type == ""){
		 alert("분류를 선택해주세요");
		 return false;
	 }
	 $("#sForm").submit();
 })
</script>
