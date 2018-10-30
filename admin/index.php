<?php
    include '../include/header.php';
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
		case "delete":
					include 'delete.php';
					break;
    default :
              include 'list.php';
         			   
	}
    include '../include/footer.php';
?>
