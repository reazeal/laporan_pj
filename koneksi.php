<?php 
error_reporting(E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR);
    ini_set('display_errors', 1);
 echo "ha";

    include("adodb5/adodb-exceptions.inc.php");
    include 'adodb5/adodb.inc.php';
   
   include("mail/MAIL.php");
    
    // Fungsi Variable.
/*
	$host_smtp = 'smtp.gmail.com';
	$port_smtp = 465;
	$user_smtp = 'roudlotuljannah.sumari@gmail.com';
	$password_smtp = '12qwaszx34erdfcv';
	$koneksi_smtp = 'tls';
	$timeout_smtp = 10;
	//$server_lokal_smtp = 'behaestex.co.id';
	$auth_type_smtp = 'plain';
    $email_tujuan = 'awaluddin.rizal@gmail.com';
    */
	$host = '192.168.11.25';
	$user = 'software';
	$pass = 'software';
	$dbname = 'tracking';
    
	// SERVER 1
	$host2= '192.168.11.25';
	$user2 = 'software';
	$pass2 = 'software';
	$dbname2 = 'tracking';
    
	
	 try { 

		 $koneksi = NewADOConnection('mysql');  
		 $koneksi->PConnect($host,$user,$pass,$dbname);
		 $hasil =  "Koneksi 1 OK!";
		 file_put_contents('./logs/log_koneksi1_'.date("j.n.Y").'.txt', $hasil, FILE_APPEND);

	} catch (exception $e) { 

		$hasil =  "ERROR KONEKSI 1. ";

       $error_log  .= var_dump($e); 
	   $error_log  .= adodb_backtrace($e->gettrace());
		file_put_contents('./logs/log_koneksi1_'.date("j.n.Y").'.txt', $hasil.$e, FILE_APPEND);

        /*
        
        $m = new MAIL;
		$m->From('roudlotuljannah.sumari@gmail.com');
		$m->AddTo($email_tujuan);
		$m->Subject('Error ... di Crontab !! --> SMS OTOMASI <-- ');
        
        
        $m->Html(" 
					
        <HTML>
        <HEAD>
        <META http-equiv=Content-Type content=text/html; charset=iso-8859-1>
        <META content='MSHTML 6.00.2900.3059' name=GENERATOR>
        <style type='text/css'>
        <!--
        .style1 {
        font-size: 11px;
        font-family: Arial, Helvetica, sans-serif;
        color: #666666;
        }
        body {
        background-color: #fff2d9;
        background-image: url(http://www.Freesms.net/images/back.jpg);
        }
        .style2 {
        color: #666666;
        font-size: 11px;
        }
        -->
        </style>
        </HEAD>
        <BODY><SPAN class=gmail_quote><BR></SPAN>
        <DIV>
        <TABLE cellSpacing=1 cellPadding=10 align=left bgColor=#f4f4f4 border=1 frame=border>
          <TBODY>
          <TR>
            <TD bgcolor=#FED983>
              <TABLE style='WIDTH: 510px' align=center bgColor=#ffffff>
                <TBODY>
                <TR>
        		<td>
        			<table border=0>
        				<tr>
        			        <td rowspan=2><IMG src='http://img526.imageshack.us/img526/4306/bhsn.jpg' width=100 height=100></td>
        			        <td align=center width=100% valign=middle><font face=Verdana size=5px><b>PT. XXX -- SMS OTOMASI </b></font> <br />
        					<font face=Verdana size=3px><b>Alamat</b></font>
        					</td>
        			    </tr>
        			    <tr>
        			        <td align=center width=100%></td>
        			    </tr>
        			</table>
        		 </td>
                </TR>
        		<TR>
                  <TD>-------------------------------------------------------------------------------------------------------------------</TD>
        		</TR>
                <TR>
                  <TD>
                    <p class='style1'>
        		     Maaf, Ada Error dengan koneksi crontab... 
        			</p>
                    <p class='style1'>Terima Kasih.</p>
                    <p class='style1'>Untuk Informasi Lebih lanjut silahkan kontak administrator anda.<br>
                      <br></p>
                            
                    <DIV><FONT face=Arial size=1>(Tolong jangan Balas ke Email ini, Email ini hanya bertujuan untuk notifikasi OTOMASI SMS saja.). 
        </FONT></DIV></TD>
                </TR></TBODY></TABLE></TD>
          </TR></TBODY></TABLE></DIV>
        </BODY>
        </HTML> 

        ");
            $c = $m->Attach('text message', 'text/plain');
            $f = './logs/log_koneksi1_'.date("j.n.Y").'.txt';
            $c = $m->Attach(file_get_contents($f), FUNC::mime_type($f), 'error.txt', null, null, 'inline', MIME::unique());
            $c = $m->Connect($host_smtp, $port_smtp, $user_smtp, $password_smtp, $koneksi_smtp, $timeout_smtp, null, null, $auth_type_smtp) or die(print_r($m->Result));
			$m->Send($c) ? 'Mail sent !' : 'Error !';
			$m->Disconnect();
       */     

     } 


	 // Koneksi 2
	try { 

		 $koneksi2 = NewADOConnection('mysql');  
		 $koneksi2->PConnect($host2,$user2,$pass2,$dbname2);
		 $hasil =  "Koneksi 2 OK <br/>";
         file_put_contents('./logs/log_koneksi2_'.date("j.n.Y").'.txt', $hasil, FILE_APPEND);
		echo $hasil;
		
	} catch (exception $e) { 
		
		$hasil =  "ERROR KONEKSI 2.";
		echo $hasil;
        $error_log  .= var_dump($e); 
		$error_log  .=adodb_backtrace($e->gettrace());
		file_put_contents('./logs/log_koneksi2_'.date("j.n.Y").'.txt', $hasil.$e, FILE_APPEND);
    }
	
