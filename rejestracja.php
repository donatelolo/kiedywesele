<?php
	session_start();

	if(isset($_POST['email']))
	{
		
	$walidacja=true;


		//nazwa miejsca


		$nick = $_POST['nick'];

		if ((strlen($nick)<3) || (strlen($nick)>70))
				{
					$walidacja = false;
					$_SESSION['e_nick'] = "Nazwa musi posiadac od 3 do 70 znaków";
				}
		

		// opis miejsca
		
		$opis_miejsca=$_POST['opis_miejsca'];
		if (strlen($opis_miejsca)>1000)
		{
			$walidacja = false;
			$_SESSION['e_opis_miejsca'] = "Maksymalna długosc opisu to 1000 znaków. Prosimy o mniej";
		}

		//wojewodztwo
		$wojewodztwo = $_POST['wojewodztwo'];

		//miejscowosc
		$miejscowosc = $_POST['miejscowosc'];
		if (strlen($miejscowosc)==0)
		{
			$walidacja = false;
			$_SESSION['e_miejscowosc'] = "Proszę o podanie miejscowosci";
		}

		//adres
		$adres=$_POST['adres'];

		if (strlen($adres)==0)
		{
			$walidacja = false;
			$_SESSION['e_adres'] = "Proszę o podanie adresu";
		}
		

		//walidacja emaila

		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

	

		if((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false))
		{
			$walidacja=false;
			$_SESSION['e_email'] = "Niepoprawny email";
		}
		// || ($emailB!=$email)
		//telefon
		$telefon = $_POST['telefon'];

		if(!isset($_POST['telefon']) || (strlen($telefon) < 8)) {
			$walidacja=false;
			$_SESSION['e_telefon']="Proszę o podanie prawidłowego numeru telefonu (tylko liczby)";

		}
		//(!is_numeric($telefon))){

		//strona www

		$strona_www=$_POST['strona_www'];
		$strona_www_valid= filter_var($strona_www, FILTER_SANITIZE_URL);
		if(filter_var($strona_www_valid, FILTER_VALIDATE_URL)==false)
			{
			$walidacja=false;
			$_SESSION['e_strona_www'] = "Niepoprawny adres strony internetowe";
		}
//|| ($strona_www_valid!=$strona_www)
		
		// poprawnosc hasla 

		$haslo1 = $_POST['haslo1'];
		$haslo2 = $_POST['haslo2'];

		if((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$walidacja=false;
			$_SESSION['e_haslo']="Hasło musi posiada od 8 do 20 znaków";
		}

		if ($haslo1!=$haslo2)
		{
			$walidacja=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne";
		}
		

		$haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT);
		
		// czy zaakceptowano regulamin

		if (!isset($_POST['regulamin']))
		{
			$walidacja=false;
			$_SESSION['e_regulamin']="Proszę zaakceptowac regulamin";
		}

		//walidacja udana

		//BOT OR NOT

		$sekret = "6LfI2xQTAAAAAMZhnomsZ-nG7ddZjPf4UIZjW1B_";

		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		

		$odpowiedz = json_decode($sprawdz);
		if($odpowiedz->success==false)
		{
			$walidacja=false;
			$_SESSION['e_bot']="Potwierdź że nie jestes botem";
		}

		
		require_once "connect.php";

		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
			$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
			if ($polaczenie->connect_errno!=0)
	{
		throw new Exception (mysqli_connect_errno());
	}
	else
	{

		//Czy email juz istnieje?
		$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email='$email'");

		if (!$rezultat) throw new Exception($polaczenie->error);
				$how_many_mails = $rezultat->num_rows;

		if($how_many_mails>0)
		{
			{
				$walidacja=false;
				$_SESSION['e_email']="Podany email już istnieje w bazie";
			}
		}

		//Czy nick juz istnieje?

		$rezultat = $polaczenie->query("SELECT id FROM uzytkownicy WHERE user='$nick'");

		if (!$rezultat) throw new Exception($polaczenie->error);
				$how_many_nicks = $rezultat->num_rows;
				
		if($how_many_nicks>0)
		{
			{
				$walidacja=false;
				$_SESSION['e_nick']="Istnieje już obiekt o podanej nazwie";
			}
		}

		//udana rejestracja
		
		if ($walidacja ==true)
					{
						if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL, '$nick','$haslo_hash','$opis_miejsca','$wojewodztwo', '$miejscowosc', '$adres' ,'$email'
							,'$telefon','$strona_www_valid')"))
						{
							$_SESSION['udanarejestracja']=true;
							header('Location:witamy.php');
						}
						else
						{
							throw new Exception($polaczenie->error);
						}
					} 

		$polaczenie->close();
	}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodnoci';
			echo '<br>Informacja developerska:'.$e;
		}

	}	
		

			
?>
<DOCTYPE html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Załóż nowe konto</title>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/validation.js"></script>
<script src="js/ajax-upload.js"></script>
<link rel="stylesheet" type="text/css" href="css/output.css">

