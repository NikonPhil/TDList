<!DOCTYPE html>

<html>
  <head>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
     
        <?php include 'header1.php'; ?>
    <style>
      .chart-container {
        width: 500px;
        height: 300px;
      }
      .data-block {
          border-color: cornflowerblue;
          border-width: thick;
          border: solid;
      }
      .td narrow {
          width: 30px;
      }
      .td wide {
          width: 205px;
      }
    </style>
  </head>

  <body>
      <!-- build display using BS4 containers -->
      <div class="container-fluid">
          <h4>To Do List Dashboard</h4>
      </div>
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-6">
                  <div class="chart-container">
                    <canvas id="mycanvas"></canvas>
                </div> 
              </div>
              <div class="col-sm-6">
                  <div class="chart-container">
                    <canvas id="mycanvas2"></canvas>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-sm-6">
                  <div class="chart-container">
                    <canvas id="mycanvas3"></canvas>
                  </div>
              </div>
              <div class="col-sm-6">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-sm-6">
                           <div class="alert alert-dark mb-0">Summary</div>
                          </div>
                      </div>
                      <div class="row">
                              <div class="col-sm-6">
                                  <div class="alert alert-info mb-0">
                                      <?php
                                      echo '<p id="d4"></p>';
                                      ?>
                                  </div>
                              </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                           <div class="alert alert-dark mb-0"></div>
                          </div>
                      </div>
                      <div class="row">
                              <div class="col-sm-6">
                                  <div class="alert alert-info mb-0">
                                     <?php
                                      echo '<p id="d5"></p>';
                                      ?> 
                                  </div>
                              </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-6">
                           <div class="alert alert-dark mb-0"></div>
                          </div>
                      </div>
                      <div class="row">
                              <div class="col-sm-6">
                                  <div class="alert alert-info mb-0">
                                      <?php
                                      echo '<p id="d6"></p>';
                                      echo '<p id="d7"></p>';
                                      ?> 
                                  </div>
                              </div>
                      </div>
                  </div>
              </div> 
                      
          </div>
      </div>
        
      
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
            $sql6 = "SELECT t.task, t.entry_date "
                    . "FROM td_tasks t "
                    . "ORDER BY t.entry_date ASC";
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
            mysqli_close($conn);
            
        //print json_encode($data);
        //print json_encode($data2);
        
        $myJSON = json_encode($data);
        $myJSON2 = json_encode($data2);
        $myJSON3 = json_encode($data3);
        
    ?>
    
    
    <script type="text/javascript">
        
//setup the javascript object from the php / mysqli result
var newdata = JSON.parse( '<?php echo json_encode($data) ?>' );
var newdata2 = JSON.parse( '<?php echo json_encode($data2) ?>' );
var newdata3 = JSON.parse( '<?php echo json_encode($data3) ?>' );
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

document.getElementById("d4").innerHTML = "# Tasks    :    " + tcount['task_count'];
document.getElementById("d5").innerHTML = "# Projects :    " + pcount['project_count'];
document.getElementById("d6").innerHTML = "# Oldest   :    " + days[1] + " Days";
document.getElementById("d7").innerHTML = " Name      : =  " + days[0];
// split the object into two arrays
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
 /* check the data
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
 console.log(count3); */
 
 // Create a new object from the two arrays
 var chartdata = {
     labels: category,
     datasets: [
        {
        label: "By Category",
        fill: true,
        lineTension: 0.1,
        backgroundColor: "rgba(255, 204, 230, 0.55)",
        borderColor: "rgba(255, 204, 230, 1)",
        pointHoverBackgroundColor: "rgba(255, 204, 230, 1)",
        pointHoverBorderColor: "rgba(255, 204, 230, 1)",
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
        backgroundColor: "rgba(255, 204, 230, 0.55)",
        borderColor: "rgba(255, 204, 230, 1)",
        pointHoverBackgroundColor: "rgba(255, 204, 230, 1)",
        pointHoverBorderColor: "rgba(255, 204, 230, 1)",
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
        backgroundColor: "rgba(255, 204, 230, 0.55)",
        borderColor: "rgba(255, 204, 230, 1)",
        pointHoverBackgroundColor: "rgba(255, 204, 230, 1)",
        pointHoverBorderColor: "rgba(255, 204, 230, 1)",
         data: count3
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
        type: 'bar',
        data: chartdata3
      });

  </script>
  <?php include './footer.php'; ?>
  </body>
</html>
