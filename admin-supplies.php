<?php include("header.php"); 
    $conn = db_connect();
    $supply_id = "";
     if (isset($_GET['supply_id'])){		
        $supply_id = $_GET['supply_id'];       
    } else {
        $supply_id="";   
    }
    $supply_qoh = "";
    $vendor_id = "";
    $supply_description = "";
    $supply_price = "";
    
    if ($supply_id != "") {
        $resultsupplies = pg_prepare($conn, "query_service", 'SELECT * FROM cleaning_supplies WHERE supply_id = $1');
        $resultsupplies = pg_execute($conn, "query_service", array($supply_id)); 
        $supply_description = trim(pg_fetch_result($resultsupplies, 'supply_description'));  
        $supply_price = trim(pg_fetch_result($resultsupplies, 'supply_price'));
        $supply_qoh = trim(pg_fetch_result($resultsupplies, 'supply_qoh'));
        $vendor_id = trim(pg_fetch_result($resultsupplies, 'vendor_id'));
    }   
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
       
        if ($supply_id == "") {
            $supply_qoh = "";
            $vendor_id = "";
            $supply_description = "";
            $supply_price = "";
        }
        $_SESSION['supply_id'] = $supply_id;
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $supply_id = $_SESSION['supply_id'];
        $supply_description = trim($_POST['supply_description']); 
        $supply_price = trim($_POST['supply_price']) ; 
        $supply_qoh = trim($_POST['supply_qoh']) ; 
        $vendor_id = trim($_POST['vendor']) ; 
        
        if ($supply_id == ""){ 
        
            $sql = "SELECT * FROM cleaning_supplies ORDER by supply_id DESC LIMIT 1";
            $result 	= pg_query($conn, $sql);
            $records 	= pg_num_rows($result);
            $new_id = pg_fetch_result($result, "supply_id");       
            $clt_number = substr($new_id, 4, 6);
            $clt_number = $clt_number + 1;
            $clt_number = str_pad($clt_number, 7, 0, STR_PAD_LEFT);
            $supply_id = substr($new_id, 0, 3);
            $supply_id .= $clt_number;   
            $_SESSION['supply_id'] = $supply_id;          
            
            $result_client = pg_prepare($conn, "services_insert_query", 'INSERT into cleaning_supplies (supply_id, vendor_id, supply_description, supply_qoh, supply_price) VALUES ($1, $2, $3, $4, $5)');        
            $result_client = pg_execute($conn, "services_insert_query", array($supply_id, $vendor_id, $supply_description, $supply_qoh, $supply_price)); 
            $supply_id="";
            $_SESSION['supply_id'] = $supply_id;
               $supply_qoh = "";
            $vendor_id = "";
            $supply_description = "";
            $supply_price = "";
        } else {
            $result = pg_prepare($conn, "services_update_query", 'UPDATE cleaning_supplies SET supply_description=$2, supply_price=$3, supply_qoh=$4, vendor_id=$5 WHERE supply_id = $1');
            $result = pg_execute($conn, "services_update_query", array($supply_id, $supply_description, $supply_price, $supply_qoh, $vendor_id)); 
            $supply_id="";
            $_SESSION['supply_id'] = $supply_id;
            $supply_qoh = "";
              $supply_qoh = "";
            $vendor_id = "";
            $supply_description = "";
            $supply_price = "";
            
        }
    }
?>  

<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    

<div class="w3-third">
   
    <div class="notes">
    <h1>Maintain Supplies</h1><hr/>    
    <h3><a class="dash" href="./admin-assets.php">Return to Equip and Supplies</a></h3><br/>  
    <h2>Supplies Listing</h2><hr/>
    <?php echo build_supply_Table() ?>
    </div>

</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">
    <h2>Enter/Update Supplies</h2><hr/>
    <label class="icclabel">Supply ID</label><label><?php echo $supply_id  ?></label><br/><br/>
    <label class="icclabel">Vendor ID</label><?php echo ddl_vendor_information(VEND, $vendor_id); ?><br/><br/>
    <label class="icclabel">Description</label><input name="supply_description" value="<?php echo $supply_description ?>"></input><br/><br/>
    <label class="icclabel">QOH</label><input name="supply_qoh" value="<?php echo $supply_qoh ?>"></input><br/><br/>
    <label class="icclabel">Price</label><input name="supply_price" value="<?php echo $supply_price ?>"></input><br/><br/>    
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />  
    </div><br/><br/>
 
</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts"  />     
    </div>
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 