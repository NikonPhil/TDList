<!DOCTYPE html >
<!-- Header, setting up the title, and menu's -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>To Do List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <!-- Add any additional styles (non-bootstrap or bootstrap mods here -->
        <style>
        hr {
            color: darkslateblue;
            background-color: darkslateblue;
            height: 3px;
            border: none;
            }
        br {
            height: 5px;
        }
        .clear {
            background-color: transparent;
            color:black;
            border: none;
             }
        .clear:hover {
            color: red;
        }
         </style>
    </head>
    <body>
   
<!-- New NavBar using Bootstrap 4 -->
 <div class="container-fluid">
   
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   <!-- Navbar text -->
  <div class="navbar-text" style="color: sandybrown">
      <h4><b>
              Simple To-Do Tracker
          </b>
      </h4>
  </div>
   <div class="p-2 mr-auto navbar-dark"></div>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" 
               data-toggle="dropdown">
                Tasks Menu
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="./td_index.php">
                    Add Task
                </a>
                <a class="dropdown-item" href="./td_update.php">
                    Update Task
                </a>
            </div>
        </li>
    <li class="nav-item">
      <a class="nav-link" href="td_priority.php">Priorities</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="td_class.php">Classes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="td_status.php">Status</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="td_category.php">Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="td_addfilename.php">Filenames</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="td_projects.php">Projects</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="td_statistics.php">Statistics</a>
    </li>
  </ul>
</nav>
<hr>
</div>
<?php    
    // Setup database variables
        $DBHost = "192.168.0.13";
        $DBName = "to_do_list";
        $DBUser = "pb";
        $DBPassword = "Vmwarent1";
?>
    </body>
</html>

