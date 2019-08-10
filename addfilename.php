<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add a new filename to the database</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
        <?php include 'Header.php';
        // put your code here
        echo '<h1>List of existing filenames</h1>';                                // edit this line
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Filename";                                                      // edit this line
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        } 
        
        // setup POST handling to add a new project
        if(isset($_POST['pid'])) {                                                // edit this line and change variable name
            // print_r($_POST); // Added to test the _POST variable                    // to test variable handling, comment out later
            // echo '<br>';                                                            // as above
            
            $projectID = $_POST['pid'];                                            // edit to change variable names
            $filename = $_POST['fname'];
            $sql = "INSERT INTO td_filename (idtd_filename, filename, " .
                     "idtd_project) VALUES (NULL, '$filename', " .
                     "'$projectID')";                                   // edit to change variable names
            echo $sql . "<br>";
            $result = mysqli_query($conn, $sql);
            
            if(! $result ) {
               die('Could not enter data: ' . mysqli_error($conn));
             }           
            }
        
        
        // setup query to select current data
        $sql = "SELECT td_filename.filename, td_projects.idtd_projects, " .
            "td_projects.project_name FROM td_filename " .
            "RIGHT JOIN td_projects ON "
                . "td_filename.idtd_project = td_projects.idtd_projects";                                 // Change sql table / field references
              
        $result = mysqli_query($conn, $sql);
        
        // show current data in a table
        echo '<table class="t01">';
          echo '<tr>';
              echo '<th>Project</th>';                                             // Change table header name
              echo '<th>Filename</th>';
          echo '</tr>';
          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['project_name'] . '</td>';                             // Change variable name
              echo '<td>' . $row['filename'] . '</td>';
            echo '</tr>';
          }
        echo '</table>';
        echo '<hr>';
        
        // display form to add new data, (select a project)
        // set up query for category name..
        echo '<p>To add a new filename select the project, enter the name '
                . 'and submit</p>';                                                 // Change the title
        echo '<table class="entry">';                                               // Open the main table
            echo '<tr>';                                                            // Create the first row
                echo '<form method="post">';                                    // set up the form, note single quotes are used to allow the use of double quotes inside the statement
                // echo '<th></th>';
                echo '<th align="center">Project Name</th>';
                echo '<th align="center">Filename</th>';
            echo '</tr>';
            echo '<tr>';
                // echo '<td align="right"></td>';                              // Change the title
                echo '<td align="center">';
                    echo '<select class="sel" name = "pid">';              // Change the reference names
                        foreach ($result as $row) {
                        echo "<option value=\"{$row['idtd_projects']}\">"
                            . "{$row['project_name']}</option>";
                    }
                    echo '</select>';
                echo '</td>';
                    echo '<td align="center"><input name="fname" type = "text">';
                echo '</td>';
            echo '</tr>';                                                           // Close the first row
            echo '<tr>';                                                            // Open the second row
                echo '<td colspan="3" align="right">';                              // open the first cell        
                // create a button
                  echo '<input class="success" type="submit" value="Add ' . $page_id 
                        . '" name="SubmitButton"/>'; 
                echo '</td>';                                                       // Close the first cell
            echo '</tr>';                                                           // Close the second row
                    echo "</form>";                                                 // close the form
        echo '</table>';                                                            // Close the table
        
        // handle input data
        // post data
        
        ?>
    </body>
</html>
