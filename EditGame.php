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
                    <a id="title1" href="CapTeams.php" style="background-color: black; color: white">HOME</a>
                </li>
            </ul>
        </nav>
    </header>

    <div id="container">

        <div id="firstbox">

            <div id="firstboxText">
                <p id="title3" style="padding-bottom: 2vw">Edit Game</p>

                <p id="title1">Choose Team 1:</p>
                <p><select id = "team1" onchange="myFunction()">
                    <option value="Team1">Team1</option>
                    <option value="Team2">Team2</option>
                    <option value="Team3">Team3</option>
                </select></p> 

                <p id="title1">Choose Team 2:</p>
                <p><select id = "team2" onchange="myFunction()">
                    <option value="Team1">Team1</option>
                    <option value="Team2">Team2</option>
                    <option value="Team3">Team3</option>
                </select></p> 
                
                <p id="t1vst2" style="font-size: 1vw;"></p>

                <script>
                    function myFunction() 
                    {
                        var x = document.getElementById("team1").value;
                        var y = document.getElementById("team2").value;
                        if(x==y)
                        {
                            document.getElementById("t1vst2").innerHTML="Combination is impossible!";
                        }
                        else
                        {
                            document.getElementById("t1vst2").innerHTML = x+"  VS  "+y;
                        }
                    }
                </script>
                
                <p id="title1">Choose Location:</p>
                <p><select id="dropdownOptions">
                    <option value="Location1">Location1</option>
                    <option value="Location2">Location2</option>
                    <option value="Location3">Location3</option>
                </select></p> 

                <p id="title1">Data:</p>
                 <input type="Date" name="data" id="dropdownOptions">
                <p id="title1">Hour:</p> 
                <input type="time" name="data" id="dropdownOptions">

                <p><input type="submit" class="submit save_contest" value="Save"></p>

            </div>

            <div id="goBackDiv"><a href="EditContest.php"><button id="goBack">Go Back >></button></a></div>
            
        </div>

        <div id="lastbox">
            <div id="wrapper">

                <img id="user" src="images/user.png" alt="user" width="120">
                <p id="title4"><?php echo $_SESSION['user_username']?></p>
                <p id="title4"><?php echo $_SESSION['user_name']?></p>
                <p id="title4">Email</p>
                <a href="mailto:****@****"><?php echo $_SESSION['user_email']?></a>
                <p id="title4">Phone Number</p>
                <p>
                    <?php 
                        if($_SESSION['user_phonenumber']==NULL){
                            echo '<p> No phone number available </p';
                        }
                        else{
                            echo $_SESSION['user_phonenumber'];
                        }
                    ?>  
                </p>
            </div>
        </div>
    
    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) 
        {
            acc[i].onclick = function() 
            {
                this.classList.toggle("active");
                this.nextElementSibling.classList.toggle("show");
            }
        }
    </script>

</body>
</html>