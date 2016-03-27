<?php include("header.php"); ?> 

<div class="w3-row-padding">

<div class="w3-third">

    <div class="notes">
    <h1>Staff Menu Options</h1><hr/>
    <h3>Staff Dashboard</h3>
    <p>Main lannding page for Staff Team members that will contain general information and news items that are related to the Job at I.C.C., as well as displaying their current information.</p>
    <h3><a class="dash" href="./staff-update.php">Update Information</a></h3>
    <p>The Update Information page allows the logged in Team member to update thier Personal Information. Keeping their own Information up to date allows I.C.C. to always have update information with the need to submit information for the companies Administration for processing.</p>
    <h3><a class="dash" href="./staff-availability.php">Availability</a></h3>
    <p>The Availability page allows Staff to update the times and dates that they are not able to work. This page will allow the Team member to keep I.C.C. informed about the times they are able to work and help prevent issues that may come up with scheduling before schedules are created.</p>
    <h3><a class="dash" href="./staff-schedule.php">Schedule</a></h3>
    <p>The Schedule page allows to Staff view the current weeks schedule to determine shift start and end times as well as the Locations they will be workingat during the week.</p>
    <h3><a class="dash" href="./logout.php">Logout</a></h3>
    <p>Logs the Current Staff member out of the System and send them to the Logout screen.</p>
    </div>

</div>

<div class="w3-third">

    <div class="notes"><br/>
    <h2>Staff Information</h2><hr/><br/>
    <label class="icclabel">First Name</label><label><?php echo $_SESSION['staff_first']; ?></label><br/><br/>
    <label class="icclabel">Last Name</label><?php echo $_SESSION['staff_last']; ?><br/><br/>
    <label class="icclabel">Address</label><?php echo $_SESSION['staff_address1']; ?><br/><br/>
    <label class="icclabel">Address</label><?php echo $_SESSION['staff_address2']; ?><br/><br/>
    <label class="icclabel">City</label><?php echo $_SESSION['city_id']; ?><br/><br/>
    <label class="icclabel">Province</label><?php echo get_property_named(PROV, $_SESSION['province_id'], 'value'); ?><br/><br/>
    <label class="icclabel">Country</label><?php echo get_property_named(CNTR, $_SESSION['country_id'], 'value'); ?><br/><br/>
    <label class="icclabel">Postal Code</label><?php echo $_SESSION['staff_postal']; ?><br/><br/>
    <label class="icclabel">Phone Number</label><?php echo display_phone_number($_SESSION['staff_phone']); ?><br/><br/>
    <label class="icclabel">Email Address</label><?php echo $_SESSION['staff_email']; ?><br/><br/>
    </div>
    
</div>

<div class="w3-third">

    <div class="notes"><br/></br><br/>
    <p>This section is used for Immaculate Cleaning Conecpts (ICC) staff to Login to the Site and view their Staff Information and their Current Schedule. Staff have the ability to update their personal information and change it for the ICC records. Staff will also be able to change their scheduling availability to notify ICC when they are not available to work on subsequent schedules.</p>    
    <img class="dash" src="./Images/icc.png" alt="Immaculate Cleaning Concepts" />  
    </div>
    
</div>

</div>

<?php include("footer.php"); ?> 