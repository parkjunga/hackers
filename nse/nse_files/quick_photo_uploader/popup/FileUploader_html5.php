<?php
 	$sFileInfo = '';
	$headers = array(); 
	foreach ($_SERVER as $k => $v){   
  	
		if(substr($k, 0, 9) == "HTTP_FILE"){ 
			$k = substr(strtolower($k), 5); 
			$headers[$k] = $v; 
		} 
	}
	
	$file = new stdClass; 
	$file->name = rawurldecode($headers['file_name']);	
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input"); 
	  
	
	/* 파일이름 중복 방지를 위한 코드 */
  	$addName = strtotime(date("Y-m-d H:i:s"));  //현재날짜,시간,분초구하기
  	$milliseconds = round(microtime(true) * 1000);  //밀리초 구하기
 	$addName .= $milliseconds;       //파일이름에 밀리초 추가하기
  	$file->name = $addName . '__' . $file->name;
  	//중복방지 코드 끝
	
	
	$newPath = $_SERVER['DOCUMENT_ROOT'].'/upload/temp/'.iconv("utf-8", "cp949", $file->name);
	
	if(file_put_contents($newPath, $file->content)) {
		$sFileInfo .= "&bNewLine=true";
		$sFileInfo .= "&sFileName=".$file->name;
		$sFileInfo .= "&sFileURL=/upload/temp/".$file->name;
	}
	echo $sFileInfo;
 ?>
