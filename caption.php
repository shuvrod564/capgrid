<?php
    include_once('config/config.inc.php');
    include_once('config/auth.inc.php');

    $captionObj = new Captions();
    $formType = 'create';
    $editCaption = [
        'cap_content' => '',
        'id' => '',
    ];
    
    if (isset($_POST['submit'])) {
        $captionObj->insertCaption($_POST);
    }

    // get edit id from url
    if (isset($_GET['id']) && isset($_GET['method']) && $_GET['method'] === 'edit') {
        $formType = 'edit';
        $editCaption = $captionObj->getEditCaption($_GET['id']);
    }

    if (isset($_POST['update'])) {
        $captionObj->updateCaption($_POST);
    }
 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Create New Caption</title>

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    <?php include_once('includes/header.inc.php'); ?>

    <main class="d-flex align-items-center py-5">
        <div class="container py-5">
            <div class="col-lg-6 mx-auto">
                <div class="p-5 md:p-8 rounded-lg bg-white shadow">
                    <h1 class="text-xl md:text-2xl font-semibold mb-5 text-dark">Create new caption</h1> 
                    
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="flex flex-col gap-4">
                        <input type="hidden" name="id" value="<?php echo $editCaption['id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <div class="col-md-6">
                            <label for="caption_text" class="text-base md:text-xl font-medium mb-2 block">Caption texts</label>
                            <textarea cols="55" rows="6" name="caption_text" id="caption_text" class="w-full h-auto p-5 border border-gray-400 rounded-lg bg-slate-50 text-base font-normal text-black" required><?php echo htmlspecialchars($editCaption['cap_content']) ?></textarea> 
                        </div> 
                        
                        <div class="text-right">
                            <button type="submit" name="<?php echo $formType == 'create' ? 'submit' : 'update' ?>" class="text-base md:text-lg font-bold px-8 py-4 inline-block bg-black text-white rounded-lg">
                                Create Caption
                            </button>
                        </div>
                    </form>
                </div>
            </div>
             
        </div>
    </main>

       
    <?php include_once('includes/footer.inc.php'); ?>
</body>
</html>