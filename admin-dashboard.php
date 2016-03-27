<?php  
    include("header.php"); 
?> 

<div class="w3-row-padding">

<div class="w3-third">

    <div class="notes">
    <h1>Administration Menu Options</h1>  
    <hr/>    
    <a href="./admin-dashboard.php" class="dash"><h3>Administration Dashboard</h3></a>
    <p>Main lannding page for Administrators and Owners that will contain general information and news items that are related to the Job at I.C.C., as well as displaying their current information.</p>
    <a href="./admin-site.php" class="dash"><h3>Website Administration</h3></a>
    <p>Maintain the site specific information that is used when creating, viewing and updating all of the Staff, Client, Vendor and Locations</p>
    <a href="./admin-staff.php" class="dash"><h3>Staff Information</h3></a>
    <p>Access to the areas of the site for maintaining Staff, Scheduling and Availabilities. Administration users can also Update their own personal information.</p>
    <a href="./admin-clients.php" class="dash"><h3>Client Information</h3></a>
    <p>Access to the areas of the site for maintaining Clients, Contracts and Site Assesments.</p>    
    <a href="./admin-assets.php" class="dash"><h3>Equipment and Supplies</h3></a>
    <p>Access to all areas of the site for maintaining Services, Vendors, Equipment and Supplies.</p>
    <a href="./admin-assets.php" class="dash"><h3>Logout</h3></a>
    <p>Logs the Current Staff member out of the System and send them to the Logout screen.</p>    
    </div>
    
</div>

<div class="w3-third">
    
    <br/><br/>
    <div class="notes">
    <h2>User Information</h2>
    <hr/><br/>
    <label class="icclabel">First Name</label><label><?php echo $_SESSION['staff_first']; ?></label><br/><br/>
    <label class="icclabel">Last Name</label><?php echo $_SESSION['staff_last']; ?><br/><br/>
    <label class="icclabel">Address</label><?php echo $_SESSION['staff_address1']; ?><br/><br/>
    <label class="icclabel">Address</label><?php echo $_SESSION['staff_address2']; ?><br/><br/>
    <label class="icclabel">City</label><?php echo $_SESSION['staff_city']; ?><br/><br/>
    <label class="icclabel">Province</label><?php echo get_property_named(PROV, $_SESSION['province_id'], 'value'); ?><br/><br/>
    <label class="icclabel">Country</label><?php echo get_property_named(CNTR, $_SESSION['country_id'], 'value'); ?><br/><br/>
    <label class="icclabel">Postal Code</label><?php echo $_SESSION['staff_postal']; ?><br/><br/>
    <label class="icclabel">Phone Number</label><?php echo display_phone_number($_SESSION['staff_phone']);  ?><br/><br/>
    <label class="icclabel">Email Address</label><?php echo $_SESSION['staff_email']; ?><br/><br/>
    </div>
    
</div>

<div class="w3-third">

    <br/></br>
    <div class="notes">    
    <p>This section is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to access all of the information required for the daily operations of the I.C.C. business. Their access is divided into five areas, with each of these areas containing a menu with options for that section of the website. These five areas are Site Administration, Staff Information, Client information, Location information and Equipment and Supplies.</p>
    </div>
    
    <div class="notes">
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts"/>      
    </div>
    
</div>

</div>

<?php include("footer.php"); ?> 