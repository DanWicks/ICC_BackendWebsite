<?php
   
    include("header.php"); 
    
    if (isset($_GET['sub_menu'])){
		$SubMenu = isset($_GET['sub_menu'])?($_GET['sub_menu']):'C';
		$_SESSION['sub_menu'] = $SubMenu;
        $_SESSION['dashboard'] = "Equip. and Supplies";
        redirect ("./admin-assets.php");
	}
?> 

<div class="w3-row-padding">

<div class="w3-third">

    <h2><b>Equipment and Supplies Dashboard</b></h2>
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information for I.C.C. Services, Vendors, Equipment and Supplies. Their access is divided into four areas, with each of these areas containing more menu options. These four areas are Maintain Services, Maintain Vendors, Maintain Equipment, and Maintain Supplies.</p>
    
    <img src="./Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  

</div>

<div class="w3-third">

    <h2><b>Equipment and Supplies Options</b></h2>  
    <ul>
    <li><b>Equipment and Supplies Dashboard</b></li>
        <ul>
        <li>Main landing page for Administrators and Owners for the Equipment and Supplies menu.</li>
        </ul>
    <li><b>Maintain Services</b></li>
        <ul>
        <li>Maintain the information for I.C.C Services that are available.</li>
        </ul>
    <li><b>Maintain Vendors</b></li>
        <ul>
        <li>Create new Locations for Vendor information.</li>
        </ul>
    <li><b>Maintain Equipment</b></li>
        <ul>
        <li>Maintain the information for Equipment information.</li>
        </ul>
    <li><b>Maintain Supplies</b></li>
        <ul>
        <li>Maintain the Required Services for Supplies information.</li>
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
    <label class="icclabel">Phone Number</label><?php echo $_SESSION['staff_phone']; ?><br/><br/>
    <label class="icclabel">Email Address</label><?php echo $_SESSION['staff_email']; ?><br/><br/>
    
</div>

</div>

<?php include("footer.php"); ?> 