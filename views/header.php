<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
    .joinus {
        position: absolute;
        top: 30%;
        background-color: #fff;
        box-shadow: 0px 0px 20px #333;   
        padding: 20px;
        width: 40%;
        min-width: 100px;
    } 
    </style>
    <title></title>
</head>
<body>
    <form method="post" action="index.php?method=getPostData">
    <div class="joinus">
        <h1 class="title"><?php echo $welcomeMessage;?></h1>
        <table>
            <tr>
                <td>
                    <label for="email">Email</label>
                <td>
                    <td><input type="text" name="email" class="form-input">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="firstname">firstname</label>
                <td>
                    <td><input type="text" name="firstname" class="form-input">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lastname">lastname</label>
                <td>
                    <td><input type="text" name="lastname" class="form-input">
                </td>
            </tr>
        </table>   
         
    </div>
</body>
</html>
