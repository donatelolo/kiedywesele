<?php
	session_start();

	if (!isset($_SESSION['udanarejestracja'])) 
	{
		header('Location:index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
?>
<DOCTYPE html>
<head>
<meta charset="UTF-8"/>
<style type="text/css">
	.error {
	color:red;
	padding: 5px;
	}
</style>
<title></title>
</head>
	<body>
		Dziękujemy za rejestrację w serwisie. Proszę o zalogowanie się
			<a href="index.php">Zaloguj się na swoje konto</a>
			<br><br>	
		
	
	</body>

</html>