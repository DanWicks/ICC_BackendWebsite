<?php include("header.php"); 
    $conn = db_connect();
    $specialty_equipment_id = "";
     if (isset($_GET['specialty_equipment_id'])){		
        $specialty_equipment_id = $_GET['specialty_equipment_id'];       
    } else {
        $specialty_equipment_id="";   
    }
    
    $specialty_equipment_description = "";

    if ($specialty_equipment_id != "") {
        $resultequip = pg_prepare($conn, "query_service", 'SELECT * FROM specialty_equipment WHERE specialty_equipment_id = $1');
        $resultequip = pg_execute($conn, "query_service", array($specialty_equipment_id)); 
        $specialty_equipment_description = trim(pg_fetch_result($resultequip, 'specialty_equipment_description'));  
 
        
    }
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
       
        if ($specialty_equipment_id == "") {
            $specialty_equipment_description = "";

        }
        $_SESSION['specialty_equipment_id'] = $specialty_equipment_id;
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $specialty_equipment_id = $_SESSION['specialty_equipment_id'];
        $specialty_equipment_description = trim($_POST['specialty_equipment_description']); 

        
        if ($specialty_equipment_id == ""){
            
            
            $specialty_equipment_id = ((trim($_POST['last_index'] )) * 2) ; 
            
            $result_client = pg_prepare($conn, "services_insert_query", 'INSERT into specialty_equipment (specialty_equipment_id, specialty_equipment_description) VALUES ($1, $2)');        
            $result_client = pg_execute($conn, "services_insert_query", array($specialty_equipment_id, $specialty_equipment_description)); 
            $specialty_equipment_id="";
            $_SESSION['specialty_equipment_id'] = $specialty_equipment_id;
            $specialty_equipment_description = "";
            $service_price = ""; 
        } else {
            $result = pg_prepare($conn, "services_update_query", 'UPDATE specialty_equipment SET specialty_equipment_description=$2 WHERE specialty_equipment_id = $1');
            $result = pg_execute($conn, "services_update_query", array($specialty_equipment_id, $specialty_equipment_description)); 
            $specialty_equipment_id="";
            $_SESSION['specialty_equipment_id'] = $specialty_equipment_id;
            $specialty_equipment_description = "";
        
            
        }
    }
?>  

<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    

<div class="w3-third">
   
    <div class="notes">
    <h1>Maintain Equipment</h1><hr/>
    <h3><a class="dash" href="./supervisor-dashboard.php">Home Page</a></h3><br/>
    <h2>Equipment Listing</h2><hr/>
    <?php echo build_equipment_super_Table() ?>
    </div>
    <br/>
    
</div>

<div class="w3-third">

    <br/>
    <div class="notes">
    <h2>Enter/Update Equipment</h2><hr/>
    <label class="icclabel">ID</label><label><?php echo $specialty_equipment_id  ?></label><br/><br/>
    <label class="icclabel">Description</label><input name="specialty_equipment_description" value="<?php echo $specialty_equipment_description ?>"></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />  
    </div>
  
</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts" /> 
    </div>
    
</div>

</form>

</div>

<?php include("footer.php"); ?> 