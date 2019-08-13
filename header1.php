<!-- Header, setting up the title, and menu's -->
<!DOCTYPE html >
<html>
    <head>
        <meta charset="UTF-8">
        <title>Navbar header</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
   
<!-- New NavBar using Bootstrap 4 -->
 <div class="container-fluid">
   
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
   <!-- Navbar text -->
  <span class="navbar-text">
      <span style="color: sandybrown"><b>Simple To-Do Tracker</b></span>
  </span>
   <div class="p-2 mr-auto navbar-dark"></div>
    <ul class="navbar-nav"> 
    <li class="nav-item">
      <a class="nav-link" href="./index.php">Tasks</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="priority.php">Priorities</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="class.php">Classes</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="status.php">Status</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="category.php">Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="addfilename.php">Filenames</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="projects.php">Projects</a>
    </li>
  </ul>
</nav>
<hr>
</div>
<?php    
    
$DBHost = "192.168.0.13";
$DBName = "to_do_list";
$DBUser = "pb";
$DBPassword = "Vmwarent1";

?>
    </body>
</html>

