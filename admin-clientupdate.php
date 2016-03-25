<?php include("header.php"); 
    $client_id = "";      
    if (isset($_GET['client_id'])){		
        $client_id = $_GET['client_id'];       
    } else {
        //redirect ("./admin-clientinfo.php");
    }   
?>

<?php
    $conn = db_connect();
    $client_id = $_SESSION['check_client_id'];
    $client_full_name = "";    
    $location_id = $_SESSION['check_location_id'];
    $client_status = "";
    $client = "";
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
    $redirect = ("./admin-clientview.php?client_id=".$client_id);
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $client_id = $_SESSION['check_client_id'];
        $location_id = $_SESSION['check_location_id'];
        
        $resultclient = pg_prepare($conn, "query_client_update", 'SELECT * FROM clients WHERE client_id = $1');
        $resultclient = pg_execute($conn, "query_client_update", array($client_id));     
        $location_id = trim(pg_fetch_result($resultclient, 'location_id'));
        $client_name = trim(pg_fetch_result($resultclient, 'client_name'));
        $client_status = trim(pg_fetch_result($resultclient, 'client_status'));  
        
        $resultlocation = pg_prepare($conn, "query_location_update", 'SELECT * FROM client_locations WHERE location_id = $1');
        $resultlocation = pg_execute($conn, "query_location_update", array($location_id)); 
        
        $cl_first_name = trim(pg_fetch_result($resultlocation, 'client_first_name'));  
        $cl_last_name = trim(pg_fetch_result($resultlocation, 'client_last_name'));
        $cl_address1 = trim(pg_fetch_result($resultlocation, 'client_address1'));
        $cl_address2 = trim(pg_fetch_result($resultlocation, 'client_address2'));
        $cl_city = trim(pg_fetch_result($resultlocation, 'city_id'));
        $province_id = trim(pg_fetch_result($resultlocation, 'province_id'));
        $country_id = trim(pg_fetch_result($resultlocation, 'country_id'));
        $cl_postal_code = trim(pg_fetch_result($resultlocation, 'client_postal_code'));
        $cl_phone_number = trim(pg_fetch_result($resultlocation, 'client_phone_number'));
        $cl_email_address = trim(pg_fetch_result($resultlocation, 'client_email_address'));
        $contact_id = trim(pg_fetch_result($resultlocation, 'contact_id')); 
      
        $client = ($client_name == "")?$client_full_name:$client_name   ;          
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cl_phone_number = "";
        $client_id = $_SESSION['check_client_id']; 
        $client_status = trim($_POST["client_status"]); 
        $location_id = $_SESSION['check_location_id']; 
        $client_name = trim($_POST["client_name"]); 
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
        
        if ($client_name != "") {
            $result = pg_prepare($conn, "client_update_query", 'UPDATE clients SET client_name=$2, client_status=$3 WHERE client_id = $1');
            $result = pg_execute($conn, "client_update_query", array($client_id, $client_name, $client_status));	  
        } else {
            $result = pg_prepare($conn, "client_status_query", 'UPDATE clients SET client_status=$2 WHERE client_id = $1');
            $result = pg_execute($conn, "client_status_query", array($client_id, $client_status));	
        }
        $result = pg_prepare($conn, "user_insert_query", 'UPDATE client_locations SET client_first_name=$2, client_last_name=$3, client_address1=$4, client_address2=$5, city_id=$6, province_id=$7, country_id=$8, client_postal_code=$9, client_phone_number=$10, client_email_address=$11, contact_id=$12 WHERE location_id = $1');
		$result = pg_execute($conn, "user_insert_query", array($location_id, $cl_first_name, $cl_last_name, $cl_address1, $cl_address2, $cl_city, $province_id, $country_id, $cl_postal_code, $cl_phone_number, $cl_email_address, $contact_id));  
        
        redirect($redirect);
  
    }
?>    

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >

    <h3><b>Client : <?php  echo $client;   ?></b></h3>

    <p><a href="./admin-clients.php">Return to Client Dashboard</a> / <a href="<?php echo $redirect; ?>">View Client Information</a></p>

<div class="w3-third">
    
    <h3>Contact Information (<?php echo $client_id; ?>) </h3>   
    <label class="icclabel">Status</label><?php echo build_drop_down(CLST,$client_status) ?><br/><br/>    
    <label class="icclabel">Client Name</label><input name="client_name" value="<?php echo $client_name; ?>" /><br/><br/>   
    <label class="icclabel">Contact First Name</label><input name="cl_first_name" value="<?php echo $cl_first_name; ?>" /><br/><br/>
    <label class="icclabel">Contact Last Name</label><input name="cl_last_name" value="<?php echo $cl_last_name; ?>" /><br/><br/>
    <label class="icclabel">Phone Number</label><input name="cl_phone_number" value="<?php echo $cl_phone_number ?>" /><br/><br/>
    <label class="icclabel">Email</label><input name="cl_email_address" value="<?php echo $cl_email_address ?>" /><br/><br/>
    <label class="icclabel">Contact Method</label><?php echo build_drop_down(CNTC,$contact_id) ?><br/><br/>
    
    
</div>

<div class="w3-third">
  
    <h3>Location Information (<?php echo $location_id ?>)</h3>
    <label class="icclabel">Address 1</label><input name="cl_address1" value="<?php echo $cl_address1 ?>" /><br/><br/>
    <label class="icclabel">Address 2</label><input name="cl_address2" value="<?php echo $cl_address2 ?>" /><br/><br/>
    <label class="icclabel">City</label><input name="cl_city" value="<?php echo $cl_city ?>" /><br/><br/>
    <label class="icclabel">Province</label><?php echo build_drop_down(PROV,$province_id) ?><br/><br/>
    <label class="icclabel">Country</label><?php echo build_drop_down(CNTR,$country_id) ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="cl_postal_code" value="<?php echo $cl_postal_code  ?>" /><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />   
 
</div>

<div class="w3-third">    
   
</div>

</form>

</div>

<?php include("footer.php"); ?> 