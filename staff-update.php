<?php include("header.php"); 
    $staff_id = "";    
    $address1 = "";
    $address2 = "";
    $city = "";	
    $province = "";
    $countries = "";
    $postalcode = "";
    $phonenumber = "";
    $emailaddress = "";     
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){        
        $staff_id = ($_SESSION["staff_id"]);   
        $address1 = ($_SESSION["staff_address1"]); 
        $address2 = ($_SESSION["staff_address2"]); 
        $city = ($_SESSION["city_id"]); 
        $province = ($_SESSION["province_id"]); 
        $countries = ($_SESSION["country_id"]); 
        $postalcode = ($_SESSION["staff_postal"]); 
        $phonenumber = ($_SESSION["staff_phone"]); 
        $emailaddress = ($_SESSION["staff_email"]);         
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $staff_id = ($_SESSION["staff_id"]);
        $address1 = trim($_POST["address1"]); 
        $address2 = trim($_POST["address2"]); 
        $city = trim($_POST["city"]); 
        $province = trim($_POST["provinces"]); 
        $countries = trim($_POST["countries"]); 
        $postalcode = trim($_POST["postalcode"]); 
        $phonenumber = trim($_POST["phonenumber"]); 
        $emailaddress = trim($_POST["emailaddress"]);         
        
        $result = pg_prepare($conn, "update_staff_query", 'UPDATE staff SET staff_address1=$2, staff_address2=$3, city_id=$4, province_id=$5, country_id=$6, staff_postal=$7, staff_phone=$8, staff_email=$9 WHERE staff_id=$1');
        $result = pg_execute($conn, "update_staff_query", array($staff_id, $address1, $address2, $city, $province , $countries,  $postalcode, $phonenumber, $emailaddress));  

        $result = pg_prepare($conn, "staff_changed_query", 'SELECT * FROM staff WHERE staff_id = $1');
        $result = pg_execute($conn, "staff_changed_query", array($staff_id));	
     
        $_SESSION['staff_address1'] = trim(pg_fetch_result($result, "staff_address1"));	 
        $_SESSION['staff_address2'] = trim(pg_fetch_result($result, "staff_address2"));	
        $_SESSION['city_id'] = trim(pg_fetch_result($result, "city_id"));	
        $_SESSION['province_id'] = trim(pg_fetch_result($result, "province_id"));	
        $_SESSION['country_id'] = trim(pg_fetch_result($result, "country_id"));	
        $_SESSION['staff_postal'] = trim(pg_fetch_result($result, "staff_postal"));	
        $_SESSION['staff_phone'] = trim(pg_fetch_result($result, "staff_phone"));	
        $_SESSION['staff_email'] = trim(pg_fetch_result($result, "staff_email"));
                
        redirect(STAFDASH);
    }      
?>

<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >

<div class="w3-third">

    <div class="notes">
    <h1>Update Staff Information</h1><hr/>
    <h3><a class="dash" href="./staff-dashboard.php">Home Page</a></h3><br/> 
    <ul>
    <li>Update your Personal Information for your I.C.C. Staff file. </li>
    <li>Keeping your Information up to date will ensure that I.C.C. has the correct information when they need to contact arises.</li>
    <li>I.C.C. related Information such as Stay Type and Staff Status can only be changed by an Administrator<li>
    <li>Password Reset will need to be completed by an Administrator</li>
    </ul>
    </div>     
       
</div>

<div class="w3-third">
        
    <div class="notes"><br/>
    <h2><?php echo $_SESSION['full_name']; ?> Details</h2><hr/>   
    <label class="icclabel">Address</label><input name="address1" value="<?php echo $address1 ?>" ></input><br/><br/>
    <label class="icclabel">Address</label><input name="address2" value="<?php echo $address2 ?>" ></input><br/><br/>
    <label class="icclabel">City</label><input name="city" value="<?php echo $city ?>" ></input><br/><br/>
    <label class="icclabel">Province</label><?php build_drop_down(PROV, $province); ?><br/><br/>
    <label class="icclabel">Country</label><?php build_drop_down(CNTR, $countries); ?><br/><br/>
    <label class="icclabel">Postal Code</label><input name="postalcode" value="<?php echo $postalcode ?>" ></input><br/><br/>
    <label class="icclabel">Phone Number</label><input name="phonenumber" value="<?php echo $phonenumber ?>" ></input><br/><br/>
    <label class="icclabel">Email Address</label><input name="emailaddress" value="<?php echo $emailaddress ?>" ></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />     
    </div><br/><br/>
 
</div>

<div class="w3-third"> 

    <div class="notes"><br/><br/><br/>
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts"/>  
    </div>
 
</div>

    </form>

</div>

<?php include("footer.php"); ?> 