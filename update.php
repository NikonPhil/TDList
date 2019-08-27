<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files included via header1.php -->
         <?php include 'header1.php'; ?> 
         <title>To Do List Update Page</title>  
          
         
    </head>
    <body>
        <div class="container-fluid">
          <h1>Task Management - Update</h1>
        </div>
        <!-- Setup database connection or exit -->
        <?php

        $page_id = "Update Task Management"; 
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        if(! $conn) {
            die('Could not connect : ' . mysqli_error());
        }   
       
        // setup POST handling to select a project
        if($_POST['upd'] == "Select") {

            $pid = $_POST['project_id'];
            echo '<div class="container-fluid" >';
            echo "<h5>Select a task to edit<h5>" . '<br>';
            echo '</div>';
            $sql = "SELECT * FROM to_do_list.join_example "
                    . "WHERE project_id = $pid "
                    . "ORDER BY priority";
            $result = mysqli_query($conn, $sql);
            if(!$result) {
                die('Could not select data: ' . mysqli_error($conn));
            }
            ?>
        <!-- Display the task table -->
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
                    // Create the ability to select a task by it's task_id
                    // Call update_task.php with selection
                    echo '<form method="post" action="update_task.php">';
                    while ($prj = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                        echo '<td>';
                        echo '<input class="clear" type="submit" name="task_s" '
                        . 'value="' . $prj['task_id'] . '">';
                        echo '</td>';
                        echo '<td>' . $prj['task'] . '</td>';
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
            </div>
             <hr>
         </div>
           <?php // Leaving the upd = select code
           }  // else { // display the current table
           
            $sql7 = "SELECT * FROM task_join";
        
        $res7 = mysqli_query($conn, $sql7);
        if(!$res7) {
                    die('Could not select data: ' . mysqli_error($conn));
                }
         
        // Start by selecting a project - and submitting the project name
         $sql = "SELECT * FROM td_projects ORDER BY project_name";
         $result = mysqli_query($conn, $sql);
         if(!$result) {
                    die('Could not select data: ' . mysqli_error($conn));
                }
           ?>
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
            </div>
             <hr>
         </div>
        
        <?php 
        
         //  } // end of POST processing
        // set up footer display   
        include 'footer.php';
        ?>
        </body>
</html>
