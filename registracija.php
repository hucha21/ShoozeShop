<html><head> 
<meta http-equiv="content-type" content="text/html; charset=UTF-16">
<title>Shooze</title> <!--naziv dokumenta i naslov stranice--> 
<link rel="stylesheet" type="text/css" href="stylesheet1.css"> <!--link za povezivanje sa vanjskom datotekom --> 
</head><body bgcolor="#ecd9c6"><font face="Century Gothic" font size="2" font color="#261a0d">
<div> <font color="black"> Pozovite nas na: 037/222-333 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Lokacija: BiH/ba 
&nbsp &nbsp <a href="registracija.php"> <font color="black"> Prijavi se/Registruj se </font> </a> </div> 

 </font>
 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BazaPodataka";
$message = "Neispravan unos podataka.";


// Create connection
$konekcija = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($konekcija->connect_error) {
    die("Connection failed: " . $konekcija->connect_error);
} 

function registracijaKorisnika($korisnicko_ime,$korisnicka_lozinka,$konekcija){
	$query = "SELECT * FROM korisnik WHERE korisnicko_ime='".$korisnicko_ime."' AND korisnicka_lozinka='".$korisnicka_lozinka."'";
	$rezultat = mysqli_query($konekcija,$query);
	
	if(mysqli_num_rows($rezultat)>0){
		//postoji korisnik u bazi podataka sa ovakvim podacima
		return false;
	}
	else{
		//ne postoji korisnik sa ovakvim podacima u bazi
		return true;
	}
}

