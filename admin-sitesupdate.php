<?php 
    include("header.php");   
?>

<?php
    $conn = db_connect();
    $site_id = "";  
    $client_id = "";
    $client_full_name = "";    
    $location_id ="";
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
    $client_last_name = "";
    $client_first_name = "";
    $site_status = "";
    $redirect = ("./admin-clientview.php?client_id=".$client_id);
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){  
        $site_id = $_GET['site_id'];
        $_SESSION['edit_site'] = $site_id;
        
        $resultsite = pg_prepare($conn, "query_site_info", 'SELECT * FROM sites WHERE site_id = $1');
        $resultsite = pg_execute($conn, "query_site_info", array($site_id));     
        $location_id = trim(pg_fetch_result($resultsite, 'site_location_id'));
        $client_id = trim(pg_fetch_result($resultsite, 'site_client_id'));
        $site_status = trim(pg_fetch_result($resultsite, 'site_status'));
        $_SESSION['client_id_site'] = $client_id;
        
        $resultclient = pg_prepare($conn, "query_client_info", 'SELECT * FROM clients WHERE client_id = $1');
        $resultclient = pg_execute($conn, "query_client_info", array($client_id));   
        $client_name = trim(pg_fetch_result($resultclient, 'client_name'));
        $_SESSION['location_id_site'] = $location_id;
        
        $resultlocation = pg_prepare($conn, "query_location_update", 'SELECT * FROM client_locations WHERE location_id = $1');
        $resultlocation = pg_execute($conn, "query_location_update", array($location_id));        
        $client_first_name = trim(pg_fetch_result($resultlocation, 'client_first_name'));  
        $client_last_name = trim(pg_fetch_result($resultlocation, 'client_last_name'));
        $cl_address1 = trim(pg_fetch_result($resultlocation, 'client_address1'));
        $cl_address2 = trim(pg_fetch_result($resultlocation, 'client_address2'));
        $cl_city = trim(pg_fetch_result($resultlocation, 'city_id'));
        $province_id = trim(pg_fetch_result($resultlocation, 'province_id'));
        $country_id = trim(pg_fetch_result($resultlocation, 'country_id'));
        $cl_postal_code = trim(pg_fetch_result($resultlocation, 'client_postal_code'));
        $cl_phone_number = trim(pg_fetch_result($resultlocation, 'client_phone_number'));
        $cl_email_address = trim(pg_fetch_result($resultlocation, 'client_email_address'));
        $contact_id = trim(pg_fetch_result($resultlocation, 'contact_id')); 
        $client_full_name = $client_last_name . ", ". $client_first_name;
        $client = ($client_name == "")?$client_full_name:$client_name   ;  
        $_SESSION['client_site_name'] = $client;
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        $client_id = $_SESSION['client_id_site'];
        $location_id = $_SESSION['location_id_site'];
        $client = $_SESSION['client_site_name'];
        $site_id = $_SESSION['edit_site'];   
        $site_status = trim($_POST["site_status"]);         
        $client_first_name = trim($_POST["cl_first_name"]); 
        $client_last_name = trim($_POST["cl_last_name"]); 
        $cl_address1 = trim($_POST["cl_address1"]); 
        $cl_address2 = trim($_POST["cl_address2"]); 
        $cl_city = trim($_POST["cl_city"]); 
        $province_id = trim($_POST["provinces"]); 
        $country_id = trim($_POST["countries"]); 
        $cl_postal_code = trim($_POST["cl_postal_code"]); 
        $cl_phone_number = trim($_POST["cl_phone_number"]); 
        $cl_email_address = trim($_POST["cl_email_address"]); 
        $contact_id = trim($_POST["contact_methods"]); 
        
       
        $result = pg_prepare($conn, "site_update_query", 'UPDATE sites SET site_status=$2 WHERE site_id = $1');
		$result = pg_execute($conn, "site_update_query", array($site_id, $site_status)); 
               
        $result = pg_prepare($conn, "user_insert_query", 'UPDATE client_locations SET client_first_name=$2, client_last_name=$3, client_address1=$4, client_address2=$5, city_id=$6, province_id=$7, country_id=$8, client_postal_code=$9, client_phone_number=$10, client_email_address=$11, contact_id=$12 WHERE location_id = $1');
		$result = pg_execute($conn, "user_insert_query", array($location_id, $client_first_name, $client_last_name, $cl_address1, $cl_address2, $cl_city, $province_id, $country_id, $cl_postal_code, $cl_phone_number, $cl_email_address, $contact_id));  
          
        redirect ("./admin-sitesinfo.php?site_id=".$site_id );
        //redirect ("./admin-sitesupdate.php?site_id=".$site_id );
    }
?> 

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >

<div class="w3-third">    
   
    <div class="notes">
    <h1>Site : <?php echo $client . "(".$site_id.")"; ?></h1><hr/>
    <h3><a class="dash" href="./admin-dashboard.php">Admin Home Page</a> / <a class="dash" href="./admin-clientview.php?client_id=<?php echo $client_id; ?> ">View Client </a> /  <a class="dash" href="./admin-sitesinfo.php?site_id=<?php echo $site_id; ?> ">View Site</a></h3><br/>
    <h2>Client Information</h2><hr/>
    <label class="icclabel">Status</label><?php echo build_drop_down(STST,$site_status  ) ?><br/><br/>    
    <label class="icclabel">Client ID</label><label name="client_id"><?php echo $client_id; ?></label><br/><br/>
    <label class="icclabel">Client Name</label><label><?php echo $client; ?></label><br/><br/>
    <label class="icclabel">Location ID</label><label><?php echo $location_id ?></label><br/><br/>   
    </div>
    
</div>

<div class="w3-third">
    
    <br/>
    <div class="notes">
    <h2>Contact Information</h2><hr/>  
    <label class="icclabel">Contact First Name</label><input name="cl_first_name" value="<?php echo $client_first_name; ?>" /><br/><br/>
    <label class="icclabel">Contact Last Name</label><input name="cl_last_name" value="<?php echo $client_last_name; ?>" /><br/><br/>
    <label class="icclabel">Phone Number</label><input name="cl_phone_number" value="<?php echo $cl_phone_number ?>" /><br/><br/>
    <label class="icclabel">Email</label><input name="cl_email_address" value="<?php echo $cl_email_address ?>" /><br/><br/>
    <label class="icclabel">Contact Method</label><?php echo build_drop_down(CNTC,$contact_id) ?><br/><br/>
    </div>
    
</div>

<div class="w3-third">

    <br/>
    <div class="notes"> 
    <h2>Location Information</h2><hr/>
    <label class="icclabel">Address 1</label><input name="cl_address1" value="<?php echo $cl_address1 ?>" /><br/><br/>
    <label class="icclabel">Address 2</label><input name="cl_address2" value="<?php echo $cl_address2 ?>" /><br/><br/>
    <label class="icclabel">City</label><input name="cl_city" value="<?php echo $cl_city ?>" /><br/><br/>
    <label class="icclabel">Province</label><?php echo build_drop_down(PROV,$province_id) ?><br/><br/>
    <label class="icclabel">Country</label><?php echo build_drop_down(CNTR,$country_id) ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="cl_postal_code" value="<?php echo $cl_postal_code  ?>" /><br/><br/>   
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />   
    </div>
    <br/>
     
</div>

<div class="w3-third">   
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 