<!DOCTYPE html>

<html>
    <head>
        <!-- CSS files added via header1.php -->
        <?php include 'header1.php'; ?>
        
        <title>To Do List Main Page</title>
        <style>
            .title {grid-area: title; }
.txt1 {grid-area: txt1; text-align: right; }
.txt2 {grid-area: txt2; text-align: right; }
.txt3 {grid-area: txt3; text-align: right; }
.txt4 {grid-area: txt4; text-align: right; }
.txt5 {grid-area: txt5; text-align: right; }
.txt5a {grid-area: txt5a; text-align: right; }
.txt6 {grid-area: txt6; text-align: right; }
.txt7 {grid-area: txt7; text-align: right; }
.sel1 {grid-area: sel1; text-align: center;}
.sel2 {grid-area: sel2; text-align: center;}
.sel3 {grid-area: sel3; text-align: center;}
.sel4 {grid-area: sel4; text-align: center;}
.sel5 {grid-area: sel5;text-align: center; }
.sel5a {grid-area: sel5a;text-align: center; }
.in1 {grid-area: in1; text-align: left;}
.in2 {grid-area: in2; text-align: left;}
.b1 {grid-area: b1; text-align: center;}
.container-add {
  display: grid; width:65%;
  margin: 0 0 0 0;
  padding: 5px;
  grid-template-columns: 60px repeat(2,1fr) 1fr repeat(4,1fr) 60px;
  gap: 10px;
  grid-template-areas: 'title title title title title title title title title .'
    'txt1 sel1 txt2 sel2 txt3 sel3 txt4 sel4 sel4 .'
    'txt5 sel5 txt5a sel5a txt6 in1 txt7 in2 in2  .'
    '. b1 . . . . . in2 in2 .';
}

        </style>   
    </head>
    <body>
        
        <div class="container-fluid">
          <h1>Task Management</h1>
        </div>
        <!-- Setup database connection or exit -->
        <?php
        $page_id = "Task Management"; 
        $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        if(! $conn) {
            die('Could not connect : ' . mysqli_error());
        }   
                
        // setup POST handling to add a new task
         if(isset($_POST['pname'])) { // Is this clause needed?
        
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

           
            $result = mysqli_query($conn, $sql);
            if(!$result ) {
               die('Could not insert data: ' . mysqli_error($conn));
             }
            
         } // End of the 'add' POST processing
         } //End of the 'pname' POST processing
        $sql7 = "SELECT * FROM task_join";
                      
        $res7 = mysqli_query($conn, $sql7);
        if(!$res7 ) {
               die('Could not select data: ' . mysqli_error($conn));
             }
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
            </div>
             <hr>
         </div>
        <!-- Set up the area to add a new task -->
        <form method="post">
        <div class="container-add">
  <div class="title" ><h5>To add a new task enter the details below:</h5></div>
  <div class="txt1">Project</div>
  <div class="sel1">
    <?php
                    $sql1 = "SELECT idtd_projects, project_name FROM td_projects"; 
                    
                    $res1 = mysqli_query($conn, $sql1);
                    if(!$res1 ) {
                        echo $sql1;
                        die('Could not select data: ' . mysqli_error($conn));
                    }
                    echo '<select class="sel" name="pname">';        
                        foreach ($res1 as $row) {                             
                          echo "<option value=\"{$row['idtd_projects']}\">"
                            . "{$row['project_name']}</option>";
                        }
                    echo "</select>";
                    ?>
  </div>
  <div class="txt2">Filename</div>
  <div class="sel2"><?php
                    $sql2 = "SELECT idtd_filename, filename FROM td_filename";
                    //echo $sql2 . "<br>";
                    $res2 = mysqli_query($conn, $sql2);
                    if(!$res2 ) {
                        echo $sql2;
                        die('Could not select data: ' . mysqli_error($conn));
                    }
                    echo '<select class="sel" name="fname">';
                    foreach ($res2 as $row2) {
                        echo "<option value=\"{$row2['idtd_filename']}\">"
                            . "{$row2['filename']}</option>";
                    }
                    echo "</select>";
                    ?></div>
  <div class="txt3">Status</div>
  <div class="sel3">
    <?php
                    $sql3 = "SELECT idtd_status, td_status FROM td_status";
                    //echo $sql3 . "<br>";
                    $res3 = mysqli_query($conn, $sql3);
                    if(!$res3 ) {
                        echo $sql3;
                        die('Could not select data: ' . mysqli_error($conn));
                    }
                    echo '<select class="sel" name="sname">';
                    foreach ($res3 as $row3) {
                        echo "<option value=\"{$row3['idtd_status']}\">"
                            . "{$row3['td_status']}</option>";
                    }
                echo "</select>";
                ?>
  </div>
  <div class="txt4">Class</div>
  <div class="sel4">
    <?php
                     $sql4 = "SELECT idtd_class, class FROM td_class";
                    $res4 = mysqli_query($conn, $sql4);
                    if(!$res4 ) {
                        echo $sql4;
                        die('Could not select data: ' . mysqli_error($conn));
                    }
                    echo '<select class="sel" name="clname">';
                    foreach ($res4 as $row4) {
                        echo "<option value=\"{$row4['idtd_class']}\">"
                            . "{$row4['class']}</option>";
                    }
                echo "</select>";
                ?>
  </div>
  <div class="txt5">Priority</div>
  <div class="sel5">
    <?php
    $sql5 = "SELECT idtd_priority, priority FROM td_priority";
                    $res5 = mysqli_query($conn, $sql5);
                    if(!$res5 ) {
                        echo $sql5;
                        die('Could not select data: ' . mysqli_error($conn));
                    }
                    echo '<select class="sel" name="prname">';
                    foreach ($res5 as $row5) {
                        echo "<option value=\"{$row5['idtd_priority']}\">"
                            . "{$row5['priority']}</option>";
                    }
                    echo "</select>";
                    ?>
  </div>
  <div class="txt5a">Category</div>
  <div class="sel5a">
   <?php
                    $sql6 = "SELECT idtd_category, category FROM td_category";
                    //echo $sql6 . "<br>";
                    $res6 = mysqli_query($conn, $sql6);
                    if(!$res6 ) {
                        echo $sql6;
                        die('Could not select data: ' . mysqli_error($conn));
                    }
                    echo '<select class="sel" name="caname">';
                    foreach ($res6 as $row6) {
                        echo "<option value=\"{$row6['idtd_category']}\">"
                            . "{$row6['category']}</option>";
                    }
                    echo "</select>";
                    ?> 
    </div>
  <div class="txt6">Task</div>
  <div class="in1">
   <input name = "task" type = "text" id = "task">
  </div>
  <div class="txt7">Details</div>
  <div class="in2">
    <input name = "details" type = "text" id = "details">
  </div>
  <div class="b1">
    <button class="btn btn-info" name="add" value="Add" 
                            type="submit">Add New Task</button> 
  </div>
</div>
        </form>
        <?php 
        // Set up page footer
        include 'footer.php';
        ?>
        </body>
</html>
