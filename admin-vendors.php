<?php include("header.php");
  $vendor_id = "";
  $update ="";
     if (isset($_GET['vendor_id'])){		
        $vendor_id = $_GET['vendor_id'];       
    } else {
        $vendor_id="";   
    }
   
    $redirect = ("./admin-vendors.php?vendor_id=".$vendor_id);     
    $vendor_name = "";
    $vendor_first = "";
    $vendor_last = "";
    $vendor_address1 = "";
    $vendor_address2 = "";
    $city_id = "";	
    $province_id = "";
    $country_id = "";
    $vendor_postal = "";
    $vendor_phone = "";
    $vendor_email = "";  
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
        
        if ($vendor_id == "") {  
            $_SESSION['update']=false;
            $sql = "SELECT * FROM vendor ORDER by vendor_id DESC LIMIT 1";
            $result 	= pg_query($conn, $sql);
            $records 	= pg_num_rows($result);
            $new_id = pg_fetch_result($result, "vendor_id");       
            $clt_number = substr($new_id, 4, 6);
            $clt_number = $clt_number + 1;
            $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
            $vendor_id = substr($new_id, 0, 3);
            $vendor_id .= $clt_number;
            $_SESSION['create_vendor_id'] = $vendor_id;
            $vendor_name = "";
            $vendor_first = "";
            $vendor_last = "";
            $vendor_address1 = "";
            $vendor_address2 = "";
            $city_id = "";	
            $province_id = "";
            $country_id = "";
            $vendor_postal = "";
            $vendor_phone = "";
            $vendor_email = "";           
            $contact_methods = "";  
        } else {
             $_SESSION['update']=true;
            $resultvendor = pg_prepare($conn, "query_vendor", 'SELECT * FROM vendor WHERE vendor_id = $1');
            $resultvendor = pg_execute($conn, "query_vendor", array($vendor_id)); 
            $_SESSION['create_vendor_id'] = $vendor_id;            
            $vendor_name = trim(pg_fetch_result($resultvendor, 'vendor_name')); 
            $vendor_first = trim(pg_fetch_result($resultvendor, 'vendor_first')); 
            $vendor_last = trim(pg_fetch_result($resultvendor, 'vendor_last')); 
            $vendor_address1 = trim(pg_fetch_result($resultvendor, 'vendor_address1')); 
            $vendor_address2 = trim(pg_fetch_result($resultvendor, 'vendor_address2')); 
            $city_id = trim(pg_fetch_result($resultvendor, 'city_id')); 
            $province_id = trim(pg_fetch_result($resultvendor, 'province_id')); 
            $country_id = trim(pg_fetch_result($resultvendor, 'country_id')); 
            $vendor_postal = trim(pg_fetch_result($resultvendor, 'vendor_postal')); 
            $vendor_phone = trim(pg_fetch_result($resultvendor, 'vendor_phone')); 
            $vendor_email = trim(pg_fetch_result($resultvendor, 'vendor_email')); 
            $contact_methods = trim(pg_fetch_result($resultvendor, 'contact_id')); 
        }
      
        $redirect = ("./admin-vendors.php?vendor_id=".$vendor_id);  
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $update = $_SESSION['update'];
        $vendor_id = $_SESSION['create_vendor_id']; 		
        $vendor_name = trim($_POST["vendor_name"]); 
        $vendor_first = trim($_POST["vendor_first"]); 
        $vendor_last = trim($_POST["vendor_last"]); 
        $vendor_address1 = trim($_POST["vendor_address1"]); 
        $vendor_last = trim($_POST["vendor_last"]); 
        $vendor_address1 = trim($_POST["vendor_address1"]); 
        $vendor_address2 = trim($_POST["vendor_address2"]); 
        $city_id = trim($_POST["city_id"]); 
        $province_id = trim($_POST["provinces"]); 
        $country_id = trim($_POST["countries"]); 
        $vendor_postal = trim($_POST["vendor_postal"]); 
        $vendor_phone = trim($_POST["vendor_phone"]); 
        $vendor_email = trim($_POST["vendor_email"]);        
        $contact_methods = trim($_POST["contact_methods"]);        
        $redirect = ("./admin-vendors.php?vendor_id=".$vendor_id);  
        echo "SQL Check    ".$update;   
        if ($update == false)     {
            $result = pg_prepare($conn, "vendor_insert_query", 'INSERT INTO vendor (vendor_id, vendor_name, vendor_first, vendor_last, vendor_address1, vendor_address2, city_id, province_id, country_id, vendor_postal, vendor_phone, vendor_email, contact_id) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11, $12, $13)');
            $result = pg_execute($conn, "vendor_insert_query", array($vendor_id, $vendor_name, $vendor_first, $vendor_last, $vendor_address1, $vendor_address2, $city_id, $province_id , $country_id,  $vendor_postal, $vendor_phone, $vendor_email, $contact_methods));
        } else {
            $result = pg_prepare($conn, "vendor_update_query", 'UPDATE vendor SET vendor_name=$2, vendor_first=$3, vendor_last=$4, vendor_address1=$5, vendor_address2=$6, city_id=$7, province_id=$8, country_id=$9, vendor_postal=$10, vendor_phone=$11, vendor_email=$12, contact_id=$13 WHERE vendor_id = $1');
            $result = pg_execute($conn, "vendor_update_query", array($vendor_id, $vendor_name, $vendor_first, $vendor_last, $vendor_address1, $vendor_address2, $city_id, $province_id , $country_id,  $vendor_postal, $vendor_phone, $vendor_email, $contact_methods));           
        }        
        $vendor_id="";
         $vendor_name = "";
        $vendor_first = "";
        $vendor_last = "";
        $vendor_address1 = "";
        $vendor_address2 = "";
        $city_id = "";	
        $province_id = "";
        $country_id = "";
        $vendor_postal = "";
        $vendor_phone = "";
        $vendor_email = "";  
        $staffstatus = "";
        $stafftype = "";
        $contact_methods = "";
        $staff_wage = "";
        $clt_number = "";
        $result = "";
        $records = "";
        $sql ="";
        $new_id = "";
        $update="";
        $redirect = ("./admin-vendors.php?vendor_id=".$vendor_id);  
        redirect($redirect);
    }
   
