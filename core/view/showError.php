<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $errCode; ?></title>
        <style type="text/css">
            body {background:#e8e8e8;font-family:sans-serif;font-size:13px;color:#4F5155;}
            h1 {text-align:center;color:#444;border-bottom:1px solid #D0D0D0;font-size:19px;font-weight:normal;margin: 0 0 14px 0;padding:14px 15px 10px 15px;}
            #container {position:fixed;left:50%;top:50%;transform:translate(-50%,-50%);border:1px solid #D0D0D0;background:#f8f8f8;box-shadow:0px 0px 8px #d0d0d0;}
        </style>
    </head>
    <body>
        <div id="container">
            <h1><?php echo 'Error Code: ' . $errCode; ?></h1>
            <p style="margin: 12px 15px;"><?php echo $errMsg; ?></p>
            <b style="text-align: right;float: right;margin: 12px 15px;">- <?php echo websiteName?></b>
        </div>
    </body>
</html>