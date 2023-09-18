<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
<meta charset="utf-8">
<link rel="stylesheet" href="styles/layout.css" type="text/css">
</head>

<body background="images/background.jpg">

    <header id="header">
        <nav>
            <div id="logo"><img  src="images/logo.png"></div>
            <ul>
                <li>
                    <a id="title1" href="About.php">ABOUT</a>
                </li>
                <li>
                    <a id="title1" href="index.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">
        
        <div id="firstbox">
            <div id="firstboxText" style="padding-bottom: 1vw;">
                <p id="title3">Welcome</p>
                <p>INTRUCTIONS:</p>
                <p>How to begin?</p>
                <p>- First, sign up and login.</p>
                <p>- See the contests that you are interested in and choose one of the teams attending that contest.</p>
                <p>- To apply you will need to choose your position.</p>
                <p>- When delivered the money, you will be accepted.</p>
            </div>
        </div>

        <div id="lastbox">
            <form action="logging.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                <div id="intro">
                    <input type="email" placeholder="Email" name="email" required/></p>
                    <input type="password" placeholder="Password" name="pass" required/></p>
                    <input type="submit" class="submit login" value="Login">
                    <button id="registerButton"><a href="register.php">Register</a></button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>