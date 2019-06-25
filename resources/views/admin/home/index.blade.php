@extends('admin.layout._layout')
@section('content')


        <!-- center left--> 
        <div class="col-md-9 content">
          <div class="col-sm-12">
            <div class="col-md-3">
              <div class="dash-box dash-box-color-1">
                <div class="dash-box-icon">
                  <i class="fa fa-users"></i>
                </div>
                <div class="dash-box-body">
                  <span class="dash-box-count">0</span>
                  <span class="dash-box-title">Pending Customers</span>
                </div>
                
                <div class="dash-box-action">
                  <a class="button" href="dashboard/customers">View</a>
                </div>        
              </div>
            </div>
            <div class="col-md-3">
              <div class="dash-box dash-box-color-2">
                <div class="dash-box-icon">
                  <i class="fa fa-user-check"></i>
                </div>
                <div class="dash-box-body">
                  <span class="dash-box-count">0</span>
                  <span class="dash-box-title">Active Customers</span>
                </div>
                
                <div class="dash-box-action">
                  <a class="button" href="dashboard/packege">View</a>
                </div>        
              </div>
            </div>
            <div class="col-md-3">
              <div class="dash-box dash-box-color-3">
                <div class="dash-box-icon">
                  <i class="fa fa-user-minus"></i>
                </div>
                <div class="dash-box-body">
                  <span class="dash-box-count">0</span>
                  <span class="dash-box-title">Disabled Customers</span>
                </div>
                
                <div class="dash-box-action">
                  <a class="button" href="dashboard/area">View</a>
                </div>        
              </div>
            </div>
            <div class="col-md-3">
              <div class="dash-box dash-box-color-4">
                <div class="dash-box-icon">
                  <i class="fa fa-comment"></i>
                </div>
                <div class="dash-box-body">
                  <span class="dash-box-count">0</span>
                  <span class="dash-box-title">Opened Tickets</span>
                </div>
                
                <div class="dash-box-action">
                  <a class="button" href="dashboard/support">View</a>
                </div>        
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <hr>
          <div class="col-sm-12">
            <div class="chart-container">
              <canvas id="chart"></canvas>
            </div>
          </div>
          <div class="clearfix"></div>
        </div><!--/col-->

          <!--center-right-->
        <div class="col-md-3">
          <!-- <h4><i class="fa fa-server"></i> Server Memory</h4> -->
            <div class="col-sm-12">
              <div id="canvas-holder">
                <canvas id="chart-pie"></canvas>
              </div>
            </div>
            <div class="clearfix"></div><hr>
            <div class="col-sm-12">
              <div id="canvas-holder">
                <canvas id="chart-dongnut"></canvas>
              </div>
            </div>
            <div class="clearfix"></div>
            <!-- <a href="http://rajtika.com/app/billmanager" target="ext">
              <img src="assets/images/upgrade-pro.png" class="img-responsive" style="width:100%;max-height: 480px;" />
            </a> -->
        </div><!--/col-span-6-->

        <div class="clearfix"></div>

<script src="{{ asset('admin/assets/plugins/chartjs/chartjs.min.js') }}"></script>
  <script>
    var config = {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
          label: 'New',
          fill: true,
          backgroundColor: 'skyblue',
          borderColor: 'green',
          borderDash: [5, 5],
          data: [5,7,6,9,4,6,7,6,9,4,9,9],
        }, {
          label: 'Active',
          backgroundColor: 'mediumseagreen',
          borderColor: 'red',
          data: [7,6,9,4,9,4,7,6,9,4,5,9],
          fill: true,
        }, {
          label: 'Disabled',
          backgroundColor: 'lightcoral',
          borderColor: 'red',
          data: [7,6,9,4,7,9,7,6,9,4,8,9],
          fill: true,
        }]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: "Customer graph of {{ date('Y') }}"
        },
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        hover: {
          mode: 'nearest',
          intersect: true
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Month'
            }
          }],
          yAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Value'
            }
          }]
        }
      }
    };
    var randomScalingFactor = function() {
      return Math.round( Math.random() * 100 );
    };
    var config2 = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            17,
            83
          ],
          backgroundColor: [
            'green',
           'red'
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Free',
          'Used'
        ]
      },
      options: {
        responsive: true,
        title: {
          display: true,
          text: 'Server Memory'
        },
      }
    };

    var config3 = {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [
            3,
            97
          ],
          backgroundColor: [
            'orange',
            'blue'
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Down',
          'Up'
        ]
      },
      options: {
        responsive: true,
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Server Uptime'
        },
        animation: {
          animateScale: true,
          animateRotate: true
        }
      }
    };

    window.onload = function() {
      var ctx = document.getElementById('chart').getContext('2d');
      window.myLine = new Chart(ctx, config);
      <?php //if( noUpgrade() == true ) : ?>
      var pie = document.getElementById('chart-pie').getContext('2d');
      window.myPie = new Chart(pie, config2);
      var doughnut = document.getElementById('chart-dongnut').getContext('2d');
      window.myDoughnut = new Chart(doughnut, config3);
      <?php //endif; ?>
    };
  </script>
@endsection