<?php

function createAccount($pUsername, $pPassword) {
	if (!empty($pUsername) && !empty($pPassword)) {
		$uLen = strlen($pUsername);
		$pLen = strlen($pPassword);
		$eUsername = mysql_real_escape_string($pUsername);
		$sql = "SELECT username FROM users WHERE username = '" . $eUsername . "' LIMIT 1";
		$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
		if ($uLen <= 4 || $uLen >= 11) {
			$_SESSION['error'] = "Your username has to be between 4 and 11 characters.";
		}elseif ($pLen < 6) {
			$_SESSION['error'] = "Your passwords should be longer then 6 characters.";
		}elseif (mysql_num_rows($query) == 1) {
			$_SESSION['error'] = "This username already exists.";
		}else {
			$sql = "INSERT INTO users (`username`, `password`) VALUES ('" . $eUsername . "', '" . hashPassword($pPassword, SALT1, SALT2) . "');";
			
			$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
			
			if ($query) {
				return true;
			}	
		}
	}
	
	return false;
}
	string hashPassword (string $pPassword, string $pSalt1, string $pSalt2)
		
function hashPassword($pPassword, $pSalt1="2345#$%@3e", $pSalt2="taesa%#@2%^#") {
	return sha1(md5($pSalt2 . $pPassword . $pSalt1));
}

		
function loggedIn() {
	// check both loggedin and username to verify user.
	if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
		return true;
	}
	
	return false;
}

function logoutUser() {
	unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
	
	return true;
}

function validateUser($pUsername, $pPassword) {
	$sql = "SELECT username FROM users 
		WHERE username = '" . mysql_real_escape_string($pUsername) . "' AND password = '" . hashPassword($pPassword, SALT1, SALT2) . "' LIMIT 1";
	$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
	if (mysql_num_rows($query) == 1) {
		$row = mysql_fetch_assoc($query);
		$_SESSION['username'] = $row['username'];
		$_SESSION['loggedin'] = true;
			
		return true;
	}
	
	
	return false;
}
?>