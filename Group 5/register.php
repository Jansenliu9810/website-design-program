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
    <meta content="Company,Reviews,Job experiences,ReviewsDance,Register" name="keywords">
    <meta content="The most comprehensive information" name="description">
    <meta content="Group 5" name="author">

    <link rel="stylesheet" href="css/LoginStyle.css">
    <title>Account Registration</title>
    <link rel="shortcut icon" href="login.ico" type="image/x-icon" />

    <!--
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Refresh" content="2"> -->
    <script type="text/javascript" src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>

    <script type="text/javascript">

        // letter and digit validate
        jQuery.validator.addMethod("chrnum", function(value, element) {
            var chrnum = /^([a-zA-Z0-9]+)$/;
            return this.optional(element) || (chrnum.test(value));
        }, "Only input digits and letter(Char:A-Z, a-z, 0-9)");


        $().ready(function() {
            // Validate the submission form
            $("#loginform").validate({
                rules: {
                    name: "required",     //Username
                    // over 6 digits password
                    password: {
                        required: true,
                        minlength:6,
                        chrnum: true
                    },
                    repassword: {
                        required: true,
                        chrnum: true,
                        equalTo: "#password"
                    },
                },
                messages: {
                    password: {
                        required: "Please enter Password",
                        minlength: "Please enter a Password more than 6 digit"
                    },
                    repassword: {
                        required: "Please enter Password",
                        equalTo: "The two passwords entered are inconsistent"
                    },
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

<body onload="randoms()" >

<section>
    <a class="home" href="index.php"><img src="img/ReviewsDance-c.png" alt="home" width="162px" height="160px"></a>

    <!-- Register Container -->
    <div class="container">
        <div class="form">
            <h2>Registration</h2>
            <form id = "loginform" action="register.php" method="post" name = "form1">
                <div class="inputBox">
                    <input type="text" placeholder="Username/Account" name="username" id="username">

                </div>

                <div class="inputBox">
                    <input type="password" placeholder="More Than 6 Digit Password" name="password" id="password">

                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Repeat The Password" name="repassword" id="repassword">

                </div>

                <div class="inputBox">
                    <input type="submit" value="Register" id="input1">

                </div>

                <p class="forget">Existing Account?<a href="login.php">
                        Click Login
                    </a></p>
            </form>
        </div>
    </div>
</section>

<!-- PHP Content -->
<?php
/* lib document required */
require_once "db_connect.php";
require_once "UserInfo.php";
require "UserDbFunction.php";

// Obtain the information from input
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])){

    // create three variables that point to three fetch values
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $repassword = $_REQUEST['repassword'];


    if($password == $repassword && $username != null){
        // Execute the registration function code
        $result = InsertUser($username, $password);

        $row = $result[0];

        $fetchInfo = $result[1];
        $fetchUser = $fetchInfo['username'];
        $fetchPass = $fetchInfo['password'];

        // Check whether the inserted data is exists
        $url='login.php';
        if($row > 0){
            //echo "<br><h2>Register Succeeded!</h2><br>";
            echo "<script>alert('Register Succeed!'); location.href='$url'</script>";
        }
        else{
            //echo "<br><h2>Username Already Existed! Go to Login!</h2><br>";
            echo "<script>alert('Username Already Existed! Go to Login!'); location.href='$url'</script>";
        }


        // Authorizes registered users
        if($fetchUser != null || $fetchPass != null){
            $UserAuthorized = UserAuthorization($fetchUser, $fetchPass);
        }
        else{
            echo "<script>alert('Authorization Failed! Please try again!')</script>";
        }

    }
    elseif($username == null){
        $url='register.php';
        echo "<script>alert('Username cannot be null, Please enter an username!'); location.href='$url'</script>";
    }

    // Omit the section below, the reason is that JQ is used for functional substitution

/*    elseif ($_POST['password'] != $_REQUEST['repassword'] && $_REQUEST['username'] != null){
        $url='http://localhost/Project/Project_Sample_Resource/sample_project/register.php';
        echo "<script>alert('The two passwords entered are inconsistent, try again!'); location.href='$url'</script>";
    }*/
}

?>

</body>
</html>





