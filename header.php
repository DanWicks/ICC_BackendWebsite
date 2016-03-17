<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>    
    <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1 charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="./css/w3.css" />
    <title> I.C.C. </title>		
</head>	
<body>

<?php
    require("./includes/constants.php");
	require("./includes/db.php");
	require("./includes/functions.php");	
	ob_start(); 
    $MenuName = "";
    $SubMenu = "";
    $title = "";
    if(session_id() == ""){
		session_start();       
	}        
    $MenuName = "Immaculate Cleaning Concepts";
    $title = "I.C.C.";
    if (isset($_SESSION['full_name'])){
        $title = $_SESSION['full_name'];
    } 
  
?>

<header>
    <div class="w3-container w3-red">
      <h2><?php echo $title; ?></h2>
    </div>
        
   <div>
        <ul class="w3-navbar w3-red">
            <li class="w3-dropdown-hover">
            <p id="MenuName"><?php if (isset($_SESSION['dashboard'])) {echo $_SESSION['dashboard'];} else { echo $MenuName;} ?></p>
            <div class="w3-dropdown-content w3-red">
            <?php 
            if (isset($_SESSION['staff_type'])) {
                echo displayMenu($_SESSION['staff_type']);
            }
            ?>
            </div>
          </li>
        </ul>
    </div>  
</header>
 