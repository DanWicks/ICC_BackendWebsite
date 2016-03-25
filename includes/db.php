<?php
	// DATABASE FUNCTIONS
	//==============================================================
	//==============================================================

	// Database Connection 
	//===============================================================
	function db_connect(){	
		$connection = pg_connect("host=127.0.0.1 dbname='" . DB_NAME . "'user='" . DB_USER . "' password='" . DB_PASSWORD . "'"); 
        //$connection = pg_connect('postgres://uwityljpwrsqju:OBnZlBE5jqpRFLUllAOfgpb8OA@ec2-54-83-22-48.compute-1.amazonaws.com:5432/dcji1sldavs0ts'); 
		return $connection;
	}
    
	// Function to check an entered User ID against the user database
	//===============================================================
	function user_change_password ($login_id, $password){		
		$conn = db_connect();			
		$result = pg_prepare($conn, "user_password_update", 'UPDATE users SET password = $1 WHERE user_id = $2');
		$result = pg_execute($conn, "user_password_update", array($password, $login_id));
	}	
    
	// Function to check an entered User ID against the user database
	//===============================================================
	function is_user_email ($login_id, $email){
		$conn = db_connect();			
		$result = pg_prepare($conn, "user_email_query", 'SELECT * FROM users WHERE user_id = $1 AND email_address = $2');
		$result = pg_execute($conn, "user_email_query", array($login_id, $email));		
		$records = pg_num_rows($result);
		if (pg_num_rows($result) == 0){
			return false;
		} else {
			return true;
		}
	}	

	// Function to check an entered User ID against the user database
	//===============================================================
	function is_user_id ($login_id){		
		$conn = db_connect();			
		$result = pg_prepare($conn, "login_query", 'SELECT * FROM staff WHERE staff_id = $1');
		$result = pg_execute($conn, "login_query", array($login_id));
		$records = pg_num_rows($result);	
		if (pg_num_rows($result) == 0){
			return false;
		}else{
			return true;
		}
	}	
    
	// 
	//===============================================================
	function get_listing($id){
		$conn = db_connect();		
		$listing = array();
		$sql = "SELECT * FROM listing_table WHERE listing_id = $id";
		$result = pg_query($conn, $sql);
		if(pg_num_rows($result))
			$listing = pg_fetch_assoc($result, 0);
		return $listing;
	}
    
	// Return Property from Database based on a Value
	//===============================================================
	function get_property($table_name, $table_value){
		$property = "";	
		$conn = db_connect();	
		$result = pg_prepare($conn, "get_property".$table_name."", 'SELECT * FROM "'.$table_name.'" WHERE value = $1');
		$result = pg_execute($conn, "get_property".$table_name."", array($table_value));			
		$property = trim(pg_fetch_result($result, "property"));
		return $property;
	}	
	
	// Return Property from Database based on a Value
	//===============================================================
	function get_property_named($table_name, $table_value, $index){
		$property = "";	
		$conn = db_connect();	
		$result = pg_prepare($conn, "get_property".$table_name.$index."", 'SELECT * FROM "'.$table_name.'" WHERE value = $1');
		$result = pg_execute($conn, "get_property".$table_name.$index."", array($table_value));	
		$property = trim(pg_fetch_result($result, "property"));
		return $property;
	}	
	
	
	// Return Property from Database based on a Value and Column
	//===============================================================
	function get_table_information($table_name, $table_column, $search, $table_value, $index){
		$property = "";	
		$conn = db_connect();
		$result = pg_prepare($conn, "get_info_".$table_value.$table_column.$index."", 'SELECT * FROM '.$table_name.' WHERE '.$search.' = $1');
		$result = pg_execute($conn, "get_info_".$table_value.$table_column.$index."", array($table_value));			
		$property = trim(pg_fetch_result($result, $table_column));
		return $property;
	}	
    
    // Return Property from Database based on a Value and Column
	//===============================================================
	function get_table_info($table_name, $table_column, $search, $table_value){
		$property = "";	
		$conn = db_connect();
		$result = pg_prepare($conn, "get_info_".$table_value.$table_column."", 'SELECT * FROM '.$table_name.' WHERE '.$search.' = $1');
		$result = pg_execute($conn, "get_info_".$table_value.$table_column."", array($table_value));			
		$property = trim(pg_fetch_result($result, $table_column));
		return $property;
	}	
	
	// Return Property from Database based on a Value
	//===============================================================
	function get_property_noname($table_name, $table_value){
		$property = "";	
		$conn = db_connect();
		$result = pg_prepare($conn, "get_property", 'SELECT * FROM "'.$table_name.'" WHERE value = $1');
		$result = pg_execute($conn, "get_property", array($table_value));
		$property = trim(pg_fetch_result($result, "property"));
		return $property;
	}	
		
	// BUILD FUNCTIONS
	//==============================================================
	//==============================================================
	
	// Build Simple Drop Down
	//===============================================================
	function build_simple_dropdown ($table_name, $preselected = ""){
		$value = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);
		echo "\n<select class=\"".$table_name."\" name=\"".$table_name."\">\n";	
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t<option value='".$value."' ". $selected .">".$value."</option>\n";
		}						
		echo "</select>\n\n";		
	}
    
    // Build Selection Drop Down
	//===============================================================
	function build_select_dropdown ($table_name, $preselected = "", $column)	{        
		$value = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);
		echo "\n<select class=\"".$table_name."\" name=\"".$table_name."\">\n";	
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, $column);
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t<option value='".$value."' ". $selected .">".$value."</option>\n";
		}						
		echo "</select>\n\n";		
	}
		
	// Build Drop Down
	//===============================================================
	function build_drop_down ($table_name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);
		echo "\n<select class=\"".$table_name."\" name=\"".$table_name."\">\n";	
		for($i = 0; $i < $records; $i++){	
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t<option value='".$value."' ".$selected.">".$property."</option>\n";
		}						
		echo "</select>\n\n";		
	}
    
    // Build Drop Down Named
	//===============================================================
	function build_drop_down_named ($table_name, $preselected = "", $name){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);
		echo "\n<select class=\"".$table_name."\" name=\"".$table_name.$name."\">\n";	
		for($i = 0; $i < $records; $i++){	
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t<option value='".$value."' ".$selected.">".$property."</option>\n";
		}						
		echo "</select>\n\n";		
	}
	
	// Build Check Boxes
	//===============================================================
	function build_check_boxes ($table_name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t\n<input type=\"checkbox\" name='".$table_name."' value='".$value."'".$selected."/>".$property;	
		}		
	}
	
	// Build Check Boxes Tall
	//===============================================================
	function build_check_boxes_tall ($table_name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t\n<input type=\"checkbox\" name='".$table_name."' value='".$value."'".$selected."/>".$property."<br/>";	
		}		
	}	
	
	// Get PRoperty Lists
	//===============================================================
	function get_properties_list($table, $included, $delimit = ","){
		$conn = db_connect();
		$label = "";
		$sql = "SELECT property FROM " . $table;
		$result 	= pg_query($conn, $sql);
		$records 	= pg_num_rows($result);
		for($i = 0; $i < $records; $i++){	
			if(isBitSet($i, $included))
				$label .= pg_fetch_result($result, $i, "property") . $delimit;
		}
		$label = substr($label, 0, strlen($label) - strlen($delimit));
		return $label;
	}
	// Build Check Boxes Named
	//===============================================================
	function build_check_boxes_named ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<input type=\"checkbox\" name='".$name."' value='".$value."'".$selected."/>".$property;	
		}		
	}
	
	// Build Check Boxes Property Value
	//===============================================================
	function build_check_boxes_isbit ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<input type=\"checkbox\" name='".$name."[]' value='".$value."'".$selected."/>".$property."<br/>";	
		}		
	}
	
	// Build Check Boxes Property Value
	//===============================================================
	function show_check_boxes_isbit ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<input type=\"checkbox\" name='".$name."[]' disabled='disabled' value='".$value."'".$selected."/>".$property;	
		}		
	}
	
	// Build Check Boxes Named
	//===============================================================
	function build_check_boxes_city ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t\n<input type=\"checkbox\" onclick=\"toggle(this);\" name='".$name."' value='".$value."'".$selected."/>".$property;	
		}		
	}	
	
	// Build Radio Buttons Tall
	//===============================================================
	function build_radio_buttons ($table_name, $preselected = ""){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value || $i == 0)? "checked='checked'":"";
			echo "\t\n<input type=\"radio\" name=\"".$table_name."\" value='".$value."' ".$selected." />".$property."<br/>";	
		}		
	}
	
	// Build Radio Buttons Wide
	//===============================================================
	function build_radio_wide ($table_name, $preselected = ""){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value || $i == 0)? "checked='checked'":"";
			echo "\t\n<input type=\"radio\" name=\"".$table_name."\" value='".$value."' ".$selected." />".$property;	
		}		
	}
	
	// Build Radio Buttons Wide
	//===============================================================
	function build_radio_table ($table_name, $class, $preselected = ""){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value || $i == 0)? "checked='checked'":"";
			echo "\t\n<td class=\"".$class."\"><input type=\"radio\" name=\"".$table_name."\" value='".$value."' ".$selected." />".$property."</td>";	
		}		
	}
	
	// Build Radio with Array Name
	//===============================================================
	function build_radio_array ($table_name, $array, $preselected = ""){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value || $i == 0)? "checked='checked'":"";
			echo "\t\n<input type=\"radio\" name=\"".$table_name."\" value='".$value."' ".$selected." />".$property."(".$array[$i].")";	
		}		
	}
	
	// Build Radio with Array Name
	//===============================================================
	function radio_array_table ($table_name, $array, $class, $preselected = ""){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value || $i == 0)? "checked='checked'":"";
			echo "\t\n<th class=\"".$class."\"><input type=\"radio\" name=\"".$table_name."\" value='".$value."' ".$selected." />".$property."(".$array[$i].")</th>";			
		}		
	}
	
	// Build Radio Buttons Wide with a Name
	//===============================================================
	function build_radio_named ($table_name, $name, $preselected = ""){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			$value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");
			$selected =($preselected == $value || $i == 0)? "checked='checked'":"";
			echo "\t\n<input type=\"radio\" name=\"".$name."\" value='".$value."' ".$selected." />".$property;	
		}		
	}
	
	// Build Select Clause from Search Results
	//===============================================================	
	function build_select_clause($table, $name, $selected, $assignment = " = "){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);
		$clause = ($selected > 0)?" AND (":"";
		for($i = 0; $i < $records; $i++){			
			//echo "in for loop" . $i . " and " . $selected . "<br/>";
			$clause .= isBitSet($i, $selected)? $name . $assignment . pg_fetch_result($result, $i, "value") . " OR ":"";				
		}		
		//echo "<br/>clause: " . $clause;
		$clause = (strlen($clause) > 0)? substr($clause, 0, strlen($clause) - 4).") ":"";
		//echo "clause: " . $clause;
		return $clause;		
	}
    
	// Build Select Clause from Search Results
	//===============================================================	
	function build_select_clause_plain($table, $name, $selected, $assignment = " = "){
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);
		$clause = ($selected >= 0)?" AND (":"";
		//echo "in for loop" . $i . " and " . $selected . "<br/>";
		$clause .= $name . $assignment . $selected. ")";					
		return $clause;
	}
    
	// Make an Array of unique Random Numbers
	//===============================================================
	// Select the last Listing ID from the Database to be used to find the Listing ID range	
	function get_number_array($id){
		$sql = "SELECT listing_id FROM listing_table ORDER BY listing_id DESC LIMIT 1;";
		$result = pg_query($conn, $sql);
		$records = pg_num_rows($result);		
		function randomize($number){
			$random = (mt_rand(10000, $number)); // create a random number between 0 and $number -1 using the modulus operator
			return $random;
		}		
		for ($i = 0; $i < 4; $i++){
			$id[$i] = randomize(pg_fetch_result($result, "listing_id"));					
			if ($i > 0)	{	
				for ($j = 0; $j < $i; $j++)	{
					if ($id[$i] == $id[$j])	{	
						$i--;
					}
				}
			}
		}
	}
    
    // Build Staff Table
	//===============================================================
    function buildStaffTable(){
        $conn 		= db_connect();
        $staffTable = "";
        $staffTable = "<table><tr><td width=\"30%\"><b>Staff ID</b></td><td><b>Staff Name</b></td></tr>";
        $conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM staff ORDER by staff_last ASC";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $firstname = pg_fetch_result($result, $i, "staff_first");
			$lastname = pg_fetch_result($result, $i, "staff_last");
            $staffID = pg_fetch_result($result, $i, "staff_id");
            $staffTable .= "<tr><td><a href=\"./admin-staffview.php?staff_id=".$staffID." \">".$staffID." </a></td><td>".$lastname.", ".$firstname."</td></tr>";
        }
        $staffTable .= "</table>";
        return $staffTable;
    }
    
    // Build Client Table
	//===============================================================
    function buildContactsTable(){
        $conn 		= db_connect();
        $staffTable = "";
        $staffTable = "<table><tr><td width=\"30%\"><b>Code</b></td><td><b>Description</b></td></tr>";
        $conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM contact_methods ORDER by value ASC";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");           
            $staffTable .= "<tr><td>".$value."</td><td>".$property."</td></tr>";
        }
        $staffTable .= "</table>";
        return $staffTable;
    }
    
    // Build Entry Method Table
	//===============================================================
    function buildentry_methodTable(){
        $conn 		= db_connect();
        $staffTable = "";
        $staffTable = "<table><tr><td width=\"30%\"><b>Code</b></td><td><b>Description</b></td></tr>";
        $conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM entry_method ORDER by value ASC";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");           
            $staffTable .= "<tr><td>".$value."</td><td>".$property."</td></tr>";
        }
        $staffTable .= "</table>";
        return $staffTable;
    }
    
    // Build Staff Status Table
	//===============================================================
    function buildstaff_statusTable(){
        $conn 		= db_connect();
        $staffTable = "";
        $staffTable = "<table><tr><td width=\"30%\"><b>Code</b></td><td><b>Description</b></td></tr>";
        $conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM staff_status ORDER by value ASC";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");           
            $staffTable .= "<tr><td>".$value."</td><td>".$property."</td></tr>";
        }
        $staffTable .= "</table>";
        return $staffTable;
    }
    
    // Build Staff Type Table
	//===============================================================
    function buildstaff_typeTable(){
        $conn 		= db_connect();
        $staffTable = "";
        $staffTable = "<table><tr><td width=\"30%\"><b>Code</b></td><td><b>Description</b></td></tr>";
        $conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM staff_type ORDER by value ASC";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $value = pg_fetch_result($result, $i, "value");
			$property = pg_fetch_result($result, $i, "property");           
            $staffTable .= "<tr><td>".$value."</td><td>".$property."</td></tr>";
        }
        $staffTable .= "</table>";
        return $staffTable;
    }
    
    // Build Client Table Short List
	//===============================================================
    function buildclientTable(){
        $conn 		= db_connect();       
        $clientTable = "";
        $clientTable = "<table><tr><td width=\"30%\"><b>Client ID</b></td><td><b>Client Name</b></td><td><b>Contact Name</b></td></tr>";
		$sqldrop 	= "SELECT * FROM clients ORDER by client_name ASC";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $client_id = pg_fetch_result($result, $i, "client_id");
			$client_name = pg_fetch_result($result, $i, "client_name");
            $location_id = pg_fetch_result($result, $i, "location_id");
                    
            $resultname = pg_prepare($conn, "newlocation_id".$i, 'SELECT * FROM client_locations WHERE location_id = $1');
            $resultname = pg_execute($conn, "newlocation_id".$i, array($location_id));
            if ((pg_num_rows($result) == 0)){
                    $firstname = "no";
                    $lastname = "name";
            } else {
               $firstname=trim(pg_fetch_result($resultname, 'client_first_name'));	
               $lastname=trim(pg_fetch_result($resultname, 'client_last_name'));	
            }          
            $name = isset($client_name)?($client_name):($lastname. ", ".$firstname);    
            $clientTable .= "<tr><td><a href=\"./admin-clientview.php?client_id=".$client_id." \">".$client_id." </a></td><td>".$name."</td><td>".$lastname. ", ".$firstname."</td></tr>";
        }
        $clientTable .= "</table>";
        return $clientTable;
    }
    
    // Build Client Sites Table 
	//===============================================================
    function builClientSitesTable($client_id){
        $conn 		= db_connect();
        $buildTable = "";
        $buildTable = "<table><tr><td width=\"30%\"><b>Site ID</b></td><td><b>Contact Name</b></td><td><b>Phone Number</b></td></tr>";
		$result = pg_prepare($conn, "query_sites", 'SELECT * FROM sites WHERE site_client_id = $1');
        $result = pg_execute($conn, "query_sites", array($client_id));
		$records = pg_num_rows($result);	
		
		for($i = 0; $i < $records; $i++){
            $site_id=trim(pg_fetch_result($result, $i,'site_id'));	
            $location_id=trim(pg_fetch_result($result, $i,'site_location_id'));	            
                $resultname = pg_prepare($conn, "newlocation_id".$i, 'SELECT * FROM client_locations WHERE location_id = $1');
                $resultname = pg_execute($conn, "newlocation_id".$i, array($location_id));
                $firstname=trim(pg_fetch_result($resultname, 'client_first_name'));	
                $lastname=trim(pg_fetch_result($resultname, 'client_last_name'));	
                $phone=trim(pg_fetch_result($resultname, 'client_phone_number'));	           
                      
            $name = ($lastname. ", ".$firstname);    
            $buildTable .= "<tr><td><a href=\"./admin-sitesinfo.php?site_id=".$site_id." \">".$site_id." </a></td><td>".$name."</td><td>".display_phone_number($phone)."</td></tr>";
        }
        
        $buildTable .= "</table>";
        return $buildTable;
    }
    
    // Build Site Services Table 
	//===============================================================
    function buildSiteServiceTable($site_id){
        $conn 		= db_connect();
        $buildTable = "";
        $buildTable = "<table><tr><td width=\"30%\"><b>Services Required</b></td><td><b>Pricing</b></td></tr>";
		$result = pg_prepare($conn, "query_services_required", 'SELECT * FROM services_required WHERE site_id = $1');
        $result = pg_execute($conn, "query_services_required", array($site_id));
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $service_id=trim(pg_fetch_result($result, 'service_id'));	            
            
            $resultname = pg_prepare($conn, "new_services".$i, 'SELECT * FROM services WHERE service_id = $1');
            $resultname = pg_execute($conn, "new_services".$i, array($service_id));
            $description=trim(pg_fetch_result($resultname, 'service_description'));	
            $price=trim(pg_fetch_result($resultname, 'service_price'));	 
           
            $buildTable .= "<tr><td>".$description." </a></td><td>".$price."</td></tr>";
        }
        $buildTable .= "</table>";
        return $buildTable;
    }
    
    // Build Site Equipement Table 
	//===============================================================
    function buildSiteEquipmentTable($requirements_id){
        $conn 		= db_connect();
        $buildTable = "";
        $buildTable = "<table><tr><td width=\"30%\"><b>Equipement Required</b></td></tr>";
		$result = pg_prepare($conn, "query_equipment_required", 'SELECT * FROM required_equipment WHERE requirements_id = $1');
        $result = pg_execute($conn, "query_equipment_required", array($requirements_id));
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
            $equipment_id=trim(pg_fetch_result($result, 'equipment_id'));	            
            
            $resultname = pg_prepare($conn, "new_equipment".$i, 'SELECT * FROM specialty_equipment WHERE specialty_equipment_id = $1');
            $resultname = pg_execute($conn, "new_equipment".$i, array($equipment_id));
            $specialty_equipment_description=trim(pg_fetch_result($resultname, 'specialty_equipment_description'));	
           
            $buildTable .= "<tr><td>".$specialty_equipment_description." </a></td></tr>";
        }
        $buildTable .= "</table>";
        return $buildTable;
    }
    
    // Build Check Boxes Equipment
	//===============================================================
	function build_check_boxes_equipment ($table_name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){
			
			$value = pg_fetch_result($result, $i, "specialty_equipment_id");
			$property = pg_fetch_result($result, $i, "specialty_equipment_description");
			$selected =($preselected == $value)? "selected='selected'":"";
			echo "\t\n<label class=\"icclabel\">".$property."</label><input type=\"checkbox\" name='".$table_name."' value='".$value."'".$selected."/><br/>";	
		}		
	}	
    
    // Build Check Boxes Property Value
	//===============================================================
	function build_check_bit_equip ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "specialty_equipment_id");
			$property = pg_fetch_result($result, $i, "specialty_equipment_description");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<label class=\"icclabel\">".$property."</label><input type=\"checkbox\" name='".$name."[]' value='".$value."'".$selected."/><br/>";	
		}		
	}
    
     // Build Check Boxes Property Value
	//===============================================================
	function build_check_bit_services ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "service_id");
			$property = pg_fetch_result($result, $i, "service_description");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<label class=\"icclabel\">".$property."</label><input type=\"checkbox\" name='".$name."[]' value='".$value."'".$selected."/><br/>";	
		}		
	}
    
    // View Check Boxes Property Value
	//===============================================================
	function view_check_bit_equip ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "specialty_equipment_id");
			$property = pg_fetch_result($result, $i, "specialty_equipment_description");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<label class=\"icclabel\">".$property."</label><input type=\"checkbox\" onclick=\"return false\" name='".$name."[]' value='".$value."'".$selected."/><br/>";	
		}		
	}
    
     // View Check Boxes Property Value
	//===============================================================
	function view_check_bit_services ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);			
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "service_id");
			$property = pg_fetch_result($result, $i, "service_description");
			$selected = isBitSet($i, $preselected)? " checked='checked'":"";
			echo "\t\n<label class=\"icclabel\">".$property."</label><input type=\"checkbox\" onclick=\"return false\" name='".$name."[]' value='".$value."'".$selected."/><br/>";	
		}		
	}
    
    // Build Label List Property Value
	//===============================================================
	function build_label_list_equip ($table_name, $name, $preselected = ""){
		$value = "";
		$property = "";
		$selected = "";		
		$conn 		= db_connect();
		$sqldrop 	= "SELECT * FROM ".$table_name."";
		$result 	= pg_query($conn, $sqldrop);
		$records 	= pg_num_rows($result);		
        echo "<ul>";
		for($i = 0; $i < $records; $i++){			
			$value = pg_fetch_result($result, $i, "specialty_equipment_id");
			$property = pg_fetch_result($result, $i, "specialty_equipment_description");
			
			echo "\t\n<li>".$property."</li><br/>";	
		}	
        echo "</ul>";
	}
?>
