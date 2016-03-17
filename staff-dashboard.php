<?php include("header.php"); ?> 

<div class="w3-row-padding">

<div class="w3-third">

    <h2><b>Staff Dashboard</b></h2>
    <p>This section is used for Immaculate Cleaning Conecpts (ICC) staff to Login to the Site and view their Staff Information and their Current Schedule. Staff have the ability to update their personal information and change it for the ICC records. Staff will also be able to change their scheduling availability to notify ICC when they are not available to work on subsequent schedules.</p>
    
    <img src="./Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  

</div>

<div class="w3-third">

    <h2><b>Staff Menu Options</b></h2>  
    <ul>
    <li><b>Staff Dashboard</b></li>
        <ul>
        <li>Main lannding page for Staff Team members that will contain general information and news items that are related to the Job at I.C.C., as well as displaying their current information.</li>
        </ul>
    <li><b>Update Information</b></li>
        <ul>
        <li>The Update Information page allows the logged in Team member to update thier Personal Information. Keeping their own Information up to date allows I.C.C. to always have update information with the need to submit information for the companies Administration for processing.</li>
        </ul>
    <li><b>Availability</b></li>
        <ul>
        <li>The Availability page allows to update the times and dates that they are not able to work. This page will allow the Team member to keep I.C.C. informed about the times they are able to work and help prevent issues that may come up with scheduling before schedules are created.</li>
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
    <label class="icclabel">Phone Number</label><?php echo display_phone_number($_SESSION['staff_phone']); ?><br/><br/>
    <label class="icclabel">Email Address</label><?php echo $_SESSION['staff_email']; ?><br/><br/>
    
</div>

</div>

<?php include("footer.php"); ?> 