<?php include("header.php"); 
    $conn = db_connect();
    $site_id = "";
     if (isset($_GET['site_id'])){		
        $site_id = $_GET['site_id'];       
    } else {
        redirect ("./admin-clientinfo.php");
    }
    $client_id = "";
    $location_id = "";
    $entry_method_id = "";
    $services_is = "";
    $requirements_id = "";
    $client_name = "";
    $client_first_name = "";
    $client_last_name = "";
    $client_full_name = "";
    $client = "";  
    $site_status = "";
    $service ="";
    $equip ="";

    $resultclient = pg_prepare($conn, "query_site_info", 'SELECT * FROM sites WHERE site_id = $1');
    $resultclient = pg_execute($conn, "query_site_info", array($site_id));     
    $location_id = trim(pg_fetch_result($resultclient, 'site_location_id'));
    $client_id = trim(pg_fetch_result($resultclient, 'site_client_id'));
    $site_status = trim(pg_fetch_result($resultclient, 'site_status'));
    
    $resultlocation = pg_prepare($conn, "query_location_info", 'SELECT * FROM client_locations WHERE location_id = $1');
    $resultlocation = pg_execute($conn, "query_location_info", array($location_id));     
    $client_first_name = trim(pg_fetch_result($resultlocation, 'client_first_name'));
    $client_last_name = trim(pg_fetch_result($resultlocation, 'client_last_name'));
    $client_address1 = trim(pg_fetch_result($resultlocation, 'client_address1'));
    $client_address2 = trim(pg_fetch_result($resultlocation, 'client_address2'));
    $city_id = trim(pg_fetch_result($resultlocation, 'city_id'));
    $province_id = trim(pg_fetch_result($resultlocation, 'province_id'));
    $country_id = trim(pg_fetch_result($resultlocation, 'country_id'));
    $client_postal_code = trim(pg_fetch_result($resultlocation, 'client_postal_code'));
    $client_phone_number = trim(pg_fetch_result($resultlocation, 'client_phone_number'));
    $client_email_address = trim(pg_fetch_result($resultlocation, 'client_email_address'));
    $contact_id = trim(pg_fetch_result($resultlocation, 'contact_id'));
   
    
    $entry_method_id = get_table_info(SIEN, 'entry_method_id', 'site_id', $site_id, 'entry_method_id');
    $client_name = get_table_info(CLNT, 'client_name', 'client_id', $client_id, 'client_name');
    $contract_start = get_table_info(CONT, 'contract_start_date', 'site_id', $site_id, 'contract_start_date');
    $contract_end = get_table_info(CONT, 'contract_end_date', 'site_id', $site_id, 'contract_end_date');
    $staff_requirements = get_table_info(CONT, 'required_staff', 'site_id', $site_id, 'required_staff');
    $service = get_table_info(CONT, 'required_services', 'site_id', $site_id, 'required_services');
    $equip = get_table_info(CONT, 'required_equipment', 'site_id', $site_id, 'required_equipment');
    $contract_create_date = get_table_info(CONT, 'contract_create_date', 'site_id', $site_id, 'contract_create_date');
    
   
    $client_full_name = $client_last_name . ", ". $client_first_name;
    $client = ($client_name == "")?$client_full_name:$client_name   ; 
    
?>  

<div class="w3-row-padding">

    
<div class="w3-third">
    
    <div class="notes">
    <h1>Site : <?php echo $client . "(".$site_id.")"; ?></h1><hr/>    
    <h3><a class="dash" href="./admin-clients.php">Client Dashboard</a> / <a class="dash" href="./admin-clientview.php?client_id=<?php echo $client_id; ?> ">Return to Client Information </a> / <a class="dash"  href="./admin-sitesupdate.php?site_id=<?php echo $site_id; ?> ">Edit Site Information </a></h3><br/>
    <h2>Contact Information</h2><hr/>
    <label class="icclabel">Client ID</label><?php echo $client_id; ?><br/><br/>
    <label class="icclabel">Site Status</label><label><?php echo get_property(STST, $site_status); ?></label><br/><br/> 
    <label class="icclabel">Client Name</label><label><?php echo $client_name; ?></label><br/><br/>
    <label class="icclabel">Location ID</label><label><?php echo $location_id ?></label><br/><br/>
    <label class="icclabel">Contact Name</label><label><?php echo $client_full_name ; ?></label><br/><br/>
    <label class="icclabel">Phone Number</label><label><?php echo display_phone_number($client_phone_number); ?></label><br/><br/>
    <label class="icclabel">Email</label><label><?php echo $client_email_address; ?></label><br/><br/>
    <label class="icclabel">Contact Method</label><label><?php echo get_property(CNTC, $contact_id); ?></label><br/><br/>
    </div>
    
</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">
    <h2>Site Information</h2><hr/>
    <label class="icclabel">Address 1</label><label><?php echo $client_address1 ?></label><br/><br/>
    <label class="icclabel">Address 2</label><label><?php echo $client_address2 ?></label><br/><br/>
    <label class="icclabel">City</label><label><?php echo $city_id ?></label><br/><br/>
    <label class="icclabel">Province</label><label><?php echo get_property(PROV, $province_id); ?></label><br/><br/>
    <label class="icclabel">Country</label><label><?php echo get_property(CNTR, $country_id); ?></label><br/><br/>
    <label class="icclabel">Postal Code</label><label><?php echo $client_postal_code ?></label><br/><br/>
    <label class="icclabel">Site Entry</label><label><?php echo get_property(ENTR, $entry_method_id); ?></label><br/><br/>
    <h2>Site Contract</h2><hr/>
    <label class="icclabel"> Contract Created</label><label><?php echo $contract_create_date ?></label><br/>    
    <label class="icclabel"> Contract Start Date</label><label><?php echo $contract_start ?></label><br/>    
    <label class="icclabel"> Contract End Date</label><label><?php echo $contract_end ?></label><br/><br/>
    </div>
     
</div>

<div class="w3-third">
    
    <br/><br/>  
    <div class="notes">
    <h2><a class="dash" href="./admin-sitespecifications.php?site_id=<?php echo $site_id; ?> ">Site Specifications</a></h2><hr/>
    <p>Staff Requirements</p>
    <label class="icclabel">Required Staff</label><label><?php echo $staff_requirements ?></label>
    <h3>Services Required</h3> 
    <?php view_check_bit_services(SRVC,"service", $service) ?>
    <h3>Equipment Required</h3>
    <?php view_check_bit_equip(SPEQ,"equip", $equip) ?><br/>        
    </div>
    
</div>

</div>

<?php include("footer.php"); ?> 