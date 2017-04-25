

<html>
<head>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
    $( document ).ready(function() {
		var haha = 'tes';
        tes(haha);

    });
		
		
 
		function tes(hahax){
			console.log('haha');
			$.ajax({    //create an ajax request to load_page.php
				type: "GET",
				<?php
					
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

				$sql_pendaftaran = "select * from klien ";
				$result_pendaftaran = $conn->query($sql_pendaftaran);
				//print_r($result->num_rows."halo");
				 if ($result_pendaftaran->num_rows != 0) {
					// print_r('satu');

					 while($row_pendaftaran = $result_pendaftaran->fetch_assoc()) {	
						$no_pendaftaran = $row_pendaftaran['no_pendaftaran'];
						 echo "url: 'laporan_jarak_harian_perbulan.php?no_pendaftaran=".$no_pendaftaran."',";
					 }

				 }
				?>            
				dataType: "html",   //expect html to be returned                
				success: function(response){                    
					$("#responsecontainer").html(response); 
					//alert(response);
				}

			});
		}
    
    </script>
</head>
<body>
    <div id="responsecontainer">
		<?php
		
		?>
	</div>
</body>
</html>


