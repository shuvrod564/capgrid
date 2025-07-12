<?php
include_once('config/config.inc.php'); 

$userObj = new Users();

if (isset($_POST['signup'])) {
    $userObj->createNewUser($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Sign Up</title>

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    
    <main class="flex items-center justify-center min-h-screen">
        <div class="container py-5">
            <div class="max-w-lg mx-auto">
                <div class="p-5 md:p-10 rounded-xl border border-white bg-white shadow"> 
                    <div class="text-center mb-5"> 
                        <img src="assets/images/capgrid.png" alt="CapGrid" class="w-auto h-12 mx-auto"> 
                        <h1 class="text-xl md:text-3xl lg:text-3xl mb-2 font-bold text-dark mt-5">Sign Up</h1> 
                        <p class="text-sm text-gray-400 max-w-[320px] mx-auto">
                            Create a new account to access the dashboard and create new captions.
                        </p>
                    </div>
                    
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="flex flex-col gap-4">
                        <div class="">
                            <label for="name" class="text-sm font-medium mb-2 block">Name</label>
                            <input type="text" name="name" id="name" class="w-full h-14 px-5 py-2 border border-gray-200 rounded-lg bg-slate-50 text-base lg:text-lg font-medium text-black" required></textarea> 
                        </div>
                        <div class="">
                            <label for="email" class="text-sm font-medium mb-2 block">Email address</label>
                            <input type="email" name="email" id="email" class="w-full h-14 px-5 py-2 border border-gray-200 rounded-lg bg-slate-50 text-base lg:text-lg font-medium text-black" required></textarea> 
                        </div> 
                        <div class="">
                            <label for="password" class="text-sm font-medium mb-2 block">Password</label>
                            <input type="password" name="password" id="password" class="w-full h-14 px-5 py-2 border border-gray-200 rounded-lg bg-slate-50 text-base lg:text-lg font-medium text-black" required></textarea> 
                        </div> 
                        
                        <div class="pt-5">
                            <button type="submit" name="signup" class="text-base md:text-lg font-bold px-8 py-4 inline-block bg-black text-white rounded-lg uppercase w-full">Sign up</button>
                        </div>
                        <div class="text-center pt-5"> 
                            <p class="text-sm md:text-base text-gray-400">Already have an account? <a href="login.php" class="text-green-400 hover:text-green-500 underline">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
             
        </div>
    </main>

       
</body>
</html>