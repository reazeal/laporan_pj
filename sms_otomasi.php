<?php
    
include 'koneksi.php';
    
    // koneksi -> 11.25
    // koneksi2 -> 11.25
     
     /*
                            $value_set_q1= "
                             SET SESSION wait_timeout=36000  
                            ";
                            $q_set1 = $koneksi->Execute($value_set_q1);
                            
                            $value_set_q2= "
                             SET GLOBAL connect_timeout=36000 
	                           ";
                            $q_set2 = $koneksi->Execute($value_set_q2);
*/
                            echo "haha";
 // Koneksi 1
       try {
                $query1 = "
                select pemasangan_id, no_seri from pemasangan -- where status = 'Belum Aktif'
                ";
                
                $q1 = $koneksi2->Execute($query1);
                
                   
                     file_put_contents('./logs/log_jumlahlokasi_'.date("j.n.Y").'.txt', $query1, FILE_APPEND);
                     
                     for($j=0;$j<$q1->RecordCount();$j++){
                        
                            $no_seri = $q1->Fields('no_seri');
				$pemasangan_id = $q1->Fields('pemasangan_id');
				//echo $no_seri;
                            
                            $query2= "
                             SELECT deviceid from traccar.devices a 
				join traccar.location b on a.id = b.devicedid
				where uniqueid = '$no_seri'
                            ";
                            $q_lokasi = $koneksi->Execute($query2);
//                            $id_karyawan = $q_ky->Fields('id_karyawan');
				$jumlah_lokasi = $q_lokasi->RecordCount();
                            
                          
                            file_put_contents('./logs/log_jumlahlokasi_'.date("j.n.Y").'.txt', $query2, FILE_APPEND);
                            
                            if($jumlah_lokasi!=0){
                                
				$query_update = "update pemasangan set status = 'Aktif' where pemasangan_id = '$pemasangan_id'";
				
                                $query3 = "
					insert into kalkun (text, destinationnumber)                               
                                VALUES
                                  ('GPS nomer .$no_seri. sudah aktif','085732976799')";
                                  
                                $q3 = $koneksi2->Execute($query3);  
                                
                              
                                file_put_contents('./logs/log_jumlahlokasi_'.date("j.n.Y").'.txt', $query3, FILE_APPEND);
                            }
                             
				
                        $q1->MoveNext();       
			}
                      
            
        
        } catch (exception $e) {
            print_r($e);
            
          
            file_put_contents('./logs/log_jumlahlokasi_'.date("j.n.Y").'.txt', $e, FILE_APPEND);
            
        }
  // END Koneksi 1
        

?>
