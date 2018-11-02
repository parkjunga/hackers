<?php
$id =$_POST['id'];
$name =$_POST['name'];
$phone =$_POST['phone'];
$email = $_POST['email1']."@".$_POST['email2'];
$phone = $_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
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
				<li><a href="#">아이디 찾기</a></li>
				<li class="on"><a href="#">비밀번호 찾기</a></li>
			</ul>

			<div class="tit-box-h4">
				<h3 class="tit-h4">비밀번호 재설정</h3>
			</div>

			<div class="section-content mt30">
				<form id="find" method="POST" action="">
				<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
					<caption class="hidden">비밀번호 재설정</caption>
					<colgroup>
						<col style="width:17%"/>
						<col style="*"/>
					</colgroup>
					<tbody>
						<tr>
							<input type="hidden" name="name" value="<?=$name?>"/>
							<input type="hidden" name="id" value="<?=$id?>"/>
							<input type="hidden" name="phone" value="<?=$name?>"/>
							<input type="hidden" name="email" value="<?=$id?>"/>
							<th scope="col">신규 비밀번호 입력</th>
							<td><input type="password" name="pw" class="input-text" placeholder="영문자로 시작하는 4~15자의 영문소문자,숫자" style="width:302px" /></td>
						</tr>
						<tr>
							<th scope="col">신규 비밀번호 재확인</th>
							<td><input type="password" name="newPwRe" class="input-text" style="width:302px" /></td>
						</tr>
					</tbody>
				</table>
				<div class="box-btn">
					<!-- <a href="#" class="btn-l">확인</a> -->
					<input name="newPwBtn" type="submit" id="cssBtn-1" class="btn-1" value="확인">
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<script>
	$("input[name='newPwBtn']").click(function(){
	/* 	var getPass =/^.*(?=.{8,15})(?=.*[0-9])(?=.*[a-zA-Z]).*$/;
		var id = $("input[name='id']").val();
		var name = $("input[name='name']").val();
		var pw = $("input[name='newPw']").val();
		var pwRe =$("input[name='newPwRe']").val();
		if(!getPass.test(pw)){
			alert("형식에 맞지 않습니다.");
			return false;
		}else if(pw == "" || pw != pwRe){
			alert("비밀번호를 확인해주세요.");
			return false;
		}else
		 */
		 var find = $("#find").serialize();
		 $.ajax({
		url:"/member/findPW.php",
		type:"POST",
		data:find
		}).done(function(result){
	    alert(result);
		if(result == 'Y'){
			alert("일치합니다.");
			location.href="/member/index.php";
		}else{
			alert("불일치합니다.");
		}
		})
		
		
	});
</script>
