<?php
include('konekcija.php');




/*************************************************************************/
/***** FUNKCIJA ZA PRIKAZIVANJE MOGUĆNOSTI ULOGOVANOM KORISNIKU **********/
function omoguci_Kupovinu(){
	if(isset($_COOKIE['shooze_Kupac'])) {
		echo '<button class="genric-btn danger add-to-cart"><span class="fa fa-shopping-bag"></span> Kupi</button>
 <button class="genric-btn success reserve"><span class="fa fa-thumb-tack"></span> Rezerviši</button></form><div class="clearfix"></div>';
	}
	else '<a href="index.php"> Ulogujte se da bi obavili kupovinu </a>';
}
/*************************************************************************/

/*************************************************************************/
/***** FUNKCIJA ZA LOGIRANJE KORISNIKu **********/
function prijavaKorisnika($korisnicko_ime,$korisnicka_lozinka,$konekcija){
	
	$query = "SELECT * FROM korisnik WHERE korisnicko_ime='".$korisnicko_ime."' AND korisnicka_lozinka='".$korisnicka_lozinka."'";
	$rezultat = mysqli_query($konekcija,$query);
	
	if(mysqli_num_rows($rezultat)>0){
		//postoji korisnik u bazi podataka sa ovakvim podacima
		while($row = $rezultat->fetch_assoc()) {
		/***** POSTAVLJA SE COOKIE SA ID KORISNIKA RADI RAZLIČITOG PRIKAZA SADRŽAJA *******/
			$sat = time() + 60 * 60 * 24 * 30;
			setcookie('shooze_Kupac', $row["korisnik_id"], $sat);
		/*****************************************/
			return true;
		}
	}
	else{
		//ne postoji korisnik sa ovakvim podacima u bazi
		return false;
	}
}
/*************************************************************************/



/********** FUNKCIJA PRIKAZA LOGIN OPCIJE POSJETIOCIMA ***********************/
function generisiHTML_logiranje(){
	if(!isset($_COOKIE['shooze_Kupac'])) {
	echo '<font face="Century Gothic" font size="2" font color="#261a0d">
			<div>
					 <font color="black"> Pozovite nas na: 037/222-333 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Lokacija: BiH/ba 
					&nbsp &nbsp <a href="index.php"> 
					<font color="black"> Prijavite se za kupovinu </font> </a> </div> 
		</font>';
 
	}
	else{
		$id = $_COOKIE['shooze_Kupac'];
		global $konekcija;
		$query = "SELECT ime_korisnika FROM korisnik WHERE korisnik_id =".$id;
		$rezultat = mysqli_query($konekcija,$query);
		while($row = $rezultat->fetch_assoc()) {
			echo '
			<div>
				<div style="float: left">
					Korisnik: '.$row['ime_korisnika'].'
				</div><br>
				<div style="float: left"">
					<a href="logout.php"><font color="black">Odjavite se</font></a>
				</div>
			</div>';
		}
	}
}
?>