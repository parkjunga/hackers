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
				<li class="on"><a href="/member/index.php?mode=find_id">아이디 찾기</a></li>
				<li><a href="/member/index.php?mode=find_pw">비밀번호 찾기</a></li>
			</ul>

			<div class="tit-box-h4">
				<h3 class="tit-h4">아이디 찾기 방법 선택</h3>
			</div>

			<dl class="find-box">
				<dt>휴대폰 인증</dt>
				<dd>
					고객님이 회원 가입 시 등록한 휴대폰 번호와 입력하신 휴대폰 번호가 동일해야 합니다.
					<label class="input-sp big">
						<input type="radio" name="radio" id="sms" checked="checked" value="1"/>
						<span class="input-txt"></span>
					</label>
				</dd>
			</dl>

			<dl class="find-box">
				<dt>이메일 인증</dt>
				<dd>
					고객님이 회원 가입 시 등록한 이메일 주소와 입력하신 이메일 주소가 동일해야 합니다.
					<label class="input-sp big">
						<input type="radio" name="radio" id="email" value="2"/>
						<span class="input-txt"></span>
					</label>
				</dd>
			</dl>

			<div class="section-content mt30">
				<form id="findId" method="POST" action="">
				<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
					<caption class="hidden">아이디 찾기 개인정보 입력</caption>
					<colgroup>
						<col style="width:15%"/>
						<col style="*"/>
					</colgroup>

					<tbody>
						<tr>
							<th scope="col">성명</th>
							<td><input type="text" name="name" class="input-text" style="width:302px" /></td>
						</tr>
	<!-- 					<tr>
							<th scope="col">생년월일</th>
							<td>
								<select class="input-sel" style="width:148px">
									<option value="">선택</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
								</select>
								년
								<select class="input-sel" style="width:147px">
									<option value="">선택</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
								</select>
								월
								<select class="input-sel" style="width:147px">
									<option value="">선택</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
									<option value="">선택입력</option>
								</select>
								일
							</td>
						</tr> -->
						<tr id="authEmail" style="display:none;">
							<th scope="col">이메일주소</th>
							<td>
								<input type="text" class="input-text" name="email1" style="width:138px"/> @ <input type="text" name="email2" class="input-text" style="width:138px"/>
								<select name="emailChnage"class="input-sel" style="width:160px" onChange="getSelectValue(this.form);">
								<option value="">선택하세요</option>
								<option value="hanmail.net">hanmail.net</option>
 								<option value="naver.com">naver.com</option>
 								<option value="gmail.com">gmail.com</option>
								 <option value="user">직접입력</option>
								</select>
								<!-- <a href="#" class="btn-s-tin ml10">인증번호 받기</a> -->
								<input type="submit" id="emailBtn" class="btn-s-tin ml10" value="인증번호 받기" style="cursor:pointer">
							</td>
						</tr>
						<tr id="authSmS">
							<th scope="col">휴대폰번호</th>
							<td>
								<input type="text" name="phone1" class="input-text" style="width:138px" maxlength="3"/> -
								<input type="text" name="phone2"class="input-text" style="width:138px" maxlength="4"/> -
								<input type="text" name="phone3"class="input-text" style="width:138px" maxlength="4"/>
								<input type="submit" id="smsBtn" class="btn-s-tin ml10" value="인증번호 받기" style="cursor:pointer">
							</td>
						</tr>
						<tr>
							<th scope="col">인증번호</th>
							<td><input name="code" type="text" class="input-text" style="width:478px" />
						    <input type="submit" class="btn-s-tin ml10" id="confBtn" value="인증번호 확인"/>
						</td>
						</tr>
					</tbody>
				</table>
			</form>
			</div>
		</div>
	</div>
</div>
<script>
// 휴대폰 인증 / 이메일 인증 동작
$("#sms").click(function(){
	$("#authEmail").hide();
	$("#authSmS").show();
})
$("#email").click(function(){
	$("#authSmS").hide();
	$("#authEmail").show();
})

// email 셀렉박스 동작 
function getSelectValue(frm)
{
 frm.email2.value = frm.emailChnage.options[frm.emailChnage.selectedIndex].text;
 if(frm.emailChnage.options[frm.emailChnage.selectedIndex].value == user){
    frm.email2.value = "";
 }
}


	$("#emailBtn").click(function(){
	var name = $("input[name='name']").val();
    var e1 = $("input[name='email1']").val();
	var e2 = $("input[name='email2']").val();
	var email = e1+"@"+e2;
	if(name == '' || e1 == '' || e2 == ''){
		alert("입력후 시도해주세요");
		return false;
	}else{
		$.ajax({
		url:"/member/find.php",
		type:"POST",
		data:{name:name,email:email}
	}).done(function(result){
		alert(result);
	})
	}
})

$("#smsBtn").click(function(){
	var name = $("input[name='name']").val();
    var p1 = $("input[name='phone1']").val();
	var p2 = $("input[name='phone2']").val();
	var p3 = $("input[name='phone3']").val();
	var phone = p1 + p2 + p3 ;
	$.ajax({
		url:"/member/find.php",
		type:"POST",
		data:{name:name,phone:phone}
	}).done(function(result){
		alert(result);
	})
})

$("#confBtn").click(function(){
	var code = $("input[name='code']").val();
	$.ajax({
		url:"/member/test.php",
		type:"POST",
		data:{code:code}
	}).done(function(result){
		if(result == 'Y'){
			alert("일치합니다.");
		}else{
			alert("불일치합니다.");
		}
	})
})

</script>