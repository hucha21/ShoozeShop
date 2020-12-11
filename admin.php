<?php
include_once("konekcija.php");
$mysqli=$konekcija;
//Admin dodavanje artikala
if(isset($_POST['dodajartikal'] )) {
		$naziv = mysqli_real_escape_string($mysqli, $_POST['naziv']);
	$brand = mysqli_real_escape_string($mysqli, $_POST['brand']);
    $godinaProizvodnje = mysqli_real_escape_string($mysqli, $_POST['godina']);
	$broj = mysqli_real_escape_string($mysqli, $_POST['broj']);
    $boja = mysqli_real_escape_string($mysqli, $_POST['boja']);
    $trgovina = mysqli_real_escape_string($mysqli, $_POST['trgovina']);
     $slika = mysqli_real_escape_string($mysqli, $_POST['slika']);
      $stanje = mysqli_real_escape_string($mysqli, $_POST['stanje']);
    $cijena = mysqli_real_escape_string($mysqli, $_POST['cijena']);
     $sastav = mysqli_real_escape_string($mysqli, $_POST['sastav']);
		
	if(empty($naziv) || empty($brand) || empty($broj) || empty($trgovina) || empty($boja) || empty($slika) || empty($stanje) || empty($cijena) || empty($sastav)) {
				
		if(empty($naziv)) {
			echo "<font color='red'>Polje naziv je prazno.</font><br/>";
		}
		
		if(empty($brand)) {
			echo "<font color='red'>Polje brand je prazno.</font><br/>";
		}
		
		if(empty($broj)) {
			echo "<font color='red'>Polje broj je prazno.</font><br/>";
        
        
		}
        	if(empty($trgovina)) {
			echo "<font color='red'>Polje trgovina je prazno.</font><br/>";
		}
        if(empty($boja)) {
			echo "<font color='red'>Polje boja je prazno.</font><br/>";
		}
        if(empty($slika)) {
			echo "<font color='red'>Polje slika je prazno.</font><br/>";
		}
        if(empty($stanje)) {
			echo "<font color='red'>Polje stanje je prazno.</font><br/>";
		}
        if(empty($cijena)) {
			echo "<font color='red'>Polje cijena je prazno.</font><br/>";
		}
        if(empty($sastav)) {
			echo "<font color='red'>Polje sastav je prazno.</font><br/>";
		}
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
	$sql="INSERT INTO obuca(naziv_obuce,proizvodjac,broj_obuce,trgovina_id,boja_obuce,obuca_slika,stanje,cijena,sastav,godina_proizvodnje,korisnik_id) VALUES('$naziv','$brand','$broj','$trgovina','$boja','$slika','$stanje','$cijena','$sastav','$godinaProizvodnje','1')";
		if (mysqli_query($mysqli, $sql)) {
  echo '<font color="green">Artikal uspješno dodan</font>';
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}
//mysqli_close($mysqli);
	}
}
//Admin brisanje artikala
else if(isset($_POST['obrisiartikal']) ) {

$id = mysqli_real_escape_string($mysqli, $_POST['id']);
$sql="DELETE FROM obuca WHERE obuca_id=$id";
if (mysqli_query($mysqli, $sql)) {
  echo '<font color="green">Artikal je obrisan</font>';
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}
}
?>

<html><head> 
<meta http-equiv="content-type" content="text/html; charset=UTF-16">
<title>Shooze</title> <!--naziv dokumenta i naslov stranice--> 
<link rel="stylesheet" type="text/css" href="stylesheet1.css"> <!--link za povezivanje sa vanjskom datotekom --> 
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet">
<script src="https://use.fontawesome.com/3fa8e7b5b9.js"></script>
</head><body bgcolor="#ecd9c6"><font face="Century Gothic" font size="2" font color="#261a0d">

 </font>
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
<tr> <td>
  <form method="post" action="admin.php">
<tr> <td align="center"><h3><span class="fa fa-plus"></span><b>Dodavanje artikla</b></h3> </td></tr>
<tr><td>Naziv artikla</td><td><input type="text" name="naziv"></td></tr>
<tr><td>Brand artikla</td><td><input type="text" name="brand"></td></tr>
<tr><td>Godina proizvodnje</td><td><input type="text" name="godina"></td></tr>
<tr><td>Boja obuće</td><td><input type="text" name="boja"></td></tr>
<tr><td>Slika obuce</td><td><input type="text" name="slika"></td></tr>
<tr><td>Sastav</td><td><input type="text" name="sastav"></td></tr>
<tr><td>Cijena </td><td><input type="text" name="cijena"></td></tr>
<tr><td>Stanje</td><td><input type="text" name="stanje"></td></tr>
<tr><td>Broj artikla</td><td><input type="text" name="broj"></td></tr>
<tr><td>Trgovina</td><td><input type="text" name="trgovina"></td></tr>
<tr><td><input type="submit" value="POTVRDI" name="dodajartikal" class="genric-btn"/></td><td><input type="reset" value="PONIŠTI"></td></tr>
  </form>
<form method="post" action="admin.php"><tr><td align="center"> <h3> <span class="fa fa-minus"></span><b>Brisanje artikla</b> </h3> </td></tr>
<tr><td>ID artikla:</td><td><input type="text" name="id"></tr>
<tr><td><input type="submit" value="OBRIŠI" name="obrisiartikal" class="genric-btn"/></td></tr></form>



</td></tr>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body> <!--kraj tijela dokumenta--> 
</html> <!--kraj deklaracije dokumenta--> 