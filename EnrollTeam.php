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
                <li id="dropdown">
                    <a id="title1">ACCOUNT</a>
                    <div id="dropdown-content">
                        <a id="title1" href="EditUser.php">Edit</a>
                        <a id="title1" href="Messages.php">Messages</a>
                        <a id="title1" href="index.php">Log Out</a>
                    </div>        
                </li>
                <li>
                    <a id="title1" href="AboutLogged.php">ABOUT</a>
                </li>
                <li>
                    <a id="title1" href="ManTeams.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">

        <div id="firstbox">

            <div id="firstboxText">
                <p id="title3" style="padding-bottom: 2vw">Enroll Team Position</p>

                <p id="title1">Free Positions:</p>
                <p><select id = "positions" onchange="myFunction()">
                    <option value="Position1">Position1</option>
                    <option value="Position2">Position2</option>
                    <option value="Position3">Position3</option>
                </select></p> 

                <p id="infoPosition"></p>
                
                <script>
                    function myFunction() 
                    {
                        var x = document.getElementById("positions").value;
                        document.getElementById("infoPosition").innerHTML = x+ " "+ "have this free spots: ";
                    }
                </script>

                <p><input type="submit" class="submit enroll_team" value="Enroll"></p>

            </div>

            <div id="goBackDiv"><a href="CapTeams.php"><button id="goBack">Go Back >></button></a></div>
            
        </div>

        <div id="lastbox">
            <div id="wrapper">
                <img id="user" src="images/user.png" alt="user" width="120">
                <p id="title4">Username</p>
                <p id="title4">Information</p>
                <p>Info</p>
                <p id="title4">Email</p>
                <a href="mailto:****@****">****@****</a>
                <p id="title4">Phone Number</p>
                <p>9********</p>
                <p id="title4">Balance</p>
                <p>€€€</p>
            </div>
        </div>
    
    </div>

</body>
</html>