<form method="post" action="index.php?route=<?php echo $data['postTo'];?>">
    <div class="joinus">
        <h1 class="title"><?php echo $data['header'];?></h1>
        <h4 class="sub-title"><?php echo $data['subheader'];?></h4>
        <table>
            <tr>
                <td>
                    <label for="email">Email:</label>
                </td>
                <td>
                    <input type="text" name="email" class="form-input" required><span class="alert">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="firstname">Firstname:</label>
                </td>
                <td>
                    <input type="text" name="firstname" class="form-input">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lastname">Lastname:</label>
                </td>
                <td>
                    <input type="text" name="lastname" class="form-input">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lastname">Captcha:</label>
                </td>
                <td>
                    <input type="text" name="captcha" class="form-input" required><span class="alert">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    <img src="<?php echo $data['captcha'];?>">
                </td>
            </tr>
            <tr>
                <td colspan="2" class="submit-td">
                    <input type="submit" class="submit">
                </td>
            </tr>
        </table>   
    </div>
</form>

