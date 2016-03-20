<?php include("header.php"); 
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
    $client_id = get_table_info(SITE, 'site_client_id', 'site_id', $site_id, 'site_client_id');
    $location_id = get_table_info(SITE, 'site_location_id', 'site_id', $site_id, 'site_location_id');
    $requirements_id = get_table_info(CONT, 'requirements_id', 'site_id', $site_id, 'requirements_id');
    $entry_method_id = get_table_info(SIEN, 'entry_method_id', 'site_id', $site_id, 'entry_method_id');
    $location_id = get_table_info(CLNT, 'location_id', 'client_id', $client_id, 'location_id');
    $client_name = get_table_info(CLNT, 'client_name', 'client_id', $client_id, 'client_name');
    $client_first_name = get_table_info(LOCA, 'client_first_name', 'location_id', $location_id, 'client_first_name');
    $client_last_name = get_table_info(LOCA, 'client_last_name', 'location_id', $location_id, 'client_last_name');
    $client_full_name = $client_last_name . ", ". $client_first_name;
    $client = ($client_name == "")?$client_full_name:$client_name   ; 
    
?>  

<div class="w3-row-padding">

    <h3><b>Site : <?php echo $client . "(".$site_id.")"; ?></b></h3>
    
    <p><a href="./admin-clients.php">Client Dashboard</a> / <a href="./admin-clientview.php?client_id=<?php echo $client_id; ?> ">Return to Client Information </a> / <a href="./admin-sitesupdate.php?site_id=<?php echo $site_id; ?> ">Edit Site Information </a></p>

<div class="w3-third">
    
    
    <h3>Contact Information</h3>
    <label class="icclabel">Client ID</label><?php echo $client_id; ?><br/><br/>
    <label class="icclabel">Client Name</label><label><?php echo $client_name; ?></label><br/><br/>
    <label class="icclabel">Location ID</label><label><?php echo $location_id ?></label><br/><br/>
    <label class="icclabel">Contact Name</label><label><?php echo $client_full_name ; ?></label><br/><br/>
    <label class="icclabel">Phone Number</label><label><?php echo display_phone_number(get_table_info(LOCA, 'client_phone_number', 'location_id', $location_id, 'client_phone_number')); ?></label><br/><br/>
    <label class="icclabel">Email</label><label><?php echo get_table_info(LOCA, 'client_email_address', 'location_id', $location_id, 'client_email_address'); ?></label><br/><br/>
    <label class="icclabel">Contact Method</label><label><?php echo get_property(CNTC, get_table_info(LOCA, 'contact_id', 'location_id', $location_id, 'contact_id')); ?></label><br/><br/>
    
</div>

<div class="w3-third">

    <h3>Location Information</h3>
    <label class="icclabel">Address 1</label><label><?php echo get_table_info(LOCA, 'client_address1', 'location_id', $location_id, 'client_address1'); ?></label><br/><br/>
    <label class="icclabel">Address 2</label><label><?php echo get_table_info(LOCA, 'client_address2', 'location_id', $location_id, 'client_address2'); ?></label><br/><br/>
    <label class="icclabel">City</label><label><?php echo get_table_info(LOCA, 'city_id', 'location_id', $location_id, 'city_id'); ?></label><br/><br/>
    <label class="icclabel">Province</label><label><?php echo get_property(PROV, get_table_info(LOCA, 'province_id', 'location_id', $location_id, 'province_id')); ?></label><br/><br/>
    <label class="icclabel">Country</label><label><?php echo get_property(CNTR, get_table_info(LOCA, 'country_id', 'location_id', $location_id, 'country_id')); ?></label><br/><br/>
    <label class="icclabel">Postal Code</label><label><?php echo get_table_info(LOCA, 'client_postal_code', 'location_id', $location_id, 'client_postal_code'); ?></label><br/><br/>
     <label class="icclabel">Site Entry</label><label><?php echo get_property(ENTR, $entry_method_id); ?></label><br/><br/>
     
</div>

<div class="w3-third">
    
    <h3>Site Specifications</h3>
    <p><a href="./admin-clientcontracts.php?site_id=<?php echo $site_id; ?> ">Site Contracts</a></p>
    <label class="icclabel"> Contract Start Date</label><label><?php echo get_table_info(CONT, 'contract_start_date', 'site_id', $site_id, 'contract_start_date'); ?></label><br/>    
    <label class="icclabel"> Contract End Date</label><label><?php echo get_table_info(CONT, 'contract_end_date', 'site_id', $site_id, 'contract_end_date'); ?></label><br/>
    
    <p><a href="./admin-siterequirements.php?site_id=<?php echo $site_id; ?> ">Site Requirements</a></p>
    <label class="icclabel">Required Staff</label><label><?php echo get_table_info(SITR, 'sr_staff_number', 'requirements_id', $requirements_id, 'sr_staff_number'); ?></label>
    
    <p><a href="./admin-servicesreq.php?site_id=<?php echo $site_id; ?> ">Services Required</a></p>
    <?php echo buildSiteServiceTable($site_id); ?>
    
    <p><a href="./admin-equipmentreq.php?site_id=<?php echo $site_id; ?> ">Equipment Required</a></p>
    <?php echo buildSiteEquipmentTable($requirements_id); ?>
    
    <p><a href="./admin-assessments.php?site_id=<?php echo $site_id; ?> ">Site Assessment</a></p>
 
</div>

</div>

<?php include("footer.php"); ?> 