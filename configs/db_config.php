<?php

define("SERVER", "localhost");
define("USER", "root");
define("DATABASE", "test");
define("PASSWORD", "@delwarisdb61@");

// Connect with Database
$db = new mysqli(SERVER, USER, PASSWORD, DATABASE);
$tx = "core_";
