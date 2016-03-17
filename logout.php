<?php 

    include("header.php"); 
    if (isset($_SESSION['staff_id'])){
        session_unset();
        redirect ("./logout.php");
    }
     
 ?> 
    
<div class="w3-row-padding">

<div class="w3-half">
    
    <h2>You have sucessfully Logged Out</h2>
    <h2>Select Home to continue.</h2>   
    <br/>
    <form action="./index.php" method="get">     
        <input type="submit" value="Home">
    </form>
    <br/>

</div>

<div class="w3-half">    

</div>

</div>

<?php include("footer.php"); ?> 