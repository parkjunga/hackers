<div id="container" class="container">
<?php
	include '../include/adminLnb.php';
?>
    
	<div id="content" class="content">
		<div class="tit-box-h3">
			<h3 class="tit-h3">강의등록</h3>
			<div class="sub-depth">
				<span><i class="icon-home"><span>홈</span></i></span>
				<span>관리자</span>
				<strong>강의등록</strong>
			</div>
		</div>

		<div class="user-notice">
			<ul class="list-guide mt15">
				<li class="tc-brand">관리자가 강의를 등록하는 페이지입니다. </li>
			</ul>
		</div>                         
        <form id="lForm" method="POST" enctype="multipart/form-data"  action="insert.php">
		<table border="0" cellpadding="0" cellspacing="0" class="tbl-col">
			<caption class="hidden">강의정보</caption>
			<colgroup>
				<col style="width:15%"/>
				<col style="*"/>
			</colgroup>

			<tbody>
				<tr>
					<th scope="col">강의</th>
					<td>
						<select name="type" class="input-sel" style="width:160px">
                            <option value="">분류</option>
                            <option value="0">일반직무</option>
                            <option value="1">산업직무</option>
                            <option value="2">공통역량</option>
                            <option value="3">어학 및 자격증</option>
						</select>
					</td>
                </tr>
                <tr>
					<th scope="col">강의명</th>
					<td><input name="title" type="text" class="input-text" style="width:611px"/></td>
				</tr>
                <tr>
					<th scope="col">강사명</th>
					<td><input name="teacher" type="text" class="input-text" style="width:100px"/></td>
				</tr>
                <tr>
					<th scope="col">교육시간</th>
					<td><input name="time" type="text"  class="input-text" style="width:50px"/> 시간</td>
                </tr>
                <tr>
					<th scope="col">학습난이도</th>
					<td>
                    <select name="level" class="input-sel" style="width:160px">
                            <option value="">선택하세요</option>
                            <option value="상">상</option>
                            <option value="중">중</option>
                            <option value="하">하</option>
						</select>
                    </td>
                </tr>
                <tr>
					<th scope="col">첨부파일</th>
					<td>
                    <input name="file" type="file"/>
                    <br/>
                    ※ 파일첨부시 웹관련 파일 업로드가 불가합니다. <strong>(ex. .php/.html/.c 등등 )</strong>
                    </td>
                </tr>
			</tbody>
		</table>

	
		<div class="box-btn t-r">
			<a href="/admin/index.php?mode=list" class="btn-m-gray">목록</a>
			<!-- <a href="#" class="btn-m ml5">저장</a> -->
			<input type="submit" id="lBtn" value="저장"/>
		</div>
       </form>		
	</div>
</div>
<script>
$("#lBtn").click(function(){
	 	
		var type = $("select[name='type']").val(); // 강의분류
		var title = $("input[name='title']").val(); //강의명 
		var teacher = $("input[name='teacher']").val();//강사명
		var time =$("input[name='time']").val(); //강의시간 
		var level =$("select[name='level']").val();
		var file = $("input[name='file']").val(); 
		var exe = file.slice(file.indexOf(".")).toLowerCase(); // 확장자분리

		// 유효성 체크 


		if(type == '' || type == null){
			alert('강의분류를 지정해주세요.');
			return false;
		}
		if(title == '' || title == null){
			alert('강의명을 입력해주세요.');
			return false;
		}
		if(teacher == '' || teacher == null){
			alert('강사명을 입력해주세요.');
			return false;
		}
		if(time == '' || time == null){
			alert('총 교육시간을 입력해주세요.');
			return false;
		}else{
			if(isNaN(time)){
				alert("숫자만 입력이가능합니다.");
				return false;
			};
		}
		if(level == '' || level == null){
			alert('강의레벨을 입력해주세요.');
			return false;
		}
		if(file == '' || file == null){
			alert('이미지 파일을 업로드해주세요');
			return false;
		}else{
			if(exe == '.jpg' || exe == '.png' || exe == '.bmp' || exe == '.gif'){
			$("#lForm").submit();
			}else{
			alert("확장자체크가 필요합니다.");
			return false;
			}
		}
		
	}); 
</script>