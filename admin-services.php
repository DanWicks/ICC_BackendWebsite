<?php include("header.php"); 
    $conn = db_connect();
    $service_id = "";
     if (isset($_GET['service_id'])){		
        $service_id = $_GET['service_id'];       
    } else {
        $service_id="";   
    }
    
    $service_description = "";
    $service_price = "";
    if ($service_id != "") {
        $resultservice = pg_prepare($conn, "query_service", 'SELECT * FROM services WHERE service_id = $1');
        $resultservice = pg_execute($conn, "query_service", array($service_id)); 
        $service_description = trim(pg_fetch_result($resultservice, 'service_description'));  
        $service_price = trim(pg_fetch_result($resultservice, 'service_price'));
        
    }
    
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        
       
        if ($service_id == "") {
            $service_description = "";
            $service_price = ""; 
        }
        $_SESSION['service_id'] = $service_id;
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $service_id = $_SESSION['service_id'];
        $service_description = trim($_POST['service_description']); 
        $service_price = trim($_POST['service_price']) ; 
        
        if ($service_id == ""){
            
            
            $service_id = ((trim($_POST['last_index'] )) * 2) ; 
            
            $result_client = pg_prepare($conn, "services_insert_query", 'INSERT into services (service_id, service_description, service_price) VALUES ($1, $2, $3)');        
            $result_client = pg_execute($conn, "services_insert_query", array($service_id, $service_description, $service_price)); 
            $service_id="";
            $_SESSION['service_id'] = $service_id;
            $service_description = "";
            $service_price = ""; 
        } else {
            $result = pg_prepare($conn, "services_update_query", 'UPDATE services SET service_description=$2, service_price=$3 WHERE service_id = $1');
            $result = pg_execute($conn, "services_update_query", array($service_id, $service_description, $service_price)); 
            $service_id="";
            $_SESSION['service_id'] = $service_id;
            $service_description = "";
            $service_price = ""; 
            
        }
    }
?>  


<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    

<div class="w3-third">

    <div class="notes">
    <h1>Maintain Services</h1><hr/>
    <h3><a class="dash" href="./admin-dashboard.php">Admin Home Page</a> / <a class="dash" href="./admin-assets.php">E & S Dashboard</a></h3><br/>    
    <h2>Services Listing</h2><hr/>
    <?php echo build_service_Table() ?>
    </div>
    <br/>
    
</div>

<div class="w3-third">
    
    <br/>
    <div class="notes">
    <h2>Enter/Update Services</h2><hr/> 
    <label class="icclabel">ID</label><label><?php echo $service_id  ?></label><br/><br/>
    <label class="icclabel">Description</label><input name="service_description" value="<?php echo $service_description ?>"></input><br/><br/>
    <label class="icclabel">Price</label><input name="service_price" value="<?php echo $service_price ?>"></input><br/><br/>
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />  
    </div>
 
</div>

<div class="w3-third">
    
    <br/><br/><br/>
    <div class="notes">   
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts"/> 
    </div>

</div>

</form>

</div>

<?php include("footer.php"); ?> 