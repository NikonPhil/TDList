<!-- Header, setting up the title, and menu's -->
<!DOCTYPE html >
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a new filename to the database</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
    <?php
    echo "<h1>Simple To-Do Tracker</h1>";
    echo "<hr>";
    echo '<table class="menu">';
        echo "<tr>";
            echo "<td>";
              echo '<a href="./index.php">Tasks</a>';
            echo "</td>";
            echo "<td>";
              echo '<a href="./priority.php">Priorities</a>';
            echo "</td>";
            echo "<td>";
              echo '<a href="./class.php">Classes</a>';
            echo "</td>";
            echo "<td>";
              echo '<a href="./status.php">Status</a>';
            echo "</td>";
            echo "<td>";
              echo '<a href="./category.php">Categories</a>';
            echo "</td>";
            echo "<td>";
              echo '<a href="./addfilename.php">Filenames</a>';
            echo "</td>";
            echo '<td>';
              echo '<a href="./projects.php">Projects</a>';
            echo '</td>';
        echo "</tr>";
    echo "</table>";
    echo "<hr>";
// echo "<br>";

    echo "<footer>";
        echo "<hr>";
        echo "<h4>By Phil Burness using Netbeans, Mysql, Apache and PHP</h4>";
    echo "</footer>";


$DBHost = "192.168.0.13";
$DBName = "to_do_list";
$DBUser = "pb";
$DBPassword = "Vmwarent1";

?>
    </body>
</html>

