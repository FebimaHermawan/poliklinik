<?php
require __DIR__ . '/autoload.php';
include_once 'lib/Controller.php';
extract($POST);
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

date_default_timezone_set("Asia/Jakarta");=
$tanggal=date("Y-m-d, H:i:s");

$connector = new WindowsPrintConnector("k15");
// POLIKLINIK PEMBAYARAN RESEP DOKTER

$q = $db->view("tdetail_resep a,tresep c, tobat b WHERE a.id_resep=c.id_resep AND a.id_obat=b.id_obat AND a.id_resep='$id'");
// var_dump($q);
$totH=0;
$tot=0;
 $obats = array();
while ($h=$q->fetch()) {
 	$hr = $h['harga'];
 	$nobat =  $h['nama_obat'];
 	$atur =  $h['aturan'];
	$jumlah = $h['jumlah'];
	$idPoli = $h['id_poli'];
	$totH = $tot+=$hr;

	$dftr = $h['id_daftar'];
	$idDok = $h['id_user'];
	$idObt = $h['id_obat'];
 // $obats[] = "$nobat"." $jumlah  : ".$atur;
 	$obats[] = new item("$nobat"," $jumlah  | ".$atur);

}
// $q1 = $db->view("tpoli WHERE id_poli='$idPoli'","nama");
// $h1=$q1->fetch();
$poliRs = $pp1['nama'];
$kembali = number_format($bayar-$totH) ;
$bayar = number_format($bayar) ;
$tottHar = number_format($totH) ;

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


$printer = new Printer($connector);

$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("POLIKLINIK .\n");

// $img = EscposImage::load("logo.png");
// $printer -> graphics($img);

$printer -> selectPrintMode();
$printer -> text("Jl Pacar Ponorogo No. 01.\n");
$printer -> feed();

 //Title of receipt 
$printer -> setEmphasis(true);
$printer -> text("$namaKasir \n");
$printer -> setJustification(Printer::JUSTIFY_RIGHT);
$printer -> text("---------------------------------");
$printer -> text("Poli : $poliRs\n");
$printer -> text("---------------------------------\n");
$printer -> setEmphasis(false);

 //Items 
$printer -> setJustification(Printer::JUSTIFY_LEFT);

$printer -> setEmphasis(false);

foreach ($obats as $obt) {
	$printer -> text($obt);
}

$printer -> setEmphasis(true);
$printer -> text("\n");
$printer -> text("Total   :");
$printer -> text("$tottHar \n");
$printer -> text("Bayar   :");
$printer -> text("$bayar \n");
$printer -> text("Kembali :");
$printer -> text("$kembali \n");
$printer -> setEmphasis(false);
$printer -> feed();

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
$printer -> text("$tglPesan \n");

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

?>