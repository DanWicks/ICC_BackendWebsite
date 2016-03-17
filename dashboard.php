<?php

    include("header.php"); 
    
    if (isset($_GET['sub_menu'])){
		$SubMenu = isset($_GET['sub_menu'])?($_GET['sub_menu']):'X';
		$_SESSION['sub_menu'] = $SubMenu;
        redirect ("./admin-dashboard.php");
	}   
    
    if ($_SESSION['staff_type'] == 'T')
        redirect ("./staff-dashboard.php");
    else if ($_SESSION['staff_type'] == 'S')
        redirect ("./supervisor-dashboard.php");
    else if ($_SESSION['staff_type'] == 'A'){
        $_SESSION['sub_menu'] = 'A';
        redirect ("./admin-dashboard.php?sub_menu=A");}
    else
        redirect ("index.php");

?> 