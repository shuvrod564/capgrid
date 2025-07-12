<?php
	include_once('config/config.inc.php');
    include_once('config/auth.inc.php');

	$userObj = new Users();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Captions List</title>

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    <?php include_once('includes/header.inc.php'); ?>
    <main class="d-flex align-items-center py-5">
        <div class="container py-5">
            <div class="space-y-5">
            	<?php
            		$users = $userObj->viewAllUsers();
            		foreach ($users as $key => $user) { 
            	?>
                <div class="p-5 md:p-8 rounded-lg bg-white shadow">
                    <p class="display-6 fw-bold text-dark">
                    	<?= $user['name'] ?>
                    </p> 
                    
                     
                </div>
            <?php } ?>
            </div>
             
        </div>
    </main>

    <?php include_once('includes/footer.inc.php'); ?>
       
</body>
</html>