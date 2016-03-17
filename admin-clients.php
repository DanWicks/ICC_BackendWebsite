<?php include("header.php");     
    if (isset($_GET['sub_menu'])){
		$SubMenu = isset($_GET['sub_menu'])?($_GET['sub_menu']):'C';
		$_SESSION['sub_menu'] = $SubMenu;
        $_SESSION['dashboard'] = "Client Information";
        redirect ("./admin-clients.php");
	}
?> 

<div class="w3-row-padding">

<div class="w3-third">

    <h2><b>Client Information Dashboard</b></h2>
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information used by the site when creating, viewing and updating Clients, Contracts and Location Assesments. Their access is divided into four areas, with each of these areas containing more menu options. These four areas are Create New Clients, Maintain Clients, Maintain Contract and Location Assesments.</p>
    
    <img src="./Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  

</div>

<div class="w3-third">

    <h2><b>Client Information Options</b></h2>  
    <ul>
    <li><b>Client Information Dashboard</b></li>
        <ul>
        <li>Main lannding page for Administrators and Owners for the Staff Information menu.</li>
        </ul>
    <li><b>Create New Clients</b></li>
        <ul>
        <li>Create New I.C.C. Clients.</li>
        </ul>  
    <li><b>Maintain Clients</b></li>
        <ul>
        <li>Maintain the information for I.C.C. Clients.</li>
        </ul>    
    <li><b>Maintain Contracts</b></li>
        <ul>
        <li>Maintain the information for I.C.C. Client Contracts.</li>
        </ul>    
    <li><b>Location Assesments</b></li>
        <ul>
        <li>Maintain the information for Location Assesments.</li>
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