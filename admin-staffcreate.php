<?php include("header.php"); ?>  

<?php
    $staff_id = ""; 		
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
        $staff_id = ""; 		
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
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $staff_id = trim($_POST["staff_id"]); 		
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
                
        $result = pg_prepare($conn, "user_insert_query", 'INSERT INTO staff (staff_id, staff_password, staff_first, staff_last, staff_address1, staff_address2, city_id, province_id, country_id, staff_postal, staff_phone, staff_email, staff_type_id, staff_status_id, contact_id, staff_wage) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14,$15,$16)');
		$result = pg_execute($conn, "user_insert_query", array($staff_id, $password,$firstname, $lastname, $address1, $address2, $city, $province , $countries,  $postalcode, $phonenumber, $emailaddress, $stafftype, $staffstatus, $contact_methods, $staff_wage));	    
                
        redirect(ADMNSTIN);
    }      
?>

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
 
    <h2>Enter New Staff Information</h2>  
 
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
    <label class="icclabel">Staff ID</label><input name="staff_id"></input><br/><br/>  
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