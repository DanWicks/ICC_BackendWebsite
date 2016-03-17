<?php
   
    include("header.php"); 
    
     if (isset($_GET['sub_menu'])){
		$SubMenu = isset($_GET['sub_menu'])?($_GET['sub_menu']):'A';
		$_SESSION['sub_menu'] = $SubMenu;
        $_SESSION['dashboard'] = "Administration Dashboard";
        redirect ("./admin-dashboard.php");
	}
?> 

<div class="w3-row-padding">

<div class="w3-third">

    <h2><b>Administration Dashboard</b></h2>
    <p>This section is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to access all of the information required for the daily operations of the I.C.C. business. Their access is divided into five areas, with each of these areas containing a menu with options for that section of the website. These five areas are Site Administration, Staff Information, Client information, Location information and Equipment and Supplies.</p>
    
    <img src="./Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  

</div>

<div class="w3-third">

    <h2><b>Administration Menu Options</b></h2>  
    <ul>
    <li><b>Administration Dashboard</b></li>
        <ul>
        <li>Main lannding page for Administrators and Owners that will contain general information and news items that are related to the Job at I.C.C., as well as displaying their current information.</li>
        </ul>
    <li><b>Site Administration</b></li>
        <ul>
        <li>Maintain the site specific information that is used when creating, viewing and updating all of the Staff, Client, Vendor and Locations</li>
        </ul>
    <li><b>Staff Information</b></li>
        <ul>
        <li>Access to the areas of the site for maintaining Staff, Scheduling and Availabilities. Administration users can also Update their own personal information.</li>
        </ul>
    <li><b>Client Information</b></li>
        <ul>
        <li>Access to the areas of the site for maintaining Clients, Contracts and Site Assesments.</li>
        </ul>
    <li><b>Location Information</b></li>
        <ul>
        <li>Access to all areas of the site for maintaining Sites, Locations and their Required Services and Cleaning availabilities.</li>
        </ul>
    <li><b>Equipment and Supplies</b></li>
        <ul>
        <li>Access to all areas of the site for maintaining Services, Vendors, Equipment and Supplies.</li>
        </ul>
    <li><b>Logout</b></li>
        <ul>
        <li>Logs the Current Staff member out of the System and send them to the Logout screen.</li>
        </ul>
    </ul>
 
</div>

<div class="w3-third">

    <h2><b>Staff Information</b></h2>
    <br/>
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

<?php include("footer.php"); ?> 