<?php include("header.php"); ?>  

<?php
$conn = db_connect();
    $site_id = "";
     if (isset($_GET['site_id'])){		
        $site_id = $_GET['site_id']; 
        $_SESSION['site_id'] = $site_id;
    } else {
        //redirect ("./admin-clientinfo.php");
    }
    $redirect = "";
    $location_id = "";
    $client_id = "";
    $assessment_id = "";
    $la_staff_number = "";
    $equip = "";
    $equipment = "";
    $rows= "";
    $contract_id ="";
    $requirements_id = "";
    $contract_requirements = "";
    $contract_create_date="";
    $contract_start_date = "";
    $contract_end_date = "";
    $required_staff = "";
    $service = "";
    $services = "";
    $isCurrentContract = "";
    
  
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        $isCurrentContract = false;
        $resultsites = pg_prepare($conn, "query_sites", 'SELECT * FROM sites WHERE site_id = $1');
        $resultsites = pg_execute($conn, "query_sites", array($site_id));     
        $client_id = trim(pg_fetch_result($resultsites, 'site_client_id'));
        $_SESSION['client_id'] = $client_id;
        $location_id = trim(pg_fetch_result($resultsites, 'site_location_id')); 
        $_SESSION['location_id'] = $location_id;
        
        $resultsitesass = pg_prepare($conn, "query_site_assess", 'SELECT * FROM location_assessment WHERE location_id = $1');
        $resultsitesass = pg_execute($conn, "query_site_assess", array($location_id));     
        $la_staff_number = trim(pg_fetch_result($resultsitesass, 'la_staff_number'));
        $_SESSION['la_staff_number'] = $la_staff_number;
    
        $site_id = $_SESSION['site_id'];
        $resultscontract = pg_prepare($conn, "query_client_contract", 'SELECT * FROM client_contracts WHERE site_id = $1');
        $resultscontract = pg_execute($conn, "query_client_contract", array($site_id));     
        $rows = pg_num_rows($resultscontract);
		if ($rows == 0){
			$sql = "SELECT * FROM client_contracts ORDER by contract_id DESC LIMIT 1";
            $result 	= pg_query($conn, $sql);
            $records 	= pg_num_rows($result);
            $new_id = pg_fetch_result($result, "contract_id");       
            $clt_number = substr($new_id, 4, 6);
            $clt_number = $clt_number + 1;
            $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
            $contract_id = substr($new_id, 0, 3);
            $contract_id .= $clt_number;
            $_SESSION['contract_id'] = $contract_id;
            $contract_requirements = "";
            $contract_create_date="";
            $contract_start_date = "";
            $contract_end_date = "";
            $required_staff = "";
            $isCurrentContract = false;
		} else {
			$contract_id = trim(pg_fetch_result($resultscontract, 'contract_id'));
            $required_staff = trim(pg_fetch_result($resultscontract, 'required_staff'));
            $service = trim(pg_fetch_result($resultscontract, 'required_services'));
            $equip = trim(pg_fetch_result($resultscontract, 'required_equipment'));
            $_SESSION['contract_id'] = $contract_id;
            $_SESSION['requirements_id'] = $requirements_id;
            
            $contract_requirements = trim(pg_fetch_result($resultscontract, 'contract_requirements'));
            $contract_create_date = trim(pg_fetch_result($resultscontract, 'contract_create_date'));
            $contract_start_date = trim(pg_fetch_result($resultscontract, 'contract_start_date'));
            $contract_end_date = trim(pg_fetch_result($resultscontract, 'contract_end_date'));              
           
            $isCurrentContract = true;
		}
        $_SESSION['isCurrentContract'] = $isCurrentContract;
        $services = "";
        $equipment = "";
        $redirect = "./admin-sitespecifications.php?site_id=".$site_id;
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $isCurrentContract = $_SESSION['isCurrentContract'];
        $client_id = $_SESSION['client_id'];
        $site_id = $_SESSION['site_id'];
        $contract_id = $_SESSION['contract_id'];
        $requirements_id = $_SESSION['requirements_id'];
        $location_id = $_SESSION['location_id'];
        $la_staff_number = $_SESSION['la_staff_number'] ;
        $required_staff = trim($_POST['required_staff']);
        $contract_create_date = trim($_POST['contract_create_date']);
        $contract_start_date = trim($_POST['contract_start_date']);
        $contract_end_date = trim($_POST['contract_end_date']);
        $contract_requirements = trim($_POST['contract_requirements']);
        
        if (!isset ($_POST['equip'])) {
			$equip = "";
		}else{
            $equipment = ($_POST['equip']);
			$equip = ($_POST['equip']);
			$equip = sumCheckBox ($equip);
			$_SESSION['equip'] = $equip;			
		}
        
        if (!isset ($_POST['service'])) {
			$service = "";
            
		}else{
            
            $services = ($_POST['service']);
			$service = ($_POST['service']);
			$service = sumCheckBox ($service);
            
			$_SESSION['service'] = $service;			
		}    
        if ($isCurrentContract == false){
            $resultscontract = pg_prepare($conn, "contract_insert", 'INSERT into client_contracts (contract_id, site_id, contract_requirements, contract_create_date, contract_start_date, contract_end_date, required_services, required_equipment, required_staff) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)');        
            $resultscontract = pg_execute($conn, "contract_insert", array($contract_id, $site_id, $contract_requirements, $contract_create_date, $contract_start_date, $contract_end_date, $service, $equip, $required_staff));
        } else {
            $resultscontract = pg_prepare($conn, "contract_insert", 'UPDATE client_contracts SET site_id=$2, contract_requirements=$3, contract_create_date=$4, contract_start_date=$5, contract_end_date=$6, required_services=$7, required_equipment=$8, required_staff=$9 WHERE contract_id = $1');
            $resultscontract = pg_execute($conn, "contract_insert", array($contract_id, $site_id, $contract_requirements, $contract_create_date, $contract_start_date, $contract_end_date, $service, $equip, $required_staff)); 
        }       
        
        $redirect = "./admin-sitespecifications.php?site_id=".$site_id;
        //redirect($redirect);
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
    
    function toggleservice(source) {
		checkboxes = document.getElementsByName('service[]');
		for(i = 0; i < checkboxes.length; i++)
		{
			checkboxes[i].checked = source.checked;
		}
	}
		
