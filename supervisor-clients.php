<?php 
    include("header.php"); 
?> 

<div class="w3-row-padding">

<div class="w3-third">
    
    <div class="notes">   
    <h1>Client Information Options</h1>
    <hr/>
    <a href="./supervisor-dashboard.php" class="dash"><h3>Home Page</h3></a><br/>
    <h2>Client Listing</h2><hr/>
    <br/>
    <?php echo buildclientSuperTable(); ?>  
    <br/><br/>
    </div>   
 
</div>

<div class="w3-third">
    
    <br/><br/>
    <div class="notes">   
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information used by the site when creating, viewing and updating Clients, Contracts and Location Assesments. Their access is divided into four areas, with each of these areas containing more menu options. These four areas are Create New Clients, Maintain Clients, Maintain Contract and Location Assesments.</p>
    </div>    
    
</div>

<div class="w3-third">

    <br/></br>  
    <div class="notes">   
    <img class="smlimg" src="./Images/icc.png" alt="Immaculate Cleaning Concepts" />  
    </div>

</div>

</div>

<?php include("footer.php"); ?> 