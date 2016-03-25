<?php include("header.php"); ?>  


<?php
    $conn = db_connect();
    $client_id = "";    
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
    $new_id = "";
    $records = "";
    $clt_number = "";
    $isLocation = "";
    $site_id = "";
    $equip = "";
    $equipment = "";
    $redirect = "";
    $staff_required = "";
    $assessment_id = "";
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $client_id = $_SESSION['client_id'];
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
        $isLocation="";
        $equip = "";  

        
        $sql = "SELECT * FROM sites ORDER by site_id DESC LIMIT 1";
        $results 	= pg_query($conn, $sql);
        $records 	= pg_num_rows($results);
        $new_id = pg_fetch_result($results, "site_id");       
        $clt_number = substr($new_id, 4, 6);
        $clt_number = $clt_number + 1;
        $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
        $site_id = substr($new_id, 0, 3);
        $site_id .= $clt_number;   
        $_SESSION['site_id'] = $site_id;
        
         $sql = "SELECT * FROM location_assessment ORDER by assessment_id DESC LIMIT 1";
        $results 	= pg_query($conn, $sql);
        $records 	= pg_num_rows($results);
        $new_id = pg_fetch_result($results, "assessment_id");       
        $clt_number = substr($new_id, 4, 6);
        $clt_number = $clt_number + 1;
        $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
        $assessment_id = substr($new_id, 0, 3);
        $assessment_id .= $clt_number;   
        $_SESSION['assessment_id'] = $assessment_id;
        
        $redirect = ("./admin-clients.php");
        $staff_required = "";        
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $site_id = $_SESSION['site_id'];
        $assessment_id = $_SESSION['assessment_id'];
         
        $client_id = $_SESSION['client_id']; 
        if (isset($_POST['isLocation'])) {
            $isLocation = trim($_POST["isLocation"]); 
        } else {
           $isLocation = ""; 
        }       
        if ($isLocation == "check") {
            $resultclient = pg_prepare($conn, "query_client_update", 'SELECT * FROM clients WHERE client_id = $1');
            $resultclient = pg_execute($conn, "query_client_update", array($client_id));     
            $location_id = trim(pg_fetch_result($resultclient, 'location_id'));
            $_SESSION['location_id'] = $location_id;
            //echo $location_id;
        } else {        
            $sql = "SELECT * FROM client_locations ORDER by location_id DESC LIMIT 1";
            $result 	= pg_query($conn, $sql);
            $records 	= pg_num_rows($result);
            $new_id = pg_fetch_result($result, "location_id");       
            $clt_number = substr($new_id, 4, 6);
            $clt_number = $clt_number + 1;
            $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
            $location_id = substr($new_id, 0, 3);
            $location_id .= $clt_number;   
            $_SESSION['location_id'] = $location_id;
        }   
        if (!isset ($_POST['equip'])) {
			$equip = "";
		}else{
            $equipment = ($_POST['equip']);
			$equip = ($_POST['equip']);
			$equip = sumCheckBox ($equip);
			$_SESSION['equip'] = $equip;			
		}        
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
        $staff_required = trim($_POST["staff_required"]);
         $redirect = ("./admin-clients.php");
        
      
        if (!isset($_POST['isLocation'])) {
            $result_location = pg_prepare($conn, "location_insert_query", 'INSERT INTO client_locations (location_id,     client_first_name, client_last_name, client_address1, client_address2, city_id, province_id, country_id,    client_postal_code, client_phone_number, client_email_address, contact_id) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12)');
            $result_location = pg_execute($conn, "location_insert_query", array($location_id, $cl_first_name, $cl_last_name, $cl_address1, $cl_address2, $cl_city, $province_id, $country_id, $cl_postal_code, $cl_phone_number, $cl_email_address, $contact_id));	
        }
        
        $result_site = pg_prepare($conn, "site_insert_query", 'INSERT into sites (site_id, site_client_id, site_location_id, site_status) VALUES ($1, $2, $3, $4)');        
        $result_site = pg_execute($conn, "site_insert_query", array($site_id, $client_id, $location_id, "S"));
        
        $result_assessment = pg_prepare($conn, "assessment_insert_query", 'INSERT into location_Assessment (assessment_id, location_id, la_staff_number) VALUES ($1, $2, $3)');        
        $result_assessment = pg_execute($conn, "assessment_insert_query", array($assessment_id, $location_id, $staff_required));  
      
         
        if (isset ($_POST['equip'])){            
            $result_locatioa = pg_prepare($conn, "locationa_insert_query", 'INSERT into assessment_equipment (assessment_id, specialty_equipment_id) VALUES ($1, $2)');
            foreach ($equipment as $value){                
                 $result_locatioa = pg_execute($conn, "locationa_insert_query", array($assessment_id, $value));  
            }
        }
   
        redirect($redirect);
    }
