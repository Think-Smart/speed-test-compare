<?php

require_once 'php/config.php';

$speedtest = new speedtest();

?>
<!DOCTYPE html>
<html DIR="LTR" LANG="en">
	<head>
<?php include('include/head.php'); ?>
	</head>
	<body>
		<div class="container">
<?php include('include/nav.php'); ?>
			
			<?php
			// print_r($speedtest->getSpeedTest());
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

<?php include('include/footer.php'); ?>
			
		</div>
	
<?php include('include/footer_script.php'); ?>

	</body>
</html>