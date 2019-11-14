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
$tanggal=date("d-m-Y H:i:s");

$connector = new WindowsPrintConnector("seoranganakdiujunglangit");
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

$user_name = $_SESSION["sess_name"];
$printer = new Printer($connector);

$printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
$printer -> text("POLIPANTAI .\n");
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
/*Cetak Obat*/ 
$printer -> text("Obat                   Harga \n");
    $getRes = $db->execute("select * from resep where id = :id", array(":id"=>$getid));  
        while ($givRes = $getRes->fetch()) {
             $getNm = $db->execute("select nama, harga, pemakaian from obat where id = :id", array(":id"=>$givRes["id_obat"]));
            while ($givNm = $getNm->fetch()) {
                $printer -> text($givNm['nama']."        ".$givRes['jumlah']." X ".$givNm['harga']."    ".$db->duit($givRes['total'])." \n");
            }
        }
    $printer -> text("Administrasi             Rp.8000 \n");
/*--Akunting--*/ 
$printer -> text("--------------------------------- \n");
$printer -> setEmphasis(true);
$printer -> text("\n");
/*Total*/ 
$tot = $getRes->fetch();
$totalRes = $tot['total'] + 8000;
$printer -> text("Total   :");
$printer -> text(" ".$db->duit($tot)." \n");
/*Uang Bayar*/ 
$printer -> text("Bayar   :");
$printer -> text(" ".$getba." \n");
/*Kembalian*/ 
$kembalian = $getba - $totalRes;
$printer -> text("Kembali :");
$printer -> text(" ".$kembalian." \n");
/*---------------*/ 
$printer -> setEmphasis(false);
$printer -> feed();

 //Dosis 
$printer -> setEmphasis(true);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("---------------------------------");
$printer -> text("Dosis \n");
        while ($givResep = $getRes->fetch()) {
            $getNm = $db->execute("select nama, harga, pemakaian from obat where id = :id", array(":id"=>$givRes["id_obat"]));
           while ($givNama = $getNm->fetch()) {
                if ($givNama["pemakaian"] == 1) {
                    $pemakaian = "Sebelum Makan";
                }
                if ($givNama["pemakaian"] == 2) {
                    $pemakaian = "Sesudah Makan";
                }
                $printer -> text($givNama['nama']." diminum ".$givResep['dosis']." x 1 hari ".$pemakaian." \n");
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
$printer -> feed();
$printer -> cut();
$printer -> pulse();

$printer -> close();
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
    // $db->redirect("index.php?act=cek&id=$getid&chg=$getCh&opt=bayar&byr=$getba");
?>