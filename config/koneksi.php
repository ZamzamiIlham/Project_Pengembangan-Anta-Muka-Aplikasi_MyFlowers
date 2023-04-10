

<?php
define('HOST','localhost');
define('USER','root');
define('DB','agro_db');
define('PASS','');
$db = new mysqli(HOST,USER,PASS,DB) 
or die('Connetion error to the database');