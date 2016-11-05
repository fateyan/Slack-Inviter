<form method="post" action="index.php?route=<?php echo $data['postTo'];?>">
    <div class="joinus">
        <h1 class="title"><?php echo $data['header'];?></h1>
        <h4 class="sub-title"><?php echo $data['subheader'];?></h4>
        <div class="form-content">
            <div class="form-col">
                <input type="text" name="email" class="form-input" placeholder="E-Mail" required>
            </div>
            <div class="form-col">
                <input type="text" name="firstname" class="form-input" placeholder="Firstname (Optional)">
            </div>
            <div class="form-col">
                <input type="text" name="lastname" class="form-input" placeholder="Lastname (Optional)">
            </div>
            <div class="form-col">
                <div class="g-recaptcha" data-sitekey="<?php echo $data['captcha']; ?>"></div>
                <script type="text/javascript" src="https://www.google.com/recaptcha/api.js"></script>
            </div>
            <div class="form-col">
                <button type="submit" class="form-btn">Submit</button>
            </div>
            <div class="form-col">
                Already have an account? Click <a href="https://<?php echo $data['domain']; ?>.slack.com/">here</a> to login with your account.
            </div>
        </div>   
    </div>
</form>

