<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Error</title>
    <link rel="stylesheet" type="text/css" href="assets/normalize.css">
    <style>
    body {
        font-family: Arial;
        font-size: 14px;
        background: #F0EEE9;
        margin-top: 100px;
    }
    .container {
        width: 40%;
        background: #FFF;
        margin: 0 auto;
        padding: 10px;
        border-radius: 6px;
    }
    .container h1 {
        padding-left: 10px;
        margin: .2em 0;
        font-size: 4em;
        color: #F97C6E;
    }
    .container h4 {
        padding-left: 10px;
        margin: .2em 0;
        font-size: 2em;
        color: #C7C7C6;
    }
    .error-list {
        background: #E7E7E7;
        color: #444;
        margin: 20px;
        padding: 10px;
        border-radius: 6px;
    }
    .error-list p {
        margin: .2em 0;
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Error</h1>
        <h4><?php echo $message['fail'];?></h4>
        <div class="error-list">
        <?php foreach($errors as $var):?>
            <p><?php echo $var;?></p>
        <?php endforeach;?>
        </div>
    </div>

</body>
</html>