if(isset($_POST['registracijaBtn'])){
	$ime_korisnika = $_POST["ime_korisnika"];
	$email_korisnika = $_POST["email_korisnika"];
	$korisnicko_ime = $_POST["korisnicko_ime"];
	$telefon_korisnika = $_POST["telefon_korisnika"];
	$korisnicka_lozinka = $_POST["korisnicka_lozinka"];
	$ulica = $_POST["ulica"];
	$postanski_broj = $_POST["postanski_broj"];
	$grad = $_POST["grad"];
	$drzava = $_POST["drzava"];
	$funkcija = $_POST["funkcija"];
	if(registracijaKorisnika($korisnicko_ime,$korisnicka_lozinka,$konekcija) == "false"){
	
	$sql = "INSERT INTO korisnik (ime_korisnika,email_korisnika,korisnicko_ime,telefon_korisnika,korisnicka_lozinka,ulica,postanski_broj,grad,drzava,funkcija) VALUES('".$ime_korisnika."' ,'".$email_korisnika."' ,'".$korisnicko_ime."','".$telefon_korisnika."','".$korisnicka_lozinka."','".$ulica."','".$postanski_broj."','".$grad."','".$drzava."','".$funkcija."')";
	if(mysqli_query($konekcija, $sql)){
		$sat = time() + 60 * 60 * 24 * 30;
		setcookie('shooze_Kupac', $konekcija -> insert_id, $sat);
    header("location: pocetna.php"); //redirekta na pocetnu page
} 
	
	
	}
	else{
		//ispisuje grešku u unosu	
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	
}

?>


<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%"> <!--glavna tabela na stranici--> 
<tbody>
<tr><td width="33%"><img src="slike/slika.png" height="100" width="150"> </td>
<td width="33%" align="middle" > <font face="Forte" font size="22" font color="black">Shooze Shop</font> </td>
<td></td>
</tr>
<tr >  <!--prvi red tabele--> 
<td colspan="3" bgcolor="#ecd9c6">  <!--spojene prve tri ćelije u prvom redu--> 

 <div align="middle"> 
   <ul> <!--neuređena lista--> 
        <li id="stil"><a class="noline" href="pocetna.php"><font face="Helvetica" font size="3" font color="black">MUŠKARCI</font></a> </li> <!--stavka liste --> 
        <li id="stil"><a class="noline" href="pocetna.php"><font face="Helvetica" font size="3" font color="black">ŽENE</font></a> </li> <!--stavka liste --> 
        <li id="stil"><a class="noline" href="pocetna.php"><font face="Helvetica" font size="3" font color="black">DJECA</font></a> </li> <!--stavka liste --> 
        <li id="stil"><a class="noline" href="pocetna.php"><font face="Helvetica" font size="3" font color="black">POČETNA</font></a> </li> <!--stavka liste --> 
        <li id="stil"><a class="noline" href="proizvodi.php"><font face="Helvetica" font size="3" font color="black">PROIZVODI</font></a> </li> <!--stavka --> 
        <li id="stil"><a class="noline" href="prodavnice.php"><font face="Helvetica" font size="3" font color="black">PRODAVNICE</font></a> </li> <!--stavka --> 
      </ul> <!--završna oznaka liste--> 

</div>
</td> <!--link na tekst--> 
  <!--prva ćelija--> 
</tr> <!--kraj prvog reda--> 

<tr> <!--drugi red tabele--> 
<td colspan="3" class="poz"> <font face="Century Gothic" font size="6" font color="black">
<div class="forma">
<center>
<form method="POST">
	<table class="tabela" width="500" height="400">
		<tr>
			<td colspan="2" align="center"><h2 class="boja">Registracija</h2></td>
		</tr>
		<tr>
			<td align="right" class="boja"><b>Ime i prezime:</b></td>
			
			<td> <input type="text" name="ime_korisnika" class="inputType"/></td>
		</tr>
		
		<tr>
			<td align="right" class="boja" ><b>E-mail:</b></td>
			
			<td> <input type="text" name="email_korisnika" class="inputType"/></td>
		</tr>
		<tr>
			<td align="right" class="boja"><b>Korisničko ime:</b></td>
			
			<td> <input type="text" name="korisnicko_ime" class="inputType"/></td>
		</tr>
		
		<tr>
			<td align="right" class="boja" ><b>Telefon:</b></td>
			
			<td> <input type="text" name="telefon_korisnika" class="inputType"/></td>
		</tr>
		
		
		
		<tr>
			<td align="right" class="boja" ><b>Korisnicka lozinka:</b></td>
			
			<td> <input type="password" name="korisnicka_lozinka" class="inputType"/></td>
		</tr>
		
		<tr>
			<td align="right" class="boja" ><b>Ulica:</b></td>
			
			<td> <input type="text" name="ulica" class="inputType"/></td>
		</tr>
		
		<tr>
			<td align="right" class="boja" ><b>Poštanski broj:</b></td>
			
			<td> <input type="text" name="postanski_broj" class="inputType"/></td>
		</tr>
		
		<tr>
			<td align="right" class="boja" ><b>grad:</b></td>
			
			<td> <input type="text" name="grad" class="inputType"/></td>
		</tr>
		
		<tr>
			<td align="right" class="boja" ><b>drzava:</b></td>
			
			<td> <input type="text" name="drzava" class="inputType"/></td>
		</tr>
		<tr>
			<td align="right" class="boja" ><b>funkcija:</b></td>
			
			<td> <input type="text" name="funkcija" class="inputType"/></td>
		</tr>
		<tr>
			
			<td colspan="2" align="center" class="boja" > <input type="submit" name="registracijaBtn" value="Registracija" id="registracijabtn"/><br><br>
			<b>Imate račun? </b><a class="noline" href="index.php" style="text-decoration:none;">Prijavite se!</a></td>
		</tr>
	</table>

</form>
</center> </font>
</div>

</td> <!--tekst u pokretu--> 
</tr> 



<tr> <!--peti red tabele--> 
<td  align="center" height="30" width="33%" bgcolor="#ecd9c6" style="color: black" > 
<br>
<p><font size="4" face="Century Gothic" color="black"><b> DOSTAVA I PLAĆANJE POŠTARINE</b></font></p> 
<font font color="black" face="Century Gothic" size="2"> <hr width="60%" color="#696969" size="0.5">
Troškovi poštarine nisu uračunati u cijenu proizvoda i biće dodani prilikom plaćanja. 
 </font>
 </td>

<td  align="center" width="33%"  height="20"  bgcolor="#ecd9c6" style="color: black" > 
<br>
<p><font size="4" face="Century Gothic" color="black"><b> VRIJEME DOSTAVE</b></font></p> 
<font font color="black" face="Century Gothic" size="2"> <hr width="30%" color="#696969" size="0.5">
Dostava se vrši unutar 3 do 7 radnih dana. 
 </font>
 </td>

<td  align="center" height="20"  bgcolor="#ecd9c6" style="color: black" > 
<br>
<p><font size="4" face="Century Gothic" color="black"><b> METODE PLAĆANJA </b></font></p> 
<font font color="black" face="Century Gothic" size="2"> <hr width="30%" color="#696969" size="0.5">
<img src="slike/s1.png"  height="30" width="40"> <img src="slike/s2.png" height="30" width="40">  <img src="slike/s3.jpg"  height="30" width="40"> 
 </font>
 </td>
 </tr> <!-- kraj reda--> 
 
 
 
 <tr> <!--peti red tabele--> 
<td  align="center" height="20" width="33%" bgcolor="#ecd9c6" style="color: black" > 
<br>
<p><font size="4" face="Century Gothic" color="black"><b> SIGURNA KUPOVINA</b></font></p> 
<font font color="black" face="Century Gothic" size="2"> <hr width="30%" color="#696969" size="0.5">
Brza dostava <br> 
Zaštita kupaca <br>
Zaštita podataka<br> 
 </font>
 </td>

<td  align="center" height="30"  bgcolor="#ecd9c6" style="color: black" > 
<br>
<p><font size="4" face="Century Gothic" color="black"><b> O NAMA </b></font></p> 
<font font color="black" face="Century Gothic" size="2"> <hr width="30%" color="#696969" size="0.5">
Kontakt <br> 
Zamjena i vraćanje  <br>
Uvjeti i pravila <br> 
Email 
 </font>
 </td>

<td  align="center" width="33%"  height="20"  bgcolor="#ecd9c6" style="color: black" > 
<br>
<p><font size="4" face="Century Gothic" color="black"><b> PRATITE NAS</b></font></p> 
<font font color="black" face="Century Gothic" size="2"> <hr width="30%" color="#696969" size="0.5">
Facebook <br> 
Instagram<br>
Twitter <br> 
Pinterest
 </font>
 </td>


 </tr> <!-- kraj reda--> 
 
 
 

 
 <tr><td colspan="3" align="center"><font font color="#261a0d" face="Century Gothic" color="black" size="2">  <br> <br>Copyright &copy Shooze Shop 2020</font> </td></tr>
</table> <!--kraj tabele--> 
<font face="Century Gothic" font size="2" font color="#261a0d">
<a class="noline" href="#top">početak</a> </font>
</body> <!--kraj tijela dokumenta--> 
</html> <!--kraj deklaracije dokumenta--> 