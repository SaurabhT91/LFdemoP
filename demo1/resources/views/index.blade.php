<?php
session_start();
if(isset($_SESSION['LOGGED_IN']))
{
    header("Location: user_page.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
 
    
    .container {
        width: 50vw;
        margin: auto;
        margin-top: 12vh;
    }
    

    
    button {
        font-size: large;
    }
    
    h1 {
        text-align: center;
    }
</style>

<body>

    <div class="container">
        <h1>User Login</h1>
        <form onsubmit="return false;">

            <div class="form-group">
                <label for="">User Name</label>
                <input type="text" name="USER_NAME">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="PASSWORD">
            </div>


                <input class="form-group" type="hidden" name="action_type" value="login">
            <div class="form-group">

                <button type="submit" id="login" >Login</button>
                <button type="submit" id="signup" >Sign Up</button>
            </div>
        </form>
    </div>
    <script src="index.js" defer></script>
</body>

</html>
