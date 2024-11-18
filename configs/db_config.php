<?php

define("SERVER", "localhost");
define("USER", "root");
define("DATABASE", "test");
define("PASSWORD", "123456");

// Connect with Database
$db = new mysqli(SERVER, USER, PASSWORD, DATABASE);
$tx = "core_";
