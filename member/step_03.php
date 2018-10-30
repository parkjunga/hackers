<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
 function Post(){
    new daum.Postcode({
        oncomplete: function(data) {
			$('[name=postNum]').val(data.zonecode); // 우편번호 (5자리)
			$('[name=postAddr]').val(data.address);
			$('[name=detailAddr]').val(data.buildingName);
        }
    }).open();
 }

</script>
<!-- 회원가입 -->

<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">회원가입</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>회원가입</strong>
				</div>
			</div>

			<div class="join-step-bar">
				<ul>
					<li><i class="icon-join-agree"></i> 약관동의</li>
					<li><i class="icon-join-chk"></i> 본인확인</li>
					<li class="last on"><i class="icon-join-inp"></i> 정보입력</li>
				</ul>
			</div>

			<div class="section-content">
			<form id="mForm" action="/member/index.php?mode=regist" method="POST" onsubmit="return check()">
				<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
					<caption class="hidden">강의정보</caption>
					<colgroup>
						<col style="width:15%"/>
						<col style="*"/>
					</colgroup>
					<tbody>
						<tr>
							<th scope="col"><span class="icons">*</span>이름</th>
							<td><input type="text" name="name" class="input-text" style="width:302px"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>아이디</th>
							<td><input type="text" name="id" class="input-text" style="width:302px" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/>
							<input type="button" id="ck" value="중복확인" class="btn-s-tin ml10">
							<!-- a id="idChk" href="#" class="btn-s-tin ml10">중복확인</a> -->
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>비밀번호</th>
							<td><input type="password" name="password" class="input-text" style="width:302px" placeholder="8-15자의 영문자/숫자 혼합"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>비밀번호 확인</th>
							<td><input type="password" name="passwordRe"class="input-text" style="width:302px"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>이메일주소</th>
							<td>
								<input type="text" class="input-text" name="email1" style="width:138px"/> @ <input type="text" name="email2" class="input-text" style="width:138px"/>
								<select name="emailChnage" class="input-sel" name="email3"style="width:160px" onChange="getSelectValue(this.form);">
								<option value="">선택하세요</option>
								<option value="hanmail.net">hanmail.net</option>
 								<option value="naver.com">naver.com</option>
 								<option value="gmail.com">gmail.com</option>
								 <option value="user">직접입력</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>휴대폰 번호</th>
							<td>
							 <?php
							$p1 = $_POST['phone1'];
							$p2 = $_POST['phone2'];
							$p3 = $_POST['phone3'];
							echo '<input type="text" name="phone1" class="input-text" value='.$p1.' style="width:50px" readonly/> - ' ;
							echo '<input type="text" name="phone2" class="input-text" value='.$p2.' style="width:50px" readonly/> -' ;
							echo '<input type="text" name="phone3" class="input-text" value='.$p3.' style="width:50px" readonly/> ' ;
							?>
