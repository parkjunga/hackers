
<?php
include '../include/header.php';


include $_GET['mode'].".".php;
if(!is_file($_GET['mode'].".".php)){
/* 	echo '페이지가 존재하지않습니다.'; */
echo("<script>location.href='/index.html';</script>");
}

/* 
$controller = new Controller($_POST);

switch ($_GET['mode']) {
	case "step_01" :  
				include 'step_01.php';
			break;
	case "step_02" :  
			include 'step_02.php';
			break;
	case "step_03" :  
				include 'step_03.php';
				break; 
	case 'regist' :
				include 'regist.php';
				break;
	case 'complete':
				include 'complete.php';
				break;
	case 'find_id':
				include 'find_id.php';
				break;
	case 'find_id_complete':
				include 'find_id_complete.php';
				break;
	case 'find_pw':
				include 'find_pw.php';
				break;
	case 'find_pw_complete':
				include 'find_pw_complete.php';
				break;
	case 'modify':
				include 'modify.php';
				break;		          
	case 'test' : InputMember(); break;
				
	default : include 'container.php';
}

function InputMember(){
	$controller->find();
}

 */


include '../include/footer.php';
?>