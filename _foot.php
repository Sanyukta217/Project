<footer class="py-2 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; 2022</div>
            <div>
                <span>Designed with &#10084; <a href="https://github.com/Sanyukta217">Sanyukta Kumari</a></span>
            </div>
        </div>
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

<script src="js/scripts.js"></script>
<script src="js/_customs.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>

<!-- <script src="js/datatables-simple-demo.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php if (basename($_SERVER['PHP_SELF']) == "dasboard.php") : ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<?php endif ?>
<script>
  $(document).ready(function(){
    $("#spinner").hide();
    // Area Chart Example
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Enquiry'],
          <?php
          $users = new Users;
          $showtbl = $users->view('enquiry_tbl','','');
          $graph="";
          foreach ($showtbl as $key => $value) {
            $graph.="['".date("Y-m-d",strtotime($value['added_on']))."',".$users->count('enquiry_tbl',' AND `added_on`="'.$value['added_on'].'"')."],";
          }
          echo $graph;
          ?>
        ]);

        var options = {
          title: 'No of Enquiry ',
          hAxis: {title: 'Date',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('myAreaChart2'));
        chart.draw(data, options);
      }

  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawBasic);

  function drawBasic() {

        var data = google.visualization.arrayToDataTable([
           ['Date', 'Task'],
          <?php
          $users = new Users;
          $showtbl2 = $users->view('task_tbl',' AND `status` = "0" GROUP BY DATE(`added_on`)','');
          $graph2="";
          foreach ($showtbl2 as $key => $value) {
            $graph2.="['".date("Y-m-d",strtotime($value['added_on']))."',".$users->count('task_tbl',' AND DATE(`added_on`)="'.date("Y-m-d",strtotime($value['added_on'])).'" AND `status`="0"')."],";
          }
          echo $graph2;
          ?>
        ]);

        var options = {
          title: 'Task(s) Completed',
          chartArea: {width: '50%'},
          hAxis: {
            title: 'Total Completed',
            minValue: 0
          },
          vAxis: {
            title: 'Task'
          }
        };

        var chart = new google.visualization.BarChart(document.getElementById('myAreaChart'));

        chart.draw(data, options);
      }
  });

</script>
</body>
</html>
