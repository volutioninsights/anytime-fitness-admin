<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Avant">
    <meta name="author" content="The Red Team">

    <!-- <link href="assets/less/styles.less" rel="stylesheet/less" media="all"> -->
    <link rel="stylesheet" href="assets/css/styles.css?=140">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
    <style type="text/css">
        body, .btn-primary {
            background: #804c9e !important;
        }
        .panel-primary {
            border-color: #72279e !important;
        }
        .panel-primary .panel-body, .panel-primary .panel-footer {
            border-top: 5px solid;
            border-color: black !important;
            border-bottom: #ddd !important;
        }
        .focusedform .brand {
            width: 350px;
        }
    </style>
    
</head><body class="focusedform">
@yield('content')      
</body>
</html>