<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $data['title'];?></title>

    <style>
    html, body {
        height: 100vh;
        text-align: center;
        padding: 0px;
        margin: 0px;
        font-family: 'Oxygen', sans-serif;
    }
    body {
        background-repeat: no-repeat;
        background-size: cover;
    }
    .joinus {
        margin-top: 10%;
        background-color: #fff;
        box-shadow: 0px 0px 10px #333;
        padding: 30px 24px;
        padding-top: 0px;
        width: 18rem;
        min-width: 100px;
        height: 18rem;
        display: inline-block;
    }
    .form-input {
        border-radius: 4px 4px;
        height: 30px;
        border: solid #ddd 1px;
        width: 180px;
    }
    .title {
        color: #111;
        margin: 8px 0px 0px 0px;
    }
    .sub-title {
        margin: 5px;
        font-weight: normal;
        color: #222;
    }
    .submit {
        background-color: #D03D3D;
        color: #fff;
        border: none;
        border-radius: 3px 3px 3px 3px;
        height: 30px;
        padding: 5px 10px;
    }
    td:nth-child(even) {
        text-align: left;
    } 
    td:nth-child(odd) {
        text-align: right;
    }
    .submit-td {
        text-align: center !important;
    } 
    canvas { 
        top: 0;
        left: 0;
        position: absolute;
        z-index: -999;
    }
    .alert {
        color: red;
    }
    </style>
    <link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">
</head>
<body>

