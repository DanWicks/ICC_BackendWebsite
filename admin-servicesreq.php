<?php include("header.php"); ?>  

<?php
$site_id = "";
     if (isset($_GET['site_id'])){		
        $site_id = $_GET['site_id'];       
    } else {
        redirect ("./admin-clientinfo.php");
    }
?>

<div class="w3-row-padding">

    <h2><b>Services Required</b></h2>
    
    <p><a href="./admin-sitesinfo.php?site_id=<?php echo $site_id; ?> ">View Site Information </a></a>

<div class="w3-half">

    <label class="icclabel">First Name</label><input></input><br/><br/>
    <label class="icclabel">Last Name</label><input></input><br/><br/>
    <label class="icclabel">Address</label><input></input><br/><br/>
    <label class="icclabel">Address</label><input></input><br/><br/>
    <label class="icclabel">City</label><input></input><br/><br/>
    <label class="icclabel">Country</label><input></input><br/><br/>
    <label class="icclabel">Postal Code</label><input></input><br/><br/>
    <label class="icclabel">Phone Number</label><input></input><br/><br/>
    <label class="icclabel">Email Address</label><input></input><br/><br/>
    
</div>

<div class="w3-half">
  
  <label class="icclabel">Sunday</label><input></input><br/><br/>
  <label class="icclabel">Monday</label><input></input><br/><br/>
  <label class="icclabel">Tuesday</label><input></input><br/><br/>
  <label class="icclabel">Wednesday</label><input></input><br/><br/>
  <label class="icclabel">Thursday</label><input></input><br/><br/>
  <label class="icclabel">Friday</label><input></input><br/><br/>
  <label class="icclabel">Saturday</label><input></input><br/><br/>
 
</div>

</div>

<?php include("footer.php"); ?> 