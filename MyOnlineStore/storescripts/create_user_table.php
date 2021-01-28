<?php
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
// Connect to the MySQL database  
require "C:\wamp64\www\MyOnlineStore\storescripts\connect_to_mysql.php";  

$sqlCommand = "CREATE TABLE IF NOT EXISTS users (
              id INT(11) NOT NULL AUTO_INCREMENT,
			  username VARCHAR(16) NOT NULL,
			  email VARCHAR(255) NOT NULL,
			  password VARCHAR(255) NOT NULL,
			  gender ENUM('m','f') NOT NULL,
			  website VARCHAR(255) NULL,
			  country VARCHAR(255) NULL,
			  userlevel ENUM('a','b','c','d') NOT NULL DEFAULT 'a',
			  avatar VARCHAR(255) NULL,
			  ip VARCHAR(255) NOT NULL,
			  signup DATETIME NOT NULL,
			  lastlogin DATETIME NOT NULL,
			  notescheck DATETIME NOT NULL,
			  activated ENUM('0','1') NOT NULL DEFAULT '0',
              PRIMARY KEY (id),
			  UNIQUE KEY username (username,email)
             )";
if (mysql_query($sqlCommand)){ 
    echo "Your admin table has been created successfully!"; 
} else { 
    echo "CRITICAL ERROR: admin table has not been created.";
}
?>