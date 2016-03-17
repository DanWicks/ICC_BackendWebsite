<?php include("header.php");     
    if (isset($_GET['sub_menu'])){
		$SubMenu = isset($_GET['sub_menu'])?($_GET['sub_menu']):'E';
		$_SESSION['sub_menu'] = $SubMenu;
        $_SESSION['dashboard'] = "Staff Information";
        redirect ("./admin-staff.php");
	}
    $staff_id = "";
    
    if (isset($_GET['staff_id'])){		
        $staff_id = $_GET['staff_id'];
        $_SESSION['check_staff_id'] = $staff_id;
    } else {
        redirect (ADMNSTIN);
    }
    $redirect = ("./admin-staffupdate.php?staff_id=".$staff_id); 	
?> 

<?php    	
    $password = "";
    $firstname = "";
    $lastname = "";
    $address1 = "";
    $address2 = "";
    $city = "";	
    $province = "";
    $countries = "";
    $postalcode = "";
    $phonenumber = "";
    $emailaddress = "";  
    $staffstatus = "";
    $stafftype = "";
    $contact_methods = "";
    $staff_wage = "";
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){  
        $resultname = pg_prepare($conn, "query_staff_update", 'SELECT * FROM staff WHERE staff_id = $1');
        $resultname = pg_execute($conn, "query_staff_update", array($staff_id));
     		
        $password = trim(pg_fetch_result($resultname, 'staff_first'));
        $firstname = trim(pg_fetch_result($resultname, 'staff_first'));
        $lastname = trim(pg_fetch_result($resultname, 'staff_last'));
        $address1 = trim(pg_fetch_result($resultname, 'staff_address1'));
        $address2 = trim(pg_fetch_result($resultname, 'staff_address2'));
        $city = trim(pg_fetch_result($resultname, 'city_id'));
        $province = trim(pg_fetch_result($resultname, 'province_id'));
        $countries = trim(pg_fetch_result($resultname, 'country_id'));
        $postalcode = trim(pg_fetch_result($resultname, 'staff_postal'));
        $phonenumber = trim(pg_fetch_result($resultname, 'staff_phone'));
        $emailaddress = trim(pg_fetch_result($resultname, 'staff_email'));
        $staffstatus = trim(pg_fetch_result($resultname, 'staff_status_id'));
        $stafftype = trim(pg_fetch_result($resultname, 'staff_type_id'));
        $contact_methods = trim(pg_fetch_result($resultname, 'contact_id'));
        $staff_wage = trim(pg_fetch_result($resultname, 'staff_wage'));
    }
?>

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
 
    <h2>Update Staff Information</h2>  

<div class="w3-third">
    
    <p><a href="./admin-staff.php">Return to Staff Dashboard</a> / <a href="<?php echo $redirect; ?>">Update Information</a><br/></p> 
    <h3>I.C.C. Information</h3>
    <br/>
    <label class="icclabel">Staff ID</label><label><?php echo $staff_id ?></label><br/><br/>  
    <label class="icclabel">Staff Status</label><?php echo get_property(STAT, $staffstatus); ?><br/><br/>  
    <label class="icclabel">Staff Type</label><?php echo get_property(TYPE, $stafftype); ?><br/><br/>
    <label class="icclabel">Salary/Wage</label><label name="staff_wage"><?php echo $staff_wage ?></label><br/><br/>  
    <label class="icclabel">Password</label><label type="password" name="password"><?php echo $password ?></label><br/><br/>       
    <br/>
    
</div>
    
<div class="w3-third">
   
    <br/><br/>
    <h3>Contact Information</h3>
    <br/>
    <label class="icclabel">First Name</label><label name="firstname"><?php echo $firstname ?><br/><br/>
    <label class="icclabel">Last Name</label><label name="lastname" ><?php echo $lastname ?></label><br/><br/>
    <label class="icclabel">Phone Number</label><label name="phonenumber" ><?php echo $phonenumber ?></label><br/><br/>
    <label class="icclabel">Email Address</label><label name="emailaddress"><?php echo $emailaddress ?></label><br/><br/>
    <label class="icclabel">Contact Method</label><?php echo get_property(CNTC, $contact_methods); ?><br/><br/>    
    
</div>

<div class="w3-third">
        
    <br/><br/>
    <h3>Staff Address</h3>
    <br/>
    <label class="icclabel">Address</label><label name="address1"><?php echo $address1 ?></label><br/><br/>
    <label class="icclabel">Address</label><label name="address2"><?php echo $address2 ?></label><br/><br/>
    <label class="icclabel">City</label><label name="city"><?php echo $city ?></label><br/><br/>
    <label class="icclabel">Province</label><?php echo get_property(PROV, $province); ?><br/><br/>
    <label class="icclabel">Country</label><?php echo get_property(CNTR, $countries); ?><br/><br/>
    <label class="icclabel">Postal Code</label><label name="postalcode" ><?php echo $postalcode ?></label><br/><br/>
        
</div>



</div>

<?php include("footer.php"); ?> 