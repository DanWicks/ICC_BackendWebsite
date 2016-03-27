<?php   
    include("header.php"); 
?> 

<div class="w3-row-padding">

<div class="w3-third">

    <div class="notes">   
    <h1>Staff Information Options</h1><hr/> 
    <a href="./admin-dashboard.php" class="dash"><h3>Return to Administration Dashboard</h3></a><br/>
    <a href="./admin-staff.php" class="dash"><h3>Staff Options</h3></a>
    <p>Main landing page for Administrators and Owners for the Staff Information menu.</p>
    <a href="./admin-staffcreate.php" class="dash"><h3>Enter New Staff</h3></a>
    <p>Enter New staff information into the I.C.C. database.</p>
    <a href="./admin-schedule.php" class="dash"><h3>Scheduling</h3></a>
    <p>Maintain the information for Staff Schedules.</p>
    <a href="./admin-availibilty.php" class="dash"><h3>Staff Availibility</h3></a>
    <p>Maintain the information for Staff Availabilities for scheduling.</p>  
    </div>
    
</div>

<div class="w3-third">
    
    <br/><br/>
    <div class="notes">   
    <h2>Staff Listing</h2><hr/>
    <br/>
    <?php echo buildStaffTable(); ?>
    </div>
    
</div>

<div class="w3-third"> 
    
    <br/></br>
    <div class="notes">      
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information used by the site when creating, viewing and updating Staff, Schedules and Staff availability. Their access is divided into five areas, with each of these areas containing more menu options. These five areas are Maintain Staff, Enter New  Staff, Maintain Schedule, Staff Availability and Update Information.</p>
    </div>
    
    <div class="notes">   
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts" />  
    </div>
    
</div>

</div>

<?php include("footer.php"); ?> 