<!-- 휴대폰 인증  -->
<?
if($_POST['agree'] != '0'){
	echo '<script>
	alert("이용약관에 동의가 되지 않은 상태입니다.")
	history.back();</script>';
}
?>
<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">회원가입</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>회원가입 완료</strong>
				</div>
			</div>

			<div class="join-step-bar">
				<ul>
					<li><i class="icon-join-agree"></i> 약관동의</li>
					<li class="on"><i class="icon-join-chk"></i> 본인확인</li>
					<li class="last"><i class="icon-join-inp"></i> 정보입력</li>
				</ul>
			</div>

			<div class="tit-box-h4">
				<h3 class="tit-h4">본인인증</h3>
			</div>

			<div class="section-content after">
				<div class="identify-box" style="width:100%;height:190px;">
					<div class="identify-inner">
						<strong>휴대폰 인증</strong>
						<p>주민번호 없이 메시지 수신가능한 휴대폰으로 1개 아이디만 회원가입이 가능합니다. </p>

						<br />
						<form id="tForm" action="/member/index.php?mode=step_03" method="POST">
						<input type="hidden" name="mode" value="0" />
						<input type="hidden" name="agree" value=<?= $_POST['agree'] ?>/>
						<input type="text" name="phone[]" class="input-text" maxlength="3" style="width:50px" maxlength="3"/> - 
						<input type="text" name="phone[]" class="input-text" maxlength="4" style="width:50px" maxlength="4"/> - 
						<input type="text" name="phone[]" class="input-text" maxlength="4" style="width:50px" maxlength="4"/>
						<input type="button" id="sendCode" value="인증번호받기" class="btn-s-line" style="cursor:pointer;">
						<!--<a href="#" class="btn-s-line">인증번호 받기</a>-->
                        </form>
					    <br /><br />
<!--                     <form action="" method="POST"> -->
						<input type="text" name="code" class="input-text" style="width:200px;"/>
                        <input id="test" type="submit" value="인증번호 확인" class="btn-s-line" style="cursor:pointer;">
                        </form>
                    </div>
					<i class="graphic-phon"><span>휴대폰 인증</span></i>
				</div>
			</div>

		</div>
    </div>
   <script>
      $("#sendCode").click(function(){
		var chk1 = RegExp(/^01([0|1|6|7|8|9]?)$/);
		var chk2 = RegExp( /^([0-9]{3,4}?)$/);
		var chk3 = RegExp( /^([0-9]{4}?)$/);
		var mode = $("input[name='mode']").val();
		if($("input[name='phone[]']")[0].value == '' || $("input[name='phone[]']")[1].value == '' || $("input[name='phone[]']")[2].value == ''){
			alert("번호가 입력되지않았습니다.")
			return false;
		}
		if (!chk1.test($("input[name='phone[]']")[0].value) || !chk2.test($("input[name='phone[]']")[1].value) || !chk3.test($("input[name='phone[]']")[2].value) ) {
				alert("숫자만 입력이 가능합니다.");
				return false;
		}
		send(mode);
	  })
	 
	 function send(val){
		$.post("/member/mode.php",{val:val},function(data){
				if(data == 'fail'){
					alert("인증코드를 확인해주세요");
					return false;
				}else if(data =='success'){
					$("#tForm").submit();
				}else{
					alert(data);
				}
				return data;
			}) 
	 }
	 $("#test").click(function(){
		var code = $("input[name='code']").val();
		if($("input[name='code']").val() == null || $("input[name='code']").val() == ''){
			   alert("인증코드를 입력해주세요.")
			   return false;
		   }
		   send(code);
	 });
      /*  $("#test").click(function(){
		   var code = $("input[name='code']").val();
		   else{
		   $.ajax({ 
			url: "/member/test.php",
			type: "POST",
			data: {code:code}
			})      
			.done(function(result) {
				//alert(result);
				if(result == 'Y:'){
					alert("인증코드가 일치합니다.");
					//window.location.href = '';
					$("#tForm").submit();
				}else {
					alert("인증코드를 확인해주세요");
					return false;										
				}
			})

		   }
		  
			}) */
    


	   
   </script>
</div>

