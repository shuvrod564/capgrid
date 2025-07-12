<?php
	// SHOW SESSION MESSAGE IF EXISTS
	echo getSessionMessageHtml();
?>
<div style="background: #f8fafc;" class="fixed top-0 left-0 -z-10 pointer-events-none min-h-screen w-full"> 
  <div class="absolute inset-0 z-0" style="
    background-image:
      linear-gradient(to right, #e8ecf0 1px, transparent 1px),
      linear-gradient(to bottom, #eae9e9 1px, transparent 1px);
    background-size: 20px 30px;
    -webkit-mask-image:
      radial-gradient(ellipse 70% 60% at 50% 0%, #000 60%, transparent 100%);
    mask-image:
      radial-gradient(ellipse 70% 60% at 50% 0%, #000 60%, transparent 100%);
  "></div> 
</div>

<nav class="py-4">
	<div class="container flex items-center justify-between gap-4">
		<a href="<?= SITE_URL ?>" class="text-xl font-medium text-dark uppercase inline-block">
			<img src="assets/images/capgrid.png" alt="CapGrid" class="w-full h-12">
		</a>

		<div class="inline-flex items-center gap-3"> 
	        <?php if(isset($_SESSION['user_id'])){ ?> 
				<a href="dashboard.php" class="inline-block px-4 py-2 bg-gray-100 text-gray-900 rounded-md">Dashboard</a>   
				<a href="caption.php?method=create" class="inline-block px-4 py-2 bg-gray-200 text-gray-900 rounded-md">Add Caption</a>   
				<!-- Profile Dropdown -->
				<div class="relative inline-block text-left" x-data="{ open: false }"> 
					<button @click="open = !open" type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer shadow-sm">
						<?php $profileImaage = $_SESSION['user_thumbnail'];	 ?>
						<img class="w-10 h-10 rounded-full bg-white object-cover" src="<?= !empty($profileImaage) ? 'uploads/'.$profileImaage : 'assets/images/avatar.jpeg' ?>" alt="User Avatar">
					</button>

					<!-- Dropdown Panel -->
					<div x-show="open" @click.outside="open = false" class="absolute right-0 z-20 mt-2 w-max origin-top-right rounded-md bg-white shadow-lg ring-1 ring-gray-200 ring-opacity-5">
						<div class="py-1 text-sm text-gray-700">
						<a href="profile.php" class="block px-4 py-2 hover:bg-gray-100">My Profile</a> 
						<form method="POST" action="logout.php">
							<button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
						</form>
						</div>
					</div>
				</div>
	        <?php } else{ ?>
	            <a href="login.php" class="inline-block px-4 py-2 bg-black text-white rounded-md">Login</a>
			<?php } ?>
			<!-- <a href="users.php" class="inline-block px-4 py-2 bg-black text-white rounded-md">All Users</a> -->

		</div>
	</div>
</nav>