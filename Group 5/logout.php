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
if(isset($_COOKIE['username']) && isset($_COOKIE['id'])){
    $userCookie = $_COOKIE['username'];
    $idCookie = $_COOKIE['id'];
    setcookie('username', $userCookie, time()-1);     // Set a cookie, timeout ----> negative value (unit: second)
    setcookie('id', $idCookie, time()-1);     // Set a cookie, timeout ----> negative value (unit: second)
    $url='index.php';
    echo "<script>alert('Logout Successful!'); location.href='$url'</script>";
}
else{
    $url='login.php';
    echo "<script>alert('Logout unvalid! Please login first!'); location.href='$url'</script>";
}

?>
