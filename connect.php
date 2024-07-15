<?php
   $servername = 'localhost';
   $username   ='id22414723_mymaitainancedb';
   $password   ='';
   $dbname   = 'id22414723_joshdb';


   $conn = new mysqli($servername,$username,$password ,$dbname );

   if ($conn->connect_error){
    die("connect faild" .$conn->connect_error);
   }
?>