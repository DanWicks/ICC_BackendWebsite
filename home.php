<?php include("header.php"); ?> 
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

     <img src="./Images/icc.jpg" alt="Immaculate Cleaning Concepts" width="100%" />     

</div>

<div class="w3-third">
  <h2>Company Information</h2>
  
  <p>Immaculate Cleaning Concepts (ICC) specializes in providing cleaning services for both domestic and commercial clients. The company is currently experiencing huge growth and management finds themselves in need of a simple way to track their clients, services requested, provided as well as cleaning staff and scheduling. The company has recently undertaken the task of researching potential solutions for supporting their ever-growing business and the decision has been made to source a design for a database and user-friendly interface that supervisory staff, and to a lesser degree, cleaning staff could access for support in the day-to-day operations of the company.</p>

</div>

</div>
<?php include("footer.php"); ?> 