<?php
    require('../fpdf186/fpdf.php');
    require_once(__DIR__."/../helpers/dbhandler.php");
    $dbhandler = new DbHandler();
    $utas_szam = $_GET['utasszam'];
    $csomag_e = $_GET['csomag_e'];
    $honnan = $_GET['honnan'];
    $hotel_nev = $_GET['hotel_nev'];
    $ellatas = $_GET['ellatas'];
    $mettol = $_GET['mettol'];
    $meddig = $_GET['meddig'];

    $ar = $_GET['ar'];
    $orszag = $_GET['orszag'];
    $cim = $_GET['lakcim'];

    $szallas = $_GET['szallas'];
    $days = $_GET['days'];
    $utazas = $_GET['utazas'];
    $ellatas_ar = $_GET['ellatas_ar'];
    session_start();
    $tomb = array();
    foreach($_SESSION['kosar_items'] as $item){
      $sessionhonnan = '';
      $sessionhotelnev = '';
      $sessionmettol = '';
      $sessionmeddig = '';
        if($item['csomage']=="true"){
          $sessionhonnan = $dbhandler->getKeresett('csomagok', 'honnan', 'csomagid', $item['csomagid'])[0];
          $sessionhotelnev = $dbhandler->getKeresett('csomagok', 'celpont', 'csomagid', $item['csomagid'])[0];
          $sessionmettol = $dbhandler->getKeresett('csomagok', 'mettol', 'csomagid', $item['csomagid'])[0];
          $sessionmeddig = $dbhandler->getKeresett('csomagok', 'meddig', 'csomagid', $item['csomagid'])[0];
        }
        else{
          $sessionhonnan = $item['honnan'];
          $sessionhotelnev = $item['hotel_nev'];
          $sessionmettol = $item['mettol'];
          $sessionmeddig = $item['meddig'];
        }

        if(!($item['csomage'] == $csomag_e && $sessionhonnan == $honnan && $sessionhotelnev == $hotel_nev && $item['ellatas'] == $ellatas && $item['utasok_szama'] == $utas_szam && $sessionmettol == $mettol && $sessionmeddig == $meddig )){
          if($item['csomage']=="true"){
            $tomb[] = array('csomage' => $item['csomage'],'csomagid' => $item['csomagid'], 'ellatas' => $ellatas , 'utasok_szama' => $utas_szam);
          }
          else{
            $tomb[] = array('csomage' => $item['csomage'],'honnan' => $honnan , 'hotel_nev' => $hotel_nev , 'ellatas' => $ellatas , 'utasok_szama' => $utas_szam , 'mettol' => $mettol , 'meddig' => $meddig);
          }
          
        }
    }
    $_SESSION['kosar_items'] = array_values($tomb);
    
    //customer and invoice details

  $info=[
    "customer"=>$_GET['nev'],
    "address"=>$cim,
    "city"=>$orszag,
    "total_amt"=>$ar,
  ];
  
  
  //invoice Products
  $products_info=[
    [
      "name"=>"Utazas",
      "price"=>"$utazas HUF",
      "qty"=>"$utas_szam",
      "total"=>strval(intval($utazas)*intval($utas_szam))." HUF"
    ],
    [
      "name"=>"Szallas",
      "price"=>"$szallas HUF",
      "qty"=>"$utas_szam x $days",
      "total"=>strval(intval($szallas)*intval($utas_szam)*intval($days))." HUF"
    ],
    [
      "name"=>"Ellatas",
      "price"=>"$ellatas_ar HUF",
      "qty"=>"$utas_szam",
      "total"=>strval(intval($ellatas_ar)*intval($utas_szam))." HUF"
    ],
  ];
  function Convert($string){
    return iconv('UTF-8', 'ISO-8859-2', "$string");
}
  class PDF extends FPDF
  {
    
    function Header(){
      
      //Display Company Info
      $this->Image('../img/kislogo2.png', 10, 10, -300);
      $this->SetFont('Arial','B',14);
      $this->Cell(100,10,Convert("JourneyMasters"),0,1,'C');
      $this->SetFont('Arial','',14);
      $this->Cell(100,7,"VAC,",0,1,'C');
      $this->Cell(100,7,"HUNGARY",0,1,'C');

      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10, Convert("SZÁMLA"),0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"SZAMLAZASI CIM: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,Convert($info["customer"]),0,1);
      $this->Cell(50,7,Convert($info["address"]),0,1);
      $this->Cell(50,7,Convert($info["city"]),0,1);
      
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"KELTEZES. : ".date("Y-m-d"));
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"LEIRAS",1,0);
      $this->Cell(40,9,"AR",1,0,"C");
      $this->Cell(30,9,"DARAB",1,0,"C");
      $this->Cell(40,9,"OSSZESEN",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(80,9,Convert($row["name"]),"LR",0);
        $this->Cell(40,9,$row["price"],"R",0,"R");
        $this->Cell(30,9,$row["qty"],"R",0,"C");
        $this->Cell(40,9,$row["total"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(30,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"OSSZESEN",1,0,"R");
      $this->Cell(40,9,$info["total_amt"]." HUF",1,1,"R");

      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
  
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>