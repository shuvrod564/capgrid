<?php
include_once('config/config.inc.php'); 

if (isset($_SESSION['user_id'])) {
    header("Location:".SITE_URL."dashboard.php");
    exit();
}

$userObj = new Users();
if (isset($_POST['login'])) {
   $error =	$userObj->loginUser($_POST);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Cap Grid</title>

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    
    <main class="flex items-center justify-center min-h-screen">
        <div class="container py-5">
            <div class="max-w-lg mx-auto">
            	<?php if (isset($_GET['msg']) && $_GET['msg'] == 'registered') {
            		echo '
            			<div class="p-4 bg-green-50 text-green-400 mb-5 text-base font-medium rounded-lg">
            				🎉 Account created successfully! Please log in to continue.
            			</div>
            		';
            	} ?>
                <div class="p-5 md:p-10 rounded-xl border border-white bg-white shadow">
                    <div class="text-center mb-5"> 
                        <img src="assets/images/capgrid.png" alt="CapGrid" class="w-auto h-12 mx-auto"> 
                        <h1 class="text-xl md:text-3xl lg:text-3xl mb-2 font-bold text-dark mt-5">Login</h1> 
                        <p class="text-sm text-gray-400 max-w-[320px] mx-auto">
                            Log in to your account to access the dashboard and create new captions.
                        </p>
                    </div>
                    
                    
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="flex flex-col gap-5">
                        <div class="">
                            <label for="username" class="text-sm font-medium mb-2 block">User name</label>
                            <input type="text" name="username" id="username" class="w-full h-14 px-5 py-2 border border-gray-200 rounded-lg bg-slate-50 text-base lg:text-lg font-medium text-black" required></textarea> 
                        </div>
                        <div class="">
                            <label for="password" class="text-sm font-medium mb-2 block">Password</label>
                            <input type="password" name="password" id="password" class="w-full h-14 px-5 py-2 border border-gray-200 rounded-lg bg-slate-50 text-base lg:text-lg font-medium text-black" required></textarea> 
                        </div> 
                        <div>
                        	<?php if(!empty($error)){ ?>
                        	<div class="p-3 text-red-400 bg-red-50 rounded-lg text-center"> 
                        		<?php echo $error; ?>
                        	</div>
                        	<?php } ?>
                        </div>
                        <div class="">
                            <button type="submit" name="login" class="text-base md:text-lg font-bold px-8 py-4 inline-block bg-black text-white rounded-lg w-full cursor-pointer">Login</button>
                        </div>
                        <div class="text-center pt-5">
                            <p class="text-sm md:text-base text-gray-400">Don't have an account? <a href="signup.php" class="text-green-400 hover:text-green-500 underline">Sign up</a></p>
                        </div> 
                    </form>
                </div>
            </div>
             
        </div>
    </main>

       <?php include_once('includes/footer.inc.php'); ?>
</body>
</html>