?>   
<script type="text/javascript">
<!--
	/*NOTE: for the following function to work, on your page
			you have to create a checkbox id'ed as city_toggle
				
	<input type="checkbox"  onclick="toggle(this);" name="city[]" value="0">
			
		and each city checkbox element has to be an named as an 
		array (specifically named "city[]")
		e.g.
			<input type="checkbox" name="city[]" value="1">Ajax
	*/
	function toggle(source) {
		checkboxes = document.getElementsByName('equip[]');
		for(i = 0; i < checkboxes.length; i++)
		{
			checkboxes[i].checked = source.checked;
		}
	}
		
//-->
</script> 
<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <h2>Enter Client Assessment : <?php echo $site_id ?></h2>
    
    <p><a href="./admin-clients.php">Return to Client Dashboard</a></p>
 
<div class="w3-third">
    
    <h2>Cleaning Location Contact : <?php echo $location_id ?></h2>
    <label class="icclabel">Same as Billing:</label><input type="checkbox" name="isLocation" value="check" <?php if ($isLocation == 'check') {echo'checked="checked"';} ?> /></br></br>
    <label class="icclabel">Contact First Name</label><input name="cl_first_name" value="<?php echo $cl_first_name; ?>" /><br/><br/>
    <label class="icclabel">Contact Last Name</label><input name="cl_last_name" value="<?php echo $cl_last_name; ?>" /><br/><br/>
    <label class="icclabel">Phone Number</label><input name="cl_phone_number" value="<?php echo $cl_phone_number ?>" /><br/><br/>
    <label class="icclabel">Email</label><input name="cl_email_address" value="<?php echo $cl_email_address ?>" /><br/><br/>
    <label class="icclabel">Contact Method</label><?php echo build_drop_down(CNTC,$contact_id) ?><br/><br/> 
     
</div>

<div class="w3-third">

    <h2>Location Information</h2>
    <label class="icclabel">Address 1</label><input name="cl_address1" value="<?php echo $cl_address1 ?>" /><br/><br/>
    <label class="icclabel">Address 2</label><input name="cl_address2" value="<?php echo $cl_address2 ?>" /><br/><br/>
    <label class="icclabel">City</label><input name="cl_city" value="<?php echo $cl_city ?>" /><br/><br/>
    <label class="icclabel">Province</label><?php echo build_drop_down(PROV,$province_id) ?><br/><br/>
    <label class="icclabel">Country</label><?php echo build_drop_down(CNTR,$country_id) ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="cl_postal_code" value="<?php echo $cl_postal_code  ?>" /><br/><br/>
   
</div>

<div class="w3-third">

    <h2>Assesment Information : <?php echo $assessment_id; ?></h2>
    <label class="icclabel">Staff Required</label><input name="staff_required" value="<?php echo $staff_required ?>" /><br/><br/>
    
    <label class="icclabel">Equipment Required</label><br/>
    <label class="icclabel">Select All</label><input type="checkbox"  onclick="toggle(this);" name="equip[]" value="0"/><br/>
    <br/><?php build_check_bit_equip(SPEQ,"equip", $equip) ?><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />  
    
</div>

</form>

</div>

<?php include("footer.php"); ?> 