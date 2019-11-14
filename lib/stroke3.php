<?php
session_start();
require __DIR__ . '/autoload.php';
include_once 'lib/Controller.php';
extract($_POST);
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
    $getact = isset($_GET["act"])?$_GET["act"]:"";
    $getid = isset($_GET["id"])?$_GET["id"]:"";
    $getmsg = isset($_GET["msg"])?$_GET["msg"]:"";
    $gettype =isset($_GET["type"])?$_GET["type"]:"";
    $getTit = isset($_GET["name"])?$_GET["name"]:"";
    $getErm = isset($_GET["erm"])?$_GET["erm"]:"";
    $getVm = isset($_GET["vm"])?$_GET["vm"]:"";
    $getoption = isset($_GET["opt"])?$_GET["opt"]:"";
    $getEs = isset($_GET["es"])?$_GET["es"]:"";
    $getidob = isset($_GET["ido"])?$_GET["ido"]:""; 
    $getCh = isset($_GET["chg"])?$_GET["chg"]:"";
    $getedob = isset($_GET["edo"])?$_GET["edo"]:"";
    $getub = isset($_GET["ub"])?$_GET["ub"]:"";
    $getba = isset($_GET["byr"])?$_GET["byr"]:"";
date_default_timezone_set("Asia/Jakarta");
$tanggal=date("Y-m-d H:i:s");

$connector = new WindowsPrintConnector("anakhits");
// POLIKLINIK PEMBAYARAN RESEP DOKTER
// $bayar = isset($_POST["bayar"])?$_POST["bayar"]:"";     
        
    $getidPas = $db->execute("select id_pasien from pendaftaran where no_daftar = :id", array(":id"=>$getCh));
        if ($getidPas->rowCount() > 0) {
            $givIdPas = $getidPas->fetch();
            $getpas = $db->execute("select nama from pasien where id = :id", array(":id"=>$givIdPas["id_pasien"]));
            $givPas = $getpas->fetch();
            $nmPas =  $givPas["nama"];
        }
    $getPol = $db->execute("select id_poli from pendaftaran where no_daftar = :id", array(":id"=>$getCh));
    if ($getPol->rowCount() > 0) {
        $givPol = $getPol->fetch();
        $getNmPol = $db->execute("select nama from poli where id = :id", array(":id"=>$givPol["id_poli"]));
        $givNmPol = $getNmPol->fetch();
        $NmPoli = $givNmPol["nama"];
    }

    $getRes = $db->execute("select * from resep where id = :id", array(":id"=>$getid));
    $givRes = $getRes->fetch();
            /*Nama Obat*/ 
            $getNmOb = $db->execute("select nama from obat where id = :id", array(":id"=>$givRes["id_obat"]));
                
            /* Jumlah Obat */
            $jumOb = $givRes["jumlah"];
            
            /* harga Obat*/ 
            $getHa = $db->execute("select harga from obat where id = :id", array(":id"=>$givRes["id_obat"]));
                
            /*Total per obat*/
            $total = $givRes["total"];

            /*Total Keseluruhan*/
            $getTot = $db->execute("select sum(total) as total from resep where id = :id", array(":id"=>$getid));
                
            /*Kembali*/
            
// $q = $db->view("tdetail_resep a,tresep c, tobat b WHERE a.id_resep=c.id_resep AND a.id_obat=b.id_obat AND a.id_resep='$id'");
// var_dump($q);
// $totH=0;
// $tot=0;
//  $obats = array();
// while ($h=$q->fetch()) {
//  	$hr = $h['harga'];
//  	$nobat =  $h['nama_obat'];
//  	$atur =  $h['aturan'];
// 	$jumlah = $h['jumlah'];
// 	$idPoli = $h['id_poli'];
// 	$totH = $tot+=$hr;

// 	$dftr = $h['id_daftar'];
// 	$idDok = $h['id_user'];
// 	$idObt = $h['id_obat'];
 // $obats[] = "$nobat"." $jumlah  : ".$atur;
 	// $obats[] = new item("$nobat"," $jumlah  | ".$atur);

// }
// $q1 = $db->view("tpoli WHERE id_poli='$idPoli'","nama");
// $h1=$q1->fetch();
// $poliRs = $pp1['nama'];
// $kembali = number_format($bayar-$totH) ;
// $bayar = number_format($bayar) ;
// $tottHar = number_format($totH) ;

//  foreach ($obats as $obat) {
// 	echo $obat;
// }

// echo $kembali ;
// echo $totH ;

// echo $bayar;
// echo $namaKasir ;

//  foreach ($obats as $obat) {
// 	echo $obat;
// }

$user_name = $_SESSION["sess_name"];
$printer = new Printer($connector);

$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("POLIPANTAI .\n");

// $img = EscposImage::load("logo.png");
// $printer -> graphics($img);

$printer -> selectPrintMode();
$printer -> text("Jl jalan no.22 rt 1 rw 3 Ponorogo, Jawa Timur, Indonesia \n");
$printer -> feed();

 //Title of receipt 
$printer -> setEmphasis(true);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("---------------------------------");
$printer -> text("Kasir  : $user_name  Poli : $NmPoli\n");
$printer -> text("Pasien : $nmPas - $tanggal \n");
$printer -> text("---------------------------------\n");
$printer -> setEmphasis(false);

 //Items 
$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer -> setEmphasis(false);

$printer -> text("Obat                   Harga \n");
    while ($givNmOb = $getNmOb->fetch()) {
        while ($givHa = $getHa->fetch()) {
            $nmOb =  $givNmOb["nama"];
            $harOb =  $givHa["harga"];
            $printer -> text("$nmOb     $jumOb X $harOb    $total \n");
$printer -> text("-------------------------------- \n");

$printer -> setEmphasis(true);
$printer -> text("\n");
$printer -> text("Total   :");
while ($givTot = $getTot->fetch()) {
     $totRes = $givTot["total"] + 8000;
     $printer -> text(" $totRes \n");
}
$printer -> text("Bayar   :");
$printer -> text(" $getba \n");
$printer -> text("Kembali :");

$kembali = $getba - $totRes;
    $printer -> text(" $kembali \n");

$printer -> setEmphasis(false);
$printer -> feed();

 //Dosis 
$printer -> setEmphasis(true);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("---------------------------------");
$printer -> text("Dosis \n");
        $dosOb = $givRes["dosis"];
        $printer -> text("$nmOb diminum $dosOb x 1 hari \n");
$printer -> setEmphasis(false);
$printer -> feed();
        } 
    }

 //Tax and total 
//$printer -> text($tax);
$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
// $printer -> text($total);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("----------------");

$printer -> selectPrintMode();

// Footer 
$printer -> feed(2);
$printer -> setJustification(Printer::JUSTIFY_CENTER);
$printer -> text("Terimakasih\n");
$printer -> text("Semoga lekas sembuh\n");
//$printer -> text("For trading hours, please visit example.com\n");
$printer -> feed();

// Cut the receipt and open the cash drawer 
$printer -> cut();
$printer -> pulse();

$printer -> close();
//header("location:?u=dtransaksi");
// unset($_SESSION['bel']);
// redirect("index.php");
/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }
    
    public function __toString()
    {
        $rightCols = 2;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;
        
        $sign = ($this -> dollarSign ? '' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
    $db->redirect("index.php?act=cek&id=$getid&chg=$getCh&opt=bayar&byr=$getba");
?>