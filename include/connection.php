<?php

$conn = new PDO('mysql:dbname=adoptii;host=localhost','root','');
$conn ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);





