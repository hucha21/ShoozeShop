<?php
class Korisnik {
	
	public $KorisnikId;
	function __construct() {
		$this->KorisnikId=1;
  }
  // get,set
  function set_atribut($name,$vrijednost) {
    $this->$name = $vrijednost;
  }
  function get_atribut($name) {
    return $this->$name;
  }
  //narudzba
  function Napravi_Narudzbu($uplata){
	  $conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
		$conn->set_charset("utf8");
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
		$sql1 = "INSERT INTO narudzba (status_narudzbe,iznos_uplate,nacin_placanja,rezervisano,korisnik_id) VALUES ('1', '%d','0','0','%d')";
		if(isset($_COOKIE['shooze_Kupac'])) {$this->KorisnikId=$_COOKIE['shooze_Kupac'];}
		echo'<script type="text/javascript">alert("' . $this->KorisnikId . '")</script>';
			$sql=sprintf($sql1,$uplata,$this->KorisnikId);
if (mysqli_query($conn, $sql)) {
      if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  return $last_id;
	  //echo'<script type="text/javascript">alert("' . $sql . '")</script>';
	  return true;}
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
  }
  
  //stavke
  function Unesi_Stavke($obuca,$kolicina,$cijena,$narudzbaId){
	  $conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
		$conn->set_charset("utf8");
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
		$sql1 = "INSERT INTO narudzba_stavka (obuca_id,kolicina_stavke,cijena_stavke,korisnik_id,narudzba_id) VALUES ('%d', '%d','%f','%d','%d')";
		if(isset($_COOKIE['shooze_Kupac'])) {$this->KorisnikId=$_COOKIE['shooze_Kupac'];}
			$sql=sprintf($sql1,$obuca,$kolicina,$cijena,$this->KorisnikId,$narudzbaId);
if (mysqli_query($conn, $sql)) {
     // echo'<script type="text/javascript">alert("' . $sql . '")</script>';
	 return true;
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
	  
  }
}
  ?>