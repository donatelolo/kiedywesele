<?php
	session_start();
	if (!isset($_SESSION['zalogowany'])) // tego ifa można dokleić wszedzie tam gdzie user jest zalogowany
	{
		header('Location: index.php');
		exit();
	}
	if(!isset($_POST['data_slubu']) && (!isset($_POST['Opis'])))
	{
		header('Location: dane.php');
		$_SESSION['e-wyslij'] = "Proszę podac datę oraz opis wydarzenia";
		exit();
	}
?>
<DOCTYPE html>
<head>
<meta charset="UTF-8"/>
<title></title>
<link rel="stylesheet" type="text/css" href="css/output.css">
</head>
	<body>
		
		

<?php
// walidacja inputów 



if (isset($_POST['data_slubu'])){
	$walidacja = true;
	$data_slubu = $_POST['data_slubu'];
	$Opis = $_POST['Opis'];

	if (strlen($Opis)==0 || (strlen($data_slubu)==0))
				{
					$walidacja=false;
					$_SESSION['e-opis']= "Ups nie udało się. Spróbuj jeszcze raz";
					header('Location:dane.php');

				}

	}
	
else {
					$walidacja=false;
					$_SESSION['e-opis']= "Ups cos poszło nie tak. Spróbuj jeszcze raz";
					header('Location:dane.php');
}
require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
//$polaczenie = mysqli_connect("localhost", "root", "", "projekt");
 
// Check connection
if($polaczenie === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
		$data_slubu = $_POST['data_slubu'];
		$Opis = $_POST['Opis'];
		$user = $_SESSION['user'];
		$sql = "INSERT INTO eventy (user, Data, Opis)
				VALUES ('$user', '$data_slubu' , '$Opis')";
				


if(mysqli_query($polaczenie, $sql)) {
    echo '<h2 id="termin">Wolny termin został zapisany w bazie, dziękujemy!'.'</h2>';
    echo '<a class="wysylka" href="dane.php">Dodac kolejny termin? </a>';
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($polaczenie);

 }
// Close connection
mysqli_close($polaczenie);
?>
		
		
	</body>

</html>