<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>To Do List Main Page</title>
        <link rel="stylesheet" type="text/css" href="TDList.css">
    </head>
    <body>
        <?php include 'Header.php';
        // put your code here
        echo '<h1>Task Management</h1>'; 
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        $page_id = "Task Management";  
        if(! $conn) {
                die('Could not connect : ' . mysqli_error());
        }   
        
        
        // setup POST handling to add a new filename
         if(isset($_POST['pname'])) {
            // print_r($_POST); // Added to test the _POST variable
            // echo '<br>';
            if ($_POST['button'] === "Update Existing Task") {
                echo 'Updating records<br>';
                $filenameID = $_POST['fname'];
            $projectID = $_POST['pname'];
            $statusID = $_POST['sname'];
            $classID = $_POST['clname'];
            $priorityID = $_POST['prname'];
            $categoryID = $_POST['caname'];
            $Entry_Date = $_POST['edate'];
            $Comp_Date = $_POST['cdate'];
            $details = $_POST['details'];
            $task = $_POST['task'];
            
            if ($statusID === "5") {
                $Comp_Date = "(CURRENT_TIMESTAMP)";
            } else {
                $Comp_Date = "NULL";
            }
            
            $sql = "UPDATE td_tasks SET "
                    . "complete_date = $Comp_Date, idtd_filename = $filenameID, "
                    . "idtd_category = $categoryID, idtd_priority = $priorityID, "
                    . "idtd_class = $classID, idtd_status = $statusID, "
                    . "idtd_projects = $projectID "
                    . "WHERE td_tasks.task = \"$task\";";
                    
            
            if ($conn->multi_query($sql) === TRUE) {
                echo "";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            } elseif ($_POST['button'] === "Enter New Task") {
            
            $filenameID = $_POST['fname'];
            $projectID = $_POST['pname'];
            $statusID = $_POST['sname'];
            $classID = $_POST['clname'];
            $priorityID = $_POST['prname'];
            $categoryID = $_POST['caname'];
            $Entry_Date = $_POST['edate'];
            $Comp_Date = $_POST['cdate'];
            $details = addslashes($_POST['details']);
            $task = $_POST['task'];
            
            if ($statusID === "5") {
                $Comp_Date = "(CURRENT_TIMESTAMP)";
            } else {
                $Comp_Date = "NULL";
            }
            
            $sql = "INSERT INTO td_tasks (id_tasks, task, details, entry_date,"
                    . " complete_date, idtd_filename, idtd_category, "
                    . "idtd_priority, idtd_class, idtd_status, idtd_projects) "
                    . "VALUES (NULL, '$task','$details', (CURRENT_TIMESTAMP), "
                    . "$Comp_Date, $filenameID, $categoryID, $priorityID, "
                    . "$classID, $statusID, $projectID) ";

            
            if ($conn->multi_query($sql) === TRUE) {
                echo "";
                } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

         }
         }
         // Test multiple selections
        //echo "<br>" . 'setting up sql' . "<br>";
        $sql1 = "SELECT idtd_projects, project_name FROM td_projects"; 
        //echo $sql1 . "<br>";
        $res1 = mysqli_query($conn, $sql1);
        
        $sql2 = "SELECT idtd_filename, filename FROM td_filename";
        //echo $sql2 . "<br>";
        $res2 = mysqli_query($conn, $sql2);
        
        $sql3 = "SELECT idtd_status, td_status FROM td_status";
        //echo $sql3 . "<br>";
        $res3 = mysqli_query($conn, $sql3);
        
        $sql4 = "SELECT idtd_class, class FROM td_class";
        //echo $sql4 . "<br>";
        $res4 = mysqli_query($conn, $sql4);
        
        $sql5 = "SELECT idtd_priority, priority FROM td_priority";
        //echo $sql5 . "<br>";
        $res5 = mysqli_query($conn, $sql5);
        
        $sql6 = "SELECT idtd_category, category FROM td_category";
        //echo $sql6 . "<br>";
        $res6 = mysqli_query($conn, $sql6);
        
        $sql7 = "SELECT td_tasks.id_tasks, td_tasks.task, td_tasks.details, 
            td_tasks.entry_date, td_projects.project_name, 
            td_filename.filename, td_class.class, td_status.td_status, 
            td_category.Category, td_priority.priority 
            FROM td_tasks 
    RIGHT JOIN td_projects ON td_projects.idtd_projects = td_tasks.idtd_projects
    RIGHT JOIN td_filename ON td_tasks.idtd_filename = td_filename.idtd_filename
    RIGHT JOIN td_class ON td_tasks.idtd_class = td_class.idtd_class
    RIGHT JOIN td_status ON td_tasks.idtd_status = td_status.idtd_status
    RIGHT JOIN td_category ON td_tasks.idtd_category = td_category.idtd_category
    JOIN td_priority ON td_tasks.idtd_priority = td_priority.idtd_priority 
    ORDER BY td_projects.project_name";
        
        $result = mysqli_query($conn, $sql7);
        
        // show current data in a table
        echo '<table class="t01">';
          echo '<tr>';
              echo '<th>Task No.</th>';
              echo '<th>Task</th>';
              echo '<th>Project</th>';
              echo '<th>Filename</th>';
              echo '<th>Priority</th>';
              echo '<th>Category</th>';
              echo '<th>Class</th>';
              echo '<th>Status</th>';
              echo '<th>Details</th>';
              echo '<th>Entry Date</th>';
          echo '</tr>';
           while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
              echo '<td>' . $row['id_tasks'] . '</td>';
              echo '<td>' . $row['task'] . '</td>';
              echo '<td>' . $row['project_name'] . '</td>';
              echo '<td>' . $row['filename'] . '</td>';
              echo '<td>' . $row['priority'] . '</td>';
              echo '<td>' . $row['Category'] . '</td>';
              echo '<td>' . $row['class'] . '</td>';
              echo '<td>' . $row['td_status'] . '</td>';
              echo '<td>' . $row['details'] . '</td>';
              echo '<td>' . $row['entry_date'] . '</td>';
            echo '</tr>';
          } 
        echo '</table>';
        echo '<hr>';
        
        // display form to add new data, (select a project)
        // set up query for project name..
        echo '<p>To add a new filename select a project, enter the filename '
                . 'and submit</p>';  
        echo '<table class="entry">';                                               // Open the main table
            echo '<tr>';                                                            // Create the first row
                echo '<td>';                                                        // Create the first cell
                    echo '<form method="post">';                                    // set up the form, note single quotes are used to allow the use of double quotes inside the statement
                    echo '<select class="sel" name="pname">';                                   // set a name for the $_post variable
                        foreach ($res1 as $row) {                                 // output each filename to an option
                          echo "<option value=\"{$row['idtd_projects']}\">"
                            . "{$row['project_name']}</option>";
                        }
                    echo "</select>";                                                   // close the selection
                echo '</td>';                                                       // Close the first cell
                echo '<td>';
                echo '<select class="sel" name="fname">';
                    foreach ($res2 as $row2) {
                        echo "<option value=\"{$row2['idtd_filename']}\">"
                            . "{$row2['filename']}</option>";
                    }
                echo "</select>";
                echo '</td>';
                echo '<td>';
                echo '<select class="sel" name="sname">';
                    foreach ($res3 as $row3) {
                        echo "<option value=\"{$row3['idtd_status']}\">"
                            . "{$row3['td_status']}</option>";
                    }
                echo "</select>";
                echo '</td>';
                echo '<td>';
                echo '<select class="sel" name="clname">';
                    foreach ($res4 as $row4) {
                        echo "<option value=\"{$row4['idtd_class']}\">"
                            . "{$row4['class']}</option>";
                    }
                echo "</select>";
                echo '</td>';
                echo '<td>';
                echo '<select class="sel" name="prname">';
                    foreach ($res5 as $row5) {
                        echo "<option value=\"{$row5['idtd_priority']}\">"
                            . "{$row5['priority']}</option>";
                    }
                echo "</select>";
                echo '</td>';
                echo '<td>';
                echo '<select class="sel" name="caname">';
                    foreach ($res6 as $row6) {
                        echo "<option value=\"{$row6['idtd_category']}\">"
                            . "{$row6['category']}</option>";
                    }
                echo "</select>";
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td align="right">Task</td>';
                echo '<td><input name = "task" type = "text" . 
                           id = "task"></td>';
                echo '<td align="right">Entry Date</td>';
                echo '<td><input name = "edate" type = "text" . 
                           id = "edatee"></td>';
                echo '<td align="right">Completion Date</td>';
                echo '<td><input name = "cdate" type = "text" . 
                           id = "cdate"></td>';
                echo '<td align="right">Details</td>';
                echo '<td><input name = "details" type = "text" . 
                           id = "details"></td>';
                echo '</tr>';                                                           // Close the first row
            echo '<tr>';                                                            // Open the second row
                echo '<td colspan="2" align="right">';                                                        // open the first cell        
                // create a button
                  echo '<input class="success" type="submit" value="Enter New'
                . ' Task" name="button"/>';
                echo '</td>';
                echo '<td>';
                echo '<input class="success" type="submit" Value="Update '
                  . 'Existing Task" name="button"';
                echo '</td>';                                                       // Close the first cell
            echo '</tr>';                                                           // Close the second row
                    echo "</form>";                                                 // close the form
        echo '</table>';                                                            // Close the table
        /* Joining tables is a fundamental principle of relational databases. 
         * In your case, A and B are related with the id column, which means 
         * that you can use a syntax similar to this one:
         *  SELECT a.id, a.name, a.num, b.date, b.roll
         *       FROM a INNER JOIN b ON a.id=b.id;
         *   INNER JOIN means that you'll only see rows where there are matching
         * records in A and B. If you want all the rows in A and matching
         * records in B, you could change INNER JOIN to LEFT JOIN. 
         * Conversely, if you want all the records from B and only the 
         * matching ones from A, use RIGHT JOIN. Finally, if you need 
         * everything from both tables, matching or not, you can use FULL JOIN.
         */
        ?>
        </body>
</html>
