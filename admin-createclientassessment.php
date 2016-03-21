<?php include("header.php"); ?>  

<?php
       
?>
<div class="w3-row-padding">

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <h2>Enter Client Assessment Information</h2>
    
    <p><a href="./admin-clients.php">Return to Client Dashboard</a></p>
 
<div class="w3-third">

    <h2>Cleaning Site Information</h2>
    <label class="icclabel">Same as Billing</label><input type="checkbox" name="sameLocation" value=""><br/><br/>
    <label class="icclabel">Client ID</label><input name="client_id"></input><br/><br/>
    <label class="icclabel">Client Name</label><input name="client_name"></input><br/><br/>
    <label class="icclabel">Location ID</label><input name="client_id"></input><br/><br/>
    <label class="icclabel">Contact First Name</label><input name="client_name"></input><br/><br/>
    <label class="icclabel">Contact Last Name</label><input name="client_id"></input><br/><br/>
    <label class="icclabel">Phone number</label><input name="client_name"></input><br/><br/>
    <label class="icclabel">Email Address</label><input name="client_id"></input><br/><br/>
    <label class="icclabel">Contact Method</label><input name="client_name"></input><br/><br/>     
    
</div>

<div class="w3-third">

    <h2>Billing Location</h2>
    <label class="icclabel">Address 1</label><input name=""></input><br/><br/>   
    <label class="icclabel">Address 2</label><input name=""></input><br/><br/>   
    <label class="icclabel">City</label><input name=""></input><br/><br/>   
    <label class="icclabel">Province</label><input name=""></input><br/><br/>   
    <label class="icclabel">Country</label><input name=""></input><br/><br/>   
    <label class="icclabel">Postal Code</label><input name=""></input><br/><br/>   
    
</div>

<div class="w3-third">

    <h2>Assessment Information</h2>
    <label class="icclabel">Assessment ID</label><input name=""></input><br/><br/>   
    <label class="icclabel">Staff Recommended</label><input name=""></input><br/><br/>   
    <label class="icclabel">Equipment Recommended</label><input name=""></input><br/><br/>  
    <input type="submit" value="Submit" /> 
    <input type="reset" value="Reset"  />    
 
</div>

</form>

</div>

<?php include("footer.php"); ?> 