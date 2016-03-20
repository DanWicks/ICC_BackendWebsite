<?php   
    include("header.php"); 
?> 

<div class="w3-row-padding">

<div class="w3-third">

    <h2><b>Staff Information Dashboard</b></h2>
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information used by the site when creating, viewing and updating Staff, Schedules and Staff availability. Their access is divided into five areas, with each of these areas containing more menu options. These five areas are Maintain Staff, Enter New  Staff, Maintain Schedule, Staff Availability and Update Information.</p>
    
    <img src="./Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />  

</div>

<div class="w3-third">

    <h2><b>Staff Information Options</b></h2>  
    <ul>
    <li><b>Staff Information Dashboard</b></li>
        <ul>
        <li>Main landing page for Administrators and Owners for the Staff Information menu.</li>
        </ul>
    <li><b><a href="./admin-staffcreate.php">Enter New Staff</a></b></li>
        <ul>
        <li>Enter New staff information into the I.C.C. database.</li>
        </ul>   
    <li><b><a href="./admin-schedule.php">Scheduling</a></b></li>
        <ul>
        <li>Maintain the information for Staff Schedules.</li>
        </ul>
    <li><b><a href="./admin-availibilty.php">Staff Availibility</a></b></li>
        <ul>
        <li>Maintain the information for Staff Availabilities for scheduling.</li>
        </ul>    
    </ul>
 
</div>

<div class="w3-third">

    <h2><b>Staff Information</b></h2>
    <br/>
    <?php echo buildStaffTable(); ?>
    
</div>

</div>

<?php include("footer.php"); ?> 