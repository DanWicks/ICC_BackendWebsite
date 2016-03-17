<?php include("header.php"); ?>  

<?php
    $location_id = ""; 		
    $cl_first_name = "";
    $cl_last_name = "";    
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){        
        $client_id = ""; 		
        $client_name = "";
        $location_id = "";           
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $client_id = trim($_POST["client_id"]); 		
        $client_name = trim($_POST["client_name"]); 
        $location_id = trim($_POST["client_locations"]);  
        if ($client_name == "") {
             $result = pg_prepare($conn, "client_insert_query", 'INSERT INTO clients (client_id, location_id) VALUES ($1,$2)');
            $result = pg_execute($conn, "client_insert_query", array($client_id, $location_id));	
        } else {
            $result = pg_prepare($conn, "client_insert_query", 'INSERT INTO clients (client_id, client_name, location_id) VALUES ($1,$2,$3)');
            $result = pg_execute($conn, "client_insert_query", array($client_id, $client_name, $location_id));	    
        }       
           
        redirect(ADMNLOCA);
    }      
?>
<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="w3-third">

    <h2>Create a New Clients</h2>
    <br/>
     <div class="w3-half">
    <img class="smlimg" src="Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  
    </div>
    <div class="w3-half">
    <p>Create New Client that will link the new Client to an Existing Location and Enter a Client name for Companies or enter Personal for Private Clients</p>
    </div>
   
    
</div>

<div class="w3-third">

    <h2>Enter Client Information</h2>
    <br/>
    <label class="icclabel">Client ID</label><input name="client_id"></input><br/><br/>
    <label class="icclabel">Client Name</label><input name="client_name"></input><br/><br/>
    <label class="icclabel">Location</label>
    <?php build_select_dropdown (LOCA, $location_id, LOCATION)  ?><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
    
</div>

<div class="w3-third">

  
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 