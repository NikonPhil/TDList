<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php include 'header1.php'; ?>
        
        <title>To Do List Main Page</title>
        
    </head>
    <body>
        
        <div class="container-fluid">
          <h1>Task Management</h1>
        </div>
        <?php
        $page_id = "Task Management"; 
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        if(! $conn) {
            die('Could not connect : ' . mysqli_error());
        }   
                
        // setup POST handling to add a new filename
         if(isset($_POST['pname'])) {
             //echo 'In the _Post["pname"] clause<br>';
             //print_r($_POST); // Added to test the _POST variable
             //echo '<br>';
            if ($_POST['mod'] == "Mod") {
                // echo 'Updating records<br>';
                $filenameID = $_POST['fname'];
                $projectID = $_POST['pname'];
                $statusID = $_POST['sname'];
                $classID = $_POST['clname'];
                $priorityID = $_POST['prname'];
                $categoryID = $_POST['caname'];
                // $Entry_Date = $_POST['edate'];
                // $Comp_Date = $_POST['cdate'];
                $details = $_POST['details'];
                $task = $_POST['task'];
            
                if ($statusID === "5") {
                    $Comp_Date = date('Y-m-d H:i:s');
                    $sql = "UPDATE td_tasks SET "
                    . "complete_date = '$Comp_Date', idtd_filename = $filenameID, "
                    . "idtd_category = $categoryID, idtd_priority = $priorityID, "
                    . "idtd_class = $classID, idtd_status = $statusID, "
                    . "idtd_projects = $projectID, details = '$details' "
                    . "WHERE td_tasks.task = \"$task\";";
                } else {
                // $Comp_Date = "NULL";
                $sql = "UPDATE td_tasks SET "
                    . "complete_date = NULL, idtd_filename = $filenameID, "
                    . "idtd_category = $categoryID, idtd_priority = $priorityID, "
                    . "idtd_class = $classID, idtd_status = $statusID, "
                    . "idtd_projects = $projectID, details = '$details' "
                    . "WHERE td_tasks.task = \"$task\";";
                }
            
            if ($result = mysqli_query($conn, $sql)) {
                echo "Worked";
                } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            }
            if ($_POST['add'] == "Add") {
                // echo 'In the add clause <br>';
                $filenameID = $_POST['fname'];
                $projectID = $_POST['pname'];
                $statusID = $_POST['sname'];
                $classID = $_POST['clname'];
                $priorityID = $_POST['prname'];
                $categoryID = $_POST['caname'];
                //$Entry_Date = $_POST['edate'];
                //$Comp_Date = $_POST['cdate'];
                $details = addslashes($_POST['details']);
                $task = $_POST['task'];
                $date = date('Y-m-d H:i:s');
                $sql = "INSERT INTO td_tasks (id_tasks, task, details, "
                    . "entry_date, idtd_filename, idtd_category, "
                    . "idtd_priority, idtd_class, idtd_status, idtd_projects) "
                    . "VALUES (NULL, '$task', '$details', '$date', "
                    . "$filenameID, $categoryID, $priorityID, "
                    . "$classID, $statusID, $projectID)";

            echo $sql . '<br>';
            if ($result = mysqli_query($conn, $sql)) {
                echo "Worked";
                } else {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
            }
            // echo 'Leaving the Add Clause<br>';
         }
         }
        $sql7 = "SELECT * FROM task_join";
        
        /*$sql7 = "SELECT td_tasks.id_tasks, td_tasks.task, td_tasks.details, 
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
    ORDER BY td_projects.project_name"; */
        
        $res7 = mysqli_query($conn, $sql7);
        
        // show current data in a table ?>
        <div class="container-fluid" >
            <div style="height: 450px; max-height:450px; overflow-y: scroll">

             <div class="row">
              <div class="col-sm-12">
                  
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Task No.</th>
                    <th>Task</th>
                    <th>Project</th>
                    <th>Filename</th>
                    <th>Priority</th>
                    <th>Category</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>Details</th>
                    <th>Entry Date</th>
                  </thead>
                    <?php
                    while ($row = mysqli_fetch_array($res7)) {
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
                    ?>
                </table>
              </div>  
             </div>
            <!-- </div> -->
            </div>
             <hr>
         </div>
        <form method="post">
        <div class="container-fluid">
            <p>To add a new Task, enter the details below</p>
            
            <div class="row">
                <div class="col-sm-1">
                    Project
                </div>
                <div class="col-sm-1">
                    <?php
                    $sql1 = "SELECT idtd_projects, project_name FROM td_projects"; 
                    //echo $sql1 . "<br>";
                    $res1 = mysqli_query($conn, $sql1);
                    echo '<select class="sel" name="pname">';        
                        foreach ($res1 as $row) {                             
                          echo "<option value=\"{$row['idtd_projects']}\">"
                            . "{$row['project_name']}</option>";
                        }
                    echo "</select>";
                    ?>
                </div>
                <div class="col-sm-1">
                    File
                </div>
                <div class="col-sm-3">
                    <?php
                    $sql2 = "SELECT idtd_filename, filename FROM td_filename";
                    //echo $sql2 . "<br>";
                    $res2 = mysqli_query($conn, $sql2);
                    echo '<select class="sel" name="fname">';
                    foreach ($res2 as $row2) {
                        echo "<option value=\"{$row2['idtd_filename']}\">"
                            . "{$row2['filename']}</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class="col-sm-1">
                    Status
                </div>
                <div class="col-sm-1">
                    <?php
                    $sql3 = "SELECT idtd_status, td_status FROM td_status";
                    //echo $sql3 . "<br>";
                    $res3 = mysqli_query($conn, $sql3);
                    echo '<select class="sel" name="sname">';
                    foreach ($res3 as $row3) {
                        echo "<option value=\"{$row3['idtd_status']}\">"
                            . "{$row3['td_status']}</option>";
                    }
                echo "</select>";
                ?>
                </div>
                <div class="col-sm-1">
                    Class
                </div>
                <div class="col-sm-1">
                    <?php
                     $sql4 = "SELECT idtd_class, class FROM td_class";
                    //echo $sql4 . "<br>";
                    $res4 = mysqli_query($conn, $sql4);
                    echo '<select class="sel" name="clname">';
                    foreach ($res4 as $row4) {
                        echo "<option value=\"{$row4['idtd_class']}\">"
                            . "{$row4['class']}</option>";
                    }
                echo "</select>";
                ?>
                </div>
                <div class="col-sm-1">
                    Priority
                </div>
                <div class="col-sm-1">
                    <?php
                    $sql5 = "SELECT idtd_priority, priority FROM td_priority";
                    //echo $sql5 . "<br>";
                    $res5 = mysqli_query($conn, $sql5);
                    echo '<select class="sel" name="prname">';
                    foreach ($res5 as $row5) {
                        echo "<option value=\"{$row5['idtd_priority']}\">"
                            . "{$row5['priority']}</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1">
                    Category
                </div>
                <div class="col-sm-1">
                    <?php
                    $sql6 = "SELECT idtd_category, category FROM td_category";
                    //echo $sql6 . "<br>";
                    $res6 = mysqli_query($conn, $sql6);
                    echo '<select class="sel" name="caname">';
                    foreach ($res6 as $row6) {
                        echo "<option value=\"{$row6['idtd_category']}\">"
                            . "{$row6['category']}</option>";
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class="col-sm-1">
                    Task
                </div>
                <div class="col-sm-4">
                  <input name = "task" type = "text" id = "task">
                </div>
                <!-- Entry date added automatically
                <div class="col-sm-3">
                 <input name = "edate" type = "text" id = "edatee">
                </div>
                <div class="col-sm-3">
                  <input name = "cdate" type = "text" id = "cdate">
                </div> -->
                <div class="col-sm-1">
                    Details
                </div>
                <div class="col-sm-4">
                   <input name = "details" type = "text" id = "details">
                </div>
        </div>
            <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <button class="btn btn-info" name="add" value="Add" type="submit">Add New Task</button> 
                </div>
                
                <div class="col-sm-6">
                
                </div>
            </div>
        </div>
        </div>
        </form>
        <?php 
                                                                  
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
        include 'footer.php';
        ?>
        </body>
</html>
