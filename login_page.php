<!DOCTYPE html>
<html>

<head>
    <title> Login </title>
    <link rel="stylesheet" href="style_login.css">
</head>

<body>
    <div id="outer_div">
        <div id="user_login_text_div">
            <span id="user_text_span"> USER </span> <span id="login_text_span"> LOGIN </span>
        </div><br>
        <hr>

        <div id="user_logo_div"></div>
        <form name="login_form" action="user_verification.php" method="POST">
            <input type="email" name="username" id="username" placeholder="    User Name">
            <input type="password" name="password" id="password" placeholder="    Password">
            <div id="error_msg_div"> 
            </div>
            <div id="submit_btn_div">
                <input type="submit" id="submit" value="Login">
            </div>
        </form>
        <br><br>
        <hr>
        <div id="signup_button_outer_div"> 
            <span id="no_account_text_span">Don't have an Account?</span>
            <span id="signup_btn_span"> <a href="signup.php" target="_SELF" style="color:#ed8c0e; text-decoration:none"> SIGN UP </a></span>
        </div>
    </div>
</body>

</html>