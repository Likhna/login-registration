<?php
require($_SERVER['DOCUMENT_ROOT'] . 'login/includes/config.php');

$sOutput .= '<div id="index-body">';
if (loggedIn()) {
	$sOutput .= '<h2>Welcome!</h2>
		Hello, ' . $_SESSION['username'] . ' how are you today?<br />
		<h4>Would you like to <a href="login.php?action=logout">Logout?</a></h4>';
}else {
	$sOutput .= '<h2>Likhna Login</h2><br />
		<h4> <a href="login.php">login</a>?</h4>
		<h4> <a href="register.php">New account</a>?</h4>';

}
$sOutput .= '</div>';

echo $sOutput;
?>