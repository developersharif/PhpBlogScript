<?php

setcookie("c_user", "", time() - (86400 * 10), "/");

header("location: login.php");


?>