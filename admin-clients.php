<?php 
    include("header.php"); 
?> 

<div class="w3-row-padding">

<div class="w3-third">
    
    <div class="notes">   
    <h1>Client Information Options</h1>
    <hr/>
    <a href="./admin-dashboard.php" class="dash"><h3>Admin Home Page</h3></a><br/>
    </div>
    <div class="notes">   
    <h3>Client Information</h3>
    <p>Main lannding page for Administrators and Owners for the Staff Information menu.</p>
    <a href="./admin-createclients.php" class="dash"><h3>Enter New Client</h3></a>
    <p>Create New I.C.C. Clients.</p>
    </div>
 
</div>

<div class="w3-third">
    
    <br/>
    <div class="notes">   
    <h2>Client Listing</h2><hr/>
    <br/>
    <?php echo buildclientTable(); ?>
    </div>
    
</div>

<div class="w3-third">

    <br/></br><br/>
    <div class="notes">   
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information used by the site when creating, viewing and updating Clients, Contracts and Location Assesments. Their access is divided into four areas, with each of these areas containing more menu options. These four areas are Create New Clients, Maintain Clients, Maintain Contract and Location Assesments.</p>
    </div>
    
    <div class="notes">   
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts" />  
    </div>

</div>

</div>

<?php include("footer.php"); ?> 