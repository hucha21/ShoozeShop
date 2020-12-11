<?php include 'Controllers/ObucaController.php';?>
<?php include 'Controllers/KorisnikController.php';?>
<?php require_once 'Controllers/class.Cart.php';
// objekat korpe
$cart = new Cart([
	'cartMaxItem' => 0,
	'itemMaxQuantity' => 0,
	'useCookie' => false,
]);
?>

<?php 
//za prijavu korisnika
	include('functions.php');
	generisiHTML_logiranje();
	$cart_Rezervacija = new Cart([
	'cartMaxItem' => 1,
	'itemMaxQuantity' => 1,
	'useCookie' => true,
]);
?>




<?php

//kupljenje obuce iz baze,pretvorba iz mysql u json radi prikaza
$brand="Svi";
$obuca = new Obuca();
$korisnik = new Korisnik();
$sva_obuca=$obuca->get_obuca($brand);
$sva_obuca2=$sva_obuca;
$return_arr=array();
while ($rows = $sva_obuca2->fetch_assoc()): {
    $row_array['obuca_id'] = $rows['obuca_id'];
    $row_array['cijena'] = $rows['cijena'];
	$row_array['proizvodjac'] = $rows['proizvodjac'];
	$row_array['stanje'] = $rows['stanje'];
    $row_array['naziv_obuce'] = $rows['naziv_obuce'];
	$row_array['broj_obuce'] = $rows['broj_obuce'];
	$row_array['boja_obuce'] = $rows['boja_obuce'];
    array_push($return_arr,$row_array);
}
endwhile;
//echo  "<script>alert($row_array);</script>";
$sva_obuca_json= json_encode($return_arr);
$products = json_decode($sva_obuca_json);
// Page
$a = (isset($_GET['a'])) ? $_GET['a'] : 'home';

//STRANICA J EPODIJELJENJA U RAZLIČITE DIJELOVE NPR:
//proizvodi.php             PRIKAZ ARTIKALA
//proizvodi.php?a=cart      PRIKAZ ARTIKALA U KORPI
//proizvodi.php?a=checkout  POTVRDA NARUDZBE
//proizvodi.php?a=finish    NAKON POTVRDE NARUDZBA SE PROVODI KROZ BAZU


