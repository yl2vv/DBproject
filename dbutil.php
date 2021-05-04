<?php
class DbUtil{
        public static $loginUser = "yl2vv";
        public static $loginPass = "";
        public static $host = "usersrv01.cs.virginia.edu"; // DB Host
        public static $schema = "yl2vv_hoosdown2study"; // DB Schema

        public static function loginConnection(){
                $db = new mysqli(DbUtil::$host, DbUtil::$loginUser, DbUtil::$loginPass, DbUtil::$schema);

                if($db->connect_errno){
                        echo("Could not connect to db");
                        $db->close();
                        exit();
                }

                return $db;
        }

}
?>