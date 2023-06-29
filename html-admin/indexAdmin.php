<!DOCTYPE html>
<html lang="en">

<head>
  <?php
      session_start();
      if($_SESSION["loggedIn"] == true){
          echo "Welcome to the Admin page!";
      }
      else{
          echo $_SESSION["loggedIn"];
          echo "<script> window.location.href='/veterans-website-project/adminLogin.html' </script>";
          echo "Incorrect username or password :(";
      }
  ?>
  
  <title>Veterans Memorial</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/searchbar.js"></script>
  <script src="js/brickclicked.js"></script>
  <script src="js/brickGroupPopulator.js"></script>

  <style>
    .fakeimg {
      height: 200px;
      background: #aaa;
    }
  </style>
</head>

<body onload="main()">
  <!-- Title Box -->
  <div class="jumbotron cool text-center" id="topthingy" style="margin:0">
    <h1>Veterans Memorial Map</h1>
    <!-- <p style="margin:0">The City of Manchester, Missouri</p> -->

    <img alt="Manchester Home Banner" class="bannerObject" src="CityofManchesterLogo.png">

  </div>

  <!-- Nav Bar -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li>
      </ul>
    </div>
      <div class="search-bar-drop-down"> 
        <input class="form-control mr-sm-2" id="searchbar" type="search" placeholder="Search"
        onkeyup="searchBar(this.value)">
        <div class="dropDownMenuItem mr-sm-2">
        <span id="tem1"></span> 
        </div>
      </div>
      <!--<button onclick="eraseSearchBar()" class="clear">X</button>-->
      <label for="searchFilter" class="font"></label>
      <br />
      <select name="searchFilter" id="searchFilter">
        <option value="firstname">First Name</option>
        <option value="lastname">Last Name</option>
      </select>
  </nav>

  <!-- Main Body -->
  <div class="mainBody">
    <div class="wrapper">
      <div class="bodyFrame">
        <!-- Rest of Columns -->
        <div class=" mainCol bg-dark">


          <!-- Row 1 -->
          <div class="brickStyle brickR1C1"></div>
          <div class="brickStyle brickR1C2">
            <iframe src="brickgroupgAdmin.html" id="bg">
            </iframe>
          </div>
          <div class="brickStyle brickR1C7"></div>
          <!-- Row 2 -->
          <div class="brickStyle brickR2C1"></div>
          <div class="brickStyle brickR2C2"></div>
          <div class="brickStyle brickR2C3"></div>
          <div class="brickStyle brickR2C4"></div>
          <div class="brickStyle brickR2C5"></div>
          <div class="brickStyle brickR2C6"></div>
          <div class="brickStyle brickR2C7"></div>
          <!-- Row 3 -->
          <div class="brickStyle brickR3C1"></div>
          <div class="brickStyle brickR3C2">
            <iframe src="brickgroupdAdmin.html" id="bd">
            </iframe>
          </div>
          <div class="brickStyle brickR3C3"></div>
          <div class="brickStyle brickR3C4">
            <iframe src="brickgroupeAdmin.html" id="be">
            </iframe>
          </div>
          <div class="brickStyle brickR3C5"></div>
          <div class="brickStyle brickR3C6">
            <iframe src="brickgroupfAdmin.html" id="bf">
            </iframe>
          </div>
          <div class="brickStyle brickR3C7"></div>
          <!-- Row 4 -->
          <div class="brickStyle brickR4C1"></div>
          <div class="brickStyle brickR4C2"></div>
          <div class="brickStyle brickR4C3"></div>
          <div class="brickStyle brickR4C4"></div>
          <div class="brickStyle brickR4C5"></div>
          <div class="brickStyle brickR4C6"></div>
          <div class="brickStyle brickR4C7"></div>
          <!-- Row 5 -->
          <div class="brickStyle brickR5C1"></div>
          <div class="brickStyle brickR5C2">
            <iframe src="brickgroupaAdmin.php" id="ba" onclick="resize_model()">
            </iframe>
          </div>
          <div class="brickStyle brickR5C3"></div>
          <div class="brickStyle brickR5C4">
            <iframe src="brickgroupbAdmin.html" id="bb">
            </iframe>
          </div>
          <div class="brickStyle brickR5C5"></div>
          <div class="brickStyle brickR5C6">
            <iframe src="brickgroupcAdmin.html" id="bc">
            </iframe>
          </div>
          <div class="brickStyle brickR5C7"></div>
          <!-- Row 6 -->
          <div class="brickStyle brickR6C1"></div>
          <div class="brickStyle brickR6C2"></div>
          <div class="brickStyle brickR6C3"></div>
          <div class="brickStyle brickR6C4"></div>
          <div class="brickStyle brickR6C5"></div>
          <div class="brickStyle brickR6C6"></div>
          <div class="brickStyle brickR6C7"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="jumbotron text-center" style="margin-bottom:0">
    <p>Last edited June 21st, 2021.</p>
  </div>
</body>

</html>
<html>

<body>
  <!-- The Box1Col2 Modal -->
  <div id="bamodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupaAdmin.php" id="ma">
      </iframe>
    </div>
  </div>
  <!-- The Box2Col2 Modal -->
  <div id="bbmodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupbAdmin.html" id="mb">
      </iframe>
    </div>
  </div>

  <!-- The Box3Col2 Modal -->
  <div id="bcmodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupcAdmin.html" id="mc">
      </iframe>
    </div>
  </div>
  <!-- The Box1Col3 Modal -->
  <div id="bdmodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupdAdmin.html" id="md">
      </iframe>
    </div>
  </div>
  <!-- The Box2Col3 Modal -->
  <div id="bemodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupeAdmin.html" id="me">
      </iframe>
    </div>
  </div>
  <!-- The Box3Col3 Modal -->
  <div id="bfmodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupfAdmin.html" id="mf">
      </iframe>
    </div>
  </div>
  <!-- The Box1Col4 Modal -->
  <div id="bgmodal" class="modal" onclick="closeModalWindow(event)">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close" onclick="closeModalSpan()">&times;</span>
      <iframe src="brickgroupgAdmin.html" id="mg">
      </iframe>
    </div>
  </div>
</body>
</html>
<?php
  exit;
?>