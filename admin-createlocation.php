<?php include("header.php"); ?>  

<?php
    $location_id = ""; 		
    $cl_first_name = "";
    $cl_last_name = "";
    $cl_address1 = "";
    $cl_address2 = "";
    $cl_city = "";
    $province_id = "";	
    $country_id = "";
    $cl_postal_code = "";
    $cl_phone_number = "";
    $cl_email_address = "";
    $contact_id = "";    
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){        
        $location_id = ""; 		
        $cl_first_name = "";
        $cl_last_name = "";
        $cl_address1 = "";
        $cl_address2 = "";
        $cl_city = "";
        $province_id = "";	
        $country_id = "";
        $cl_postal_code = "";
        $cl_phone_number = "";
        $cl_email_address = "";
        $contact_id = "";      
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $location_id = trim($_POST["location_id"]); 		
        $cl_first_name = trim($_POST["cl_first_name"]); 
        $cl_last_name = trim($_POST["cl_last_name"]); 
        $cl_address1 = trim($_POST["cl_address1"]); 
        $cl_address2 = trim($_POST["cl_address2"]); 
        $cl_city = trim($_POST["city"]); 
        $province_id = trim($_POST["provinces"]); 
        $country_id = trim($_POST["countries"]); 
        $cl_postal_code = trim($_POST["cl_postal_code"]); 
        $cl_phone_number = trim($_POST["cl_phone_number"]); 
        $cl_email_address = trim($_POST["cl_email_address"]); 
        $contact_id = trim($_POST["contact_methods"]);        
        
      
        $result = pg_prepare($conn, "location_insert_query", 'INSERT INTO client_locations (location_id,     cl_first_name, cl_last_name, cl_address1, cl_address2, cl_city, province_id, country_id,    cl_postal_code, cl_phone_number, cl_email_address, contact_id) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12)');
		$result = pg_execute($conn, "location_insert_query", array($location_id, $cl_first_name, $cl_last_name, $cl_address1, $cl_address2, $cl_city, $province_id, $country_id, $cl_postal_code, $cl_phone_number, $cl_email_address, $contact_id));	    
            
        redirect(ADMNLOCA);
    }      
?>
<div class="w3-row-padding">

<div class="w3-third">

    <h2>Create a New Location</h2>
    <br/>
     <div class="w3-half">
    <img class="smlimg" src="Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  
    </div>
    <div class="w3-half">
    <p>Create New location that will be used to when Site Assessments are done for Clients as also used when Creating Client and the Sites that I.C.C. will be maintaining</p>
    </div>
   
    
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="w3-third">
   
    <br/><br/>
    <h3>Location Contact</h3>
    <label class="icclabel">Location ID</label>         <input name="location_id"></input><br/><br/>
    <label class="icclabel">Contact First Name</label>  <input name="cl_first_name"></input><br/><br/>
    <label class="icclabel">Contact Last Name</label>   <input name="cl_last_name"></input><br/><br/>    
    <label class="icclabel">Phone Number</label>        <input name="cl_phone_number"></input><br/><br/>
    <label class="icclabel">Email Address</label>       <input name="cl_email_address"></input><br/><br/>
    <label class="icclabel">Contact Method</label>      <?php build_drop_down(CNTC, $contact_id); ?><br/><br/>
    
</div>

<div class="w3-third">
    
    <br/><br/>
    <h3>Location Address</h3>
    <label class="icclabel">Address</label>     <input name="cl_address1"></input><br/><br/>
    <label class="icclabel">Address</label>     <input name="cl_address2"></input><br/><br/>
    <label class="icclabel">City</label>        <input name="city"></input><br/><br/>
    <label class="icclabel">Province</label>    <?php build_drop_down(PROV, $province_id); ?><br/><br/>
    <label class="icclabel">Country</label>     <?php build_drop_down(CNTR, $country_id); ?><br/><br/>
    <label class="icclabel">Postal Code</label> <input name="cl_postal_code"></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
   
</div>

</form>

</div>

<?php include("footer.php"); ?> 