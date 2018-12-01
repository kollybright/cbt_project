<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/gif/png" href="<?php echo base_url('assets/Logomakr_3Cb7tC.png')?>">
    <title>Access denied | Alerts</title>
    <style>
        body,html{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;;
            background-color: #f5f5f5;
        }
        a{
            color: #0069d9;
            font-size: large;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h1>Sorry, you don't have access to this page.</h1><br/>

<h3>Your session might have expired.</h3>

<a href='<?php echo site_url("main"); ?>'>Login now</a>

</body>
</html>