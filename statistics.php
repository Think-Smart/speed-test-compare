<?php

require_once 'php/config.php';

$speedtest = new speedtest();

?>
<!DOCTYPE html>
<html DIR="LTR" LANG="en">
	<head>
<?php include('include/head.php'); ?>




    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	
	google.charts.setOnLoadCallback(drawVisualization00);
	function drawVisualization00() {
        
		var data = google.visualization.arrayToDataTable([
			 ['Distance', 'Ethernet', 'Wireless', 'Average'],
			 ['0.3 meter',  93.16,      34.11,         63.63],
			 ['1.5 meter',  92.02,      32.35,        62.18],
			 ['18.3 meter',  87.3,      16.16,        51.73],
			 ['19.5 meter',  85.65,      12.23,        48.94],
		  ]);

		  
		var options = {
		  title : 'Download speed',
		  vAxis: {title: 'Mb/s'},
		  hAxis: {title: 'Distance'},
		  seriesType: 'bars',
		  series: {2: {type: 'line'}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div00'));
		chart.draw(data, options);
	}
	
	google.charts.setOnLoadCallback(drawVisualization01);
	function drawVisualization01() {
        
		var data = google.visualization.arrayToDataTable([
			 ['Distance', 'Ethernet', 'Wireless', 'Average'],
			 ['0.3 meter',  2033.72,      2028.02 ,         2030.87],
			 ['1.5 meter',  2028.02 ,      2022.57 ,        2025.29],
			 ['18.3 meter',  2022.57 ,      2018.02 ,        2020.29],
			 ['19.5 meter',  2013.48 ,      2017.59 ,        2015.53],
		  ]);

		  
		var options = {
		  title : 'Upload speed',
		  vAxis: {title: 'Kb/s'},
		  hAxis: {title: 'Distance'},
		  seriesType: 'bars',
		  series: {2: {type: 'line'}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div01'));
		chart.draw(data, options);
	}
	
	
	google.charts.setOnLoadCallback(drawVisualization10);
	function drawVisualization10() {
        var data = google.visualization.arrayToDataTable([
			 ['Type', 'Tomer', 'Ori', 'Average'],
			 ['Ethernet',  11.36,      18.27,         14.81],
			 ['Wireless',  12.01,      15.94,        13.97],
		  ]);

		var options = {
		  title : 'Download speed',
		  vAxis: {title: 'Mb/s'},
		  hAxis: {title: 'Type of Internet connection'},
		  seriesType: 'bars',
		  series: {2: {type: 'line'}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div10'));
		chart.draw(data, options);
	}
	
	google.charts.setOnLoadCallback(drawVisualization11);
	function drawVisualization11() {
        var data = google.visualization.arrayToDataTable([
			 ['Type', 'Tomer', 'Ori', 'Average'],
			 ['Ethernet',  511.49 ,      1098.04 ,         804.76],
			 ['Wireless',  381.33,      1104.81,        743.07],
		  ]);

		var options = {
		  title : 'Upload speed',
		  vAxis: {title: 'Kb/s'},
		  hAxis: {title: 'Type of Internet connection'},
		  seriesType: 'bars',
		  series: {2: {type: 'line'}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div11'));
		chart.draw(data, options);
	}
	
	google.charts.setOnLoadCallback(drawVisualization20);
	function drawVisualization20() {
        var data = google.visualization.arrayToDataTable([
			 ['Type', 'Tomer', 'Ori', 'Barak', 'Average'],
			 ['Ethernet',  11.35,      8.84,         11.58,             10.59],
			 ['Wireless',  9.61,      8.45,        10.47,             9.51],
		  ]);

		var options = {
		  title : 'Download speed',
		  vAxis: {title: 'Mb/s'},
		  hAxis: {title: 'Type of Internet connection'},
		  seriesType: 'bars',
		  series: {3: {type: 'line'}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div20'));
		chart.draw(data, options);
	}
	
	google.charts.setOnLoadCallback(drawVisualization21);
	function drawVisualization21() {
        var data = google.visualization.arrayToDataTable([
			 ['Type', 'Tomer', 'Ori', 'Barak', 'Average'],
			 ['Ethernet',  510.47 ,      1239.28  ,         633.66 ,             794.47],
			 ['Wireless',  255.49  ,      1200.57 ,        674.97 ,             710.34],
		  ]);

		var options = {
		  title : 'Upload speed',
		  vAxis: {title: 'Kb/s'},
		  hAxis: {title: 'Type of Internet connection'},
		  seriesType: 'bars',
		  series: {3: {type: 'line'}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('chart_div21'));
		chart.draw(data, options);
	}
	
</script>

	</head>
	<body>
		<div class="container">
<?php include('include/nav.php'); ?>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Ethernet vs. Wireless Distance influences</h3>
				</div>
				<div class="panel-body" style="padding: 10px 0;">
					<div id="chart_div00" style="width: 50%; height:300px;float:left;"></div>
					<div id="chart_div01" style="width: 50%; height:300px;float:left;"></div>
				</div>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Load on the network: with 2 computers</h3>
				</div>
				<div class="panel-body" style="padding: 10px 0;">
					<div id="chart_div10" style="width: 50%; height:300px;float:left;"></div>
					<div id="chart_div11" style="width: 50%; height:300px;float:left;"></div>
				</div>
			</div>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Load on the network: with 3 computers</h3>
				</div>
				<div class="panel-body" style="padding: 10px 0;">
					<div id="chart_div20" style="width: 50%; height:300px;float:left;"></div>
					<div id="chart_div21" style="width: 50%; height:300px;float:left;"></div>
				</div>
			</div>
			<?php
			// print_r($speedtest->getSpeedTest());
			/*
			$tests = $speedtest->getSpeedTest();
			
			if (is_array($tests) && !empty($tests)) {
				foreach ($tests as $positionKey => $position) {
					?>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title"><?php echo $position['name'] . " - " . $position['provider']; ?></h3>
				</div>
				<div class="panel-body">
					<?php
					
					if (isset($position['speedTest']) && is_array($position['speedTest']) && !empty($position['speedTest'])) {
						echo '
<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2">#</th>
			<th rowspan="2">Computer name</th>
			<th rowspan="2">Distance</th>
			<th colspan="3" class="spanTypeTest">Download speed</th>
			<th colspan="3" class="spanTypeTest">Upload speed</th>
			<th colspan="3" class="spanTypeTest">Ping time</th>
		</tr>
		<tr>
			<th>Average</th>
			<th>Median</th>
			<th>Max</th>
			<th>Average</th>
			<th>Median</th>
			<th>Max</th>
			<th>Average</th>
			<th>Median</th>
			<th>Min</th>
		</tr>
	</thead>
	<tbody>
						';
						$counter = 1;
						foreach ($position['speedTest'] as $test) {
							// print_r($test);
							echo '
		<tr data-toggle="modal" data-target="#editSpeedTest" data-id="' . $test['id'] . '" class="testRow">
			<th scope="row">' . $counter .'</th>
			<td>' . $test['device']['device_name'] . ' - ' . $test['device']['internet_type'] . '</td>
			<td>' . $test['internet_distance'] . '</td>
			<td>' . $test['downloadSpeedAverage'] . ' Mb/s</td>
			<td>' . $test['downloadSpeedMedian'] . ' Mb/s</td>
			<td>' . $test['downloadSpeedMax'] . ' Mb/s</td>
			<td>' . $test['uploadSpeedAverage'] . ' Kb/s</td>
			<td>' . $test['uploadSpeedMedian'] . ' Kb/s</td>
			<td>' . $test['uploadSpeedMax'] . ' Kb/s</td>
			<td>' . $test['pingSpeedAverage'] . ' ms</td>
			<td>' . $test['pingSpeedMedian'] . ' ms</td>
			<td>' . $test['pingSpeedMin'] . ' ms</td>
		</tr>
							';
							$counter++;
						}
						echo '</tbody></table>';
					} else echo 'empty..';
					
					?>
				</div>
			</div>
					<?php
				}
			}
			
			?>
<div class="modal fade " id="editSpeedTest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg"" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit SpeedTest</h4>
			</div>
			<form id="editSpeedTestForm">
				<input type="hidden" class="form-control positionId" id="editSpeedTestFormId" placeholder="id">
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="editSpeedTestFormDevice">Device</label>
								<select class="form-control" id="editSpeedTestFormDevice">
									<?php
									$devices = $speedtest->get_device();
									if (is_array($devices) && !empty($devices))
										foreach($devices as $k => $device)
											echo '<option value="' . $device['id'] . '">' . $device['device_name'] . ' - ' . $speedtest->internet_type[$device['internet_type']] . '</option>';
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="editSpeedTestFormPosition">Position</label>
								<select class="form-control" id="editSpeedTestFormPosition">
									<?php
									$positions = $speedtest->get_position();
									if (is_array($positions) && !empty($positions))
										foreach($positions as $k => $position)
											echo '<option value="' . $position['id'] . '">' . $position['name'] . '</option>';
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="editSpeedTestFormInternetDistance">Internet source distance</label>
								<input type="number" step="0.01" class="form-control" id="editSpeedTestFormInternetDistance" placeholder="distance">
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-4 speedTestResults">
							<p>Download speed: <span id="downloadSpeedLive" class="speedNum">0</span> Mb/s</p>
							<p>Download speed average: <span id="downloadSpeedAverage" class="speedNum">0</span> Mb/s</p>
							<p>Download speed median: <span id="downloadSpeedMedian" class="speedNum">0</span> Mb/s</p>
							<p>Download speed max: <span id="downloadSpeedMax" class="speedNum">0</span> Mb/s</p>
						</div>
						<div class="col-md-4 speedTestResults">
							<p>Upload speed: <span id="uploadSpeedLive" class="speedNum">0</span> Kb/s</p>
							<p>Upload speed average: <span id="uploadSpeedAverage" class="speedNum">0</span> Kb/s</p>
							<p>Upload speed median: <span id="uploadSpeedMedian" class="speedNum">0</span> Kb/s</p>
							<p>Upload speed max: <span id="uploadSpeedMax" class="speedNum">0</span> Kb/s</p>
						</div>
						<div class="col-md-4 speedTestResults">
							<p>Ping speed: <span id="pingSpeedLive" class="speedNum">0</span> ms</p>
							<p>Ping speed average: <span id="pingSpeedAverage" class="speedNum">0</span> ms</p>
							<p>Ping speed median: <span id="pingSpeedMedian" class="speedNum">0</span> ms</p>
							<p>Ping speed min: <span id="pingSpeedMin" class="speedNum">0</span> ms</p>
						</div>
					</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="php/action/deleteTest.php?id=" class="btn btn-warning delete-confirm">Delete</a>
					<button type="button" class="btn btn-primary startSpeedTest">Start SpeedTest</button>
					<button type="submit" class="btn btn-info">Save changes <i class="fa fa-angle-double-right"></i></button>
				</div>
			</form>
			<div class="modal-body text-center" id="editSpeedTestLoading" style="font-size: 32px;padding: 40px 15px;">
				<i class="fa fa-spinner fa-spin" style="margin-right: 10px;"></i>
				Please wait
			</div>
		</div>
	</div>
</div>
<?php */ ?>
<?php include('include/footer.php'); ?>
			
		</div>
	
<?php include('include/footer_script.php'); ?>

	</body>
</html>