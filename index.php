<?php
	session_start();

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] ==true))
	{
		header('Location:dane.php');
		exit();
	}
?>
<DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8"/>

<link rel="stylesheet" type="text/css" href="css/output.css">
<link href='https://fonts.googleapis.com/css?family=Lato:300italic,400' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/scroll.js"></script>

<title></title>


</head>
	<body>

<img id="image" src="img/slub.jpg"/>

<nav role="navigation" id="nav">
              <input class="trigger" type="checkbox" id="mainNavButton">
              <label for="mainNavButton" onclick></label>
              <ul>
                <li><a href="rejestracja.php" id= "Rejestracja">Rejestracja</a></li>
                <li><a href="logowanie.php" id= "Logowanie">Logowanie</a></li>
              </ul> 
</nav>







<div id="search">
	<h1 id="text">Wolne terminy wesel</h1>
	<button id="szukaj">Znajdź najlepsze miejsce</button>
</div>
<div id="end"></div>
<?php
require_once "connect.php";
$conn = new mysqli($host, $db_user, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT eventy.id, eventy.user, eventy.Data, eventy.Opis, uzytkownicy.user,
uzytkownicy.opis_miejsca, uzytkownicy.wojewodztwo,uzytkownicy.miejscowosc,
uzytkownicy.adres, uzytkownicy.email, uzytkownicy.telefon, uzytkownicy.strona_www FROM eventy INNER JOIN uzytkownicy ON eventy.user = uzytkownicy.user"; 



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	
        echo  '<div class="ogloszenie">'. 
        
        '<div class="data">'        	. '<span class"naglowek_data">' 			   . "Data:  "    . "</span>"         . $row["Data"].  "</div>" . "<br>". 
        '<div class="opis_wydarzenia">' . '<span class"naglowek_opis_wydarzenia">' 	   . "Opis wydarzenia: " .  "</span>" . $row["Opis"] . "</div>" . "<br>".
        '<div class="nazwahotelu">' 	. '<span class="naglowek_hotel">'              . "Nazwa obiektu: ". "</span>"     . $row["user"] .'</div>'."<br>".
        '<div class="opis_miejsca">'	. '<span class="naglowek_opis_miejsca">'       . "Miejsce: ". "</span>"           . $row["opis_miejsca"] .'</div>'."<br>".
        '<div class="wojewodztwo">' 	. '<span class="naglowek_wojewodztwo">'        . "Wojewodztwo: ". "</span>"       . $row["wojewodztwo"] .'</div>'."<br>".
        '<div class="miejscowosc">' 	. '<span class="naglowek_miejscowosc">'        . "Miejscowosc: ". "</span>"       . $row["miejscowosc"] .'</div>'."<br>".
        '<div class="adres">'       	. '<span class="naglowek_adres>'               . "Adres: ". "</span>"             . $row["adres"] .'</div>'."<br>".
        '<div class="email">'       	. '<span class="naglowek_email">'              . "Email: ". "</span>"             . $row["email"] .'</div>'."<br>".
        '<div class="telefon">'     	. '<span class="naglowek_telefon">'            . "Telefon: ". "</span>"           . $row["telefon"] .'</div>'."<br>".
        '<div class="strona_www">'      .'<span class="naglowek_strona_www">'          . "Strona www: ". "</span>"        . "<a href='".$row['strona_www']."'>" .$row['strona_www']. "</a>" . '</div>'."<br>".
         
        "</div>";
     
     
    }
} else {
    echo "Niestety cos poszło nie tak";
}
$conn->close();
?>

<?php
		if(isset($_SESSION['blad'])) echo $_SESSION['blad'];
		?>

		
		
	
	</body>

</html>