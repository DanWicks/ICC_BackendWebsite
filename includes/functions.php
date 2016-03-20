<?php
/*	Name 			: Sold Real Estate Group
	Group Memebers	: Gavin Shelley / Daniel Just / Milad Sakhizadah
	Course Code		: INTN3201 Internet Developement
	File			: db.php
	Description		: This is functions file for SOLD Real estate website.
	Date Created	: Sept 8 2014
	Validated		: N/A 
*/

	// DISPLAY FUNCTIONS
	//==============================================================
	//==============================================================

	// Function to Display Copyright Information
	function displayCopyrightInfo () {
		echo "&copy; Redline Solutions " . date('Y');
	}	
	
	// REDIRECT FUNCTION
	//==============================================================
	//==============================================================
	
	// Redirect to Logout page			
	function redirect ($page_name) {
		header("Location:".$page_name);
		ob_flush();
	}	
	
	// VALIDATION FUNCTIONS
	//==============================================================
	//==============================================================
	
	// Check if a user entered phone number is valid
	function is_valid_phone($phone) {
		$check_phone = "";		
		$check_phone = (substr($phone,0, MIN_PN));	
        if(!preg_match('/^[2-9]{1}[0-9]{2}[2-9]{1}[0-9]{2}[0-9]{4}$/', $check_phone)) {
			return false;
		} else 	{
			return true;
		}	
	}	
	
	// Display a stored phone number and output a formatted stirng
	function display_phone_number ($phone) {
		$output_phone = "";
		$output_phone = "(".(substr($phone,0,3)).") ".(substr($phone,3,3))."-".(substr($phone,6,4));
		if (strlen($phone) > MIN_PN) {
			$output_phone .= " EXT ".(substr($phone, MIN_PN, (strlen($phone))));
		}
		return $output_phone;
	}
	
	// Check to see if a user entered password is valid
	function is_valid_postal_code ($check_code) {
		$provinces = "";
		$letters = "";		
		$counter = "";
		$counter = 0;		
		$provinces = array('A','B','C','E','G','H','J','L','M','N','P','R','S','T','V','X','Y');
		$letters = array('A','B','C','E','G','H','J','K','L','M','N','P','R','S','T','V','W','X','Y');
		for ($i = 0; $i < MAX_PC; $i++) {
			if ($i == 0) {
				foreach ($provinces as &$value) {
					if ($value == $check_code[$i]) {
						$counter ++;
					}
				}
			}
			if ($i == 2 || $i == 4) {
				$check = $check_code[$i];
				foreach ($letters as &$value) {
					if ($value == $check_code[$i]) {
						$counter++;	
					}
				}
			}
			if ($i == 1 || $i == 3 || $i == 5) {
				if (is_numeric($check_code[$i])) {
					$counter++;
				}
			}
		}
		if ($counter == MAX_PC)	{
			return true;
		} else {
			return false;
		}
	}
	
	/*
	this function should be passed a integer power of 2, and any decimal number,
	it will return true (1) if the power of 2 is contain as part of the decimal argument
	*/
	function isBitSet($power, $decimal) {
		if((pow(2,$power)) & ($decimal)) 
			return 1;
		else
			return 0;
	} 
	
	/*
	this function can be passed an array of numbers (like those submitted as 
	part of a named[] check box array in the $_POST array).
	*/
	function sumCheckBox($array) {
		$num_checks = count($array); 
		$sum = 0;
		for ($i = 0; $i < $num_checks; $i++) {
		  $sum += $array[$i]; 
		}
		return $sum;
	}
	
	// Format Currency
	//====================================================
	function format_currency($value)
	{
		$currency = "";
		$spacing="";
		$check = "";
		$add = "";				
		$currency = "$";
		$loop = ceil(strlen($value)/3);
		$spacing = strlen($value)%3;
		if ($spacing == 0) {
			$check = 1;
		} else {
			$check = 0;
		}
		$add=0;		
		for ($i = 0; $i < $loop; $i++) {	
			if ($check == 0) {		
				$currency .= substr($value,0,$spacing).",";	
				$check = 1;
			} else {
				$currency .= substr($value,0+$spacing+($add),3).",";
				$add = $add + 3;
			}			
		}
		$currency = substr($currency, 0, strlen($currency) - strlen(1));
		return $currency;
	}
	
	// Page Number Links
	//==========================================
	function pagination($page, $total_pages, $name) {	
		if ($total_pages == 1) 	{
			echo "<td class=\"site_navc\">1</td>";
		} else {
			echo "<td class=\"site_navc\">"; 
			if ($page > 1) {
				echo "<a href='".$name."?page=".($page-1)."'> PREV </a>";
			} else {
				echo " PREV ";
			}
			// Display Page Links
			for ($i=1; $i<=$total_pages; $i++) {
				if ($i == $page) { 
                    echo $i; 
                } else { 
                    echo "<a href='".$name."?page=".$i."'> ".$i."</a> ";
                }
			}	
			if ($page < $total_pages) {
				echo "<a href='".$name."?page=".($page+1)."'> NEXT </a>";
			} else {
				echo " NEXT ";
			}
			echo "</td>";	
		}
	}
    
    // Page Number Links
	//==========================================
    function displayMenu(){
        $userMenu = "";        
        if ($_SESSION['staff_type'] == 'T') {
            $userMenu = "<a href=\"./staff-dashboard.php\">Home</a><a href=\"./staff-update.php\">Upadte Information</a><a href=\"./staff-availability.php\">Availability</a><a href=\"./logout.php\">Logout</a>" ;
        } else if ($_SESSION['staff_type'] == "S") {
            $userMenu =  "<a href=\"./supervisor-dashboard.php\">Home</a><a href=\"./supervisor-update.php\">Update Information</a><a href=\"./supervisor-siteinfo.php\">Site Information</a><a href=\"./supervisor-schedules.php\">Schedules</a><a href=\"./supervisor-supplies.php\">Supplies</a><a href=\"./supervisor-equipment.php\">Equipment</a><a href=\"./logout.php\">Logout</a>";
        } else if (isset($_SESSION['staff_type']) && ($_SESSION['staff_type'] == 'A')){          
                $userMenu = "<b><a href=\"./admin-dashboard.php\">Administration Menu</a></b><a href=\"./admin-site.php\">Website Administration</a><a href=\"./admin-staff.php \">Staff Information</a><a href=\"./admin-clients.php\">Client Information</a><a href=\"./admin-assets.php\">Equip. and Supplies</a><a href=\"./logout.php\">Logout</a>";
        }                
        return $userMenu;
    }	
?>
