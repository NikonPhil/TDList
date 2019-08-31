<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
     
        <?php include 'header1.php'; ?>
    <style>
    
     .g1 { grid-area: g1; }
     .g2 { grid-area: g2; }
     .g3 { grid-area: g3; }
     .g4 { grid-area: g4; }
     .g5 { grid-area: g5; }
     

    .wrapper {
      display: grid;
      width: 95%;
      grid-template-columns: 1fr 4fr 4fr 3fr;
      gap: 40px;
      grid-template-areas:  '. g1     g2     g5'
                            '. g3     g4     g5';
    }
    /* .wrapper > div { border: 1px solid black;} */
    .sum { grid-area: sum; }
    .t1  { grid-area: t1; }
    .t2  { grid-area: t2; }
    .t3  { grid-area: t3; }
    .t4  { grid-area: t4; }
    .t5  { grid-area: t5; }
    .t6  { grid-area: t6; }
    .t7  { grid-area: t7; }
    .v1  { grid-area: v1; }
    .v2  { grid-area: v2; }
    .v3  { grid-area: v3; }
    .v4  { grid-area: v4; }
    .v5  { grid-area: v5; }
    .v6  { grid-area: v6; }
    .ttl {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: repeat(7, auto);
        gap: 10px;
        border: 1px solid slategray;
        background-color: lightblue;
        padding: 5px;
        grid-template-areas: '.  sum sum sum sum sum'
                             '.  t1   t1  t1  v1  .  '
                             '.  t2   t2  t2  v2  .  '
                             '.  t3   t3  t3  v3  t4  '
                             '.  t5   t5  t5  v4  .  '
                             '.  t6   t6  t6  v5  .  '
                             '.  t7   t7  t7  v6  .  ';
    } 
    </style>
  </head>

  <body>
      <!-- build display using BS4 containers -->
      <div class="container-fluid">
          <h4>To Do List Dashboard</h4>
      </div>
      <!-- Modification for CSS Grid -->
      <div class="wrapper">
        <div class="g1">
            <div class="chart-container">
                <canvas id="mycanvas"></canvas>
            </div> 
        </div>
        <div class="g2">
            <div class="chart-container">
                <canvas id="mycanvas2"></canvas>
            </div>
        </div>
        <div class="g3">
            <div class="chart-container">
                <canvas id="mycanvas3"></canvas>
            </div>
        </div>
        <div class="g4">
            <div class="chart-container">
                <canvas id="mycanvas4"></canvas>
            </div>
        </div>
        <div class="g5">
            <div class="ttl">
                  <div class="sum">
                      <div><p><b>Summary</b></p>
                           </div>
                  </div>
                  <div class="t1">
                    <p>Number of tasks</p>
                  </div>
                  <div class="v1">
                            <?php
                                echo '<p id="d4"></p>';
                            ?>
                  </div>
                  <div class="t2">
                    <p>Number of Projects</p>
                  </div>
                  <div class="v2">
                            <?php
                             echo '<p id="d5"></p>';
                             ?> 
                  </div>
                <div class="t3">
                    <p>Oldest Task</p>
                </div>
                  <div class="v3">
                     <?php echo '<p id="d6"></p>'; ?>
                  </div>
                <div class="t4">
                    <p>Days</p>
                </div>
                <div class="t5">
                    <p>Task</p>
                </div>
                <div class="v4">
                    <?php echo '<p id="d7"></p>'; ?>
                </div>

                <div class="t6">
                        <p>Filename</p>
                </div>
                <div class="v5">
                    <?php echo '<p id="d8"></p>'; ?>
                </div>
                <div class="t7">
                        <p>Project</p>
                </div>
                <div class="v6">
                    <?php echo '<p id="d9"></p>'; ?>
                </div>
            </div>
         </div>
        </div>
 
      <!-- End of CSS Grid Mods -->
        
      
    <?php
    $conn = mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        if(! $conn) {
            echo 'No Connection <br>';
            die('Could not connect : ' . mysqli_error());
        }   
        
        $sql = "SELECT count(t.task) AS series, p.Category AS labels "
            . "FROM td_tasks t JOIN td_category p "
            . "WHERE t.idtd_category = p.idtd_category "
            . "GROUP BY p.idtd_category";
        $result = mysqli_query($conn, $sql);
            if(!$result ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
        $sql2 = "SELECT count(t.task) AS seriesb, p.priority AS labelsb "
            . "FROM td_tasks t JOIN td_priority p "
            . "WHERE t.idtd_priority = p.idtd_priority "
            . "GROUP BY p.idtd_priority";
        $result2 = mysqli_query($conn, $sql2);
            if(!$result2 ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
        $sql3 = "SELECT count(t.task) AS seriesc, p.project_name AS labelsc "
            . "FROM td_tasks t JOIN td_projects p "
            . "WHERE t.idtd_projects = p.idtd_projects "
            . "GROUP BY p.idtd_projects";
        $result3 = mysqli_query($conn, $sql3);
            if(!$result3 ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
        $sql4 = "SELECT count(task) AS task_count FROM td_tasks";
        $result4 = mysqli_query($conn, $sql4);
            if(!$result4 ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
        $sql5 = "SELECT count(project_name) AS project_count FROM td_projects";
        $result5 = mysqli_query($conn, $sql5);
            if(!$result5 ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
        $sql7 = "SELECT count(t.task) AS seriesd, p.td_status AS labelsd "
            . "FROM td_tasks t JOIN td_status p "
            . "WHERE t.idtd_status = p.idtd_status "
            . "GROUP BY p.idtd_status";
        $result7 = mysqli_query($conn, $sql7);
            if(!$result7 ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
            
        
        //loop through the returned data
            $data = array();
            foreach ($result as $row) {
              $data[] = $row;
            }
            $data2 = array();
            foreach ($result2 as $row) {
              $data2[] = $row;
            }
            $data3 = array();
            foreach ($result3 as $row) {
              $data3[] = $row;
            }
            $data4 = mysqli_fetch_assoc($result4);
            $data5 = mysqli_fetch_assoc($result5);
            // Calculate oldest Task outstanding
            // Get the oldest task
           
            $sql6 ="SELECT * FROM oldest_task";
            $result6 = mysqli_query($conn, $sql6);
            if(!$result6 ) {
                echo '<could not query db<br>';
               die('Could not select data: ' . mysqli_error($conn));
            }
            $data6 = mysqli_fetch_assoc($result6);
            
            $msqldt = $data6['entry_date'];
            $msqlt = $data6['task'];
            $entryd = DateTime::createFromFormat("Y-m-d H:i:s",
            $msqldt)->format("Y-m-d");
            $today = date("Y-m-d");
            $dt1 = date_create($today);
            $dt2 = date_create($entryd);
            $ddiff = date_diff($dt2, $dt1);
            $age = $ddiff->format('%R%a');
            $days = array();
            $days[0] = $data6['task'];
            $days[1] = $age;
            $days[2] = $data6['filename'];
            $days[3] = $data6['project_name'];
            
            
            $data7 = array();
            foreach ($result7 as $row) {
              $data7[] = $row;
            }
            mysqli_close($conn);
            
        //print json_encode($data);
        //print json_encode($data7);
        
        $myJSON = json_encode($data);
        $myJSON2 = json_encode($data2);
        $myJSON3 = json_encode($data3);
        
    ?>
    
    
    <script type="text/javascript">
        
//setup the javascript object from the php / mysqli result
var newdata = JSON.parse( '<?php echo json_encode($data) ?>' );
var newdata2 = JSON.parse( '<?php echo json_encode($data2) ?>' );
var newdata3 = JSON.parse( '<?php echo json_encode($data3) ?>' );
var newdata4 = JSON.parse( '<?php echo json_encode($data7) ?>' );
// Set up the values for the summary
var tcount = JSON.parse('<?php echo json_encode($data4) ?>' );
var pcount = JSON.parse('<?php echo json_encode($data5) ?>' );
var days = JSON.parse('<?php echo json_encode($days) ?>' );
//console.log("tcount");
//console.log(tcount);
//console.log("pcount");
//console.log(pcount);
//console.log("days");
//console.log(days);

document.getElementById("d4").innerHTML = tcount['task_count'];
document.getElementById("d5").innerHTML = pcount['project_count'];
document.getElementById("d6").innerHTML = days[1];
document.getElementById("d7").innerHTML = days[0];
document.getElementById("d8").innerHTML = days[2];
document.getElementById("d9").innerHTML = days[3];
//split the object into two arrays
var category = [];
var count = [];
for(var i in newdata){
   category.push(newdata[i].labels);
   count.push(newdata[i].series);
 }
 var priority = [];
 var count2 = [];
 for(var i in newdata2){
   priority.push(newdata2[i].labelsb);
   count2.push(newdata2[i].seriesb);
 }
 var project = [];
 var count3 = [];
 for(var i in newdata3){
   project.push(newdata3[i].labelsc);
   count3.push(newdata3[i].seriesc);
 }
 var tdstatus = [];
 var count4 = [];
 for(var i in newdata4){
   tdstatus.push(newdata4[i].labelsd);
   count4.push(newdata4[i].seriesd);
 }
// check the data
 console.log("Category");
 console.log(category);
 
 console.log("count");
 console.log(count);
 
  console.log("Priority");
 console.log(priority);
 
 console.log("count2");
 console.log(count2);
 
 console.log("Project");
 console.log(project);
 
 console.log("count3");
 console.log(count3);
 
 console.log("tdStatus")
 console.log(tdstatus);
 
 console.log("count4");
 console.log(count4);
 // Create a new object from the two arrays
 var chartdata = {
     labels: category,
     datasets: [
        {
        label: "By Category",
        fill: true,
        lineTension: 0.1,
        backgroundColor: "rgba(240, 173, 78, 0.55)",
        borderColor: "rgba(240, 173, 78, 1)",
        pointHoverBackgroundColor: "rgba(240, 173, 78, 1)",
        pointHoverBorderColor: "rgba(240, 173, 78, 1)",
        data: count
     }
     ]
 }
 
 var chartdata2 = {
     labels: priority,
     datasets: [
         {
         label: "By Priority",
         fill: true,
        lineTension: 0.1,
        backgroundColor: "rgba(240, 173, 78, 0.55)",
        borderColor: "rgba(240, 173, 78, 1)",
        pointHoverBackgroundColor: "rgba(240, 173, 78, 1)",
        pointHoverBorderColor: "rgba(240, 173, 78, 1)",
         data: count2
     }
     ]
 }
 
 var chartdata3 = {
     labels: project,
     datasets: [
         {
         label: "By Project",
         fill: true,
        lineTension: 0.1,
        backgroundColor: "rgba(240, 173, 78, 0.55)",
        borderColor: "rgba(240, 173, 78, 1)",
        pointHoverBackgroundColor: "rgba(240, 173, 78, 1)",
        pointHoverBorderColor: "rgba(240, 173, 78, 1)",
         data: count3
     }
     ]
 }
 var chartdata4 = {
     labels: tdstatus,
     datasets: [
         {
         label: "By Status",
         fill: true,
        lineTension: 0.1,
        backgroundColor: "rgba(240, 173, 78, 0.55)",
        borderColor: "rgba(240, 173, 78, 1)",
        pointHoverBackgroundColor: "rgba(240, 173, 78, 1)",
        pointHoverBorderColor: "rgba(240, 173, 78, 1)",
         data: count4
     }
     ]
 }
 /* Check the data
  console.log("chartdata");
  console.log(chartdata);
 
  console.log("chartdata2");
  console.log(chartdata2);
  
  console.log("chartdata3");
  console.log(chartdata3); */
  
 // setup the pointer to mycanvas
 var ctx = $("#mycanvas");
 
 var LineGraph = new Chart(ctx, {
        type: 'line',
        data: chartdata
      });
      
 var ctx2 = $("#mycanvas2");
 
 var LineGraph = new Chart(ctx2, {
        type: 'line',
        data: chartdata2
      });
      
 var ctx3 = $("#mycanvas3");
 
 var LineGraph = new Chart(ctx3, {
        type: 'line',
        data: chartdata3
      });

var ctx4 = $("#mycanvas4");
 
 var LineGraph = new Chart(ctx4, {
        type: 'line',
        data: chartdata4
      });
  </script>
  <?php include './footer.php'; ?>
  </body>
</html>
