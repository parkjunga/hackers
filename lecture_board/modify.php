<!-- 에디터 -->
<script type="text/javascript" src="/nse/nse_files/js/HuskyEZCreator.js" charset="utf-8"></script>
<script language = "javascript"> 
//상위 셀렉트로 하위 셀렉트 제어하기
function showSub(obj) {

	f = document.forms.nse;
	$.ajax({
		url:'/lecture_board/select.php',
		data:{obj:obj}
	}).done(function(result){
		//alert(result);
		var s = result.split("%");	
		//alert(s);
		var html = "";
		$("#type2").html("");
		for(var i of s){	
			if(i != "")	{
			   var num = i.split("^");
		       //alert(num);
		       html += "<option value='"+num[0]+"'>"+num[1]+"</option>";
		       $("#type2").html(html);		
			}
		 
		}
	})
/* 
    if(obj == 0) {

        f.type2.style.display = "";
        f.SUB5.style.display = "none";


    } else {

        f.type2.style.display = "none";
        f.SUB5.style.display = "";

     } */
}


</script>
<div id="container" class="container">
<?php
	include '../include/lnb.php';
	$no = $_GET['review_no'];
	// 글번호
	$sql = "SELECT * 
	        FROM tb_review r 
			INNER JOIN tb_lecture l 
			ON r.lecture_no = l.lecture_no 
			INNER JOIN tb_file f 
			ON l.file_no = f.file_no 
			WHERE r.board_no = '$no'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	//echo $row;
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

		<div class="user-notice">
			<strong class="fs16">유의사항 안내</strong>
			<ul class="list-guide mt15">
				<li class="tc-brand">수강후기는 신청하신 강의의 학습진도율 25%이상 달성시 작성가능합니다. </li>
				<li>욕설(욕설을 표현하는 자음어/기호표현 포함) 및 명예훼손, 비방,도배글, 상업적 목적의 홍보성 게시글 등 사회상규에 반하는 게시글 및 강의내용과 상관없는 서비스에 대해 작성한 글들은 삭제 될 수 있으며, 법적 책임을 질 수 있습니다.</li>
			</ul>
		</div>
		<form id="testF" name="nse"  action="/lecture_board/index.php?mode=update" method="POST"enctype="multipart/form-data"> 
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
						<input type="hidden" name="review_no" value="<?= $row['board_no'] ?>"/>
						<select name="type" class="input-sel" style="width:160px" onChange="showSub(this.options[this.selectedIndex].value);">
							<option value="">분류</option>
							<option value="0" <? if($row['category_no'] == 0) echo 'selected' ?>>일반직무</option>
                            <option value="1" <? if($row['category_no'] == 1) echo 'selected' ?>>산업직무</option>
                            <option value="2" <? if($row['category_no'] == 2) echo 'selected' ?>>공통역량</option>
                            <option value="3" <? if($row['category_no'] == 3) echo 'selected' ?>>어학 및 자격증</option>
						</select>
						<select id="type2" name="type2" class="input-sel ml5" style="width:454px">
							<option value="<?= $row['lecture_no'] ?>" ><?= $row['lecture_title'] ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="col">제목</th>
					<td><input name="title" type="text" class="input-text" style="width:611px" value="<?=$row['title'] ?>"/></td>
				</tr>
				<tr>
					<th scope="col">강의만족도</th>
					<td>
						<ul class="list-rating-choice">
							<li>
								<label class="input-sp ico">
									<input type="radio" name="score" value="5" <? if($row['satisfy'] == 0 ) ?>checked="<?echo 'checked'?>"/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:100%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="score" value="4" <? if($row['satisfy'] == 0 ) ?>checked="<?echo 'checked'?>"/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:80%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="score" value="3" <? if($row['satisfy'] == 0 ) ?>checked="<?echo 'checked'?>"/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:60%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="score" value="2" <? if($row['satisfy'] == 0 ) ?>checked="<?echo 'checked'?>"/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:40%"></span>
								</span>
							</li>
							<li>
								<label class="input-sp ico">
									<input type="radio" name="score" value="1" <? if($row['satisfy'] == 0 ) ?>checked="<?echo 'checked'?>"/>
									<span class="input-txt">만점</span>
								</label>
								<span class="star-rating">
									<span class="star-inner" style="width:20%"></span>
								</span>
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
		
		<div class="editor-wrap">
		
    	   <textarea name="ir1" id="ir1" class="nse_content" cols="108" ><?=htmlspecialchars($row['contents'])?></textarea>
			<script type="text/javascript">
				var oEditors = [];
				nhn.husky.EZCreator.createInIFrame({
   				oAppRef: oEditors,
    			elPlaceHolder: "ir1",
    			sSkinURI: "/nse/nse_files/SmartEditor2Skin.html",
    			fCreator: "createSEditor2"
			});
				function submitContents(elClickedObj) {
   				// 에디터의 내용이 textarea에 적용됩니다.
				oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
    			// 에디터의 내용에 대한 값 검증은 이곳에서 document.getElementById("ir1").value를 이용해서 처리하면 됩니다. 
    			try {
        		elClickedObj.form.submit();
    			} catch(e) {}
			}
</script>
	</div>
		<div class="box-btn t-r">
			<a href="/lecture_board/index.php?mode=list" class="btn-m-gray">목록</a>
			<input type="submit" value="수정" onclick="submitContents(this)" class="btn-m ml5"  style="cursor:pointer;"/>
		</div>
        </form>
		
	</div>
</div>