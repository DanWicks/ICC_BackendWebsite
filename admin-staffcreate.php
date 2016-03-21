<?php include("header.php"); ?>  

<?php
    $staff_id = ""; 
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
    $clt_number = "";
    $result = "";
    $records = "";
    $sql ="";
    $new_id = "";
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){ 
        $sql = "SELECT * FROM staff ORDER by staff_id DESC LIMIT 1";
		$result 	= pg_query($conn, $sql);
		$records 	= pg_num_rows($result);
        $new_id = pg_fetch_result($result, "staff_id");       
        $clt_number = substr($new_id, 4, 6);
        $clt_number = $clt_number + 1;
        $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
        $staff_id = substr($new_id, 0, 3);
        $staff_id .= $clt_number;
        $_SESSION['create_staff_id'] = $staff_id;
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
        $redirect = ("./admin-staffview.php?staff_id=".$staff_id);  
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $staff_id = $_SESSION['create_staff_id']; 		
        $password = trim($_POST["password"]); 
        $firstname = trim($_POST["firstname"]); 
        $lastname = trim($_POST["lastname"]); 
        $address1 = trim($_POST["address1"]); 
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
        $redirect = ("./admin-staffview.php?staff_id=".$staff_id);  
             
        $result = pg_prepare($conn, "user_insert_query", 'INSERT INTO staff (staff_id, staff_password, staff_first, staff_last, staff_address1, staff_address2, city_id, province_id, country_id, staff_postal, staff_phone, staff_email, staff_type_id, staff_status_id, contact_id, staff_wage) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16)');
		$result = pg_execute($conn, "user_insert_query", array($staff_id, $password,$firstname, $lastname, $address1, $address2, $city, $province , $countries,  $postalcode, $phonenumber, $emailaddress, $stafftype, $staffstatus, $contact_methods, $staff_wage));	    
                
        redirect($redirect);
    }      
?>

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
 
    <h2><b>Enter New Staff Information</b></h2>  
    
    <p><a href="./admin-staff.php">Return to Staff Dashboard</a></p>
 
<div class="w3-third">
   
    <h3>Contact Information</h3>
    <br/>
    <label class="icclabel">First Name</label><input name="firstname"></input><br/><br/>
    <label class="icclabel">Last Name</label><input name="lastname"></input><br/><br/>
    <label class="icclabel">Phone Number</label><input name="phonenumber"></input><br/><br/>
    <label class="icclabel">Email Address</label><input name="emailaddress"></input><br/><br/>
    <label class="icclabel">Contact Method</label><?php build_drop_down(CNTC, $contact_methods); ?><br/><br/>
    
</div>

<div class="w3-third">
        
    <h3>Staff Address</h3>
    <br/>
    <label class="icclabel">Address</label><input name="address1"></input><br/><br/>
    <label class="icclabel">Address</label><input name="address2"></input><br/><br/>
    <label class="icclabel">City</label><input name="city"></input><br/><br/>
    <label class="icclabel">Province</label><?php build_drop_down(PROV, $province); ?><br/><br/>
    <label class="icclabel">Country</label><?php build_drop_down(CNTR, $countries); ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="postalcode"></input><br/><br/>
        
</div>

<div class="w3-third">
       
    <h3>I.C.C. Information</h3>
    <br/>
    <label class="icclabel">Staff ID</label><label name="staff_id" value="<?php echo $staff_id ?>"><?php echo $staff_id ?></label><br/><br/>  
    <label class="icclabel">Staff Status</label><?php build_drop_down(STAT, $staffstatus); ?><br/><br/>  
    <label class="icclabel">Staff Type</label><?php build_drop_down(TYPE, $stafftype); ?><br/><br/>
    <label class="icclabel">Salary/Wage</label><input name="staff_wage"></input><br/><br/>      
    <label class="icclabel">Password</label><input name="password"></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
    <br/>
    
</div>

</div>

</form>

<?php include("footer.php"); ?> 