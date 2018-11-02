<?php

require_once 'Controller.php';
$result = mysql_query($result['sql']);
$row = mysql_fetch_assoc($result);
/* include 'db.php';
$phone = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
$name = $_POST['name'];
$email = $_POST['email1'].'@'.$_POST['email2'];
//echo $phone;
//echo "세션 등록확인";
//echo $test;
$sql = "select * 
        from tb_user 
        where name='$name'
        and (phone='$phone'
         or email ='$email')"; 

$result = mysql_query($sql);
$row = mysql_fetch_assoc($result); */

?>

<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">아이디/비밀번호 찾기</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>아이디/비밀번호 찾기</strong>
				</div>
			</div>

			<ul class="tab-list">
				<li class="on"><a href="#">아이디 찾기</a></li>
				<li><a href="#">비밀번호 찾기</a></li>
			</ul>

			<div class="tit-box-h4">
				<h3 class="tit-h4">아이디 조회결과</h3>
			</div>

			<div class="guide-box">
				<p class="fs16 mb5"><?= $name ?> 회원님의 아이디는 아래와 같습니다.</p>
				<strong class="big-title tc-brand"><?= $row['id'] ?> </strong>
			</div>

			<div class="box-btn mt30">
				<a href="/member/login.php" class="btn-l">로그인하러 가기</a>
				<a href="/member/index.php?mode=find_pw" class="btn-l-line ml5">비밀번호 찾기</a>
			</div>

		</div>
	</div>
</div>
