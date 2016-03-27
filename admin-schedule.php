<?php include("header.php"); ?>  

<?php
    $staff_id = ""; 		
    $site_client_id = "";
    $start_time = "";    
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){        
        $staff_id = ""; 		
        $site_client_id = "";
        $start_time = "";           
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $staff_id = trim($_POST["staff_id"]); 		
        $site_client_id = trim($_POST["clients"]); 
        $start_time = trim($_POST["client_locations"]);  
        /*
        $result = pg_prepare($conn, "sites_insert_query", 'INSERT INTO sites (site_id, site_client_id, site_location_id)  
        VALUES ($1,$2,$3)');
		$result = pg_execute($conn, "sites_insert_query", array($site_id, $site_client_id, $site_location_id) );	    
            
        redirect(ADMNSITE);*/
    }      
?>

<div class="w3-row-padding">

    <div class="notes">
    <h1>Staff Schedule (UNDER CONSTRUCTION)</h1><hr/>
    <h3><a class="dash" href="./admin-staff.php">Return to Staff Dashboard</a></h3>
    <?php build_schedule(); ?><br/><br/>
     </div>
     
</div>

<?php include("footer.php"); ?> 