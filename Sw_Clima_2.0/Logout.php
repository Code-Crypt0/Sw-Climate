<?php

session_start();
session_destroy();
header("location: Login.php?logout=1");

?>
