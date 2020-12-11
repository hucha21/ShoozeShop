<?php
class Obuca {
	function __construct() {
  }
  // get,set
  function set_atribut($name,$vrijednost) {
    $this->$name = $vrijednost;
  }
  function get_atribut($name) {
    return $this->$name;
  }
  //vracanje obuce iz baze
function get_obuca($brand){
	$brand=strval($brand);
	$conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
	$conn->set_charset("utf8");
	$sql="";
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
	if($brand=="Svi")
	{$sql = "SELECT* FROM obuca where stanje>0";}
else
{
$stringDet="SELECT* FROM obuca WHERE proizvodjac='%s'";
$sql=sprintf($stringDet,$brand);}
//echo'<script type="text/javascript">alert("' . $sql . '")</script>';
$rezultat=mysqli_query($conn,$sql) or die($conn->error);
return $rezultat;
} 
//vracanje po id
function get_obuca_id($brand){
	$brand=(int) strval($brand);
	$conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
	$conn->set_charset("utf8");
	$sql="";
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
$stringDet="SELECT* FROM obuca WHERE obuca_id='%i'";
$sql=sprintf($stringDet,$brand);
//echo'<script type="text/javascript">alert("' . $sql . '")</script>';
$rezultat=mysqli_query($conn,$sql) or die($conn->error);
return $rezultat;
}
//vracanje brendova u bazi
function get_brendove(){
	$conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
	$conn->set_charset("utf8");
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
$sql = "SELECT* FROM obuca GROUP BY proizvodjac";
$rezultat=mysqli_query($conn,$sql);
return $rezultat;
}
//kupovina
function ZavrsiKupovinu($id,$kol){
	$conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
		$conn->set_charset("utf8");
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
	$sql1 = "SELECT * FROM obuca WHERE obuca_id='%d'";
		$sql=sprintf($sql1,$id);
		//echo'<script type="text/javascript">alert("' . $sql . '")</script>';
			 $fetch=mysqli_query($conn,$sql) or die($conn->error);
					$row = $fetch->fetch_assoc();
	    $sql1 =  "UPDATE obuca SET stanje='%d' WHERE obuca_id='%d'";
		$sql=sprintf($sql1,$row['stanje']-$kol,$id);
		$rezultat=mysqli_query($conn,$sql) or die($conn->error);
		return $rezultat;
}
function VratiRezervaciju($id,$kol){
	$conn = new mysqli('localhost', 'root', '', 'bazapodataka','3306');
		$conn->set_charset("utf8");
	if(!$conn){
		die("Fatal Error: Connection Error!");
	}
	$sql1 = "SELECT * FROM obuca WHERE obuca_id='%d'";
		$sql=sprintf($sql1,$id);
		//echo'<script type="text/javascript">alert("' . $sql . '")</script>';
			 $fetch=mysqli_query($conn,$sql) or die($conn->error);
					$row = $fetch->fetch_assoc();
	    $sql1 =  "UPDATE obuca SET stanje='%d' WHERE obuca_id='%d'";
		$sql=sprintf($sql1,$row['stanje']+$kol,$id);
		$rezultat=mysqli_query($conn,$sql) or die($conn->error);
		return $rezultat;
}
}
?>