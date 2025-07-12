<?php
	include_once('config/config.inc.php'); 

	$userObj = new Users();

    if(isset($_POST['update'])) {
        $userObj->updateUser($_POST, $_FILES);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Profile</title>

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    <?php include_once('includes/header.inc.php'); ?>

    

    <main class="d-flex align-items-center py-5">
        <div class="container py-5">
            <div class="space-y-5">
            	<?php
                    $userid = $_SESSION['user_id'];
            		$user = $userObj->getUserProfile($userid);
            		// var_dump($user);
            	?> 
                <div class="bg-white p-3 rounded-lg">
                    <div class="bg-black rounded-lg min-h-[140px] relative"> 
                        <a href="profile.php?action=edit" class="px-4 py-2 text-sm text-white bg-teal-400 rounded-lg hover:bg-teal-500 absolute right-3 top-3">
                            Edit Profile
                        </a>
                    </div>
                    <div class="text-center relative z-30 pb-10">
                        <img src="<?php if($user['thumbnail']) { echo 'uploads/'.$user['thumbnail']; } else { echo 'assets/images/avatar.jpeg'; } ?>" alt="user" class="w-24 h-24 rounded-full mx-auto mt-[-50px] border-4 border-white bg-slate-50 shadow"> 
                        <p class="text-center text-gray-400 mt-1">
                            @<?= strtolower(explode(' ', trim($user['name']))[0]) ?>
                        </p>
                        <p class="text-center text-gray-900 text-xl md:text-2xl lg:text-3xl font-semibold">
                            <?= $user['name'] ?>
                        </p>
                        <div class="flex justify-center items-center gap-x-2 my-2 text-gray-400"> 
                            <span>Joined <?php echo date("F, Y", strtotime($user['created_at'])) ?></span>
                        </div>
                        <p class="text-center text-gray-600 mt-5">
                            <?= $user['bio'] ?>
                        </p>
                    </div>
                </div>
              
            </div>
             
        </div>
    </main>

    <!-- Modal Background -->
    <?php if(isset($_GET['action']) && $_GET['action'] == 'edit') { ?>
    <div id="profileModal" class="fixed inset-0 bg-black/25 bg-opacity-50 flex items-center justify-center z-50">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
            <h2 class="text-xl font-semibold mb-5">Edit Profile</h2>
            
            <form action="" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <div>
                    <label for="avatar" class="text-xs md:text-base font-medium mb-2 block">Avatar</label>
                    <input type="file" name="avatar" id="avatar" class="w-full h-auto px-5 py-2.5 border border-gray-100 rounded-lg bg-slate-50 text-base font-normal text-black"  accept="image/*">
                </div>
                <div class="col-md-6">
                    <label for="name" class="text-xs md:text-base font-medium mb-2 block">Name</label>
                    <input type="text" name="name" id="name" value="<?= $user['name'] ?>" class="w-full h-auto px-5 py-2.5 border border-gray-100 rounded-lg bg-slate-50 text-base font-normal text-black" required>
                </div> 
                <div class="col-md-6">
                    <label for="email" class="text-xs md:text-base font-medium mb-2 block">Email</label>
                    <input type="email" name="email" id="email" value="<?= $user['email'] ?>" class="w-full h-auto px-5 py-2.5 border border-gray-100 rounded-lg bg-slate-50 text-base font-normal text-black" required>
                </div>  
                <div class="col-md-6">
                    <label for="bio" class="text-xs md:text-base font-medium mb-2 block">Bio</label>
                    <textarea name="bio" id="bio" cols="55" rows="3" class="w-full h-auto px-5 py-2.5 border border-gray-100 rounded-lg bg-slate-50 text-base font-normal text-black"><?= $user['bio'] ?></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" name="update" class="px-4 py-1 5 rounded-lg bg-black text-white">
                        Update
                    </button>
                </div>
                 
            </form>

        </div><!-- Modal Content -->
    </div>
    <script>
    function openModal() {
        document.getElementById('profileModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('profileModal').classList.add('hidden');
    }
    </script>
    <?php } ?>


    <?php include_once('includes/footer.inc.php'); ?>
       
</body>
</html>