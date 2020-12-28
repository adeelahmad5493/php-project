<!DOCTYPE html>
<html>
    <head>
        <title>SIGN UP </title>
        <link rel="stylesheet" href="style_signup.css">
    </head>
    <body>
        <div id="signup_outer_div">
            <div id="signup_text_div"> SIGN UP FORM </div>
            <form name="signup_form" action="create_account.php" method="POST">
                <input type="text" name="name" class = "box name" id="name" placeholder="    Full Name"><br>
                <input type="email" name = "email" class = "box email" id="email" placeholder="   User Name"><br>
                <input type="password" name = "password"class = "box password" id="password" placeholder="    Password"><br>
                <input type="password" name = "confirm_password" class = "box password" id="re_password" placeholder="    Confirm Password"><br>
                <input type="submit" name = "submit" id = "submit" value="Sign Up">
                <div id="haveaccount_text_div">
                    <span id="haveaccount_text_span"> Already have an account? </span>
                    <span id="login_span"> <a href="login_page.php" target="_SELF" target="_blank" style="color:black"> LOG IN </a> </span>                
                </div>
            </form>
        </div>
    </body>
</html>