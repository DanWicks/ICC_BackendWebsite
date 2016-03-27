<?php include("header.php"); 
    $client_id = "";
    $location_id = "";
    $client_name = "";
    $client_first_name = "";
    $client_last_name = "";
    $client_full_name = "";
    $client = "";
    if (isset($_GET['client_id'])){		
        $client_id = $_GET['client_id'];  
        $_SESSION['check_client_id'] = $client_id;        
    } else {
        redirect ("./admin-clientinfo.php");
    }
    $redirect = ("./admin-clientupdate.php?client_id=".$client_id); 	
    $location_id = get_table_info(CLNT, 'location_id', 'client_id', $client_id, 'location_id');
    $client_status = get_table_info(CLNT, 'client_status', 'client_id', $client_id, 'client_status');
    $_SESSION['check_location_id'] = $location_id;
    $client_name = get_table_info(CLNT, 'client_name', 'client_id', $client_id, 'client_name');
    $client_first_name = get_table_info(LOCA, 'client_first_name', 'location_id', $location_id, 'client_first_name');
    $client_last_name = get_table_info(LOCA, 'client_last_name', 'location_id', $location_id, 'client_last_name');
    $client_full_name = $client_last_name . ", ". $client_first_name;
    $client = ($client_name == "")?$client_full_name:$client_name   ;  
?>  

<div class="w3-row-padding">    

<div class="w3-third">
    
    <div class="notes">
    <h1>Contact Information</h1><hr/>   
    <h3><a class="dash" href="./supervisor-clients.php">Client Listings</a></h3><br/>
    <h2>Client : <?php  echo $client;   ?></h2><hr/>
    <label class="icclabel">Client ID</label><?php echo $client_id; ?><br/><br/>
    <label class="icclabel">Client Status</label><?php echo get_property(CLST, $client_status); ?><br/><br/>
    <label class="icclabel">Client Name</label><label><?php echo $client_name; ?></label><br/><br/>
    <label class="icclabel">Location ID</label><label><?php echo $location_id ?></label><br/><br/>
    <label class="icclabel">Contact Name</label><label><?php echo $client_full_name; ?></label><br/><br/>
    <label class="icclabel">Phone Number</label><label><?php echo display_phone_number(get_table_info(LOCA, 'client_phone_number', 'location_id', $location_id, 'client_phone_number')); ?></label><br/><br/>
    <label class="icclabel">Email</label><label><?php echo get_table_info(LOCA, 'client_email_address', 'location_id', $location_id, 'client_email_address'); ?></label><br/><br/>
    <label class="icclabel">Contact Method</label><label><?php echo get_property(CNTC, get_table_info(LOCA, 'contact_id', 'location_id', $location_id, 'contact_id')); ?></label><br/></div><br/>
    
    
</div>

<div class="w3-third">
    
    <br/>
    <div class="notes">
    <h2>Location Information</h2><hr/>
    <label class="icclabel">Address 1</label><label><?php echo get_table_info(LOCA, 'client_address1', 'location_id', $location_id, 'client_address1'); ?></label><br/><br/>
    <label class="icclabel">Address 2</label><label><?php echo get_table_info(LOCA, 'client_address2', 'location_id', $location_id, 'client_address2'); ?></label><br/><br/>
    <label class="icclabel">City</label><label><?php echo get_table_info(LOCA, 'city_id', 'location_id', $location_id, 'city_id'); ?></label><br/><br/>
    <label class="icclabel">Province</label><label><?php echo get_property(PROV, get_table_info(LOCA, 'province_id', 'location_id', $location_id, 'province_id')); ?></label><br/><br/>
    <label class="icclabel">Country</label><label><?php echo get_property(CNTR, get_table_info(LOCA, 'country_id', 'location_id', $location_id, 'country_id')); ?></label><br/><br/>
    <label class="icclabel">Postal Code</label><label><?php echo get_table_info(LOCA, 'client_postal_code', 'location_id', $location_id, 'client_postal_code'); ?></label><br/><br/>
    </div>

   
    
</div>

<div class="w3-third">
    
    <br/>
    <div class="notes">
    <h2>Cleaning Sites Information</h2><hr/>
    <?php echo builSuperSitesTable($client_id); ?>    
    </div>
    
    <div class="notes">
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts"/>      
    </div>
    
</div>

</div>

<?php include("footer.php"); ?> 