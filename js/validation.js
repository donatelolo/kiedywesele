

window.onload =function Validate(){
	
	var nazwa_obiektu = document.getElementById("nick");
	var opis_obiektu  = document.getElementById("opis_miejsca");
	var wojewodztwo   = document.getElementById("wojewodztwo");
	var miejscowosc   = document.getElementById("miejscowosc");
	var adres 		  = document.getElementById("adres");
	var email 		  = document.getElementById("email");
	var telefon 	  = document.getElementById("telefon");
	var strona_www    = document.getElementById("strona_www");
	var haslo1 		  = document.getElementById("haslo1");
	var haslo2 		  = document.getElementById("haslo2");
	var regulamin     = document.getElementById("regulamin");
	var submitt       = document.getElementById("submit");
	

	walidacja = false;
	
	
	nazwa_obiektu.addEventListener("blur", Nickname);
	opis_obiektu.addEventListener("blur", Opis);
	miejscowosc.addEventListener("blur", Miejscowosc);
	adres.addEventListener("blur", Adres);
	telefon.addEventListener("blur", Telefon);
	strona_www.addEventListener("blur", Strona);
	email.addEventListener("blur", walidacjaEmail);
	haslo1.addEventListener("blur", Haslo);
	haslo2.addEventListener("blur", Haslo);
	submitt.addEventListener("click", Podsumowanie);
	
	
function Nickname(){
	nazwa_obiektu_wartosc = nazwa_obiektu.value.length;
	var nazwa_ob = document.getElementById("nick_wal");
     if (nazwa_obiektu_wartosc <4 || nazwa_obiektu_wartosc > 70) {
        nazwa = "Ups to chyba nie ta nazwa";
        walidacja = false;
        nazwa_ob.className = 'bad';
    } else {
        nazwa = "Super!";
        walidacja = true;
     	nazwa_ob.className = 'good';
    }

   nazwa_ob.innerHTML = nazwa;
}
function Opis(){
	opis_obiektu_wartosc = opis_obiektu.value.length;
   	var opis_ob = document.getElementById("opis_wal");
   	if (opis_obiektu_wartosc >1000) {
        opis = "Opis jest ciut za długi";
        opis_ob.className = "bad";
        walidacja = false;
   
    } else if (opis_obiektu_wartosc == 0) {
        opis = "Czy na pewno nie chcesz dodac opisu?";
        walidacja = true;
        opis_ob.className = "good";
    }
    else {
    	opis = "Super opis!";
    	walidacja = true;
    	opis_ob.className = "good";
    }
    opis_ob.innerHTML = opis;
}
function Miejscowosc(){
	miejscowosc_wartosc = miejscowosc.value.length;
   	var miejscowosc_ob = document.getElementById("miejscowosc_wal");
   	if (miejscowosc_wartosc <= 1 ) {
        miejsce = "Proszę o podanie miejscowosci";
        miejscowosc_ob.className = "bad";
        walidacja = false;
          
    } else {
    	miejsce="Bardzo dobrze";
    	miejscowosc_ob.className = "good";
        walidacja = true;    
    }
    miejscowosc_ob.innerHTML = miejsce;
}
function Adres(){
	adres_wartosc = adres.value.length;
   	var adres_ob = document.getElementById("adres_wal");
   	if (adres_wartosc <= 1 ) {
        adr = "Proszę o podanie adresu";
        adres_ob.className = 'bad';
        walidacja = false;
   
    } else {
        adr = "Jest git ";
        walidacja = true;
        adres_ob.className = 'good';
       
    }
    adres_ob.innerHTML = adr;
}
function Telefon(){
	telefon_wartosc = telefon.value.length;
	var telefon_ob = document.getElementById("telefon_wal");
     if (telefon_wartosc < 8) {
        tel = "Ups to chyba nie ten telefon";
        telefon_ob.className = 'bad';
        walidacja = false;
        
    } else {
        tel = "Input OK"; 
        walidacja = true;
     	telefon_ob.className = 'good';
    }

   telefon_ob.innerHTML = tel;
}
function Haslo(){
	haslo1_wartosc = haslo1.value.length;
	haslo2_wartosc = haslo2.value.length;
	var haslo1_ob = document.getElementById("haslo1_wal");
	var haslo2_ob = document.getElementById("haslo2_wal");
	var haslo3_ob = document.getElementById("haslo3_wal");
	
    if (haslo1_wartosc <= 7 ) {
        has1 = "Hasło powinno miec co najmniej 8 znakow";
        haslo1_ob.className = 'bad';
        walidacja = false;
        
    } 
    else {
    	has1 = "Super hasło";
    	haslo1_ob.className = 'good';
    	walidacja = true;
    }
    haslo1_ob.innerHTML = has1;

    if (haslo2_wartosc <= 7){
        has2 = "Hasło powinno miec co najmniej 8 znakow"; 
        haslo2_ob.className = 'bad';
        walidacja = false;
     	
    }
    else {
    	has2 = "Super hasło";
    	haslo2_ob.className = 'good';
    	walidacja = true;
    }
    haslo2_ob.innerHTML = has2;

    if (haslo1_wartosc !== haslo2_wartosc){
    	has3 = "Hasła różnią się";
    	haslo3_ob.className = 'bad';
		walidacja = false;
     	
    }
    else{
    	has3 = "Hasła są takie same";
    	haslo3_ob.className = 'good';
    	walidacja = true;
    }
    haslo3_ob.innerHTML = has3;
}
function walidacjaEmail() {
	var email_ob = document.getElementById("email_wal");
    var re =  /\S+@\S+\.\S+/;
    email_wartosc = email.value;
    if (re.test(email_wartosc) == true){
    	ema = "Super email";
    	email_ob.className = 'good';
    	walidacja = true;
    }
    else{
    	ema = "Ups! To chyba nie ten email, popraw go proszę"
    	email_ob.className = 'bad';
    	walidacja = false;
    }
    email_ob.innerHTML = ema;
}
function Strona(str){
	strona_www_wartosc = strona_www.value.length;
	var strona_ob = document.getElementById("strona_www_wal");
	
	if (strona_www_wartosc <= 1){
        str = "Proszę o podanie strony www";
        strona_ob.className = 'bad';
        walidacja = false;
     	
    }
    else {
    	str = "Super strona";
    	strona_ob.className = 'good';
    	walidacja = true;
    }
    strona_ob.innerHTML = str;
}
function WalRegulamin(){
	var regulamin_ob = document.getElementById("regulamin_wal");
	if(regulamin.checked) {
		walidacja = true;

	}
	else{
		walidacja = false;
		reg = "Proszę o zatwierdzenie regulaminu";
		regulamin_ob.className = 'bad';
	}
	regulamin_ob.innerHTML = reg;
}
function Podsumowanie(event){
 
 if (walidacja == false){	
 	event.preventDefault();

 }
 else {

 }
}




}    

