<?php include("header.php"); ?>  

<?php
    $conn = db_connect();
    $client_id = "";    
    $location_id = "";
    $client_name = "";
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
    $new_id = "";
    $records = "";
    $clt_number = "";
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $sql = "SELECT * FROM clients ORDER by client_id DESC LIMIT 1";
		$result 	= pg_query($conn, $sql);
		$records 	= pg_num_rows($result);
        $new_id = pg_fetch_result($result, "client_id");       
        $clt_number = substr($new_id, 4, 6);
        $clt_number = $clt_number + 1;
        $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
        $client_id = substr($new_id, 0, 3);
        $client_id .= $clt_number;
        //$client_id = "";
        $location_id = "";
        $client_name = "";
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
        $client_id = trim($_POST["client_id"]); 
        $client_name = trim($_POST["client_name"]);
        $location_id = trim($_POST["location_id"]);      
        $cl_first_name = trim($_POST["cl_first_name"]); 
        $cl_last_name = trim($_POST["cl_last_name"]); 
        $cl_address1 = trim($_POST["cl_address1"]); 
        $cl_address2 = trim($_POST["cl_address2"]); 
        $cl_city = trim($_POST["cl_city"]); 
        $province_id = trim($_POST["provinces"]); 
        $country_id = trim($_POST["countries"]); 
        $cl_postal_code = trim($_POST["cl_postal_code"]); 
        $cl_phone_number = trim($_POST["cl_phone_number"]); 
        $cl_email_address = trim($_POST["cl_email_address"]); 
        $contact_id = trim($_POST["contact_methods"]); 
        
        /*
        $result = pg_prepare($conn, "client_update_query", 'UPDATE clients SET client_name=$2 WHERE client_id = $1');
        $result = pg_execute($conn, "client_update_query", array($client_id, $client_name));	  
        
        
        $result = pg_prepare($conn, "user_insert_query", 'UPDATE client_locations SET client_first_name=$2, client_last_name=$3, client_address1=$4, client_address2=$5, city_id=$6, province_id=$7, country_id=$8, client_postal_code=$9, client_phone_number=$10, client_email_address=$11, contact_id=$12 WHERE location_id = $1');
		$result = pg_execute($conn, "user_insert_query", array($location_id, $cl_first_name, $cl_last_name, $cl_address1, $cl_address2, $cl_city, $province_id, $country_id, $cl_postal_code, $cl_phone_number, $cl_email_address, $contact_id));  
    */
    }
?>    
<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <h2>Create a New Clients</h2>
    
    <p><a href="./admin-clients.php">Return to Client Dashboard</a></p>
 
<div class="w3-third">
    
    <p>Create New Client that will link the new Client to an Existing Location and Enter a Client name for Companies or enter Personal for Private Clients</p>
    <img class="smlimg" src="Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  
     
</div>

<div class="w3-third">

    <h2>Contact Information</h2>
    <label class="icclabel">Client ID</label><label name="client_id"><?php echo $client_id; ?></label><br/><br/>
    <label class="icclabel">Client Name</label><input name="client_name" value="<?php echo $client_name;  ?>"></input><br/><br/>
    <label class="icclabel">Location ID</label><input name="location_id" value="<?php echo $location_id; ?>"></input><br/><br/>
      <label class="icclabel">Contact First Name</label><input name="cl_first_name" value="<?php echo $cl_first_name; ?>" /><br/><br/>
    <label class="icclabel">Contact Last Name</label><input name="cl_last_name" value="<?php echo $cl_last_name; ?>" /><br/><br/>
    <label class="icclabel">Phone Number</label><input name="cl_phone_number" value="<?php echo $cl_phone_number ?>" /><br/><br/>
    <label class="icclabel">Email</label><input name="cl_email_address" value="<?php echo $cl_email_address ?>" /><br/><br/>
    <label class="icclabel">Contact Method</label><?php echo build_drop_down(CNTC,$contact_id) ?><br/><br/> 
    
</div>

<div class="w3-third">

    <h2>Billing Location</h2>
     <label class="icclabel">Address 1</label><input name="cl_address1" value="<?php echo $cl_address1 ?>" /><br/><br/>
    <label class="icclabel">Address 2</label><input name="cl_address2" value="<?php echo $cl_address2 ?>" /><br/><br/>
    <label class="icclabel">City</label><input name="cl_city" value="<?php echo $cl_city ?>" /><br/><br/>
    <label class="icclabel">Province</label><?php echo build_drop_down(PROV,$province_id) ?><br/><br/>
    <label class="icclabel">Country</label><?php echo build_drop_down(CNTR,$country_id) ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="cl_postal_code" value="<?php echo $cl_postal_code  ?>" /><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 