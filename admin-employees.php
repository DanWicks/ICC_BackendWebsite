 <!DOCTYPE html>
<html>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./css/w3.css" />
<body>

<header>
    <div class="w3-container w3-red">
      <h2>I.C.C<?php?></h2>
        <p>Employee Information</p>
    </div>        
    <div>
        <ul class="w3-navbar w3-red">
            <li class="w3-dropdown-hover">
            <a href="#">Dropdown</a>
            <div class="w3-dropdown-content w3-red">
                <a href="./admin-dashboard.php">Dashboard</a>
                <a href="./admin-update.php">Update ICC Information</a>
                <a href="./view-employees.php">View Employees</a>
                <a href="./create-employees.php">Create Employees</a>
                <a href="./view-vendors.php">View Vendors</a>
                <a href="./create-vendors.php">Create Vendors</a>
                <a href="./view-supplies.php">View Supplies</a>
                <a href="./create-supplies.php">Create Supplies</a>
                <a href="./logout.php">Logout</a>
            </div>
            </div>
          </li>
        </ul>
    </div>  
</header>

<div class="w3-row-padding">

<div class="w3-half">

    <h2>Information</h2>
    <br/>
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

  <h2>  Schedule</h2>  
  <label class="icclabel">Sunday</label><input></input><br/><br/>
  <label class="icclabel">Monday</label><input></input><br/><br/>
  <label class="icclabel">Tuesday</label><input></input><br/><br/>
  <label class="icclabel">Wednesday</label><input></input><br/><br/>
  <label class="icclabel">Thursday</label><input></input><br/><br/>
  <label class="icclabel">Friday</label><input></input><br/><br/>
  <label class="icclabel">Saturday</label><input></input><br/><br/>
 
</div>

</div>

<footer>
    <div class="w3-container w3-red">  
      <p>Brought to you by Redline Solutions</p>
    </div>
</footer>  
  
</body>
</html>