<?php
//기본 리다이렉트
echo $_REQUEST["htImageInfo"];

$url = $_REQUEST["callback"] .'?callback_func='. $_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);
if (bSuccessUpload) { //성공 시 파일 사이즈와 URL 전송
	
	$tmp_name = $_FILES['Filedata']['tmp_name'];

	 //업로드 이미지 파일이름 중복 방지 코드
	 $addName = strtotime(date("Y-m-d H:i:s"));
	 $milliseconds = round(microtime(true) * 1000);  //밀리초 구하기
	 $addName .= $milliseconds;       //파일이름에 밀리초 추가하기
	 //업로드 이미지 파일이름 중복 방지를 위해 수정되는 코드

	$name = $_FILES['Filedata']['name'];


	//$new_path = "../upload/".urlencode($_FILES['Filedata']['name']);
	  //이미지 파일 업로드시 파일이름 중복될 때 처리 코드 수정
	$new_path = "../upload/".urlencode($name);

	@move_uploaded_file($tmp_name, $new_path);
	$url .= "&bNewLine=true";
	$url .= "&sFileName=".urlencode(urlencode($name));
	//$url .= "&size=". $_FILES['Filedata']['size'];
	//아래 URL을 변경하시면 됩니다.
	$url .= "&sFileURL=http://test.naver.com/popup/upload/".urlencode(urlencode($name));
} else { //실패시 errstr=error 전송
	$url .= '&errstr=error';
}
header('Location: '. $url);
?>