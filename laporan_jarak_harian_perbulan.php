
<?php

require 'mail_php/PHPMailerAutoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$no_pendaftaranx = $_GET["no_pendaftaran"];
$filex = str_replace('/','_',$no_pendaftaranx);
$File = $filex.".pdf";


	$servername = "192.168.11.25";
				$username = "software";
				$password = "software";
				$dbname = "tracking";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
	//$imei = $_GET["data_imei"];
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
	
	

    // Create connection
   // print_r($imei."masuk");
    // Check connection
	
    
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	//$this->Image('logo.png',10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	//$this->Cell(80);
	// Title
	$this->Cell(280,10,'Title',1,0,'C');
	// Line break
	$this->Ln(20);
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class

//$pdf = new PDF('P','mm',array(215 ,330));
$pdf = new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Cell(280,10,'Laporan Jarak Harian Bulan : ',1,1,'C');
$pdf->Cell(20,10,'',0,0,'C');
$pdf->SetFont('Times','B',12);
$sql_pendaftaran = "select * from klien ";
		$result_pendaftaran = $conn->query($sql_pendaftaran);
		//print_r($result->num_rows."halo");
	     if ($result_pendaftaran->num_rows != 0) {
			// print_r('satu');
			
			 while($row_pendaftaran = $result_pendaftaran->fetch_assoc()) {	
				$pdf->Cell(50,10,'No. Pendaftaran',1,1,'L');
				$pdf->Cell(20,10,'',0,0,'C');
				$pdf->Cell(50,10,'Nama Pelanggan',1,1,'L');
				$pdf->Cell(20,10,'',0,1,'C');
			 }
			 
		 }

$pdf->Ln(20);
$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(30,10,'Nopol',1,0,'C');
$pdf->Cell(30,10,'Tanggal',1,0,'C');
$pdf->Cell(40,10,'Total Jarak',1,0,'C');
$pdf->Cell(40,10,'Rata-Rata Jarak',1,1,'C');
$i = 1;
$sql = "select * from pemasangan ";
		$result = $conn->query($sql);
		//print_r($result->num_rows."halo");
	     if ($result->num_rows != 0) {
			// print_r('satu');
			
			 while($row = $result->fetch_assoc()) {				
				$now = strtotime(date("Y-m-d"));
				$date = date('Y-m-d', strtotime('+1 day', $now));
				$x = mktime(0, 0, 0, date("m")-1, date("d"), date("Y"));
				$bulantahun = date("m-Y", $x);				
				$bulantahunlaporan = date("Y-m", $x);				
				$nopol = $row['nopol'];
				for($a=1;$a<=31;$a++){
					$pdf->Cell(10,10,$i,1,0,'C');
					$pdf->Cell(30,10,$nopol,1,0,'C');		 
					$pdf->Cell(30,10,$a.'-'.$bulantahun,1,0,'C');	
					$tanggal = $bulantahunlaporan.'-'.$a;
					$sql_jarak = " select IFNULL(SUM(jarak),0) jarak from data_laporan where nopol = '$nopol' and insert_time like '$tanggal%' ";
					//echo $sql_jarak;
					$result_jarak = $conn->query($sql_jarak);					
					if ($result_jarak->num_rows != 0) {
						
						while($row_jarak = $result_jarak->fetch_assoc()) {
							$jarak = $row_jarak['jarak'];
							$pdf->Cell(40,10,$jarak,1,1,'C');
						}
					}else{
						$pdf->Cell(40,10,'0',1,1,'C');
					}
					$i = $i + 1;
				}
				
			}
			 
		 }

$filename="/var/www/html/laporan/".$File;

$pdf->Output($filename,'F'); 
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.googlemail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'roudlotuljannah.sumari@gmail.com';                 // SMTP username
$mail->Password = '12qwaszx34erdfcv';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('roudlotuljannah.sumari@gmail.com', 'Mailer');
$mail->addAddress('awaluddin.rizal@gmail.com', 'Joe User'); 
$mail->addAttachment($File);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

?>
