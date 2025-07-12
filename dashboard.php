<?php
    include_once('config/config.inc.php');
    include_once('config/auth.inc.php');

    $captionObj = new Captions();

    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $captionObj->deleteCaption($_GET['delete']);
    }
    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Dashboard</title>

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    <?php include_once('includes/header.inc.php'); ?>
     
    <main class="d-flex align-items-center py-5">
        <div class="container py-5">
            <!-- <div class="text-right mb-5">
                <a href="caption.php?method=create" class="inline-flex items-center gap-2 bg-gray-200 px-5 py-2.5 rounded-lg">
                    Add New Caption
                </a>
            </div> -->
            <div class="space-y-5">
            	<?php
            		$captions = $captionObj->getLoggedUserCaptions();
                    if (!empty($captions)) {  
            		foreach ($captions as $caption) { 
            	?>
                <div class="rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <p class="text-base md:text-lg font-semibold text-dark mb-4">
                    	<?= $caption['cap_content'] ?>
                    </p> 
                    
                    <div class="text-sm text-gray-400 flex items-center justify-between">
                        <?= date('M d, Y', strtotime($caption['created_at'])) ?>
                        <div class="inline-flex items-center gap-2"> 
                            <a href="caption.php?id=<?php echo $caption['id']; ?>&method=edit" class="py-1 px-2 rounded-lg text-yellow-400 bg-yellow-50 hover:bg-yellow-100">Edit</a>    
                            <a href="dashboard.php?delete=<?php echo $caption['id']; ?>" class="py-1 px-2 rounded-lg text-red-400 bg-red-50 hover:bg-red-100">Remove</a>    
                        </div>
                    </div>
                </div>
                <?php } } else { ?>
                <div class="text-center p-5 bg-slate-50 min-h-[300px] rounded-lg md:text-lg flex items-center justify-center">
                    No captions found. Start creating your first one!
                </div>
                <?php }  ?>
            </div>
             
        </div>
    </main>

    <?php include_once('includes/footer.inc.php'); ?>
</body>
</html>