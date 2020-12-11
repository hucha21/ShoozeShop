<?php 
	include('functions.php');
?>
<html><head> 
<meta http-equiv="content-type" content="text/html; charset=UTF-16">
<title>Shooze</title> <!--naziv dokumenta i naslov stranice--> 
<link rel="stylesheet" type="text/css" href="stylesheet1.css"> <!--link za povezivanje sa vanjskom datotekom --> 
<script src="https://use.fontawesome.com/3fa8e7b5b9.js"></script>
</head><body bgcolor="#ecd9c6">
<?php 
	generisiHTML_logiranje();
?>

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
<tr > <!--dr red tabele--> 

<td  colspan="3"> <!--prva ćelija u dr redu--> 

<style>
* {box-sizing: border-box}
.mySlides {display: none}
img {vertical-align: middle;}



/* Slideshow container */
.slideshow-container {
  max-width: 1500px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>

<br> <br>
<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 3</div>
  <img src="slike/slika1.jpg" style="width:100%">
 
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 3</div>
  <img src="slike/slika2.jpg" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 3</div>
  <img src="slike/slika3.jpg" style="width:100%">
  <div class="text"></div>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>



</td>
</tr>  <!--kraj dr reda--> 




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
