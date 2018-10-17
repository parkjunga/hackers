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
						<input type="text" name="phone1" class="input-text" maxlength="3" style="width:50px" maxlength="3"/> - 
						<input type="text" name="phone2" class="input-text" maxlength="4" style="width:50px" maxlength="4"/> - 
						<input type="text" name="phone3" class="input-text" maxlength="4" style="width:50px" maxlength="4"/>
						<input type="button" id="phoneC" value="인증번호받기" class="btn-s-line">
						<!--<a href="#" class="btn-s-line">인증번호 받기</a>-->
                        </form>
					    <br /><br />
<!--                     <form action="" method="POST"> -->
						<input type="text" name="code" class="input-text" style="width:200px"/>
                        <input id="test" type="submit" value="인증번호 확인" class="btn-s-line">
                        </form>
                    </div>
					<i class="graphic-phon"><span>휴대폰 인증</span></i>
				</div>
			</div>

		</div>
    </div>
   <script>
      $("#phoneC").click(function(){
		var p1 = $("input[name='phone1']").val();
		var p2 = $("input[name='phone2']").val();
		var p3 = $("input[name='phone3']").val();
		if(p1 == null || p1 == ''){
			alert("값비어있")
			return false;
		}
		if(p2 == null || p2 == ''){
			alert("값비어있1")
			return false;
		}
		if(p3 == null || p3 == ''){
			alert("값비어있4")
			return false;
		}
		alert("인증번호가 발송되었습니다.");
	  })

       $("#test").click(function(){
		   var code = $("input[name='code']").val();
		   //alert(code);
		   $.ajax({ 
			url: "/member/test.php",
			type: "POST",
			data: {code:code}
			})      
			.done(function(result) {
				if(result == 'N'){
					alert("인증코드를 확인해주세요");
					return false;
				}else {
					alert("인증코드가 일치합니다.");
					//window.location.href = '';
					$("#tForm").submit();
										
				}
			//alert("비교");
			//alert(result);
			})

			})
    


	   
   </script>
</div>

