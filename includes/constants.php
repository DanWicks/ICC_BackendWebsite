<?php
	// Definitions of Constants
	//=========================
	
	// Database Constants
	define("DB_NAME"	, 'icc_project'); 
    //define("DB_NAME"	, 'TESTING-ICC1'); 
	define("DB_USER"	, 'redline_admin'); 
	define("DB_PASSWORD", 'redline_access'); 
    //define("DB_NAME"	, 'dcji1sldavs0ts'); 
    //define("DB_USER"	, 'uwityljpwrsqju'); 
	//define("DB_PASSWORD", 'OBnZlBE5jqpRFLUllAOfgpb8OA'); 
	
	// Cookies Expiry
	define("EXPIRE"		,604800); 		// for 30 days storage
	define("FEATURE"	,86400); 		// for 1 day storage
	define("WELCOME"	,86400);		// for 1 day storage
	
	// User Type Constants
	define("A"			,'Administrator');
	define("S"			,'Supervisor');
	define("T"			,'Team-Member');
	define("D"			,'Owner');
	define("M"			,'Manager');
    
    // Min MAX 
    define("MIN_PN"     ,10);
    define("MAX_PN"     ,14);
		
	// Table Names
	define("STAF"		,"staff");
	define("PROV"		,"provinces");
	define("TYPE"		,"staff_type");
	define("STAT"		,"staff_status");
	define("ADMN"		,"region_links");
    define("CNTR"		,"countries");
    define("CNTC"       ,"contact_methods");
    define("LOCA"       ,"client_locations");
    define("CLNT"       ,"clients");
    define("SITE"       ,"sites");
    define("STME"       ,"shift_times");
    define("CONT"       ,"client_contracts");
    define("SITR"       ,"site_requirements");
    define("ENTR"       ,"entry_method");
    define("SIEN"       ,"site_entry");
    define("REEQ"       ,"required_equipment");
    define("SPEQ"       ,"specialty_equipment");
    define("CLST"       ,"client_status");
    define("STST"       ,"site_status");
    define("SRVR"       ,"services_required");
    define("SRVC"       ,"services");
    
    
    // Column Names
    define("LOCATION"   ,"location_id");
    define("CLIENT"     ,"client_id");
    define("STAFF"      ,"staff_id");
    define("SITES"      ,"site_id");

	// Listing Limits
	define("MAX_SEARCH"	,200);
	define("MAX_PAGE"	,10);
	define("MAX_IMAGE"	,5);
	define("MAX_USER"	,10);
	
	// Redirect Page Names	
	define("AGENT"		,"dashboard.php");
	define("ADMIN"		,"admin.php");
	define("ADMNDASH"	,"admin-dashboard.php");
	define("SUPRDASH"   ,"supervisor-dashboard.php");
	define("HOME"		,"index.php");
	define("LOGIN"		,"login.php");
	define("STAFDASH"	,"staff-dashboard.php");
    define("ADMNSTFF"   ,"admin-staff.php");
    define("ADMNLOCA"   ,"admin-locationinfo.php");
    define("ADMNSITE"   ,"admin-sites.php");
    define("ADMNSTIN"   ,"admin-staffinfo.php");
    
    // Page Constants
    define("START"      ,"_start");
    define("END"        ,"_end");
	
?>
