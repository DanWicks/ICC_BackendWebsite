<?php include("header.php"); ?> 

<div class="w3-row-padding">

<div class="w3-third">

    <h2><b>Supervisors Dashboard</b></h2>
    <p>This section is used for Immaculate Cleaning Conecpts (ICC)Supervisors and Managers to Login and view information the require when on the Job. The Supervisors and Managers have access to the same inforamtion that Staff Members have as well as the content needed on the Job. Supervisors and Managers will have access to Information about specific Sites they are in charge of, Employees schedules, as well as Immaculate Cleaning Concepts supplies and equipments lists.</p>
    
    <img src="./Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  

</div>

<div class="w3-third">

    <h2><b>Supervisor Menu Options</b></h2>  
    <ul>
    <li><b>Supervisor Dashboard</b></li>
        <ul>
        <li>Main lannding page for Supervisors and Managers that will contain general information and news items that are related to the Job at I.C.C., as well as displaying their current information.</li>
        </ul>
    <li><b>Update Information</b></li>
        <ul>
        <li>The Update Information page allows the logged in Team member to update thier Personal Information. Keeping their own Information up to date allows I.C.C. to always have update information with the need to submit information for the companies Administration for processing.</li>
        </ul>
    <li><b>Site Information</b></li>
        <ul>
        <li>Supervisors and Managers can view Site specific information regarding the Cleaning Sites they will be looking after.</li>
        </ul>
    <li><b>Schedules</b></li>
        <ul>
        <li>Supervisors and Managers can view the Schedules for all employees that will allow them to see who is scheduled to work at specific Sites.</li>
        </ul>
    <li><b>Supplies</b></li>
        <ul>
        <li>Supervisor and Managers can view the supplies I.C.C. currently has to determine what is available for each of their cleaning Sites.</li>
        </ul>
    <li><b>Equipment</b></li>
        <ul>
        <li>Supervisor and Managers can view the equipment I.C.C. currently has to determine what is available for each of their cleaning Sites.</li>
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