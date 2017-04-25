<?php

$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "traccar";

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
	
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

$sql = "INSERT INTO tracking.data_laporan
		SELECT  
		MD5(CONCAT(now(),nopol,no_pendaftaran, uniqueid, alat_id, merk, tipe, `name`, latitude, `longitude` ,servertime ,SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(positions.attributes,'distance',-1),':',-2),',',1))) id,
		 `longitude`, latitude, servertime ,alat_id, no_pendaftaran, uniqueid, nopol, merk, tipe  ,SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(positions.attributes,'distance',-1),':',-2),',',1) AS jarak
		FROM positions 
		JOIN devices b ON positions.deviceid = b.id
		JOIN tracking.`pemasangan` a ON a.no_seri = b.uniqueid
		-- WHERE protocol = 'gt06'
		-- LIMIT 10 
		 ";
		$result = $conn->query($sql);
		

?>
