<?php
	function generateNewString($len = 20) {
		$token = "poiuztrewqasdfghjklmnbvcxy1234567890";
		$token = str_shuffle($token);
		$token = substr($token, 0, $len);

		return $token;
	}

	function redirectToLoginPage() {
		header('Location: https://moj-dennik.eu/login.php');
		exit();
	}

?>