?>

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
 
<div class="w3-third">
   
    <div class="notes">
    <h1>Maintain Vendor Information</h1><hr/>  
    <h3><a class="dash" href="./admin-assets.php">Return to Equip and Supplies</a></h3><br/>
    <h2>Vendor Listing</h2><hr/>
    <?php  echo build_vendor_Table(); ?>
    </div>
    
</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">
    <h2>Contact Information</h2><hr/>
    <br/><label class="icclabel">Vendor ID</label><label name="vendor_id" value="<?php echo $vendor_id ?>"><?php echo $vendor_id ?></label><br/><br/>  
    <label class="icclabel">Vendor Name</label><input name="vendor_name" value="<?php echo $vendor_name ?>"></input><br/><br/>    
    <label class="icclabel">First Name</label><input name="vendor_first" value="<?php echo $vendor_first ?>"></input><br/><br/>
    <label class="icclabel">Last Name</label><input name="vendor_last" value="<?php echo $vendor_last ?>"></input><br/><br/>
    <label class="icclabel">Phone Number</label><input name="vendor_phone" value="<?php echo $vendor_phone ?>"></input><br/><br/>
    <label class="icclabel">Email Address</label><input name="vendor_email" value="<?php echo $vendor_email ?>"></input><br/><br/>
    <label class="icclabel">Contact Method</label><?php build_drop_down(CNTC, $contact_methods); ?><br/><br/>   
    </div>
    
</div>

<div class="w3-third">
     
    <br/><br/>
    <div class="notes">
    <h2>Staff Address</h2><hr/>
    <label class="icclabel">Address</label><input name="vendor_address1" value="<?php echo $vendor_address1 ?>"></input><br/><br/>
    <label class="icclabel">Address</label><input name="vendor_address2" value="<?php echo $vendor_address2 ?>"></input><br/><br/>
    <label class="icclabel">City</label><input name="city_id" value="<?php echo $city_id ?>"></input><br/><br/>
    <label class="icclabel">Province</label><?php build_drop_down(PROV, $province_id); ?><br/><br/>
    <label class="icclabel">Country</label><?php build_drop_down(CNTR, $country_id); ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="vendor_postal" value="<?php echo $vendor_postal ?>"></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
    </div>
    
</div>

</div>

</form>

<?php include("footer.php"); ?> 