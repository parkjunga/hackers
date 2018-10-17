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
<?php
include 'db.php';
$id = $_SESSION['id'];
$sql = "select * from tb_user where id='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
echo $row['id'];
echo $row['email'];
echo "<br/>";
$te = explode('@',$row['email']);
$p1 = substr($row['phone'],0,3);
$p2 = substr($row['phone'],3,4);
$p3 = substr($row['phone'],7,4);
echo $p2;
echo $te[0];
?>
<div id="container" class="container-full">
	<div id="content" class="content">
		<div class="inner">
			<div class="tit-box-h3">
				<h3 class="tit-h3">내정보수정</h3>
				<div class="sub-depth">
					<span><i class="icon-home"><span>홈</span></i></span>
					<strong>내정보수정</strong>
				</div>
			</div>

			<div class="section-content">
			<form id="modifyForm" action="update.php" method="POST" onsubmit="return modify()">
				<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
					<caption class="hidden">강의정보</caption>
					<colgroup>
						<col style="width:15%"/>
						<col style="*"/>
					</colgroup>
                   
					<tbody>
						<input type="hidden" name="id" value="<?= $id ?>">
						<tr><th scope='col'><span class='icons'>*</span>이름</th><td><?= $row['name'] ?></td></tr>
						 <tr>
							<th scope="col"><span class="icons">*</span>아이디</th>
							<td><?= $id ?></td>
							 <!-- <a href="#" class="btn-s-tin ml10">중복확인</a> </td> -->
						</tr> 
						 <tr>
							<th scope="col"><span class="icons">*</span>비밀번호</th>
							<td><input type="password" name="password" class="input-text" style="width:302px" placeholder="8-15자의 영문자/숫자 혼합"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>비밀번호 확인</th>
							<td><input type="password" name="passwordRe" class="input-text" style="width:302px"/></td>
						</tr> 
						<tr>
							<th scope="col"><span class="icons">*</span>이메일주소</th>
							<td>
								<input type="text" name="email1" class="input-text" style="width:138px" value="<?= $te[0] ?>"/> @ 
								<input type="text" name="email2" value="<?=$te[1]?>" class="input-text" style="width:138px"/>
								<select id="sEmail" class="input-sel" style="width:160px" >
									<option value="0">naver.com</option>
									<option value="1">gmail.com</option>
									<option value="2">hanmail.net</option>
									<option value="3">직접입력</option>
								</select>
							</td>
						</tr> 
						<tr>
							<th scope='col'><span class='icons'>*</span>휴대폰 번호</th><td><?=$p1."-".$p2."-".$p3?></td></tr>
						
						<tr>
							<th scope="col"><span class="icons"></span>일반전화 번호</th>
							<td><input type="text" name="tel1" class="input-text" style="width:88px"/> - 
							<input type="text" name="tel2" class="input-text" style="width:88px"/> - 
							<input type="text" name="tel3" class="input-text" style="width:88px"/></td>
						</tr>
						<tr>
							<th scope="col"><span class="icons">*</span>주소</th>
							<td>
								<p >
									<label>우편번호 <input type="text" name="postNum" value="<?=$row['post'] ?>" class="input-text ml5" style="width:242px" disabled /></label>
									<!-- <a href="#" class="btn-s-tin ml10">주소찾기</a> -->
									<input type="button" value="주소찾기" class="btn-s-tin ml10"onclick="Post()"/>
								</p>
								<p class="mt10">
									<label>기본주소 <input type="text" name="postAddr" value="<?=$row['addr']?>" class="input-text ml5" style="width:719px"/></label>
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
										<input type="radio" name="sms" value="Y"checked="checked"/>
										<span class="input-txt">수신함</span>
									</label>
									<label class="input-sp">
										<input type="radio" name="sms" value="N" />
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
										<input type="radio" name="email" value="Y" />
										<span class="input-txt">수신함</span>
									</label>
									<label class="input-sp">
										<input type="radio" name="email" value="N"  />
										<span class="input-txt">미수신</span>
									</label>
								</div>
								<p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
							</td>
						</tr>
					</tbody>
					
				</table>

				<div class="box-btn">
					<input type="submit" value="정보수정" class="btn-1"/>
					<!-- <a href="#" class="btn-l">정보수정</a> -->
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	//alert($("#sEmail option:selected").val())
	//var email = $("#sEmail option:selected").val();
/* 	var a = document.getElementById('sEmail').options[document.getElementById('sEmail').selectedIndex].text;
	var b = document.querySelector('input[name="email3"]').value;
	//querySelector('input[name="pwd"]')
	if(b == ""){
		b.value = "테스";
	}
	alert(b); */
	
function modify(){
  var pw = document.querySelector('input[name="password"]').value;
  var pwR = document.querySelector('input[name="passwordRe"]').value;
  var dAddr = document.querySelector('input[name="detailAddr"]').value;
   if(pw == '' || pwR == '' || pw != pwR){
	   alert("비밀번호를 확인해주세요");
	   return false;
   } 
   if(dAddr == ''){
	   alert("입력값이 올바르지 않습니다.")
   }
}
</script>