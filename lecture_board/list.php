<?php

include 'Controller.php';
$controller = new Controller();
$result =$controller->boardList($_GET['type'],$_GET['$type2'],$_GET['$keyword'],$_GET['category_no']);
 // 검색쿼리
 $pageSize = 10; // 페이지당 보여줄 게시글 수 
 $blockSize = 5; // 블록 당 페이지 수
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
			<li class="<? if($_GET['category_no'] == '') echo 'on' ?>"><a href="/lecture_board/index.php?mode=list" >전체</a></li>
			<li class="<? if($_GET['category_no'] == '0') echo 'on' ?>" ><a href="/lecture_board/index.php?mode=list&&category_no=0" >일반직무</a></li>
			<li class="<? if($_GET['category_no'] == '1') echo 'on' ?>"><a href="/lecture_board/index.php?mode=list&&category_no=1" >산업직무</a></li>
			<li class="<? if($_GET['category_no'] == '2') echo 'on' ?>"><a href="/lecture_board/index.php?mode=list&&category_no=2" >공통역량</a></li>
			<li class="<? if($_GET['category_no'] == '3') echo 'on' ?>"><a href="/lecture_board/index.php?mode=list&&category_no=3" >어학 및 자격증</a></li>
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
			 $bestSql = $result['sql']."order by r.cnt desc Limit 0,3";
             $bestRst = mysql_query($bestSql);
			 while($bestRow = mysql_fetch_array($bestRst)){
				$star = $bestRow['satisfy'];
				if($bestRow['satisfy'] == '0'){
					$star = '0';
				}
				else if($bestRow['satisfy'] == '1') {
					$star = '20';
				}
				else if($bestRow['satisfy'] == '2') {
					$star = '40';
				}
				else if($bestRow['satisfy'] == '3') {
					$star = '60';
				}
				else if($bestRow['satisfy'] == '4') {
					$star = '80';
				}else if($bestRow['satisfy'] == '5') {
					$star = '100';
				} 
			 ?>
				<!-- set -->
				<tr class="bbs-sbj">
					<td><span class="txt-icon-line"><em>BEST</em></span></td>
					<td><?= $bestRow['category_title']?></td>
					<td>
                    <a href="/lecture_board/index.php?mode=view&&review_no=<?= $bestRow['board_no']?>"  >
							<span class="tc-gray ellipsis_line">수강 강의명 : <?= $bestRow['lecture_title']?></span>
							<strong class="ellipsis_line"><?= $bestRow['title']?></strong>
						</a>
					</td>
					<td class="last"><span class="star-rating">
							<span class="star-inner" style="width:<?= $star ?>%"></span>
						</span></td>
					<td class="last"><?= $bestRow['name']?></td>
					<td class="last"><?= $bestRow['cnt']?></td>
				</tr>
				<?
			 }
			 ?>
				<!-- 일반 게시글 -->
				<?php
				// $totalSize는 한페이지당 뿌려줄 데이터 수 
				$s_point = ($result['page']-1)*$pageSize; 
				if($_GET['type'] != '' ){
					if($_GET['type2']== 1){
					   $data = $result['sql'].$result['where'].' Limit '.$s_point.','.$pageSize;
					}else{
						$data = $result['sql'].$result['where2'].' Limit '.$s_point.','.$pageSize;
						echo $data;
					}
				}else{
					// 총 데이터 수 
					if($_GET['category_no'] != ''){
						$data = $result['sql'].
								"where c.category_no =" .$_GET['category_no']. 
							  "order by r.board_no desc 
							  Limit ".$s_point.','.$pageSize;
					}else{
						$data = $result['sql']."order by r.board_no desc Limit ".$s_point.','.$pageSize;
					}
					
				}
				
				$rst = mysql_query($data);
				while($row = mysql_fetch_array($rst)){
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
			<a href="<?= $PHP_SELF?>?page=<?= $result['start']?>"><i class="icon-first"><span class="hidden">첫페이지</span></i></a>
			<a href="<?= $PHP_SELF?>?page=<? if($result['page'] != 1){echo $result['start']-1;}else{echo $result['start'];}?>"><i class="icon-prev"><span class="hidden">이전페이지</span></i></a>
			<?
			for($p=$result['start']; $p<=$result['end']; $p++){
			?>
			<a id="paging" href="<?= $PHP_SELF?>?page=<?=$p?>" <? 	if($result['page'] == $p){ echo 'class="active"';}?> ><?=$p?></a>
			<?
			}
			?>
			<a href="<?$PHP_SELF?>?page=<? if($result['page'] != $result['end']){echo $result['end']+1;}else{echo $result['end'];}?>"><i class="icon-next"><span class="hidden">다음페이지</span></i></a>
			<a href="<?$PHP_SELF?>?page=<?= $result['end']?>"><i class="icon-last"><span class="hidden">마지막페이지</span></i></a>
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

