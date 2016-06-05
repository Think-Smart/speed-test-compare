<?php

require_once 'php/config.php';

$speedtest = new speedtest();

?>
<!DOCTYPE html>
<html DIR="LTR" LANG="en">
	<head>
<?php include('include/head.php'); ?>
	</head>
	<body class="runSpeedTest">
		<div class="container">
<?php include('include/nav.php'); ?>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Make SpeedTest</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<form id="makeSpeedTest">
							<div class="col-md-4">
								<div class="form-group">
									<label for="makeSpeedTesDevice">Device</label>
									<select class="form-control" id="makeSpeedTesDevice">
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
									<label for="makeSpeedTestPosition">Position</label>
									<select class="form-control" id="makeSpeedTestPosition">
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
									<label for="makeSpeedTestInternetDistance">Internet source distance</label>
									<input type="number" step="0.1" class="form-control" id="makeSpeedTestInternetDistance" placeholder="distance">
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
							<div class="col-md-12" style="margin-top: 20px;">
								<button type="button" class="btn btn-primary btn-lg startSpeedTest" style="margin-right: 15px;">Start SpeedTest</button>
								<button type="submit" class="btn btn-info btn-lg">Save <i class="fa fa-angle-double-right"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			
<?php include('include/footer.php'); ?>
			
		</div>
	
<?php include('include/footer_script.php'); ?>

	</body>
</html>