</head>
	<body>
	

		<form method="post" >
	<h4>Nazwa obiektu:</h4> <br>	<input type="text" name="nick" id="nick" value="<?php echo (isset($_POST['nick']) ? $_POST['nick'] : ''); ?> "><div id="nick_wal"></div><br>	
			<?php
				if (isset($_SESSION['e_nick']))
				{
					echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
					unset($_SESSION['e_nick']);
				}
			?>
	<h4>Opis:</h4> <br> <textarea name="opis_miejsca" id="opis_miejsca" value="<?php echo (isset($_POST['opis_miejsca']) ? $_POST['opis_miejsca'] : ''); ?> "></textarea><div id="opis_wal"></div><br>
			<?php
				if (isset($_SESSION['e_opis_miejsca']))
				{
					echo '<div class="error">'.$_SESSION['e_opis_miejsca'].'</div>';
					unset($_SESSION['e_opis_miejsca']);
				}
			?>


			

	<h4>Województwo:</h4> <br><select name="wojewodztwo" id="wojewodztwo" width="100px" value="<?php echo (isset($_POST['wojewodztwo']) ? $_POST['wojewodztwo'] : ''); ?> "><div id="wojewodztwo_wal"></div>
								<option value="dolnośląskie">dolnośląskie</option>
								<option value="kujawsko-pomorskie">kujawsko-pomorskie</option>
								<option value="lubelskie">lubelskie</option>
								<option value="lubuskie">lubuskie</option>
								<option value="łódzkie">łódzkie</option>
								<option value="małopolskie">małopolskie</option>
								<option value="mazowieckie">mazowieckie</option>
								<option value="opolskie">opolskie</option>
								<option value="podkarpackie">podkarpackie</option>
								<option value="podlaskie">podlaskie</option>
								<option value="pomorskie">pomorskie</option>
								<option value="śląskie">śląskie</option>
								<option value="świętokrzyskie">świętokrzyskie</option>
								<option value="warmińsko-mazurskie">warmińsko-mazurskie</option>
								<option value="wielkopolskie">wielkopolskie"</option>
								<option value="zachodniopomorskie">zachodniopomorskie</option>
							</select> 

	<h4>Miejscowosc:</h4> <br><input type="text" name="miejscowosc" id="miejscowosc" value="<?php echo (isset($_POST['miejscowosc']) ? $_POST['miejscowosc'] : ''); ?> "><div id="miejscowosc_wal"></div><br>
			<?php
				if (isset($_SESSION['e_miejscowosc']))
				{
					echo '<div class="error">'.$_SESSION['e_miejscowosc'].'</div>';
					unset($_SESSION['e_miejscowosc']);
				}
			?>

	<h4>Adres:</h4> <br> <input type="text" name="adres" id="adres" value="<?php echo (isset($_POST['adres']) ? $_POST['adres'] : ''); ?> "><div id="adres_wal"></div> <br>	
			
			<?php
				if (isset($_SESSION['e_adres']))
				{
					echo '<div class="error">'.$_SESSION['e_adres'].'</div>';
					unset($_SESSION['e_adres']);
				}
			?>
	<h4>E-mail:</h4> <br>	<input type="text" name="email" id="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?> "><div id="email_wal"></div><br>
			<?php
				if (isset($_SESSION['e_email']))
				{
					echo '<div class="error">'.$_SESSION['e_email'].'</div>';
					unset($_SESSION['e_email']);
				}
			?>
	<h4>Telefon:</h4> <br> <input type="text" name="telefon" id="telefon" value="<?php echo (isset($_POST['telefon']) ? $_POST['telefon'] : ''); ?> "> <div id="telefon_wal"></div><br>
			<?php
				if (isset($_SESSION['e_telefon']))
				{
					echo '<div class="error">'.$_SESSION['e_telefon'].'</div>';
					unset($_SESSION['e_telefon']);
				}
			?>
	<h4>Strona www:</h4> <br> <input type="text" name="strona_www" id="strona_www" value="<?php echo (isset($_POST['strona_www']) ? $_POST['strona_www'] : ''); ?> "> <div id="strona_www_wal"></div><br> 
			<?php
				if (isset($_SESSION['e_strona_www']))
				{
					echo '<div class="error">'.$_SESSION['e_strona_www'].'</div>';
					unset($_SESSION['e_strona_www']);
				}
			?>
			

	<h4>Hasło:</h4> <br>	<input type="password" name="haslo1" id="haslo1"><div id="haslo1_wal"></div><br>
			<?php
				if (isset($_SESSION['e_haslo']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
					unset($_SESSION['e_haslo']);
				}
			?>
			
	<h4>Powtórz hasło:</h4> <br>	<input type="password" name="haslo2" id="haslo2" ><div id="haslo2_wal"></div><br><div id="haslo3_wal"></div>
			
			<br>
			<label>
					<input type="checkbox" name="regulamin" id="regulamin" value="<?php echo (isset($_POST['regulamin']) ? $_POST['regulamin'] : ''); ?> "><p>Akceptuję Regulamin</p><div id="regulamin_wal"></div>		
			</label>
			<br>
			<?php
				if (isset($_SESSION['e_regulamin']))
				{
					echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
					unset($_SESSION['e_regulamin']);
				}
			?>
			<br>
			<div class="g-recaptcha" data-sitekey="6LfI2xQTAAAAAOrZk6-pvLpb1862sHtLeVZu_TvR"></div>
			<?php
				if (isset($_SESSION['e_bot']))
				{
					echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
					unset($_SESSION['e_bot']);
				}
			?>
			<br>
			
    
			<br>	
			<input type="submit" name="submit"  id="submit" value="Zarejestruj się!">
			</form>
	
		<script src="js/validation.js"></script>
	</body>

</html>