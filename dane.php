<?php
	session_start();
	if (!isset($_SESSION['zalogowany'])) // tego ifa można dokleić wszedzie tam gdzie user jest zalogowany
	{
		header('Location: index.php');
		exit();
	}
?>
<DOCTYPE html>
<head>
<link rel="stylesheet" href="js/jquery/jquery-ui.css">
  <script src="js/jquery.js"></script>
  <script src="js/jquery/jquery-ui.js"></script>
  <script src="js/main.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/output.css">

<meta charset="UTF-8"/>
<title></title>
</head>
	<body>
		<?php
			echo '<p class="powitanie">Dzień dobry '.$_SESSION['user'].'! </p> <a id="wyloguj" href="logout.php">Wyloguj się!</a>' ;			
		?>

<br>
<br>
		<form action="wyslij.php" method="POST">
			<p>Data eventu:</p> <input type="text" name="data_slubu" id="datepicker" placeholder="Wolny termin..."><br>
			<p>Opis:</p> <textarea name="Opis"></textarea>
			<input type="submit" class="wysylka" value="Wyslij">
		</form>
		<?php

			if (isset($_SESSION['e-opis']))
				{
					echo '<div class="error">'.$_SESSION['e-opis'].'</div>';
					unset($_SESSION['e-opis']);
				}

				if (isset($_SESSION['e_wyslij']))
				{
					echo '<div class="error">'.$_SESSION['e_wyslij'].'</div>';
					unset($_SESSION['e_wyslij']);
				}
			?>


	</body>

</html>