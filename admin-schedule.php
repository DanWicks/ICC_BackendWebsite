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

    <h2><b>Staff Schedule</b></h2>    
    
    <p><a href="./admin-staff.php">Return to Staff Dashboard</a></p>

<div class="w3-third">
    
   <?php echo buildStaffTable(); ?>
    
</div>

<div class="w3-twothird">

    
    <?php build_select_dropdown (STAF, $staff_id, STAFF);  ?>
    <?php build_select_dropdown (SITE, $staff_id, SITES);  ?>
    <?php build_drop_down_named(STME, $start_time,START); ?>
    <?php build_drop_down_named(STME, $start_time,END); ?>
    
</div>

</div>

<?php include("footer.php"); ?> 