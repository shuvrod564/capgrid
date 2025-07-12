<?php
// CHECK IF USER LOGGED IN OR NOT 
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit();
}

?>