// Prikaz artikala u korpi
if ($a == 'cart') {
	$cartContents = '
	<div class="alert alert-warning">
		<i class="fa fa-info-circle"></i> Korpa je prazna.
	</div>';
	// Brisanje svih artikala iz korpe
	if (isset($_POST['empty'])) {
		$cart->clear();
		header("Refresh:0; url=proizvodi.php");
	}
	// dodavanje u korpu
	if (isset($_POST['add'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->obuca_id) {
				break;
			}
		}
		$cart->add($product->obuca_id, $_POST['qty'], [
			'price' => $product->cijena,
			'color' => (isset($_POST['boja_obuce'])) ? $_POST['boja_obuce'] : '',
		]);
	}
	// update artikla u korpi
	if (isset($_POST['update'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->obuca_id) {
				break;
			}
		}

		$cart->update($product->obuca_id, $_POST['qty'], [
			'price' => $product->cijena,
			'color' => (isset($_POST['boja_obuce'])) ? $_POST['boja_obuce'] : '',
		]);
	}

	// brisanje određenog artikla iz korpe
	if (isset($_POST['remove'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->obuca_id) {
				break;
			}
		}
		$cart->remove($product->obuca_id, [
			'price' => $product->cijena,
			'color' => (isset($_POST['boja_obuce'])) ? $_POST['boja_obuce'] : '',
		]);
	}
	//pravljenje izgleda i prikaz korpe 
	if (!$cart->isEmpty()) {
		$allItems = $cart->getItems();
		$cartContents = '
		<table class="table table-striped table-hover" border="1">
			<thead>
				<tr>
					<th class="col-md-7">Artikal</th>
					<th class="col-md-3 text-center">Kolicina</th>
					<th class="col-md-2 text-right">Cijena</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->obuca_id) {
						break;
					}
				}

				$cartContents .= '
				<tr>
					<td>' . $product->naziv_obuce . ' ' . $product->proizvodjac . '</td>
					<td class="text-center"><div class="form-group"><input type="number" value="' . $item['quantity'] . '" min="1" class="form-control quantity pull-left" style="width:70px"><div class="pull-right"><button class="btn btn-default btn-update" data-id="' . $id . '" data-color=""><i class="fa fa-refresh"></i> Osvjezi korpu</button><button class="btn btn-danger btn-remove" data-id="' . $id . '" data-color=""><i class="fa fa-trash"></i></button></div></div></td>
					<td class="text-right">' . $product->cijena . ' KM</td>
				</tr>';
			}
		}

		$cartContents .= '
			</tbody>
		</table>
		

		<div class="text-right">
			<h3>Total:<br />' . number_format($cart->getAttributeTotal('price'), 2, '.', ',') . ' KM</h3>
		</div>

		<p>
			<div class="pull-left">
				<button class="btn btn-danger btn-empty-cart">Obrisi sve iz korpe</button>
			</div>
			<div class="pull-right text-right">
			
				<a href="?a=home" class="btn btn-default">Nastavi kupovati</a>
				<a href="?a=checkout" class="btn btn-danger">Zavrsi kupovinu</a>
			</div>
		</p>';
	} else header("Refresh:0; url=proizvodi.php");
}
//POTVRDA NARUDZBE
elseif ($a == 'checkout'){
	 //Prikaz trenutne korpe
	 if (!$cart->isEmpty()) {
		$allItems = $cart->getItems();

		$cartContents = '
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-7">Artikal</th>
					<th class="col-md-3 text-center">Kolicina</th>
					<th class="col-md-2 text-right">Cijena</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->obuca_id) {
						break;
					}
				}

				$cartContents .= '
				<tr>
					<td>' . $product->naziv_obuce . ' ' . $product->proizvodjac . '</td>
					<td class="text-center"><div class="form-group">1</div></td>
					<td class="text-right">' . $product->cijena . ' KM</td>
				</tr>';
			}
		}
		$cartContents .= '
			</tbody>
		</table>
		<div class="text-right">
			<h3>Total:<br />' . number_format($cart->getAttributeTotal('price'), 2, '.', ',') . ' KM</h3>
		</div>';
		
	}
 }
 //PROVODJENE NARUDZBE KROZ BAZU
 elseif ($a == 'finish'){
	 if ($cart->isEmpty())$gener_error = "Korpa je prazna";
	// fali za prijavu korisnika
		if(empty($gener_error)){
			$allItems = $cart->getItems();
			//kreiranje narudzbe
			$narudzbaId=$korisnik->Napravi_Narudzbu(number_format($cart->getAttributeTotal('price'), 2, '.', ','));
			//prolazakj kroz artikle u korpi
		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->obuca_id) {
						break;
					}
				}
				//unosenje stavki
			$korisnik->Unesi_Stavke($product->obuca_id,$item['quantity'],$product->cijena*$item['quantity'],$narudzbaId);
			//skidanje sa stanja
				$obuca->ZavrsiKupovinu($product->obuca_id,$item['quantity']);
			}
		}
    } else {
	echo"<script>alert('$gener_error');window.location.href='proizvodi.php?a=checkout';</script>";}
	$cart->clear();
	echo"<script>alert('Hvala Vam na kupovini!');window.location.href='pocetna.php';</script>";
 }
 // Prikaz rezrevacija
