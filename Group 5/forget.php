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
    <meta content="Company,Reviews,Job experiences,ReviewsDance,Forget" name="keywords">
    <meta content="The most comprehensive information" name="description">
    <meta content="Group 5" name="author">

    <link rel="stylesheet" href="css/LoginStyle.css">
    <link rel="shortcut icon" href="forget.png" type="image/x-icon" />
    <title>Forget Password</title>


    <script type="text/javascript" src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/lib/jquery.js"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/dist/jquery.validate.min.js"></script>
    <script src="https://static.runoob.com/assets/jquery-validation-1.14.0/dist/localization/messages_zh.js"></script>

    <script type="text/javascript">
        function randoms()
        {
            document.getElementById("username").value = "";
            document.getElementById("repassword").value = "";
            document.getElementById("password").value = "";
        }


        // letter and digit validate
        jQuery.validator.addMethod("chrnum", function(value, element) {
            var chrnum = /^([a-zA-Z0-9]+)$/;
            return this.optional(element) || (chrnum.test(value));
        }, "Only input digits and letter(Char:A-Z, a-z, 0-9)");

        $().ready(function() {
            // Validate the submission form
            $("#forgetform").validate({
                rules: {
                    // over 6 digits password
                    password: {
                        required: true,
                        minlength:6,
                        chrnum: true
                    },
                    // Verify password
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

<body onload="randoms()">
<section>

    <a class="home" href="index.php"><img src="img/ReviewsDance-c.png" alt="home" width="162px" height="160px"></a>

    <!-- Login Container -->
    <div class="container">
        <div class="form">
            <h2>Forget Password</h2>
            <form id = "forgetform" action="forget.php" method="post" name = "form">
                <div class="inputBox">
                    <input type="text" placeholder="Username/Account" name="username" id="username">

                </div>

                <div class="inputBox">
                    <input type="password" placeholder="Enter A New Password" name="password" id="password">

                </div>
                <div class="inputBox">
                    <input type="password" placeholder="Repeat The Password" name="repassword" id="repassword">

                </div>
                <div class="inputBox">
                    <input type="submit" value="Update">

                </div>
                <p class="forget">Had an Account?<a href="login.php">
                        Click Login
                    </a></p>
                <p class="forget">Haven't Account?<a href="register.php">
                        Register
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
require_once "UserDbFunction.php";

// Obtain the information from input
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repassword'])){

    // create three variables that point to three fetch values
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $repassword = $_REQUEST['repassword'];


    if($password == $repassword && $username != null){
        // Execute the registration function code
        $row = UpdatePassword($username, $password);
        if($row > 0){
            $url='login.php';
            echo "<script>alert('Update Password Succeed!'); location.href='$url'</script>";
        }
        else{
            $url='register.php';
            echo "<script>alert('Password Update Failed, maybe username not exist! Please go to Register!'); location.href='$url'</script>";
        }
    }
    elseif($username == null){
        $url='forget.php';
        echo "<script>alert('Username cannot be null, Please enter an username!'); location.href='$url'</script>";
    }

}

?>

</body>
</html>
