<?php 
    include("header.php"); 
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
    <li><b><a href="./admin-createclients.php">Enter New Clients</a></b></li>
        <ul>
        <li>Create New I.C.C. Clients.</li>
        </ul>   
    </ul>
 
</div>

<div class="w3-third">

    <h2><b>Client Listing</b></h2>
    <?php echo buildclientTable(); ?>
    
</div>

</div>

<?php include("footer.php"); ?> 