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
    } else {
        redirect (ADMNSTIN);
    }    
?> 

<?php  
    $staff_id = $_SESSION['check_staff_id'];
    $redirect = ("./admin-staffview.php?staff_id=".$staff_id); 
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
        $staff_id = $_SESSION['check_staff_id'];
        $resultname = pg_prepare($conn, "query_staff_update", 'SELECT * FROM staff WHERE staff_id = $1');
        $resultname = pg_execute($conn, "query_staff_update", array($staff_id));
        $staff_id = trim(pg_fetch_result($resultname, 'staff_id'));
        $password = trim(pg_fetch_result($resultname, 'staff_password'));
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
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
       	$staff_id = $_SESSION['check_staff_id'];
        $password = trim($_POST["password"]); 
        $firstname = trim($_POST["firstname"]); 
        $lastname = trim($_POST["lastname"]); 
        $address1 = trim($_POST["address1"]); 
        $address2 = trim($_POST["address2"]); 
        $city = trim($_POST["city"]); 
        $province = trim($_POST["provinces"]); 
        $countries = trim($_POST["countries"]); 
        $postalcode = trim($_POST["postalcode"]); 
        $phonenumber = trim($_POST["phonenumber"]); 
        $emailaddress = trim($_POST["emailaddress"]); 
        $stafftype = trim($_POST["staff_type"]); 
        $staffstatus = trim($_POST["staff_status"]);
        $contact_methods = trim($_POST["contact_methods"]); 
        $staff_wage = trim($_POST["staff_wage"]); 
              
        
        $result = pg_prepare($conn, "user_insert_query", 'UPDATE staff SET staff_password=$2, staff_first=$3, staff_last=$4, staff_address1=$5, staff_address2=$6, city_id=$7, province_id=$8, country_id=$9, staff_postal=$10, staff_phone=$11, staff_email=$12, staff_type_id=$13, staff_status_id=$14, contact_id=$15, staff_wage=$16 WHERE staff_id = $1');
		$result = pg_execute($conn, "user_insert_query", array($staff_id, $password,$firstname, $lastname, $address1, $address2, $city, $province , $countries,  $postalcode, $phonenumber, $emailaddress, $stafftype, $staffstatus, $contact_methods, $staff_wage));	    
                
        redirect($redirect);
    }      
?>

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
 
    

<div class="w3-third">
    
    <div class="notes">
    <h1>Update Staff Information</h1><hr/>  
    <h3><a class="dash" href="./admin-staff.php">Return to Staff Dashboard</a> / <a class="dash" href="<?php echo $redirect; ?>">View Information</a></h3><br/> 
    <h2>I.C.C. Information</h2><hr/>
    <br/>
    <label class="icclabel">Staff ID</label><label name="staff_id"><?php echo $_SESSION['check_staff_id']; ?></label><br/><br/>  
    <label class="icclabel">Staff Status</label><?php build_drop_down(STAT, $staffstatus); ?><br/><br/>  
    <label class="icclabel">Staff Type</label><?php build_drop_down(TYPE, $stafftype); ?><br/><br/>
    <label class="icclabel">Salary/Wage</label><input name="staff_wage" value="<?php echo $staff_wage ?>"></input><br/><br/>  
    <label class="icclabel">Password</label><input type="password" name="password" value="<?php echo $password ?>"></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />
    </div>
    <br/>
    
</div>
    
<div class="w3-third">
   
    <div class="notes">
    <br/><br/><br/><br/>
    <h2>Contact Information</h2><hr/>
    <br/>
    <label class="icclabel">First Name</label><input name="firstname" value="<?php echo $firstname ?>"><br/><br/>
    <label class="icclabel">Last Name</label><input name="lastname" value="<?php echo $lastname ?>"></input><br/><br/>
    <label class="icclabel">Phone Number</label><input name="phonenumber" value="<?php echo $phonenumber ?>"></input><br/><br/>
    <label class="icclabel">Email Address</label><input name="emailaddress" value="<?php echo $emailaddress ?>"></input><br/><br/>
    <label class="icclabel">Contact Method</label><?php build_drop_down(CNTC, $contact_methods); ?><br/><br/>    
    </div>
    
</div>

<div class="w3-third">
    
    <div class="notes">
    <br/><br/><br/><br/>
    <h2>Staff Address</h2><hr/>
    <br/>
    <label class="icclabel">Address</label><input name="address1" value="<?php echo $address1 ?>"></input><br/><br/>
    <label class="icclabel">Address</label><input name="address2" value="<?php echo $address2 ?>"></input><br/><br/>
    <label class="icclabel">City</label><input name="city" value="<?php echo $city ?>"></input><br/><br/>
    <label class="icclabel">Province</label><?php build_drop_down(PROV, $province); ?><br/><br/>
    <label class="icclabel">Country</label><?php build_drop_down(CNTR, $countries); ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="postalcode" value="<?php echo $postalcode ?>"></input><br/><br/>
    </div>
    
</div>

</form>

</div>

<?php include("footer.php"); ?> 