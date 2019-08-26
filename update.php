<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
         <title>To Do List Update Page</title>  
        <?php include 'header1.php'; ?>    
         <style>
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
        <div class="container-fluid">
          <h1>Task Management - Update</h1>
        </div>
        <?php
        print_r($_POST);
        echo '<br>';
        $page_id = "Update Task Management"; 
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        if(! $conn) {
            die('Could not connect : ' . mysqli_error());
        }   
       
        // setup POST handling to update a task
            if($_POST['upd'] == "Select") {
                echo 'In the Post upd = Select code<br>';
                $pid = $_POST['project_id'];
                echo '<div class="container-fluid" >';
                echo "<h5>Select a task to edit<h5>" . '<br>';
                echo '</div>';
                $sql = "SELECT * FROM to_do_list.join_example "
                        . "WHERE project_id = $pid "
                        . "ORDER BY priority";
                echo $sql . '<br>';
                if (!$result = mysqli_query($conn, $sql)) {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
              
                //var_dump($prj);
                
                ?>
            <div class="container-fluid" >
            <div style="height: 450px; max-height:450px; overflow-y: scroll">
             <div class="row">
              <div class="col-sm-12"> 
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Task ID</th>
                    <th>Task</th>
                    <th>Details</th>
                    <th>Filename</th>
                    <th>Priority</th>
                    <th>Category</th>
                    <th>Class</th>
                    <th>Status</th>
                    <th>Entry Date</th>
                  </thead>
                    <?php
                    echo '<form method="post" action="update_task.php">';
                    while ($prj = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                        echo '<td>';
                        echo '<input class="clear" type="submit" name="task_s" '
                        . 'value="' . $prj['task_id'] . '">';
                        echo '</td>';
                        echo '<td>' . $prj['task'] . '</td>';
                        //echo '<td>' . $row['project_name'] . '</td>';
                        echo '<td>' . $prj['details'] . '</td>';
                        echo '<td>' . $prj['filename'] . '</td>';
                        echo '<td>' . $prj['priority'] . '</td>';
                        echo '<td>' . $prj['Category'] . '</td>';
                        echo '<td>' . $prj['class'] . '</td>';
                        echo '<td>' . $prj['td_status'] . '</td>';
                        echo '<td>' . $prj['entry_date'] . '</td>';
                      echo '</tr>';
                    } 
                    echo '</form>';
                    ?>
                </table>
              </div>  
             </div>
            <!-- </div> -->
            </div>
             <hr>
         </div>
           <?php // Leaving the upd = select code
           } else {
           /* if ($_POST['update'] == "Update") {
                echo 'Updating records<br>';
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
                    . "complete_date = '$Comp_Date', "
                    . "idtd_filename = $filenameID, "
                    . "idtd_category = $categoryID, "
                    . "idtd_priority = $priorityID, "
                    . "idtd_class = $classID, "
                    . "idtd_status = $statusID, "
                    . "idtd_projects = $projectID, "
                    . "details = '$details' "
                    . "WHERE td_tasks.task = \"$task\";";
                } else {
                // $Comp_Date = "NULL";
                $sql = "UPDATE td_tasks SET "
                    . "complete_date = NULL, "
                    . "idtd_filename = $filenameID, "
                    . "idtd_category = $categoryID, "
                    . "idtd_priority = $priorityID, "
                    . "idtd_class = $classID, "
                    . "idtd_status = $statusID, "
                    . "idtd_projects = $projectID, "
                    . "details = '$details' "
                    . "WHERE td_tasks.task = \"$task\";";
                }
            
            if ($result = mysqli_query($conn, $sql)) {
                echo "Worked";
                } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            // closing update == Update
            } */
            // $sql7 = "SELECT * FROM task_join";
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
        
        $res7 = mysqli_query($conn, $sql7);
        
         
        // Start by selecting a project - and submitting the project name
         $sql = "SELECT * FROM td_projects ORDER BY project_name";
         if (!$result = mysqli_query($conn, $sql)) {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
         } ?>
         <div class="container-fluid" >
            <div style="height: 100px; max-height:450px; ">
             <div class="row">
              <div class="col-sm-5">
                <form method="post">
                  <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th Colspan="3">Project Name</th>
                  </thead>
                  <tbody>
                  <tr>
                  <td class="align-middle">
                      Choose a Project to modify and press Select Update
                  </td>
                  <td class="align-middle">
                      
                      <?php
                        echo '<select name="project_id">';        
                        foreach ($result as $row) {                             
                          echo "<option value=\"{$row['idtd_projects']}\">"
                            . "{$row['project_name']}</option>";
                        }
                        echo "</select>";
                      ?>             
                  </td>
                  <td class="align-middle">
                      <button class="btn btn-info" name="upd" value="Select" 
                            type="submit">Select Project</button>
                  </td>
                  </tr>
                  </tbody>
              </table>
              </form>
              </div>
             </div>
            </div>
         </div>
        <hr>
        <?php      
            // use $_POST to draw the table of tasks related to the project
            // use  form and $_POST to allow modification of the task
            // use an alert to confirm update success
            // on close of the alert returns to the project list again
            
            ?>
        <!-- show current data in a table -->
        
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
                  <tbody>
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
                  </tbody>
                </table>
              </div>  
             </div>
            <!-- </div> -->
            </div>
             <hr>
         </div>
        
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
           }
        include 'footer.php';
        ?>
        </body>
</html>