//-->
</script>
<div class="w3-row-padding">

    <h2><b>Site Specifications :<?php echo $isCurrentContract ?></b></h2>
    
    <p><a href="./admin-sitesinfo.php?site_id=<?php echo $site_id; ?> ">Return to Site Information </a></a>
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="w3-third">

    <h3>Assessment Details</h3>
    <label class="icclabel">Client ID</label><label><?php echo $client_id ?></label><br/><br/>
    <label class="icclabel">Location ID</label><label><?php echo $location_id ?></label><br/><br/>
    <label class="icclabel">Required Staff</label><label><?php echo $la_staff_number ?></label><br/><br/>
    <label class="icclabel">Equipment Required</label><br/>   
    <br/><?php build_label_list_equip(SPEQ,"equipment") ?><br/>
    <h3>Contract</h3>
    <label class="icclabel">Contract ID</label><label><?php echo $contract_id ?></label><br/><br/>
    <label class="icclabel">Date Format</label><label class="icclabel">YYYY-MM-DD</label><br/>
    <label class="icclabel">Contract Date</label><input name="contract_create_date" value="<?php echo $contract_create_date ?>"></input><br/><br/>
    <label class="icclabel">Start Date</label><input name="contract_start_date" value="<?php echo $contract_start_date ?>"></input><br/><br/>
    <label class="icclabel">End Date</label><input name="contract_end_date" value="<?php echo $contract_end_date ?>"></input><br/><br/>
    
</div>

<div class="w3-third">  
    
    <h3>Site Requirements</h3>
    <label class="icclabel">Number of Staff</label><input name="required_staff" value="<?php echo $required_staff ?>"></input><br/><br/>
    <h3>Services Required</h3><br/>
    <label class="icclabel">Select All</label><input type="checkbox"  onclick="toggleservice(this);" name="service[]" value="0"/>
    <br/><?php build_check_bit_services(SRVC,"service", $service) ?>
    <h3>Equipment Required</h3><br/>
    <label class="icclabel">Select All</label><input type="checkbox"  onclick="toggle(this);" name="equip[]" value="0"/>
    <br/><?php build_check_bit_equip(SPEQ,"equip", $equip) ?><br/>
    <h3>Contract Notes</h3>
    <textarea name="contract_requirements" rows="4" cols="45"><?php echo $contract_requirements; ?></textarea><br/><br/>
 
</div>

<div class="w3-third">
  
    <h3>Cleaning Schedule</h3>
    <label class="icclabel">Sunday</label><input></input><br/><br/>
    <label class="icclabel">Monday</label><input></input><br/><br/>
    <label class="icclabel">Tuesday</label><input></input><br/><br/>
    <label class="icclabel">Wednesday</label><input></input><br/><br/>
    <label class="icclabel">Thursday</label><input></input><br/><br/>
    <label class="icclabel">Friday</label><input></input><br/><br/>
    <label class="icclabel">Saturday</label><input></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  /> 
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 