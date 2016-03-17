<?php include("header.php"); ?>  

<?php
    $site_id = ""; 		
    $site_client_id = "";
    $site_location_id = "";    
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){        
        $site_id = ""; 		
        $site_client_id = "";
        $site_location_id = "";           
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $site_id = trim($_POST["site_id"]); 		
        $site_client_id = trim($_POST["clients"]); 
        $site_location_id = trim($_POST["client_locations"]);  
        
        $result = pg_prepare($conn, "sites_insert_query", 'INSERT INTO sites (site_id, site_client_id, site_location_id)  
        VALUES ($1,$2,$3)');
		$result = pg_execute($conn, "sites_insert_query", array($site_id, $site_client_id, $site_location_id) );	    
            
        redirect(ADMNSITE);
    }      
?>

<div class="w3-row-padding">

<div class="w3-third">

    <h2>Create a New Cleaning Site</h2>
    <br/>
     <div class="w3-half">
    <img class="smlimg" src="Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  
    </div>
    <div class="w3-half">
    <p>Create New Site that will link all of the Information together with Customer Information and Location Information</p>
    </div>
   
    
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="w3-third">

    <h2>Enter Site Information</h2>
    <br/>
    <label class="icclabel">Site ID</label><input name="site_id"></input><br/><br/>
    <label class="icclabel">Client ID</label>
    <?php build_select_dropdown (CLNT, $site_client_id, CLIENT)  ?><br/><br/>
    <label class="icclabel">Location</label>
    <?php build_select_dropdown (LOCA, $site_location_id, LOCATION)  ?><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
    
</div>

<div class="w3-third">

  
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 