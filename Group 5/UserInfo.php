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

class UserInfo
{
    protected $username = "";
    protected $password = "";
    protected $pw_conf = "";

    public function __construct($username, $password, $pw_conf)
    {
        $this->username = $username;
        $this->password = $password;
        $this->pw_conf = $pw_conf;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPass(){
        return $this->password;
    }

    public function getConf(){
        return $this->pw_conf;
    }

}

?>