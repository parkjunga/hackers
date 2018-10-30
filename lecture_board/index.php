<?php
    include '../include/header.php';
    

    switch ($_GET['mode']) {
		case "write" :  
		         include 'write.php';
				break;
		case "insert":
				include 'insert.php';
				break;
		case "select":
				include 'select.php';
				break;
/* 		case "list" :  
				include 'list.php';
			   break; */
		case "view" :
				include 'view.php';
			  break;
		case "modify":
				include 'modify.php';
				break;
		case "update":
				include 'update.php';
				break;
		case "delete":
				include 'delete.php';
				break;
		default: 
				include 'list.php';
				break;			   
	}

?>
<?php

include '../include/footer.php';
?>
