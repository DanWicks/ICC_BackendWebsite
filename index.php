<?php include("header.php"); ?>  

<?php
    
    // Database Connection Function
    $conn = db_connect();
    $login_id = "";		// user input for user id
	$login_pass = "";	// user input for password
    $error = "";
    $first_name = "";
    $last_name = "";
    $full_name = "";
    // Initial Loading of the Page
    //============================
    if($_SERVER["REQUEST_METHOD"] == "GET")	{
        $login_id = "";
        $login_pass= "";
        $error= "";	
        $full_name = "";
    }			
    else if($_SERVER["REQUEST_METHOD"] == "POST"){					
        $login_id = trim($_POST["login_id"]);
        $login_pass = trim($_POST["login_pass"]);              
        if(!isset($login_id) || $login_id == ""){
            $error .= "Please Enter your User ID.";
        }		
        else if (is_user_id($login_id) == false){
            $error = "That User name does not exist";	
            $login_id = "";
        }
		else {	
            $result = pg_prepare($conn, "password_query", 'SELECT * FROM staff WHERE staff_id = $1 AND staff_password = $2');
            $result = pg_execute($conn, "password_query", array($login_id, $login_pass));					
			if (!isset($login_pass) || $login_pass == ""){
                $error .= "Please Enter your password";
            }	
            else if (pg_num_rows($result) == 0)	{
                $error .= "Incorrect Password.";
                $login_pass = "";
            }
            else {	                
                $_SESSION['staff_id'] = $login_id;
                $_SESSION['staff_password'] = $login_pass; 
                $_SESSION['staff_first'] = trim(pg_fetch_result($result, "staff_first"));	
                $_SESSION['staff_last'] = trim(pg_fetch_result($result, "staff_last"));	
                $_SESSION['staff_type'] = trim(pg_fetch_result($result, "staff_type_id"));	
                $_SESSION['staff_status_id'] = trim(pg_fetch_result($result, "staff_status_id"));	
                $_SESSION['staff_address1'] = trim(pg_fetch_result($result, "staff_address1"));	 
                $_SESSION['staff_address2'] = trim(pg_fetch_result($result, "staff_address2"));	
                $_SESSION['staff_city'] = trim(pg_fetch_result($result, "staff_city"));	
                $_SESSION['province_id'] = trim(pg_fetch_result($result, "province_id"));	
                $_SESSION['country_id'] = trim(pg_fetch_result($result, "country_id"));	
                $_SESSION['staff_postal'] = trim(pg_fetch_result($result, "staff_postal"));	
                $_SESSION['staff_phone'] = trim(pg_fetch_result($result, "staff_phone"));	
                $_SESSION['staff_email'] = trim(pg_fetch_result($result, "staff_email"));
                
                $first_name = trim(pg_fetch_result($result, "staff_first"));
                $last_name = trim(pg_fetch_result($result, "staff_last"));	
                $full_name = $first_name . " " . $last_name;
                $_SESSION['full_name']= $full_name;
                
                if ($_SESSION['staff_type'] == 'T'){
                    $_SESSION['dashboard'] = 'Staff Dashboard';
                    redirect ("./staff-dashboard.php");
                }
                else if ($_SESSION['staff_type'] == 'S'){
                    $_SESSION['dashboard'] = 'Supervisor Dashboard';
                    redirect ("./supervisor-dashboard.php");
                }
                else if ($_SESSION['staff_type'] == 'A'){
                    $_SESSION['dashboard'] = 'Administrator Dashboard';
                    $_SESSION['sub_menu'] = 'A';
                    redirect ("./admin-dashboard.php");}
                else
                    redirect ("index.php");
			}
		}
	}
	
?>  
    
<div class="w3-row-padding">

<div class="w3-third">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>Staff Login</h2>
        <label>Enter ID</label><br/><input name="login_id" type="text" /><br/>
        <label>Enter Password</label><br/><input name   ="login_pass" type="password" /><br/><br/>
        <input type="submit" value="Submit" />
    </form>
    
    <h2> <?php echo $error ?> </h2>   
    
</div>

<div class="w3-third">

     <img src="Images/icc.png" alt="Immaculate Cleaning Concepts" width="100%" />     

</div>

<div class="w3-third">
  <h2>Company Information</h2>
  
  <p>Immaculate Cleaning Concepts (ICC) specializes in providing cleaning services for both domestic and commercial clients. The company is currently experiencing huge growth and management finds themselves in need of a simple way to track their clients, services requested, provided as well as cleaning staff and scheduling. The company has recently undertaken the task of researching potential solutions for supporting their ever-growing business and the decision has been made to source a design for a database and user-friendly interface that supervisory staff, and to a lesser degree, cleaning staff could access for support in the day-to-day operations of the company.</p>

</div>

</div>

<?php include("footer.php"); ?> 