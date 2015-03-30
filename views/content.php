<body>
    <form method="post" action="index.php?method=getPostData">
    <div class="joinus">
        <h1 class="title"><?php echo $data['welcomeMessage'];?></h1>
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
                    <label for="firstname">Firstname</label>
                <td>
                    <td><input type="text" name="firstname" class="form-input">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lastname">Lastname</label>
                <td>
                    <td><input type="text" name="lastname" class="form-input">
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit">
                </td>
            </tr>
        </table>   
         
    </div>

