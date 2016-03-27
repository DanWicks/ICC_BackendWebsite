<?php   
    include("header.php"); 
?> 

<div class="w3-row-padding">



<div class="w3-third">

    <div class="notes">  
    <h1>Equipment and Supplies Options</h1> 
    <hr/> 
    <a href="./admin-dashboard.php" class="dash"><h3>Return to Administration Dashboard</h3></a><br/>    
    <a href="./admin-assets.php" class="dash"><h3>Equipment and Supplies Dashboard</h3></a></li>
    <p>Main landing page for Administrators and Owners for the Equipment and Supplies menu.</p>
    <a href="./admin-services.php" class="dash"><h3>Maintain Services</h3></a>
    <p>Maintain the information for I.C.C Services that are available.</p>
    <a href="./admin-vendors.php" class="dash"><h3>Maintain Vendors</h3></a>
    <p>Create new Locations for Vendor information.</p>
    <a href="./admin-equipment.php" class="dash"><h3>Maintain Equipment</h3></a>
    <p>Maintain the information for Equipment information.</p>
    <a href="./admin-supplies.php" class="dash"><h3>Maintain Supplies</h3></a>
    <p>Maintain the Required Services for Supplies information.</p>
    </div>
 
</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">  
    <h2>Vendor Listing</h2><hr/>
    <br/>
    <?php  echo build_vendor_Table(); ?>
    </div>
    
</div>

<div class="w3-third">

    <br/><br/>
    <div class="notes">  
    <p>This pages is used for Immaculate Cleaning Conecpts (ICC) Owners and Administration to maintain the information for I.C.C. Services, Vendors, Equipment and Supplies. Their access is divided into four areas, with each of these areas containing more menu options. These four areas are Maintain Services, Maintain Vendors, Maintain Equipment, and Maintain Supplies.</p>
    </div>
    
    <div class="notes">
    <img class="smlimg" src="Images/icc.png" alt="Immaculate Cleaning Concepts" />   
    </div>
    
</div>

</div>

<?php include("footer.php"); ?> 