<!-- 							
								<input type="text" name="phone1" class="input-text" style="width:50px"/> - 
								<input type="text" name="phone2" class="input-text" style="width:50px"/> - 
								<input type="text" name="phone3" class="input-text" style="width:50px"/>
 -->							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons"></span>일반전화 번호</th>
							<td><input type="text" name="tel1" class="input-text" style="width:88px"/> - <input type="text" name="tel2" class="input-text" style="width:88px"/> - <input type="text" name="tel3" class="input-text" style="width:88px"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>주소</th>
							<td>
								<p >
									<label>우편번호 <input type="text" name="postNum" class="input-text ml5" style="width:242px" readonly /></label>
									<!--<a href="#" class="btn-s-tin ml10">주소찾기</a>-->
									<input type="button" value="주소찾기" onclick="Post()" class="btn-s-tin ml10"/>
								</p>
								<p class="mt10">
									<label>기본주소 <input type="text" name="postAddr" class="input-text ml5" style="width:719px"/></label>
								</p>
								<p class="mt10">
									<label>상세주소 <input type="text" name="detailAddr" class="input-text ml5" style="width:719px"/></label>
								</p>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>SMS수신</th>
							<td>
								<div class="box-input">
									<label class="input-sp">
										<input type="radio" name="sms" value="Y" checked="checked"/>
										<span class="input-txt">수신함</span>
									</label>
									<label class="input-sp">
										<input type="radio" name="sms"  value="N" />
										<span class="input-txt">미수신</span>
									</label>
								</div>
								<p>SMS수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
							</td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>메일수신</th>
							<td>
								<div class="box-input">
									<label class="input-sp">
										<input type="radio" name="email" value="N"  checked="checked"/>
										<span class="input-txt">수신함</span>
									</label>
									<label class="input-sp">
										<input type="radio"  name="email" value="N" />
										<span class="input-txt">미수신</span>
									</label>
								</div>
								<p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="box-btn">
				    <input id="cssBtn-1" type="submit" value="회원가입" class="btn-1" style="cursor:pointer; />
					<!-- <a href="#" class="btn-l">회원가입</a> -->
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function getSelectValue(frm)
{
 frm.email2.value = frm.emailChnage.options[frm.emailChnage.selectedIndex].text;
 if(frm.emailChnage.options[frm.emailChnage.selectedIndex].value == user){
    frm.email2.value = "";
 }
}
 $("#ck").click(function(){
	 var id = $("input[name='id']").val();
	 var chk = RegExp(/^[A-Za-z0-9_\.\-]/);
	 $.ajax({
		 url: "/member/idChk.php",
		 type:"POST",
		 data:{id:id}
	 })
	 .done(function(result){
		 alert(result);
		 if(result == 'N'){
			$("input[name='id']").val("");
		 }else if(result == "Y") {
			 if(chk.test(id)){
				 alert("아이디가 사용가능합니다.");
			 }else{
				 alert("아이디를 수정해주세요");
				 $("input[name='id']").val("");
			 }
		 }
	 })
 });

// 유효성 체크 
function check(){
	  //var getMail = RegExp(/^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/);
      var getMail = RegExp(/^[A-Za-z0-9_\.\-]/);
	  var getCheck= RegExp(/^[a-zA-Z0-9]{4,12}$/);
      var getName= RegExp(/^[가-힣]+$/);
	  var getPass =RegExp(/^(?=.*[a-zA-Z])(?=.*[0-9]).{8,15}/);
	  var name = $("input[name='name']").val();
	  var id = $("input[name='id'").val();
	  var email =$("input[name='email1']").val();
	  var pw1 = $("input[name='password']").val();
	  var pw2 = $("input[name='passwordRe']").val();
	  var post = $("input[name='postNum']").val();
	  var dAddr = $("input[name='detailAddr']").val();
	  var sms = $('input:checkbox[name="sms"]').is(":checked");
	  var email = $('input:checkbox[name="email"]').is(":checked");
	  // 이름 체크 
	  if (!getName.test(name)) {
        alert("이름을 확인해주세요");
        $(name).val("");
        $(name).focus();
        return false;
      }
     
	 // 아이디 체크 
	 if(id == ""){
		 alert("아이디를 확인해주세요.");
		 return false;
	 }

     
	  // 이메일 체크 
	  if(!getMail.test(email)){
        alert("이메일형식에 맞게 입력해주세요");
        $("#mail").val("");
        $("#mail").focus();
        return false;
      }

	  // 비밀번호 체크 
	  if(!getCheck.test(pw1)) {
      alert("형식에 맞춰서 PW를 입력해줘용");
      $(pw1).val("");
      $(pw1).focus();
      return false;
      }
	  if(pw1 != pw2){
		  alert("비밀번호가 일치 하지 않습니다.");
		  return false;
	  }
      if(getPass.test(pw1)){
		  alert("확인필요");
		  return false;
	  }

     // 주소 체크 
	 if(post == "" ){
		 alert("주소를 입력해주세요.");
		 return false;
	 }
	 if(dAddr == ""){
		 alert("상세주소를 입력해주세요.");
		 return false;
	 }
	
/* 	// 수신여부 
	if(sms){
		alert("문자체크확인");
		return false;
	}
	if(email){
		alert("메일수신체크확인");
		return false;
	} */

}

</script>

