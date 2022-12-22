<!--
/*
*
* Develop By
* Name: Jansen Liu
* Date: 2022/10/21
* Email: Jansenliu9810@gmail.com
*
*/
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Company,Reviews,Job experiences,ReviewsDance,Login" name="keywords">
    <meta content="The most comprehensive information" name="description">
    <meta content="Group 5" name="author">

    <link rel="stylesheet" href="css/LoginStyle.css">
    <link rel="shortcut icon" href="logins.png" type="image/x-icon" />
    <title>Client Login</title>
    <script type="text/javascript" src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>

    <script type="text/javascript">
        function randoms()
        {
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";
        }


        // letter and digit validate
        jQuery.validator.addMethod("chrnum", function(value, element) {
            var chrnum = /^([a-zA-Z0-9]+)$/;
            return this.optional(element) || (chrnum.test(value));
        }, "Only input digits and letter(Char:A-Z, a-z, 0-9)");

        $().ready(function() {
            // Validate the submission form
            $("#loginform").validate({
                rules: {
                    name: "required",   //username
                    // over 6 digits password
                    password: {
                        required: true,
                        minlength:6,
                        chrnum: true
                    }
                },
                messages: {
                    id: "Please enter your Username/Account",
                    password: {
                        required: "Please enter Password",
                        minlength: "Please enter a Password more than 6 digit",
                    }
                }
            });
        });

    </script>
    <style>
        .error{
            color:red;
        }
    </style>
</head>

<body onload="randoms()">



<section>
    <a class="home" href="index.php"><img src="img/ReviewsDance-c.png" alt="home" width="162px" height="160px"></a>

    <!-- Login Container -->
    <div class="container">
        <div class="form">
            <h2>Login</h2>
            <form id = "loginform" action="login.php" method="post" name = "form1">
                <div class="inputBox">
                    <input type="text" placeholder="Username/Account" name="username" id="username">

                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Password" name="password" id="password">

                </div>
                <div class="inputBox">
                    <input type="submit" value="Login" id="input1">
                </div>
                <p class="forget">Forgot Password?<a href="forget.php">
                        Click on Here
                    </a></p>
                <p class="forget">Haven't an account?<a href="register.php">
                        Register
                    </a></p>
            </form>
        </div>
    </div>
    </div>
</section>

<!-- PHP content -->
<?php
// require lib php file
require_once "UserInfo.php";
require_once "db_connect.php";
require_once "UserDbFunction.php";

// Separate two entering values not null, then run the user information searching
if(isset($_POST['username']) && isset($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username != null && $password != null){

        // Execute Searching function
        $result = SelectUser($username, $password);

        // Extract data from the username and password in the Array fetch()
        $fetchId = $result['id'];
        $fetchUser = $result["username"];
        $fetchPass = $result["password"];
        // echo "<h2>$row<br>$fetchUser<br>$fetchPass</h2>";

        // Check whether the login is successful
/*        if($row > 0){
            $url='http://localhost/Project/Project_Sample_Resource/sample_project/project_main_interface.html';
            echo "<script>alert('Login Successful!'); location.href='$url'</script>";
        }
        else {
            $url = 'http://localhost/Project/Project_Sample_Resource/sample_project/login.php';
            echo "<script>alert('Username or Password not correct or not existed, Please try again!'); location.href='$url'</script>";
        }*/


        // Cookie Setting and Check whether the login is successful
        if($result){
            $IdCookie = setcookie('id', $fetchId, time()+7200);               // Set a cookie store user-id, time is two hour (unit: second)
            $UserCookie = setcookie('username', $fetchUser, time()+7200);     // Set a cookie, time is two hour (unit: second)
            $url='index.php';
            echo "<script>alert('Login Successful!'); location.href='$url'</script>";
        }
        else{
            $url = 'login.php';
            echo "<script>alert('Username or Password not correct or not existed, Please try again!'); location.href='$url'</script>";
        }

    }
    else{
        $url = 'login.php';
        echo "<script>alert('Username and Password Cannot be null, Please enter an Username and Password!'); location.href='$url'</script>";
    }
}

?>

</body>
</html>








