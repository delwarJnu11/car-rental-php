<?php

define("SERVER", "localhost");
define("USER", "root");
define("DATABASE", "car_rental_management");
define("PASSWORD", "123456"); // @delwarisdb61@

// Connect with Database
$db = new mysqli(SERVER, USER, PASSWORD, DATABASE);
$tx = "car_";
