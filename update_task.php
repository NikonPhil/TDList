<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <!-- CSS files included via header1.php -->
        <title>Update Task Details</title>
        <?php include 'header1.php'; ?>    
         
    </head>
    <body>
        <!-- Connect to database or exit -->
        <?php
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        if(! $conn) {
            die('Could not connect : ' . mysqli_error());
        }   
        // Set up pOST processing for task selection
        if(isset($_POST['task_s'])) {
            
            $task_id = $_POST['task_s'];
            $sql = "SELECT * FROM to_do_list.join_example "
                        . "WHERE task_id = $task_id "
                        . "ORDER BY priority";
            $result = mysqli_query($conn, $sql);
            if(!$result ) {
                echo $sql;
                die('Could not select data: ' . mysqli_error($conn));
            }
            
            $sql2 = "SELECT * FROM td_comments WHERE idtd_tasks = $task_id "
                    . "ORDER BY entry_date DESC";
            $result2 = mysqli_query($conn, $sql2);
            if(!$result2 ) {
                echo $sql2;
                die('Could not select data: ' . mysqli_error($conn));
            }
        } // End of 'task_s' POST processing   
        
        if ($_POST['mod'] == "Mod") {
         
            $statusID = $_POST['stname'];
            $classID = $_POST['clname'];
            $priorityID = $_POST['prname'];
            $categoryID = $_POST['caname'];
            $details = trim(addslashes($_POST['details']));
            $task_id = $_POST['task_id'];
        
            if ($statusID === "5") { // Is the task closed?
                $Comp_Date = date('Y-m-d H:i:s');
                $sql = "UPDATE td_tasks SET "
                . "complete_date = '$Comp_Date', "
                . "idtd_category = $categoryID, idtd_priority = $priorityID, "
                . "idtd_class = $classID, idtd_status = $statusID "
                . "WHERE td_tasks.id_tasks = \"$task_id\";";
                
                $sql3 = "INSERT INTO td_comments (comments, idtd_tasks, "
                . "entry_date) VALUES (\"$details\", $task_id, "
                . "now())";
            } else { // No, leave the completion date open
                $sql = "UPDATE td_tasks SET "
                    . "complete_date = NULL, "
                    . "idtd_category = $categoryID, idtd_priority = $priorityID, "
                    . "idtd_class = $classID, idtd_status = $statusID "
                    . "WHERE td_tasks.id_tasks = \"$task_id\";";

                $sql3 = "INSERT INTO td_comments (comments, idtd_tasks, "
                    . "entry_date) VALUES (\"$details\", $task_id, "
                    . "now())";
            }

        if (!$result = mysqli_query($conn, $sql)) {
            echo "Error: updating table " . $sql . "<br>" . mysqli_error($conn);
        } elseif (!$result3 = mysqli_query($conn, $sql3)) {
             echo "Error: inserting into table" . $sql3 . "<br>" . mysqli_error($conn);   
            } else {
            header("Location: ./index.php");
        }
        } // End of 'mod' POST processing
        ?>
        <!-- Display the task table -->
        <form method="post" id="task_upd">
            <div class="container-fluid">
            <div style="height: 250px; max-height:350px; overflow-y: scroll">
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
                    <th>Open for (days)</th>
                  </thead>
                  <tbody>
                    <?php
                    $prj = mysqli_fetch_assoc($result);
                      echo '<tr>';
                      echo '<td class="align-middle" >';
                      echo '<input class="clear" type="text" name="task_id" '
                        . ' style="width: 20px;" value="' 
                        . $prj['task_id'] . '"></input>';
                        echo '<td class="align-middle">' . $prj['task'] . '</td>';
                        echo '<td class="align-middle">' . $prj['details'] . '</td>';
                      echo '<td class="align-middle">' . $prj['filename'] . '</td>';
                      echo '<td>';
                        $sqlpr = "SELECT * FROM td_priority";
                        $respr = mysqli_query($conn, $sqlpr);
                        echo '<select name="prname" form="task_upd" class="custom-select">';
                        foreach ($respr as $row3) {
                            if($row3['priority'] == $prj['priority']) {
                                $sel = "selected";
                            } else {
                                $sel = " ";  
                            }
                        echo '<option value="' . $row3['idtd_priority'] . '"' . $sel . '>'
                            . $row3['priority'] . '</option>';
                        }
                        echo '</selected>';
                      echo '</td>';
                      
                      echo '<td>';
                        $sqlca = "SELECT * FROM td_category";
                        $resca = mysqli_query($conn, $sqlca);
                        echo '<select name="caname" form="task_upd" class="custom-select">';
                        foreach ($resca as $row4) {
                            if($row4['Category'] == $prj['Category']) {
                                $sel = "selected";
                            } else {
                                $sel = " ";  
                            }
                        echo '<option value="' . $row4['idtd_category'] . '"' . $sel . '>'
                            . $row4['Category'] . '</option>';
                        }
                        echo '</selected>';
                      echo '</td>';
                      echo '<td>';
                        $sqlcl = "SELECT * FROM td_class";
                        $rescl = mysqli_query($conn, $sqlcl);
                        echo '<select name="clname" form="task_upd" class="custom-select">';
                        foreach ($rescl as $row5) {
                            if($row5['class'] == $prj['class']) {
                                $sel = "selected";
                            } else {
                                $sel = " ";  
                            }
                        echo '<option value="' . $row5['idtd_class'] . '"' . $sel . '>'
                            . $row5['class'] . '</option>';
                        }
                        echo '</selected>';
                      echo '</td>';
                      echo '<td>';
                       $sqlst = "SELECT * FROM td_status";
                        $resst = mysqli_query($conn, $sqlst);
                        echo '<select name="stname" form="task_upd" class="custom-select">';
                        foreach ($resst as $row6) {
                            if($row6['td_status'] == $prj['td_status']) {
                                $sel = "selected";
                            } else {
                                $sel = " ";  
                            }
                        echo '<option value="' . $row6['idtd_status'] . '"' . $sel . '>'
                            . $row6['td_status'] . '</option>';
                        }
                        echo '</selected>';
                      echo '</td>';
                     
                        echo '<td class="align-middle">';
                            $msqldt = $prj['entry_date'];
                            $entryd = DateTime::createFromFormat("Y-m-d H:i:s",
                            $msqldt)->format("Y-m-d");
                            $today = date("Y-m-d");
                            $dt1 = date_create($today);
                            $dt2 = date_create($entryd);
                            $ddiff = date_diff($dt2, $dt1);
                            echo $ddiff->format('%R%a');
                        echo '</td>';
                      echo '</tr>';
                    ?>
                   </tbody>
                </table>
              </div>  
             </div>
            </div>
             <hr>
         </div>
        <!-- Display the comments section -->    
        <div class="container-fluid">
            <div style="height: 250px; max-height:350px; overflow-y: scroll">
             <div class="row">
              <div class="col-sm-8">  
                <table class="table table-bordered table-sm table-striped">
                  <thead class="thead-dark">
                    <th>Entry Date</th>
                    <th>Comment</th>
                  </thead>
                  <tbody>
                    <?php  
                     while ($msg = mysqli_fetch_assoc($result2)) {
                        echo '<tr>';
                        echo '<td style="width: 20%">' . $msg['entry_date'] . '</td>';
                        echo '<td style="width: 80%">' . $msg['comments'] . '</td>';
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
        <!-- Display the comments entry section -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                
                    <table>
                        
                        <tr>
                            <td>
                                <div class="col-sm-1"></div>  
                            </td>
                            <td>
                                <div class="col-sm-3">
                               <textarea name="details" form="task_upd" 
                                    cols="40" rows="4" 
                                    placeholder="Add a new comment here..">
                               </textarea>
                                </div>
                            </td>
                            <td>
                                <div class="col-sm-1"></div>
                            </td>
                            <td>
                                <div class="col-sm-1">
                              <button class="btn btn-info" form="task_upd" 
                                      type="submit" name="mod" value="Mod">
                                Update Task
                              </button> 
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </form>
        <?php
        // Setup the footer display
        include 'footer.php';
        ?>
    </body>
</html>