/*
        
          $m = new MAIL;
		$m->From('roudlotuljannah.sumari@gmail.com');
		$m->AddTo($email_tujuan);
		$m->Subject('Error ... di Crontab !! --> SMS OTOMASI <-- ');
        
        
        $m->Html(" 
					
        <HTML>
        <HEAD>
        <META http-equiv=Content-Type content=text/html; charset=iso-8859-1>
        <META content='MSHTML 6.00.2900.3059' name=GENERATOR>
        <style type='text/css'>
        <!--
        .style1 {
        font-size: 11px;
        font-family: Arial, Helvetica, sans-serif;
        color: #666666;
        }
        body {
        background-color: #fff2d9;
        background-image: url(http://www.Freesms.net/images/back.jpg);
        }
        .style2 {
        color: #666666;
        font-size: 11px;
        }
        -->
        </style>
        </HEAD>
        <BODY><SPAN class=gmail_quote><BR></SPAN>
        <DIV>
        <TABLE cellSpacing=1 cellPadding=10 align=left bgColor=#f4f4f4 border=1 frame=border>
          <TBODY>
          <TR>
            <TD bgcolor=#FED983>
              <TABLE style='WIDTH: 510px' align=center bgColor=#ffffff>
                <TBODY>
                <TR>
        		<td>
        			<table border=0>
        				<tr>
        			        <td rowspan=2><IMG src='http://img526.imageshack.us/img526/4306/bhsn.jpg' width=100 height=100></td>
        			        <td align=center width=100% valign=middle><font face=Verdana size=5px><b>PT. XXX -- SMS OTOMASI </b></font> <br />
        					<font face=Verdana size=3px><b>Alamat</b></font>
        					</td>
        			    </tr>
        			    <tr>
        			        <td align=center width=100%></td>
        			    </tr>
        			</table>
        		 </td>
                </TR>
        		<TR>
                  <TD>-------------------------------------------------------------------------------------------------------------------</TD>
        		</TR>
                <TR>
                  <TD>
                    <p class='style1'>
        		     Maaf, Ada Error dengan koneksi crontab... 
        			</p>
                    <p class='style1'>Terima Kasih telah menggunakan SMS OTOMASI.</p>
                    <p class='style1'>Untuk Informasi Lebih lanjut silahkan kontak administrator anda.<br>
                      <br></p>
                            
                    <DIV><FONT face=Arial size=1>(Tolong jangan Balas ke Email ini, Email ini hanya bertujuan untuk notifikasi SMS OTOMASI saja.). 
        </FONT></DIV></TD>
                </TR></TBODY></TABLE></TD>
          </TR></TBODY></TABLE></DIV>
        </BODY>
        </HTML> 

        ");
            $c = $m->Attach('text message', 'text/plain');
            $f = './logs/log_koneksi2_'.date("j.n.Y").'.txt';
            $c = $m->Attach(file_get_contents($f), FUNC::mime_type($f), 'error.txt', null, null, 'inline', MIME::unique());
            $c = $m->Connect($host_smtp, $port_smtp, $user_smtp, $password_smtp, $koneksi_smtp, $timeout_smtp, null, null, $auth_type_smtp) or die(print_r($m->Result));
			$m->Send($c) ? 'Mail sent !' : 'Error !';
			$m->Disconnect();
            
*/            
     


?>
