<?php
    include '../member/header.php';
    switch ($_GET['mode']) {
		case "write" :  
		         include 'write.php';
				break;
		case "view" :
				include 'view.php';
			  break;
		case "modify":
				include 'modify.php';
              break;
        default :
              include 'list.php';
         			   
	}
    include '../member/footer.php';
?>
