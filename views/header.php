<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $data['title'];?></title>
    <link rel="stylesheet" type="text/css" href="assets/normalize.css">
    <style>
    html, body {
        height: 100vh;
    }
    body {
        font-family: 'Oxygen', sans-serif;
        min-width: 410px;
        padding-top: 70px;
        font-size: 14px;
    }
    a {
        color: #1e91cf;
        text-decoration: none;
    }
    a:hover {
        color: #1e91cf;
        text-decoration: underline;
    }
    .joinus {
        background-color: rgba(255, 255, 255, .8);
        width: 40%;
        min-width: 410px;
        margin: 0 auto;
        padding: 20px 0;
        border-radius: 7px;
        box-shadow: 0 0 7px rgba(0, 0, 0, .1);
    }
    .joinus h1, .joinus h4 {
        margin: .2em 5%;
    }
    .form-col {
        width: 90%;
        margin: 5%;
    }
    .form-input {
        border-radius: 4px 4px;
        height: 30px;
        border: solid #ddd 1px;
        width: 100%;
        font-size: 1.1em;
        line-height: 1.42;
        padding: 8px 13px;
    }
    .form-btn {
        background: #1E91CF;
        border-color: #1978AB;
        background-image: 0;
        border: none;
        color: #FFF;
        border-radius: 3px;
        display: inline-block;
        font-size: 1.2em; 
        font-weight: normal;
        line-height: 1.42;
        padding: 8px 12px;
        text-align: center;
        vertical-align: middle;
    }
    canvas { 
        top: 0;
        left: 0;
        position: fixed;
        z-index: -999;
    }
    </style>
    <link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
</head>
<body>

