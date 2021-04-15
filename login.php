<?php

include('master_page.php');
include('db_operations.php');

if (isset($_POST['SubmitCheck'])) {
    $sql = "SELECT id,firstname,lastname FROM tblUsers WHERE email = '".$_POST['userEmail']."' AND passwd = '".$_POST['userPassword']."';";
    $res = dbQuery($servername, $username, $password, $dbname, $sql);
    
    if ($res == "0 results") {

        // echo "Incorrect Email or Password! Returning you to the form...";
        // header("Refresh:3");
        echo '<script>alert("Incorrect Email or Password!")</script>';
        header("Refresh:0");
    }

    else {

        $userFullName = $res[0]['firstname']." ".$res[0]['lastname'];
        
        // echo "Hello ".$userFullName."!";
        setcookie("checkLogin",$userFullName, time() + 60);
        header("Refresh:0; url=index.php");
        
    }
   
} 

else {
    // The form has not been posted; Show the form
    headTags($title);
    bodyTags($title);
    ?>

    <!--Content-->
    <h2>Please, login to see the website content:</h2>
    <br>
    <div class="container">
        
        <form id="LoginForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="userEmail">Registration Email:</label>
        <input type="text" name="userEmail">

        <label for="userPassword">Password:</label>
        <input type="password" name="userPassword">
    
        <input type="hidden" name="SubmitCheck" value="sent">
        <input type="Submit" name="LoginForm_Submit" value="Login">
        </form>
    </div>
    <!-- End of Content-->
<?php
footerTags($openHours,$phoneNumber,$formattedPN,$emailAddress,$mainAddress);
}
?>
