<?php
	session_start();
	if((!isset($_POST['login']))|| (!isset($_POST['haslo'])))
		{
			$_SESSION['blad']= '<span class="error_log">Nieprawidlowy login lub haslo</span>';

		}
?>
<DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/output.css">
  <script src="js/logowanie_val.js"></script>

<meta charset="UTF-8"/>
<title></title>
</head>
	<body>
		<form action="zaloguj.php" method="POST" id="log">
			 <input type="text" name="login" id= "login" class="formularz" placeholder="Login">
			 <input type="password" name="haslo" id="haslo" class="formularz" placeholder="Hasło">
			  <input type="submit" id="zaloguj" value="Zaloguj się">
		</form>
		
<?php
		if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
?>


	</body>

</html>