<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    body {
        font-family: "Consolas";
        font-size: 200%;
    }
    .container {
        margin: 0 auto;
        text-align: center;
    }
    .container h1 {
        color: #F97C6E;
    }
    .container h4 {
        color: #C7C7C6;
    }
    .error-list {
        margin: 0;
        padding: 0;
    }
    .error-list li {
        list-style: none;
    }
    </style>
    <title>Errors occurred</title>
</head>
<body>
    <div class="container">
        <h1>Error</h1>
        <h4><?php echo $message['fail'];?></h4>
        <ul class="error-list">
        <?php foreach($errors as $var):?>
            <li><?php echo $var;?></li>
        <?php endforeach;?>
        </ul>
    </div>

</body>
</html>