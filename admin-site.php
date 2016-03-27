<?php 
    include("header.php");  
?> 

<?php
    $staff_status_value="";
    $staff_status_property="";
    $staff_type_value = "";
    $staff_type_property="";
    $contact_methods_value = "";
    $contact_methods_property = "";
    $entry_methods_value = "";
    $entry_methods_property = "";
    $conn = db_connect();
    if($_SERVER["REQUEST_METHOD"] == "GET"){        
        $staff_status_value="";
        $staff_status_property="";
        $staff_type_value = "";
        $staff_type_property="";
        $contact_methods_value = "";
        $contact_methods_property = "";
        $entry_methods_value = "";
        $entry_methods_property = "";
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){	
        $staff_status_value=trim($_POST["staff_status"]); 
        $staff_status_property=trim($_POST["staff_status_property"]);         
        if ($staff_status_property != ''){
            $result = pg_prepare($conn, "update_staff_status", 'UPDATE staff_status SET property=$2 WHERE value = $1');
            $result = pg_execute($conn, "update_staff_status", array($staff_status_value, $staff_status_property    ));	  
        }  
        $staff_type_value=trim($_POST["staff_type"]); 
        $staff_type_property=trim($_POST["staff_type_property"]);         
        if ($staff_type_property != ''){
            $result = pg_prepare($conn, "update_staff_type", 'UPDATE staff_type SET property=$2 WHERE value = $1');
            $result = pg_execute($conn, "update_staff_type", array($staff_type_value, $staff_type_property    ));	  
        }  
        $contact_methods_value=trim($_POST["contact_methods"]); 
        $contact_methods_property=trim($_POST["contact_methods_property"]);         
        if ($contact_methods_property != ''){
            $result = pg_prepare($conn, "update_contact_methods", 'UPDATE contact_methods SET property=$2 WHERE value = $1');
            $result = pg_execute($conn, "update_contact_methods", array($contact_methods_value, $contact_methods_property    ));	  
        }  
        $entry_methods_value=trim($_POST["entry_method"]); 
        $entry_methods_property=trim($_POST["entry_methods_property"]);         
        if ($entry_methods_property != ''){
            $result = pg_prepare($conn, "update_contact_methods", 'UPDATE entry_method SET property=$2 WHERE value = $1');
            $result = pg_execute($conn, "update_contact_methods", array($entry_methods_value, $entry_methods_property    ));	  
        }  
    }    
?>

<div class="w3-row-padding">

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="w3-third"> 
    
    <div class="notes">    
    <h1>Website Administration Options</h1><hr/>
    <a href="./admin-dashboard.php" class="dash"><h3>Admin Home Page</h3></a><br/>
    <h2>Staff Status</h2><hr/>
    <?php echo buildstaff_statusTable(); ?>
    <p>Update Status Description</p>
    <?php build_drop_down(STAT,$staff_status_value) ?>
    <input name="staff_status_property"/>
    <br/><br/><br/>
    </div>
    <hr/>
    
    <div class="notes">
    <h2>Staff Type</h2><hr/>
    <?php echo buildstaff_typeTable(); ?>
    <p>Update Staff Types</p>
    <?php build_drop_down(TYPE,$staff_type_value) ?>
    <input name="staff_type_property"/>
    <br/><br/><br/>
    </div>  
        
</div>

<div class="w3-third">
    
    <br/><br/><br/>
    <div class="notes">
    <h2>Contact Methods</h2><hr/>
    <?php echo buildContactsTable(); ?>
    <p>Update Contact Method Descriptions</p>
    <?php build_drop_down(CNTC,$contact_methods_value) ?>
    <input name="contact_methods_property"/>
    <br/><br/><br/>
    </div>   
    
    <div class="notes">    
    <h2>Entry Methods</h2><hr/>
    <?php echo buildentry_methodTable(); ?>
    <p>Update Entry Method Descriptions</p>
    <?php build_drop_down(ENTR,$entry_methods_value) ?>
    <input name="entry_methods_property"/><br/><br/  >
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  /> 
    <br/><br/><br/>
    </div>   
        
</div>

<div class="w3-third">
    
    <br/></br><br/>
    <div class="notes">
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information used by the site when creating, viewing and updating Client, Staff, Location and Vendors. Their access is divided into four areas, with each of these areas containing more menu options. These fours areas are Contact Methods,  Entry Methods, Staff Status, and Staff Types.</p>
    </div>
    
    <div class="notes">
    <img class="smlimg" src="Images/icc.png" alt="Immaculate Cleaning Concepts" />   
    </div>
    
</div>

</form>

</div>

<?php include("footer.php"); ?> 