elseif ($a == 'rezervacije') {
	$cartContents_Rez = '
	<div class="alert alert-warning">
		<i class="fa fa-info-circle"></i> Korpa je prazna.
	</div>';
	// Brisanje svih artikala iz korpe
	if (isset($_POST['empty_rez'])) {
		
		
		foreach ($products as $product) {
			if ($_POST['id'] == $product->obuca_id) {
				break;
			}
		}
		$cart_Rezervacija->remove($product->obuca_id, [
			'price' => $product->cijena,
			'color' => (isset($_POST['boja_obuce'])) ? $_POST['boja_obuce'] : '',
		]);
		//vracanje na stanje
				$obuca->VratiRezervaciju($product->obuca_id,1);
		//header("Refresh:0; url=proizvodi.php");
	}
	// dodavanje u korpu
	if (isset($_POST['rezervisi'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->obuca_id) {
				break;
			}
		}
		$cart_Rezervacija->add($product->obuca_id, $_POST['qty'], [
			'price' => $product->cijena,
			'color' => (isset($_POST['boja_obuce'])) ? $_POST['boja_obuce'] : '',
		]);
		//skidanje sa stanja
				$obuca->ZavrsiKupovinu($product->obuca_id,$_POST['qty']);
	}
	//pravljenje izgleda i prikaz korpe 
	if (!$cart_Rezervacija->isEmpty()) {
		$allItems = $cart_Rezervacija->getItems();
		$cartContents_Rez = '
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-7">Artikal</th>
					<th class="col-md-3 text-center">Kolicina</th>
					<th class="col-md-2 text-right">Cijena</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->obuca_id) {
						break;
					}
				}

				$cartContents_Rez .= '
				<tr>
					<td>' . $product->naziv_obuce . ' ' . $product->proizvodjac . '</td>
					<td class="text-center"><div class="form-group"><input type="number" value="' . $item['quantity'] . '" min="1" disabled class="form-control quantity pull-left" style="width:70px"><div class="pull-right"><button class="btn btn-danger btn-empty-cart_rez" data-id="' . $id . '" data-color=""><i class="fa fa-trash"></i></button></div></div></td>
					<td class="text-right">' . $product->cijena . ' KM</td>
				</tr>';
			}
		}

		$cartContents_Rez .= '
			</tbody>
		</table>
		

		<div class="text-right">
			<h3>Total:<br />' . number_format($cart_Rezervacija->getAttributeTotal('price'), 2, '.', ',') . ' KM</h3>
		</div>

		<p>
			
			<div class="pull-right text-right">
			
				<a href="?a=home" class="btn btn-default">Nastavi kupovati</a>
				<a href="?a=rezervacija_kupovina" class="btn btn-danger">Kupi Artikal</a>
			</div>
		</p>';
	} else header("Refresh:0; url=proizvodi.php");
}
//PROVODJENE rezervacije u kupovinu
 else if ($a == 'rezervacija_kupovina'){
	 if ($cart_Rezervacija->isEmpty())$gener_error = "Korpa je prazna";
	// fali za prijavu korisnika
		if(empty($gener_error)){
			$allItems = $cart_Rezervacija->getItems();
			//kreiranje narudzbe
			$narudzbaId=$korisnik->Napravi_Narudzbu(number_format($cart_Rezervacija->getAttributeTotal('price'), 2, '.', ','));
			//prolazakj kroz artikle u korpi
		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->obuca_id) {
						break;
					}
				}
				//unosenje stavki
			$korisnik->Unesi_Stavke($product->obuca_id,$item['quantity'],$product->cijena*$item['quantity'],$narudzbaId);
			}
		}
    } else {
	echo"<script>alert('$gener_error');window.location.href='proizvodi.php?a=checkout';</script>";}
	$cart_Rezervacija->clear();
	echo"<script>alert('Hvala Vam na kupovini!');window.location.href='pocetna.php';</script>";
 }

?>
<html><head> 
<meta http-equiv="content-type" content="text/html; charset=UTF-16">
<title>Shooze</title> <!--naziv dokumenta i naslov stranice--> 
<link rel="stylesheet" type="text/css" href="stylesheet1.css"> <!--link za povezivanje sa vanjskom datotekom -->
<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet">
<script src="https://use.fontawesome.com/3fa8e7b5b9.js"></script>
</head><body bgcolor="#ecd9c6">

<div align="right">
<?php if(isset($_COOKIE['shooze_Kupac'])): ?> <!--ako je kupac prijavljen prikazi korpe -->
						<a href="?a=cart" id="li-cart"><i class="fa fa-shopping-cart"></i> Korpa (<?php echo $cart->getTotalItem(); ?>)</a>
					</div><br>
					<div align="right">
						<a href="?a=rezervacije" id="li-cart"><i class="fa fa-thumb-tack"></i> Rezervacija (<?php echo $cart_Rezervacija->getTotalItem(); ?>)</a>
					</div><br>
  <?php endif; ?>
 <!-- Prikaz korpe -->
 <?php if ($a == 'cart'): ?>
		<div class="container">
			<h1>Potrošačka korpa</h1>

			<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
						<?php echo $cartContents; ?>
					 </div>
				</div>
			</div>
		</div>
		<!-- Prikaz rezervacija -->
 <?php elseif ($a == 'rezervacije'): ?>
		<div class="container">
			<h1>Rezervisani artikli</h1>

			<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
						<?php echo $cartContents_Rez; ?>
					 </div>
				</div>
			</div>
		</div>
		 <!-- Potvrda narudzbe -->
 <?php elseif ($a == 'checkout'): ?>
		<div class="container">
		<h2>Vaša narudzba:</h2>
				<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
						<pre><?php echo $cartContents; ?></pre>
					 </div>
				</div>
			</div>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" checked id="f-option5" name="selector">
                                    <label for="f-option5">Placanje pouzecem</label>
                                    <div class="check"></div>
                                </div>
                                <p>Plaća se po pouzeću. Poštarina besplatna unutar BiH</p>
                            </div>
							<a class="btn btn-danger" href="proizvodi.php?a=finish">Potvrdi narudzbu</a>
							<span class="help-block"><?php echo $gener_error; ?></span>
                        </div>
 <!-- Prikaz artikala -->
 <?php else: ?>
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

