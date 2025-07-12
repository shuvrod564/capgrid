<?php 
session_start();
 
// SET ERROR REPORTING
error_reporting(E_ALL);
ini_set("display_errors", 1);

// SET SITE URL BASED ON ENVIRONMENT 
define('SITE_URL', 'https://localhost/PHP/capgrid/');
	
// CREATE DB CONNECTION AND SUPER CLASS NAMED CAPTIONS
class Captions 
{
	private $servername = "localhost"; 
	private $username   = "root";
	private $password   = "";
	private $dbname     = "capgrid";
	public $con; 

	// db connection
	public function __construct() 
	{
		$this ->con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if (mysqli_connect_error()) {
			trigger_error("Failed to connect to MySQL:". mysqli_connect_error());
			
		} else {
			return $this->con;
		}
	}


	// COLLECT ALL CAPTIONS FOR VIEW ON HOMEPAGE 
	public function viewAllCaptions()
	{
		$query = "SELECT * FROM captions ORDER BY id DESC";
		$sql = $this->con->query($query);
		if ($sql->num_rows > 0) {
			$data = array();
			while ($row = $sql->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo '<div class="p-5 text-center text-lg md:text-2xl">No caption found!</div>';
		}
	}


	// INSERT NEW CAPTION ITEM TO DB
	public function insertCaption($post)
	{
		$capText = $this->con->real_escape_string($post['caption_text']);
		$authorID = $this->con->real_escape_string($post['user_id']);

		$query = "INSERT INTO captions(cap_content, author) VALUES ( '$capText', '$authorID' )";
		$sql   = $this->con->query($query);
		if ($sql == true) {
			setSessionMessage('Caption inserted successfully!', 'success');
			header("Location: dashboard.php");
		} else {
			echo "Registration fail try again!";
		}
	}

	// GET EDIT CAPTION DATA
	public function getEditCaption($id)
	{
		$id = (int) $id;
		$query = "SELECT * FROM captions WHERE id = $id";
		$sql = $this->con->query($query);
		if ($sql && $sql->num_rows > 0) {
			return $sql->fetch_assoc();
		} else {
			return null;
		}
	}

	// UPDATE CAPTION ITEM
	public function updateCaption($post)
	{
		$id = $this->con->real_escape_string($post['id']);
		$capText = $this->con->real_escape_string($post['caption_text']);
		$query = "UPDATE captions SET cap_content = '$capText' WHERE id = $id";
		$sql = $this->con->query($query);
		if ($sql == true) {
			setSessionMessage('Caption updated successfully!', 'success');
			header("Location:".SITE_URL."dashboard.php");
			exit();
		}
	}

	// DELETE CAPTION BASED ON ID FOR LOGGED USER ONLY
	public function deleteCaption($post) 
	{
		$id = $post;
		$query = "DELETE FROM captions WHERE id = $id";
		$sql = $this->con->query($query);
		if ($sql == true) {
			setSessionMessage('Caption deleted successfully!', 'success');
			header("Location:".SITE_URL."dashboard.php");
			exit();
		}
	}


	// GET CAPTIONS FOR DASGBOARD PAGE FOR LOGGED IN USER
	public function getLoggedUserCaptions()
	{
		$user_id = $_SESSION['user_id'];
		$query = "SELECT * FROM captions WHERE author = '$user_id' ORDER BY id DESC";
		$sql = $this->con->query($query);
		if ($sql->num_rows > 0) {
			$data = array();
			while ($row = $sql->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} 
	}
	 

}


// SESSION MESSAGES SET AND SHOW
function setSessionMessage($message, $type = 'success') {
	$_SESSION['form_message'] = [
		'text' => $message,
		'type' => $type
	];
}

function getSessionMessageHtml() {
	if (isset($_SESSION['form_message'])) {
		$msg = $_SESSION['form_message'];
		unset($_SESSION['form_message']);

		// Choose color classes based on type
		$color = $msg['type'] === 'success' ? 'green' : ($msg['type'] === 'error' ? 'red' : 'blue');
		$icon = $color === 'green'
			? '<svg class="w-6 h-6 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
			: '<svg class="w-6 h-6 text-'.$color.'-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01"/></svg>';

		return '
		<div id="toast-'.$msg['type'].'" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 mb-4 text-gray-900 bg-'.$color.'-100 rounded-lg shadow" role="alert">
			'.$icon.'
			<div class="ml-3 text-sm font-normal">
				'.htmlspecialchars($msg['text']).'
			</div>
			<button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-'.$color.'-100 text-'.$color.'-500 rounded-lg focus:ring-2 focus:ring-'.$color.'-400 p-1.5 hover:bg-'.$color.'-200 inline-flex h-8 w-8" onclick="document.getElementById(\'toast-'.$msg['type'].'\').remove();" aria-label="Close">
				<span class="sr-only">Close</span>
				<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
				</svg>
			</button>
		</div>
		';
	}
	return '';
}
 

/**
 * 
 */
class Users extends Captions
{
	// INSERT NEW USER INTO DB
	public function createNewUser($post)
	{
	    $name = $this->con->real_escape_string($post['name']);
	    $email = $this->con->real_escape_string($post['email']);
	    $password = $this->con->real_escape_string($post['password']);
	    
	    // Hash the password securely
	    $hash_password = password_hash($password, PASSWORD_DEFAULT); // ← semicolon was missing here

	    $query = "INSERT INTO users(name, email, password) VALUES ('$name', '$email', '$hash_password')";
	    $sql = $this->con->query($query);
	    if ($sql == true) { 
        	setSessionMessage('User registered successfully!', 'success');

	        header("Location: login.php?msg=registered");
	        exit(); // Optional but recommended after header redirect
	    } else {
	        return '❌ Failed to register user.';
	    }
	}

	// UPDATE USER PROFILE DATA
	public function updateUser($post, $file)
	{ 
		$id = (int) $post['id'];
		$name = $this->con->real_escape_string($post['name']);
		$email = $this->con->real_escape_string($post['email']);
		$bio = $this->con->real_escape_string($post['bio']);
		$avatarFilename = '';

		// Handle avatar upload (without MIME type checking)
		if (isset($file['avatar']) && $file['avatar']['error'] === UPLOAD_ERR_OK) {
			$uploadDir = 'uploads/';
			if (!is_dir($uploadDir)) {
				mkdir($uploadDir, 0755, true);
			}
			$extension = pathinfo($file['avatar']['name'], PATHINFO_EXTENSION);
			$avatarFilename = 'avatar_' . time() . '_' . rand(1000, 9999) . '.' . $extension;
			$destination = $uploadDir . $avatarFilename;

			move_uploaded_file($file['avatar']['tmp_name'], $destination);
		}

		// Build query
		$query = "UPDATE users SET name = '$name', email = '$email', bio = '$bio'";
		if ($avatarFilename !== '') {
			$query .= ", thumbnail = '$avatarFilename'";
		}
		$query .= " WHERE id = $id";

		$sql = $this->con->query($query);

		if ($sql === true) {
			setSessionMessage("Profile updated successfully.", 'success');
			header("Location:" . SITE_URL . "profile.php");
			exit();
		} else {
			setSessionMessage("Failed to update profile.", 'error');
		}
	}




	// CHECK LOGIN CREDENTICIALS
	public function loginUser($post)
	{
		$username = $this->con->real_escape_string($post['username']);
		$password = $post['password'];

		$query = "SELECT * FROM users WHERE email = '$username'";
		$sql   = $this->con->query($query);
		if ($sql->num_rows > 0) {
			$user = $sql->fetch_assoc();
			 
			if (password_verify($password, $user['password'])) {
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['user_email'] = $user['email'];
				$_SESSION['user_name'] = $user['name']; 
				$_SESSION['user_thumbnail'] = $user['thumbnail']; 

				setSessionMessage('Login success!', 'success'); 
				header("Location:". SITE_URL ."dashboard.php");
				exit();
			} else {
				return 'Invalid credentials!';
			}
		} else {
			return 'Invalid credentials!'; 
		}
	}

	// VIEW ALL USERS AT ADMIN PANEL
	public function viewAllUsers()
	{
		$query = "SELECT * FROM users ORDER BY id DESC";
		$sql = $this->con->query($query);
		if ($sql->num_rows > 0) {
			$data = array();
			while ($row = $sql->fetch_assoc()) {
				$data[] = $row;
			}
			return $data;
		} else {
			echo "No user found!";
		}
	}

	// GET USER PROFILE DATA FOR PROFILE PAGE
	public function getUserProfile($id)
	{
		$query = "SELECT * FROM users WHERE id = $id";
		$sql = $this->con->query($query);
		if ($sql->num_rows > 0) {
			return $sql->fetch_assoc();
		}
	}
	 


} 






?>