<?php require("include/header.php");
$main = new main();
$admin = new admin();
$user = new user();


if (isset($_POST["settings"])) {

if (isset($_POST["host"]) & isset($_POST['username']) & isset($_POST['password']) & isset($_POST['port'])) {
    $host = trim($_POST['host']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $port = trim($_POST['port']);
    $array = array("host" => "$host", "username" => "$username", "password" => "$password", "port" => "$port");
    $jsobj = json_encode($array);
    $update = $main->update("update settings set more ='$jsobj';");
    if ($update) {
        $stg_msg = "Setting updated.";
    } else {
        echo "error";
    }
}else{
    echo "error"; 
} 
} //if end


?>




<div class="card">
    <div class="card-header">
        <h3 class="card-title">Mail Configaration:</h3>
        <div class="card-tools">
            <a href="mail-config.php">&nbsp;Refresh&nbsp;</a>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body p-1">
        <table class="table table-striped projects">

            <tbody>
                <?php
                $Set_query = $main->select("select * from settings ");
                $settings = $Set_query->fetch_assoc();
                $more = json_decode($settings['more']);

                ?>
                <form action="" method="post">
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Host:
                        </a>

                    </td>
                    <td>
                        <input type="text" name="host" id="host" value="<?php if(isset($more->host)){echo $more->host;} ?>" placeholder="Host" class="form-control"></input>
                    </td>

                    <td class=" ">
                <small>example: smtp.gmail.com</small>
                    </td>
                </tr>                
                
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Email:
                        </a>

                    </td>
                    <td>
                        <input type="text" name="username" id="username" value="<?php if(isset($more->username)){echo $more->username;} ?>" placeholder="Email" class="form-control"></input>
                    </td>

                    <td class="">
                <small>example: example@gmail.com</small>
                    </td>
                </tr>                
                
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> password:
                        </a>

                    </td>
                    <td>
                        <input type="password" name="password" id="password"  placeholder="********" class="form-control"></input>
                    </td>

                    <td class="">
                <small>your email id password.</small>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <a>
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Port:
                        </a>

                    </td>
                    <td>
                        <input type="number" name="port" id="port" value="<?php if(isset($more->port)){echo $more->port;} ?>" placeholder="Port: 587" class="form-control"></input>
                        <input type="hidden" name="settings" id="hidden" ></input>
                    </td>

                    <td class="">
                <small>example: SMTP Port 25, 465, 587 or 2525</small>
                    </td>
                </tr>
                <tr> <td>
                <input type="submit" value="Save" class="btn btn-info btn-lg"></td><td></td></input>
                </tr>
                
                </form>
                
                </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<div class="card">
<div class="card-header">How To Enable Email Sending In Gmail?</div>
<div class="card-body"> 
<p><br></p><ol style="box-sizing: inherit; margin: 10px 0px 0px 35px; padding: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Segoe UI Regular&quot;, system-ui, -apple-system, BlinkMacSystemFont, Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;"><li style="box-sizing: inherit; padding: 0px; margin: 0px 0px 10px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit;"><font color="#222222">Before sending emails using the Gmail's </font>SMTP server<font color="#222222">, you to make some of the security and permission level settings under your&nbsp;</font><a href="https://myaccount.google.com/security" style="color: rgb(0, 0, 0); box-sizing: inherit; padding: 0px; margin: 0px; font: inherit; cursor: pointer; border-bottom: 1px dotted rgb(0, 0, 0);">Google Account Security Settings</a><font color="#222222">.</font><br style="box-sizing: inherit; padding: 0px; margin: 0px; font: inherit;"></li><li style="color: rgb(34, 34, 34); box-sizing: inherit; padding: 0px; margin: 0px 0px 10px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit;">Make sure that&nbsp;<span style="box-sizing: inherit; padding: 0px; margin: 0px; font-style: inherit; font-variant: inherit; font-weight: bolder; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; color: rgb(54, 54, 54);">2-Step-Verification</span>&nbsp;is disabled.<br style="box-sizing: inherit; padding: 0px; margin: 0px; font: inherit;"></li><li style="color: rgb(34, 34, 34); box-sizing: inherit; padding: 0px; margin: 0px 0px 10px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit;">Turn&nbsp;<span style="box-sizing: inherit; padding: 0px; margin: 0px; font-style: inherit; font-variant: inherit; font-weight: bolder; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; color: rgb(54, 54, 54);">ON</span>&nbsp;the<span style="box-sizing: inherit; padding: 0px; margin: 0px; font-style: inherit; font-variant: inherit; font-weight: bolder; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; color: rgb(54, 54, 54);">&nbsp;"Less Secure App"</span>&nbsp;access or click&nbsp;<a href="https://myaccount.google.com/u/0/lesssecureapps" style="box-sizing: inherit; color: rgb(0, 0, 0); padding: 0px; margin: 0px; font: inherit; cursor: pointer; border-bottom: 1px dotted rgb(0, 0, 0);">here</a>.<br style="box-sizing: inherit; padding: 0px; margin: 0px; font: inherit;"></li><li style="color: rgb(34, 34, 34); box-sizing: inherit; padding: 0px; margin: 0px 0px 10px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit;">If 2-step-verification is enabled, then you will have to create app password for your application or device.<br style="box-sizing: inherit; padding: 0px; margin: 0px; font: inherit;"></li><li style="color: rgb(34, 34, 34); box-sizing: inherit; padding: 0px; margin: 0px 0px 10px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit;">For security measures, Google may require you to complete this additional step while signing-in. Click here to allow access to your Google account using the new device/app.<br style="box-sizing: inherit; padding: 0px; margin: 0px; font: inherit;"><br style="box-sizing: inherit; padding: 0px; margin: 0px; font: inherit;"></li></ol><p style="box-sizing: inherit; margin: 10px 0px 0px; padding: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: 1.5; font-family: &quot;Segoe UI Regular&quot;, system-ui, -apple-system, BlinkMacSystemFont, Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(34, 34, 34); letter-spacing: 0.3px;"><em style="box-sizing: inherit; padding: 0px; margin: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit;">Note: It may take an hour or more to reflect any security changes</em></p></div>
</div>


<?php include("include/footer.php"); ?>