<tr> <!--treći red tabele--> 
<td colspan="3" valign="top" align="middle"> 
<!--Prikaz artikala iz baze-->
<table border="0" cellpadding="0" cellspacing ="0"   width="60%">  <!--tabela--> 

<tr>  <!--prvi red tabele-->

<?php 
					$brand="Svi";
$sva_obuca=$obuca->get_obuca($brand);
	$i=0;
					while ($row = $sva_obuca->fetch_assoc()):
						//echo "<br>" . $row['obuca_id']; ?>
<td align="center" border="1px"><a href="slike/<?php echo $row['obuca_slika']?>">
<img src="slike/<?php echo $row['obuca_slika']?>" title="ženske patike" width="400" height="400" border="0"/></a>
<form>
<input type="hidden" value="<?php echo $row['obuca_id'] ?>" class="product-id" />
 <font color="black" ><i><?php echo $row['naziv_obuce'] ?></i></font><br>
  <font color="black" ><i><?php echo $row['proizvodjac'] ?></i></font><br>
   BOJA:<select class="color"><font color="black" ><option value="<?php echo $row['boja_obuce'] ?>"><?php echo $row['boja_obuce'] ?></option></select></font><br>
   BROJ OBUCE: <select><option value="<?php  echo $row['broj_obuce']?>"><?php  echo $row['broj_obuce']?> </option></select><br>
   <input type="number" value="1" class="quantity" /><br>
 <font color="black" ><b><?php echo $row['cijena']?> KM </b></font><br> <!--ukošeni tekst crne boje ispod slike--> 
 
 <?php omoguci_Kupovinu(); ?>
 
 
<!-- <button class="genric-btn danger add-to-cart"><span class="fa fa-shopping-bag"></span> Kupi</button>
 <button class="genric-btn success reserve"><span class="fa fa-thumb-tack"></span> Rezerviši</button></form><div class="clearfix"></div>-->
</td>  <!--prva ćelija--> 
<?php $i=$i+1;if($i%3==0) {?> <!--da bi bila 3 artikla u jednom redu-->
</tr><tr>
<?php } ?>
<?php endwhile;?>
 </table>
 <!-- Zavrsetak Prikaza artikala iz baze-->
 
 <?php endif; ?>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Skripta kad se klikne na dugme vezano za artikal--> 
		<script>
			$(document).ready(function(){
				$('.add-to-cart').on('click', function(e){
					e.preventDefault();

					var $btn = $(this);
					var id = $btn.parent().parent().find('.product-id').val();
					var color = $btn.parent().parent().find('.color').val() || '';
					var qty = $btn.parent().parent().find('.quantity').val();
					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="color" value="' + color + '"><input type="hidden" name="qty" value="' + qty + '">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-update').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var qty = $btn.parent().parent().find('.quantity').val();
					var color = $btn.attr('data-color');
				
					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="update" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="qty" value="'+qty+'"><input type="hidden" name="color" value="'+color+'">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-remove').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var color = $btn.attr('data-color');

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="remove" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="color" value="'+color+'">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-empty-cart').on('click', function(){
					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="empty" value="">');

					$('body').append($form);
					$form.submit();
				});
				
				$('.reserve').on('click', function(e){
					e.preventDefault();

					var $btn = $(this);
					var id = $btn.parent().parent().find('.product-id').val();
					var color = $btn.parent().parent().find('.color').val() || '';
					var qty = $btn.parent().parent().find('.quantity').val();
//window.alert(id);
					var $form = $('<form action="?a=rezervacije" method="post" />').html('<input type="hidden" name="rezervisi" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="color" value="' + color + '"><input type="hidden" name="qty" value="' + 1 + '">');
					$('body').append($form);
					$form.submit();
				});
				$('.btn-empty-cart_rez').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var color = $btn.attr('data-color');

					var $form = $('<form action="?a=rezervacije" method="post" />').html('<input type="hidden" name="empty_rez" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="color" value="'+color+'">');

					$('body').append($form);
					$form.submit();
				});

			});
		</script>
</body> <!--kraj tijela dokumenta--> 
</html> <!--kraj deklaracije dokumenta--> 