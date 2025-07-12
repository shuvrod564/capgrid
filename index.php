<?php
	include_once('config/config.inc.php');

	$captionObj = new Captions();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon"> 
    <title>Captions List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <?php include('includes/style.inc.php'); ?> 
     
</head>
<body> 

    <?php include_once('includes/header.inc.php'); ?>

    <main class="d-flex align-items-center py-5">
        <div class="container py-5">
            <div class="space-y-5">
            	<?php
            		$captions = $captionObj->viewAllCaptions();
                    if(!empty($captions)) {
            		foreach ($captions as $key => $caption) { 
                    $encodedText = urlencode($caption['cap_content']);
            	?> 
                <div class="rounded-xl bg-white p-6 shadow-lg outline outline-black/5 dark:bg-slate-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                    <p class="text-lg lg:text-xl font-semibold text-dark mb-4 caption-text">
                    	 <?= htmlspecialchars($caption['cap_content']) ?>
                    </p> 
                    <div class="flex justify-between">
                        <div class="inline-flex items-center gap-3">
                            <button class="copy-btn px-3 pt-1 pb-1.5 text-xs bg-gray-100 rounded-full leading-4 cursor-pointer hover:bg-gray-200">Copy</button>
                             
                        </div>
                        <div class="text-right text-sm text-gray-400"> 
                            <?= date("F, Y", strtotime($caption['created_at'])) ?> 
                        </div>    
                    </div>
                </div>
            <?php } } ?>
            </div>
             
        </div>
    </main>

       
    <?php include_once('includes/footer.inc.php'); ?>                    

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const copyButtons = document.querySelectorAll(".copy-btn");

        copyButtons.forEach(button => {
            button.addEventListener("click", function () {
                const parentCard = this.closest(".rounded-xl");
                if (!parentCard) return;

                const captionParagraph = parentCard.querySelector(".caption-text");
                if (!captionParagraph) return;

                const captionText = captionParagraph.textContent.trim();

                navigator.clipboard.writeText(captionText)
                    .then(() => {
                        this.textContent = "Copied!";
                        this.classList.add("bg-green-200");
                        setTimeout(() => {
                            this.textContent = "Copy";
                            this.classList.remove("bg-green-200");
                        }, 1500);
                    })
                    .catch(err => {
                        console.error("Copy failed: ", err);
                    });
            });
        });
    });
    </script>

    
</body>
</html>