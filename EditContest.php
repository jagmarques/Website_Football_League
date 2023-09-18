<?php

session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
    }  
    

 ?>
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
			<form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
				<div id="firstboxText">
					<p id="title3" style="padding-bottom: 1.1vw;">Calendario</p>
					<?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                    try{
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($connection->connect_errno != 0){
                            throw new Exception(mysqli_connect_errno());
                        }
                        else{
        					$sql ="SELECT * FROM game WHERE state=0;";
        					if($sql!=NULL){
            					$result = mysqli_query($connection,$sql);
            					$resultCheck = mysqli_num_rows($result);
            					if($resultCheck>0){
                					while($row = mysqli_fetch_assoc($result)){
										echo '<p style="title1">'.$row['team_team_name'] . ' VS ' .$row['team_team_name1'] .' Date: ' .$row['game_date']. '</p><input type="submit" name="editgame"></button><br><br><br>';
									}
            					}
                                else{
                                    echo 'No games available';
                                }
        					}
                            $connection->close();
                        }
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: '.$e . '</p>';
                    }
				?>
				</div>
			</form>
				<div id="goBackDiv"><a href="ManContests.php"><button id="goBack">Go Back >></button></a></div>
			
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

    </div>

</body>
</html>