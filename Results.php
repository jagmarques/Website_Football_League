<?php

    session_start();
    
    if (!isset($_SESSION['logged']))
    {
        header('Location: logging.php');
        exit();
    }

    if(isset($_POST['results'])){
        results();
    }

    function results(){
            $game_name= $_SESSION['game_name'];
            $goalsteam1= $_POST['goalsteam1'];
            $goalsteam2= $_POST['goalsteam2'];
            $teams = explode(' VS ', $game_name);
            $team1 = $teams[0];
            $team2=$teams[1];
            require_once "connect.php";
            mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
            try
            {
                $connection = new mysqli($host, $db_user, $db_password, $db_name);
                if ($connection->connect_errno != 0)
                {
                    throw new Exception(mysqli_connect_errno());
                }
                else{
                      $update = "UPDATE game SET goals_a='$goalsteam1',goals_b='$goalsteam2' where team_team_name='$team1' and team_team_name1='$team2'";
                      if($connection->query($update)){
                        header('Location:ManGames.php');
                      }else{
                        echo "ERROR";
                      }
                }
              }

            catch(Exception $e)
            {
                echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
            }
        exit;

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
              <a id="title1" href="index.php">Log out</a>
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
        <p id="title3">Results</p>
                    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="myForm">
                    <?php
                    require_once "connect.php";
                    mysqli_report(MYSQLI_REPORT_STRICT);// throw errors, not warnings
                    try{
                        $connection = new mysqli($host, $db_user, $db_password, $db_name);
                        if ($connection->connect_errno != 0){
                            throw new Exception(mysqli_connect_errno());
                        }
                        else{
                            $game_name= $_SESSION['game_name'];
                            $teams = explode(' VS ', $game_name);
                            $team1 = $teams[0];
                            $team2=$teams[1];
                            echo $team1.'<input type="int" name="goalsteam1"></input> VS <input type="int" name="goalsteam2"></input>'.$team2;
                            }
                            
                            $connection->close();
                        
                    }
                    catch(Exception $e)
                    {
                        echo '<span id="title1" style="color:red;">Server error! Try later</span>';
                        echo '<br /><p id="title1">Developer info: ' . $e . '</p>';
                    }
                ?>
                <br><br>
                <input type="submit" class="accordion" name="results" value="Add Results" />
              </form>
      </div>

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