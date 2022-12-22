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

<?php
// require lib php file
require_once "UserInfo.php";
require_once "db_connect.php";

// Database Connection function
function openConnection(){
    require 'db_connect.php';
    global $attr, $user, $pass, $opts;

    try{
        $pdo = new PDO($attr, $user, $pass, $opts);
    }
    catch (PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    return $pdo;
}


// function of Register -----> Insert data into database 'user_db'
function InsertUser($username, $password){

    /* database connection */
    $pdo = openConnection();

    // Extract 3 data variables from the UserInformation dataset
    /*            $username = $UserInformation->getUsername();
                $password = $UserInformation->getPass();
                $repassword = $UserInformation->getConf();*/

    // included the preventive SQL injection function
    $sql = "INSERT INTO user_db (username, password) VALUES" . "(:username, :password)";
    try{
        $query = $pdo->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();

        $fetchUserInfo = $query->fetch();

        // After inserted statement is executed, counted the inserted data
        $row = $query->rowCount();
    }
    catch (PDOException $e){
        fatalError($e->getMessage());
    }

    /*    $sql = "SELECT * FROM user_db WHERE username = $username";
        $query = $pdo->query($sql);

        $SechRes = $query->fetch();     // Searching result is an array
        print_r("information: ", $SechRes);

        if($SechRes != []){
            return false;
        }
        else{

        }*/

    $pdo = null;
    return array($row, $fetchUserInfo);
}


// Authorization
function UserAuthorization($fetchUser, $fetchPass){

    // database connection
    $pdo = openConnection();

    $sql = "GRANT insert,update,select ON TABLE employerReview_S to $fetchUser";
    try{
        $query = $pdo->prepare($sql);
        $query->execute();
    }
    catch (PDOException $e){
        fatalError($e->getMessage());
    }

    $pdo = null;
}


// function of Login -----> Select username from database "user_db" if it exists
function SelectUser($username, $password){
    $pdo = openConnection();

    $username = $pdo->quote($username);
    $password = $pdo->quote($password);

    $sql = "SELECT * FROM user_db WHERE username = $username AND password = $password";
    try{
        $result = $pdo->prepare($sql);
        $result->execute();
        $UserInfofetch = $result->fetch();
    }
    catch (PDOException $e){
        fatalError($e->getMessage());
    }
    $pdo = null;

    // return an array included Searching result Counting and result Information (Array) ----> $UserInfofetch
    return $UserInfofetch;
}


// function of Forget Password -----> Update data in database 'user_db'
function UpdatePassword($username, $password){

    /* database connection */
    $pdo = openConnection();

    $username = $pdo->quote($username);
    $password = $pdo->quote($password);

    // included the preventive SQL injection function
    $sql = "UPDATE user_db SET password = $password WHERE username = $username";
    try{
        $query = $pdo->prepare($sql);
        $query->execute();
        $row = $query->rowCount();
    }
    catch (PDOException $e){
        fatalError($e->getMessage());
    }

    $pdo = null;
    return $row;
}


// throw error when the code running error
function fatalError($errorMessage){
    echo "<p><strong>Something runing wrong: $errorMessage</strong></p>";
}


?>