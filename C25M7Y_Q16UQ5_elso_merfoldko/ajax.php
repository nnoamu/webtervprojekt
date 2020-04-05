<?php 
if($_POST['action'] == 'call_this') {
  session_start();

	session_unset();
	session_destroy();

	
    echo "Kijelentkeztél";
    
	
}

header("Refresh:0");

?>