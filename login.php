<?php
require($_SERVER['DOCUMENT_ROOT'] . 'login/includes/config.php');
if (isset($_GET['action'])) {
	switch (strtolower($_GET['action'])) {
		case 'login':
			if (isset($_POST['username']) && isset($_POST['password'])) {
				if (!validateUser($_POST['username'], $_POST['password'])) {
					$_SESSION['error'] = "Silly username or password";
					unset($_GET['action']);
				}
			}else {
				$_SESSION['error'] = "Fill in both, Dummy!";
				unset($_GET['action']);
			}			
		break;
		case 'logout':
			if (loggedIn()) {
				logoutUser();
				$sOutput .= '<h1>Logged out!</h1><br />You have been logged out successfully. 
						<br /><h4>Would you like to go to <a href="index.php">site index</a>?</h4>';
			}else {
				// unset the action to display the login form.
				unset($_GET['action']);
			}
		break;
	}
}

$sOutput .= '<div id="index-body">';
if (loggedIn()) {
	$sOutput .= '<h1>Logged In!</h1><br /><br />
		Hello, ' . $_SESSION["username"] . ' how are you today?<br /><br />
		<h4>Would you like to <a href="login.php?action=logout">logout</a>?</h4>
		<h4>Would you like to go to <a href="index.php">site index</a>?</h4>';
}elseif (!isset($_GET['action'])) {
	$sUsername = "";
	if (isset($_POST['username'])) {
		$sUsername = $_POST['username'];
	}
	
	$sError = "";
	if (isset($_SESSION['error'])) {
		$sError = '<span id="error">' . $_SESSION['error'] . '</span><br />';
	}
	
	$sOutput .= '<h2>Login to our site</h2><br />
		<div id="login-form">
			' . $sError . '
			<form name="login" method="post" action="login.php?action=login">
				Username: <input type="text" name="username" value="' . $sUsername . '" /><br />
				Password: <input type="password" name="password" value="" /><br /><br />
				<input type="submit" name="submit" value="Login!" />
			</form>
		</div>
		<h4>Would you like to <a href="login.php">login</a>?</h4>
		<h4>Create a new <a href="register.php">account</a>?</h4>';
}

$sOutput .= '</div>';
echo $sOutput;
?>