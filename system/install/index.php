<?php
ini_set('display_errors', 'off');
require_once("../../configer/config.php");
require_once("../../classes/main_cls.php");
$main = new main();
if ($main->db_check() != false) {
    header("location: ../../index.php");
    exit();
}

if (isset($_POST["submit"])) {
    $dbname = $_POST["dbname"];
    $dbuser = $_POST["dbusername"];
    $dbpass = $_POST["dbpass"];
    $dbhost = $_POST["host"];
    $conn = new mysqli("$dbhost", "$dbuser", "$dbpass", "$dbname");
    // Check connection
    if ($conn->connect_errno) {
        header("location: ?failed");
        exit();
    } else {
        if ($conn) {
            $sql_file = "sql/database.sql";
            $templine = '';
            $lines = file($sql_file);
            foreach ($lines as $line) {
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;
                $templine .= $line;
                if (substr(trim($line), -1, 1) == ';') {
                    $create_tbl = mysqli_query($conn, $templine);
                    $templine = '';
                }
            }
            if ($create_tbl) {
                echo "Tables imported successfully!";
                $config_file = "../../configer/config.php";
                $db_conn_code = "<?php
                define('host', '$dbhost');
                define('user_name', '$dbuser');
                define('password', '$dbpass');
                define('db_name', '$dbname'); ?>";
$insert_db_conn = file_put_contents($config_file, $db_conn_code);
if ($insert_db_conn) {
header("location: account.php?admin");
exit;
}
} else {
echo "Failed to import tables!";
}
}
}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install</title>
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../lib/style.css">
    <script src="../../lib/plugins/jquery/jquery.min.js"></script>
</head>

<body>
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="container">

        <div class="card ">
            <div class="card-header text-center ">
                Install-v1.0
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Database Name</label>
                            <input type="text" class="form-control" id="dbname" name="dbname"
                                placeholder="Database Name (white space not allow)" pattern="^\S+$" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Database Username</label>
                            <input type="text" class="form-control" id="dbusername" name="dbusername"
                                placeholder="Database Username" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Database Password</label>
                            <input type="text" class="form-control" id="dbpass" name="dbpass"
                                placeholder="Database Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Host</label>
                            <input type="text" class="form-control" id="host" name="host" placeholder="Database Host"
                                required>
                        </div>
                    </div>

                    <button type="submit" name="submit" style="background: whitesmoke;
    color: black;
    border: 1px solid;
    border-radius: 5px;
    box-shadow: 3px 4px #d6d6d6d9;">Submit</button>
                </form>
            </div>
            <div class="card-footer text-center">
                developed by <a href="https://google.com/search?q=developersharif" target="_blank">DeveloperSharif.</a>
            </div>
        </div>
    </div>
    <script src="../../lib/function.js"></script>
    <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>